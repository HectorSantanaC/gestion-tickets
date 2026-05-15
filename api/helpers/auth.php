<?php

declare(strict_types=1);

function requireAuth(): void {
    if (empty($_SESSION['user_id'])) {
        sendResponse(jsonError('No autenticado'), 401);
        exit;
    }
}

function requireAnyRole(array $allowedRoles): void {
    requireAuth();
    $userRoles = array_map('trim', explode(',', $_SESSION['user_role'] ?? ''));
    if (empty(array_intersect($userRoles, $allowedRoles))) {
        sendResponse(jsonError('Acceso denegado'), 403);
        exit;
    }
}

function userHasRole(string $role): bool {
    $userRoles = array_map('trim', explode(',', $_SESSION['user_role'] ?? ''));
    return in_array($role, $userRoles, true);
}
