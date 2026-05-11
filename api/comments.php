<?php

declare(strict_types=1);

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true) ?? [];
$db = getDbConnection();

if ($method === 'PUT') {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        sendResponse(jsonError('ID de comentario requerido'), 400);
    }

    if (!validateUuid($id)) {
        sendResponse(jsonError('ID de comentario inválido'), 400);
    }

    $check = $db->prepare('SELECT * FROM comments WHERE id = :id');
    $check->execute([':id' => $id]);
    $comment = $check->fetch();
    if (!$comment) {
        sendResponse(jsonError('Comentario no encontrado'), 404);
    }

    $content = trim($input['content'] ?? '');
    if ($content === '') {
        sendResponse(jsonError('El contenido es requerido'), 400);
    }
    if (strlen($content) > 10000) {
        sendResponse(jsonError('El contenido debe tener 10000 caracteres o menos'), 400);
    }

    $stmt = $db->prepare('
        UPDATE comments SET content = :content, updated_at = NOW() WHERE id = :id RETURNING *
    ');
    $stmt->execute([':content' => $content, ':id' => $id]);
    $updated = $stmt->fetch();

    sendResponse(jsonSuccess($updated));
}

if ($method === 'DELETE') {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        sendResponse(jsonError('ID de comentario requerido'), 400);
    }

    if (!validateUuid($id)) {
        sendResponse(jsonError('ID de comentario inválido'), 400);
    }

    $check = $db->prepare('SELECT id FROM comments WHERE id = :id');
    $check->execute([':id' => $id]);
    if (!$check->fetch()) {
        sendResponse(jsonError('Comentario no encontrado'), 404);
    }

    $db->prepare('DELETE FROM comments WHERE id = :id')->execute([':id' => $id]);

    http_response_code(204);
    exit;
}

sendResponse(jsonError('Método no permitido'), 405);