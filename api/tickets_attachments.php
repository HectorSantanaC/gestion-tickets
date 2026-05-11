<?php

declare(strict_types=1);

$method = $_SERVER['REQUEST_METHOD'];
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
        SELECT * FROM attachments
        WHERE ticket_id = :ticket_id
        ORDER BY created_at DESC
    ');
    $stmt->execute([':ticket_id' => $ticketId]);
    $attachments = $stmt->fetchAll();

    sendResponse(jsonSuccess($attachments));
}

if ($method === 'POST') {
    $uploaderId = isset($_POST['uploader_external_id']) ? (int) $_POST['uploader_external_id'] : null;
    if (!$uploaderId || $uploaderId <= 0) {
        sendResponse(jsonError('uploader_external_id debe ser un entero positivo'), 400);
    }

    $commentId = null;
    if (!empty($_POST['comment_id'])) {
        if (!validateUuid($_POST['comment_id'])) {
            sendResponse(jsonError('ID de comentario inválido'), 400);
        }
        $commentCheck = $db->prepare('SELECT id FROM comments WHERE id = :id AND ticket_id = :ticket');
        $commentCheck->execute([':id' => $_POST['comment_id'], ':ticket' => $ticketId]);
        if (!$commentCheck->fetch()) {
            sendResponse(jsonError('Comentario no encontrado'), 404);
        }
        $commentId = $_POST['comment_id'];
    }

    if (empty($_FILES['file'])) {
        sendResponse(jsonError('El archivo es requerido'), 400);
    }

    $file = $_FILES['file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        sendResponse(jsonError('Error al subir el archivo'), 400);
    }

    $allowedTypes = ['image/png', 'image/jpeg', 'application/pdf'];
    if (!in_array($file['type'], $allowedTypes, true)) {
        sendResponse(jsonError('Tipo de archivo no permitido. Permitidos: PNG, JPG, JPEG, PDF'), 400);
    }

    $maxSize = 10 * 1024 * 1024;
    if ($file['size'] > $maxSize) {
        sendResponse(jsonError('El tamaño del archivo excede el límite (10MB)'), 400);
    }

    $originalName = basename($file['name']);
    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
    $uuid = bin2hex(random_bytes(16));
    $safeName = $uuid . '.' . $extension;
    $uploadDir = __DIR__ . '/../uploads/' . $ticketId;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $uploadPath = $uploadDir . '/' . $safeName;
    if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
        sendResponse(jsonError('Error al guardar el archivo'), 500);
    }

    $relativePath = 'uploads/' . $ticketId . '/' . $safeName;

    $stmt = $db->prepare('
        INSERT INTO attachments (ticket_id, comment_id, filename, file_path, file_size, mime_type, uploader_external_id)
        VALUES (:ticket, :comment, :filename, :path, :size, :mime, :uploader)
        RETURNING *
    ');
    $stmt->execute([
        ':ticket' => $ticketId,
        ':comment' => $commentId,
        ':filename' => $originalName,
        ':path' => $relativePath,
        ':size' => $file['size'],
        ':mime' => $file['type'],
        ':uploader' => $uploaderId,
    ]);
    $attachment = $stmt->fetch();

    sendResponse(jsonSuccess($attachment), 201);
}

sendResponse(jsonError('Método no permitido'), 405);