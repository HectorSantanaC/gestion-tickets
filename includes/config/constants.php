<?php

/**
 * Configuration constants for the application
 */

return [
    'allowed_pages' => [
        'dashboard',
        'create-ticket',
        'login',
        'ticket-detail',
        'admin',
        'tickets',
        'statistics'
    ],
    'page_titles' => [
        'dashboard' => 'Registro de incidencias - Dashboard',
        'create-ticket' => 'Crear nuevo ticket - Servicio de asistencia',
        'login' => 'Login - Registro de incidencias',
        'ticket-detail' => 'Detalles del ticket - Servicio de asistencia',
        'admin' => 'Servicio de asistencia - Administración y estadísticas',
        'tickets' => 'Incidencias - Gestor de Incidencias',
        'statistics' => 'Estadísticas - Gestor de Incidencias'
    ],
    'default_page' => 'dashboard',
    'default_title' => 'Registro de incidencias',
    'sidebar_width' => '256px'
];