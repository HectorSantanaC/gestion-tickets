<?php

declare(strict_types=1);

require_once __DIR__ . '/config/headers.php';
require_once __DIR__ . '/helpers/response.php';
require_once __DIR__ . '/helpers/pagination.php';
require_once __DIR__ . '/helpers/validator.php';
require_once __DIR__ . '/helpers/auth.php';
require_once __DIR__ . '/../config/db.php';

$uri = $_SERVER['REQUEST_URI'] ?? '/';

// Detect base path (works in subdirectory or root)
$docRoot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/');
$projectDir = str_replace('\\', '/', dirname(__DIR__));
$basePath = str_replace($docRoot, '', $projectDir);
$apiPath = '/api/';

$path = substr($uri, strlen($basePath) + strlen($apiPath));
$segments = explode('?', $path);
$resource = $segments[0];
$resource = trim($resource, '/');

if ($resource === '' || $resource === 'index.php') {
    sendResponse([
        'message' => 'Gestion Tickets API',
        'version' => '1.0',
        'endpoints' => [
            'GET  /api/categories',
            'GET  /api/categories/{id}',
            'POST /api/categories',
            'PUT  /api/categories?id={id}',
            'DELETE /api/categories?id={id}',
            'GET  /api/tags',
            'GET  /api/tags/{id}',
            'POST /api/tags',
            'PUT  /api/tags?id={id}',
            'DELETE /api/tags?id={id}',
            'GET  /api/tickets',
            'GET  /api/tickets/{id}',
            'POST /api/tickets',
            'PUT  /api/tickets?id={id}',
            'DELETE /api/tickets?id={id}',
            'GET  /api/tickets/{id}/comments',
            'POST /api/tickets/{id}/comments',
            'PUT  /api/comments?id={id}',
            'DELETE /api/comments?id={id}',
            'GET  /api/tickets/{id}/attachments',
            'POST /api/tickets/{id}/attachments',
            'DELETE /api/attachments?id={id}',
        ],
    ]);
}

if (preg_match('#^tickets/([a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12})/(comments|attachments)$#', $resource, $matches)) {
    $ticketId = $matches[1];
    $subResource = $matches[2];
    $_GET['ticket_id'] = $ticketId;
    require_once __DIR__ . '/tickets_' . $subResource . '.php';
    exit;
}

$publicRoutes = ['auth/login', 'auth/logout'];
if (!in_array($resource, $publicRoutes, true)) {
    requireAuth();
    requireAnyRole(['admin', 'administracion', 'gestor', 'medico']);
}

$resourceFile = __DIR__ . '/' . $resource . '.php';

if (!file_exists($resourceFile)) {
    sendResponse(jsonError('Recurso no encontrado'), 404);
}

require_once $resourceFile;