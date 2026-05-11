<?php

declare(strict_types=1);

function jsonSuccess(mixed $data): array
{
    return ['data' => $data];
}

function jsonError(string $message): array
{
    return ['error' => $message];
}

function jsonPaginated(array $data, array $meta): array
{
    return [
        'data' => $data,
        'meta' => $meta,
    ];
}

function sendResponse(array $response, int $status = 200): void
{
    http_response_code($status);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}