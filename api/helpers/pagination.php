<?php

declare(strict_types=1);

function getPaginationParams(): array
{
    $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
    $perPage = isset($_GET['per_page']) ? max(1, min(100, (int) $_GET['per_page'])) : 10;

    return [
        'page' => $page,
        'per_page' => $perPage,
    ];
}

function buildPaginationMeta(int $page, int $perPage, int $total): array
{
    return [
        'page' => $page,
        'per_page' => $perPage,
        'total' => $total,
        'total_pages' => (int) ceil($total / $perPage),
    ];
}