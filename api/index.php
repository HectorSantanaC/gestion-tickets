<?php

declare(strict_types=1);

require_once __DIR__ . '/config/headers.php';
require_once __DIR__ . '/helpers/response.php';
require_once __DIR__ . '/helpers/pagination.php';
require_once __DIR__ . '/helpers/validator.php';
require_once __DIR__ . '/../includes/config/db.php';

$uri = $_SERVER['REQUEST_URI'];
$basePath = '/api/';

if (strpos($uri, $basePath) !== 0) {
    sendResponse(jsonError('Not Found', 404));
}

$path = substr($uri, strlen($basePath));
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

$resourceFile = __DIR__ . '/' . $resource . '.php';

if (!file_exists($resourceFile)) {
    sendResponse(jsonError('Not Found', 404));
}

require_once $resourceFile;