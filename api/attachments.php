<?php

declare(strict_types=1);

$method = $_SERVER['REQUEST_METHOD'];
$db = getDbConnection();

if ($method === 'DELETE') {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        sendResponse(jsonError('ID de adjunto requerido'), 400);
    }

    if (!validateUuid($id)) {
        sendResponse(jsonError('ID de adjunto inválido'), 400);
    }

    $check = $db->prepare('SELECT * FROM attachments WHERE id = :id');
    $check->execute([':id' => $id]);
    $attachment = $check->fetch();
    if (!$attachment) {
        sendResponse(jsonError('Adjunto no encontrado'), 404);
    }

    $filePath = __DIR__ . '/../' . $attachment['file_path'];
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    $dir = dirname($filePath);
    if (is_dir($dir)) {
        $files = glob($dir . '/*');
        if (count($files) === 0) {
            rmdir($dir);
        }
    }

    $db->prepare('DELETE FROM attachments WHERE id = :id')->execute([':id' => $id]);

    http_response_code(204);
    exit;
}

sendResponse(jsonError('Método no permitido'), 405);