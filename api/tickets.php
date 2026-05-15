<?php

declare(strict_types=1);

require_once __DIR__ . '/../includes/ticket_number_generator.php';

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true) ?? [];
$db = getDbConnection();

$validStatuses = ['abierta', 'en_progreso', 'pendiente_verificacion', 'resuelta', 'cerrada'];
$validPriorities = ['baja', 'normal', 'alta', 'urgente'];
$validPrefixes = ['TIC', 'INC', 'REQ', 'BUG'];

function getTicketWithRelations(PDO $db, string $id): ?array
{
    $stmt = $db->prepare('
        SELECT t.*, c.name as category_name
        FROM tickets t
        LEFT JOIN categories c ON t.category_id = c.id
        WHERE t.id = :id
    ');
    $stmt->execute([':id' => $id]);
    $ticket = $stmt->fetch();

    if (!$ticket) {
        return null;
    }

    if ($ticket['category_id']) {
        $ticket['category'] = [
            'id' => $ticket['category_id'],
            'name' => $ticket['category_name'],
        ];
    }
    unset($ticket['category_name']);

    $tagsStmt = $db->prepare('
        SELECT tg.id, tg.name
        FROM ticket_tags tt
        JOIN tags tg ON tt.tag_id = tg.id
        WHERE tt.ticket_id = :id
    ');
    $tagsStmt->execute([':id' => $id]);
    $ticket['tags'] = $tagsStmt->fetchAll();

    return $ticket;
}

if ($method === 'GET') {
    $id = $_GET['id'] ?? null;

    if ($id) {
        if (!validateUuid($id)) {
            sendResponse(jsonError('ID de ticket inválido'), 400);
        }

        $ticket = getTicketWithRelations($db, $id);

        if (!$ticket) {
            sendResponse(jsonError('Ticket no encontrado'), 404);
        }

        $usersMap = $_SESSION['users_map'] ?? [];
        $ticket['reporter_name'] = $usersMap[$ticket['reporter_external_id']] ?? 'Usuario #' . $ticket['reporter_external_id'];
        $ticket['reporter_initial'] = mb_strtoupper(mb_substr($ticket['reporter_name'], 0, 1));
        $ticket['assignee_name'] = $ticket['assignee_external_id'] ? ($usersMap[$ticket['assignee_external_id']] ?? 'Agente #' . $ticket['assignee_external_id']) : null;
        $ticket['assignee_initial'] = $ticket['assignee_name'] ? mb_strtoupper(mb_substr($ticket['assignee_name'], 0, 1)) : null;

        sendResponse(jsonSuccess($ticket));
    }

    $where = [];
    $params = [];

    if (!empty($_GET['status']) && validateEnum($_GET['status'], $GLOBALS['validStatuses'])) {
        $where[] = 't.status = :status';
        $params[':status'] = $_GET['status'];
    }

    if (!empty($_GET['priority']) && validateEnum($_GET['priority'], $GLOBALS['validPriorities'])) {
        $where[] = 't.priority = :priority';
        $params[':priority'] = $_GET['priority'];
    }

    if (!empty($_GET['category_id'])) {
        if (!validateUuid($_GET['category_id'])) {
            sendResponse(jsonError('category_id inválido'), 400);
        }
        $where[] = 't.category_id = :category_id';
        $params[':category_id'] = $_GET['category_id'];
    }

    if (!empty($_GET['reporter_external_id'])) {
        $where[] = 't.reporter_external_id = :reporter';
        $params[':reporter'] = (int) $_GET['reporter_external_id'];
    }

    if (!empty($_GET['assignee_external_id'])) {
        $where[] = 't.assignee_external_id = :assignee';
        $params[':assignee'] = (int) $_GET['assignee_external_id'];
    }

    $whereClause = $where ? 'WHERE ' . implode(' AND ', $where) : '';

    $countStmt = $db->prepare("SELECT COUNT(*) FROM tickets t $whereClause");
    $countStmt->execute($params);
    $total = (int) $countStmt->fetchColumn();

    $pagination = getPaginationParams();
    $offset = ($pagination['page'] - 1) * $pagination['per_page'];

    $query = "
        SELECT t.*
        FROM tickets t
        $whereClause
        ORDER BY t.created_at DESC
        LIMIT :limit OFFSET :offset
    ";
    $stmt = $db->prepare($query);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':limit', $pagination['per_page'], PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $tickets = $stmt->fetchAll();

    foreach ($tickets as &$ticket) {
        $categoryStmt = $db->prepare('SELECT id, name FROM categories WHERE id = :id');
        $categoryStmt->execute([':id' => $ticket['category_id']]);
        $cat = $categoryStmt->fetch();
        if ($cat) {
            $ticket['category'] = $cat;
        }

        $tagsStmt = $db->prepare('
            SELECT tg.id, tg.name
            FROM ticket_tags tt
            JOIN tags tg ON tt.tag_id = tg.id
            WHERE tt.ticket_id = :id
        ');
        $tagsStmt->execute([':id' => $ticket['id']]);
        $ticket['tags'] = $tagsStmt->fetchAll();
    }

    $usersMap = $_SESSION['users_map'] ?? [];
    foreach ($tickets as &$t) {
        $t['reporter_name'] = $usersMap[$t['reporter_external_id']] ?? 'Usuario #' . $t['reporter_external_id'];
        $t['reporter_initial'] = mb_strtoupper(mb_substr($t['reporter_name'], 0, 1));
        $t['assignee_name'] = $t['assignee_external_id'] ? ($usersMap[$t['assignee_external_id']] ?? 'Agente #' . $t['assignee_external_id']) : null;
        $t['assignee_initial'] = $t['assignee_name'] ? mb_strtoupper(mb_substr($t['assignee_name'], 0, 1)) : null;
    }

    $meta = buildPaginationMeta($pagination['page'], $pagination['per_page'], $total);
    sendResponse(jsonPaginated($tickets, $meta));
}

if ($method === 'POST') {
    $missing = validateRequired($input, ['subject', 'reporter_external_id']);
    if ($missing) {
        sendResponse(jsonError('Campos requeridos faltantes: ' . implode(', ', $missing)), 400);
    }

    $subject = trim($input['subject']);
    if (strlen($subject) > 500) {
        sendResponse(jsonError('El asunto debe tener 500 caracteres o menos'), 400);
    }

    $reporterExternalId = (int) $input['reporter_external_id'];
    if ($reporterExternalId <= 0) {
        sendResponse(jsonError('reporter_external_id debe ser un entero positivo'), 400);
    }

    $description = trim($input['description'] ?? '');
    $status = $input['status'] ?? 'abierta';
    $priority = $input['priority'] ?? 'normal';
    $assigneeExternalId = isset($input['assignee_external_id']) ? (int) $input['assignee_external_id'] : null;
    $impactLevel = trim($input['impact_level'] ?? '');
    $prefix = strtoupper($input['prefix'] ?? 'TIC');
    $tags = $input['tags'] ?? [];

    if (!validateEnum($status, $validStatuses)) {
        sendResponse(jsonError('Estado inválido. Valores válidos: ' . implode(', ', $validStatuses)), 400);
    }

    if (!validateEnum($priority, $validPriorities)) {
        sendResponse(jsonError('Prioridad inválida. Valores válidos: ' . implode(', ', $validPriorities)), 400);
    }

    if (!in_array($prefix, $validPrefixes, true)) {
        sendResponse(jsonError('Prefijo inválido. Valores válidos: ' . implode(', ', $validPrefixes)), 400);
    }

    $categoryId = null;
    if (!empty($input['category_id'])) {
        if (!validateUuid($input['category_id'])) {
            sendResponse(jsonError('category_id inválido'), 400);
        }
        $catCheck = $db->prepare('SELECT id FROM categories WHERE id = :id');
        $catCheck->execute([':id' => $input['category_id']]);
        if (!$catCheck->fetch()) {
            sendResponse(jsonError('Categoría no encontrada'), 404);
        }
        $categoryId = $input['category_id'];
    }

    foreach ($tags as $tagId) {
        if (!validateUuid($tagId)) {
            sendResponse(jsonError('ID de tag inválido: ' . $tagId), 400);
        }
        $tagCheck = $db->prepare('SELECT id FROM tags WHERE id = :id');
        $tagCheck->execute([':id' => $tagId]);
        if (!$tagCheck->fetch()) {
            sendResponse(jsonError('Tag no encontrado: ' . $tagId), 404);
        }
    }

    $ticketNumber = generateTicketNumber($db, $prefix);

    $stmt = $db->prepare('
        INSERT INTO tickets (ticket_number, subject, description, status, priority, category_id, reporter_external_id, assignee_external_id, impact_level)
        VALUES (:num, :subject, :desc, :status, :priority, :cat, :reporter, :assignee, :impact)
        RETURNING *
    ');
    $stmt->execute([
        ':num' => $ticketNumber,
        ':subject' => $subject,
        ':desc' => $description,
        ':status' => $status,
        ':priority' => $priority,
        ':cat' => $categoryId,
        ':reporter' => $reporterExternalId,
        ':assignee' => $assigneeExternalId,
        ':impact' => $impactLevel ?: null,
    ]);
    $ticket = $stmt->fetch();

    $historyStmt = $db->prepare('
        INSERT INTO ticket_history (ticket_id, user_external_id, action_type, new_value)
        VALUES (:ticket, :user, :action, :new)
    ');
    $historyStmt->execute([
        ':ticket' => $ticket['id'],
        ':user' => $reporterExternalId,
        ':action' => 'created',
        ':new' => 'Ticket creado',
    ]);

    if ($tags) {
        $tagInsert = $db->prepare('INSERT INTO ticket_tags (ticket_id, tag_id) VALUES (:ticket, :tag)');
        foreach ($tags as $tagId) {
            $tagInsert->execute([':ticket' => $ticket['id'], ':tag' => $tagId]);
        }
    }

    $ticket['tags'] = $tags;
    sendResponse(jsonSuccess(getTicketWithRelations($db, $ticket['id'])), 201);
}

if ($method === 'PUT') {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        sendResponse(jsonError('ID de ticket requerido'), 400);
    }

    if (!validateUuid($id)) {
        sendResponse(jsonError('ID de ticket inválido'), 400);
    }

    $check = $db->prepare('SELECT * FROM tickets WHERE id = :id');
    $check->execute([':id' => $id]);
    $ticket = $check->fetch();
    if (!$ticket) {
        sendResponse(jsonError('Ticket no encontrado'), 404);
    }

    $subject = isset($input['subject']) ? trim($input['subject']) : $ticket['subject'];
    if (strlen($subject) > 500) {
        sendResponse(jsonError('El asunto debe tener 500 caracteres o menos'), 400);
    }

    $description = isset($input['description']) ? trim($input['description']) : $ticket['description'];
    $status = isset($input['status']) ? $input['status'] : $ticket['status'];
    $priority = isset($input['priority']) ? $input['priority'] : $ticket['priority'];
    $assigneeExternalId = array_key_exists('assignee_external_id', $input) ? (int) $input['assignee_external_id'] : $ticket['assignee_external_id'];
    $impactLevel = isset($input['impact_level']) ? trim($input['impact_level']) : $ticket['impact_level'];
    $tags = array_key_exists('tags', $input) ? $input['tags'] : null;

    $categoryId = $ticket['category_id'];
    if (array_key_exists('category_id', $input)) {
        if ($input['category_id'] === null) {
            $categoryId = null;
        } else {
            if (!validateUuid($input['category_id'])) {
                sendResponse(jsonError('category_id inválido'), 400);
            }
            $catCheck = $db->prepare('SELECT id FROM categories WHERE id = :id');
            $catCheck->execute([':id' => $input['category_id']]);
            if (!$catCheck->fetch()) {
                sendResponse(jsonError('Categoría no encontrada'), 404);
            }
            $categoryId = $input['category_id'];
        }
    }

    if (!validateEnum($status, $validStatuses)) {
        sendResponse(jsonError('Estado inválido. Valores válidos: ' . implode(', ', $validStatuses)), 400);
    }

    if (!validateEnum($priority, $validPriorities)) {
        sendResponse(jsonError('Prioridad inválida. Valores válidos: ' . implode(', ', $validPriorities)), 400);
    }

    if ($tags !== null) {
        foreach ($tags as $tagId) {
            if (!validateUuid($tagId)) {
                sendResponse(jsonError('ID de tag inválido: ' . $tagId), 400);
            }
            $tagCheck = $db->prepare('SELECT id FROM tags WHERE id = :id');
            $tagCheck->execute([':id' => $tagId]);
            if (!$tagCheck->fetch()) {
                sendResponse(jsonError('Tag no encontrado: ' . $tagId), 404);
            }
        }
    }

    $historyRecords = [];

    if ($status !== $ticket['status']) {
        $historyRecords[] = [
            'action' => 'status_change',
            'old' => $ticket['status'],
            'new' => $status,
        ];
    }

    if ($priority !== $ticket['priority']) {
        $historyRecords[] = [
            'action' => 'priority_change',
            'old' => $ticket['priority'],
            'new' => $priority,
        ];
    }

    if ($assigneeExternalId !== $ticket['assignee_external_id']) {
        $historyRecords[] = [
            'action' => 'assignment',
            'old' => $ticket['assignee_external_id'] ? (string) $ticket['assignee_external_id'] : '',
            'new' => $assigneeExternalId ? (string) $assigneeExternalId : '',
        ];
    }

    $stmt = $db->prepare('
        UPDATE tickets
        SET subject = :subject, description = :desc, status = :status, priority = :priority,
            category_id = :cat, assignee_external_id = :assignee, impact_level = :impact, updated_at = NOW()
        WHERE id = :id
        RETURNING *
    ');
    $stmt->execute([
        ':subject' => $subject,
        ':desc' => $description,
        ':status' => $status,
        ':priority' => $priority,
        ':cat' => $categoryId,
        ':assignee' => $assigneeExternalId,
        ':impact' => $impactLevel ?: null,
        ':id' => $id,
    ]);

    $historyStmt = $db->prepare('
        INSERT INTO ticket_history (ticket_id, user_external_id, action_type, old_value, new_value)
        VALUES (:ticket, :user, :action, :old, :new)
    ');
    foreach ($historyRecords as $record) {
        $historyStmt->execute([
            ':ticket' => $id,
            ':user' => $ticket['reporter_external_id'],
            ':action' => $record['action'],
            ':old' => $record['old'],
            ':new' => $record['new'],
        ]);
    }

    if ($tags !== null) {
        $db->prepare('DELETE FROM ticket_tags WHERE ticket_id = :id')->execute([':id' => $id]);
        if ($tags) {
            $tagInsert = $db->prepare('INSERT INTO ticket_tags (ticket_id, tag_id) VALUES (:ticket, :tag)');
            foreach ($tags as $tagId) {
                $tagInsert->execute([':ticket' => $id, ':tag' => $tagId]);
            }
        }
    }

    sendResponse(jsonSuccess(getTicketWithRelations($db, $id)));
}

if ($method === 'DELETE') {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        sendResponse(jsonError('ID de ticket requerido'), 400);
    }

    if (!validateUuid($id)) {
        sendResponse(jsonError('ID de ticket inválido'), 400);
    }

    $check = $db->prepare('SELECT id FROM tickets WHERE id = :id');
    $check->execute([':id' => $id]);
    if (!$check->fetch()) {
        sendResponse(jsonError('Ticket no encontrado'), 404);
    }

    $db->prepare('DELETE FROM tickets WHERE id = :id')->execute([':id' => $id]);

    http_response_code(204);
    exit;
}

sendResponse(jsonError('Método no permitido'), 405);