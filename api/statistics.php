<?php

declare(strict_types=1);

$method = $_SERVER['REQUEST_METHOD'];

if ($method !== 'GET') {
    sendResponse(jsonError('Método no permitido'), 405);
}

$db = getDbConnection();

$stmt = $db->query("
    SELECT
        COUNT(*) FILTER (WHERE status = 'abierta') AS abiertas,
        COUNT(*) FILTER (WHERE status = 'pendiente_verificacion') AS pendientes,
        COUNT(*) FILTER (WHERE priority = 'urgente') AS urgentes,
        COUNT(*) FILTER (WHERE status IN ('resuelta', 'cerrada') AND updated_at::date = CURRENT_DATE) AS resueltas_hoy,
        COUNT(*) AS total,
        COUNT(*) FILTER (WHERE status IN ('resuelta', 'cerrada')) AS cerradas
    FROM tickets
");

$stats = $stmt->fetch();

sendResponse(jsonSuccess([
    'abiertas' => (int) $stats['abiertas'],
    'pendientes' => (int) $stats['pendientes'],
    'urgentes' => (int) $stats['urgentes'],
    'resueltas_hoy' => (int) $stats['resueltas_hoy'],
    'total' => (int) $stats['total'],
    'cerradas' => (int) $stats['cerradas'],
]));
