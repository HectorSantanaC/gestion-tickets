<?php

declare(strict_types=1);

function requireAuth(): void {
    if (empty($_SESSION['user_id'])) {
        sendResponse(jsonError('No autenticado'), 401);
        exit;
    }
}

function requireRole(string $role): void {
    requireAuth();
    if ($_SESSION['user_role'] !== $role) {
        sendResponse(jsonError('Acceso denegado'), 403);
        exit;
    }
}
