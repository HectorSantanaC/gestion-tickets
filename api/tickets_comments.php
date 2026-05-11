<?php

declare(strict_types=1);

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true) ?? [];
$db = getDbConnection();

$ticketId = $_GET['ticket_id'] ?? null;

if (!$ticketId) {
    sendResponse(jsonError('ID de ticket requerido'), 400);
}

$check = $db->prepare('SELECT id FROM tickets WHERE id = :id');
$check->execute([':id' => $ticketId]);
if (!$check->fetch()) {
    sendResponse(jsonError('Ticket no encontrado'), 404);
}

if ($method === 'GET') {
    $stmt = $db->prepare('
        SELECT * FROM comments
        WHERE ticket_id = :ticket_id
        ORDER BY created_at ASC
    ');
    $stmt->execute([':ticket_id' => $ticketId]);
    $comments = $stmt->fetchAll();

    sendResponse(jsonSuccess($comments));
}

if ($method === 'POST') {
    $missing = validateRequired($input, ['author_external_id', 'content']);
    if ($missing) {
        sendResponse(jsonError('Campos requeridos faltantes: ' . implode(', ', $missing)), 400);
    }

    $content = trim($input['content']);
    if ($content === '') {
        sendResponse(jsonError('El contenido es requerido'), 400);
    }
    if (strlen($content) > 10000) {
        sendResponse(jsonError('El contenido debe tener 10000 caracteres o menos'), 400);
    }

    $authorExternalId = (int) $input['author_external_id'];
    if ($authorExternalId <= 0) {
        sendResponse(jsonError('author_external_id debe ser un entero positivo'), 400);
    }

    $stmt = $db->prepare('
        INSERT INTO comments (ticket_id, author_external_id, content)
        VALUES (:ticket, :author, :content)
        RETURNING *
    ');
    $stmt->execute([
        ':ticket' => $ticketId,
        ':author' => $authorExternalId,
        ':content' => $content,
    ]);
    $comment = $stmt->fetch();

    sendResponse(jsonSuccess($comment), 201);
}

sendResponse(jsonError('Método no permitido'), 405);