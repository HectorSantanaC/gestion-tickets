<?php

declare(strict_types=1);

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true) ?? [];
$db = getDbConnection();

if ($method === 'GET') {
    $id = $_GET['id'] ?? null;

    if ($id) {
        if (!validateUuid($id)) {
            sendResponse(jsonError('ID de tag inválido'), 400);
        }

        $stmt = $db->prepare('SELECT * FROM tags WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $tag = $stmt->fetch();

        if (!$tag) {
            sendResponse(jsonError('Tag no encontrado'), 404);
        }

        sendResponse(jsonSuccess($tag));
    }

    $stmt = $db->query('SELECT * FROM tags ORDER BY name ASC');
    $tags = $stmt->fetchAll();

    sendResponse(jsonSuccess($tags));
}

if ($method === 'POST') {
    $missing = validateRequired($input, ['name']);
    if ($missing) {
        sendResponse(jsonError('Campos requeridos faltantes: ' . implode(', ', $missing)), 400);
    }

    $name = trim($input['name']);
    if (strlen($name) > 50) {
        sendResponse(jsonError('El nombre debe tener 50 caracteres o menos'), 400);
    }

    $check = $db->prepare('SELECT id FROM tags WHERE LOWER(name) = LOWER(:name)');
    $check->execute([':name' => $name]);
    if ($check->fetch()) {
        sendResponse(jsonError('Ya existe un tag con este nombre'), 400);
    }

    $stmt = $db->prepare('INSERT INTO tags (name) VALUES (:name) RETURNING *');
    $stmt->execute([':name' => $name]);
    $tag = $stmt->fetch();

    sendResponse(jsonSuccess($tag), 201);
}

if ($method === 'PUT') {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        sendResponse(jsonError('ID de tag requerido'), 400);
    }

    if (!validateUuid($id)) {
        sendResponse(jsonError('ID de tag inválido'), 400);
    }

    $check = $db->prepare('SELECT id FROM tags WHERE id = :id');
    $check->execute([':id' => $id]);
    if (!$check->fetch()) {
        sendResponse(jsonError('Tag no encontrado'), 404);
    }

    $missing = validateRequired($input, ['name']);
    if ($missing) {
        sendResponse(jsonError('Campos requeridos faltantes: ' . implode(', ', $missing)), 400);
    }

    $name = trim($input['name']);
    if (strlen($name) > 50) {
        sendResponse(jsonError('El nombre debe tener 50 caracteres o menos'), 400);
    }

    $checkName = $db->prepare('SELECT id FROM tags WHERE LOWER(name) = LOWER(:name) AND id != :id');
    $checkName->execute([':name' => $name, ':id' => $id]);
    if ($checkName->fetch()) {
        sendResponse(jsonError('Ya existe un tag con este nombre'), 400);
    }

    $stmt = $db->prepare('UPDATE tags SET name = :name WHERE id = :id RETURNING *');
    $stmt->execute([':name' => $name, ':id' => $id]);
    $tag = $stmt->fetch();

    sendResponse(jsonSuccess($tag));
}

if ($method === 'DELETE') {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        sendResponse(jsonError('ID de tag requerido'), 400);
    }

    if (!validateUuid($id)) {
        sendResponse(jsonError('ID de tag inválido'), 400);
    }

    $check = $db->prepare('SELECT id FROM tags WHERE id = :id');
    $check->execute([':id' => $id]);
    if (!$check->fetch()) {
        sendResponse(jsonError('Tag no encontrado'), 404);
    }

    $used = $db->prepare('SELECT 1 FROM ticket_tags WHERE tag_id = :id LIMIT 1');
    $used->execute([':id' => $id]);
    if ($used->fetch()) {
        sendResponse(jsonError('No se puede eliminar un tag asignado a tickets'), 400);
    }

    $db->prepare('DELETE FROM tags WHERE id = :id')->execute([':id' => $id]);

    http_response_code(204);
    exit;
}

sendResponse(jsonError('Método no permitido'), 405);