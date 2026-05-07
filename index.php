<?php
// Router - Entry point
$page = $_GET['page'] ?? 'dashboard';

// Define allowed pages
$allowedPages = ['dashboard', 'create-ticket', 'login', 'ticket-detail', 'admin', 'tickets', 'statistics'];

// Normalize page name
if (!in_array($page, $allowedPages)) {
  $page = 'dashboard';
}

// Set currentPage for navbar highlighting
$currentPage = $page;

// For login page, we don't include the sidebar
$isLoginPage = ($page === 'login');

$pageTitles = [
  'dashboard' => 'Registro de incidencias - Dashboard',
  'create-ticket' => 'Crear nuevo ticket - Servicio de asistencia',
  'login' => 'Login - Registro de incidencias',
  'ticket-detail' => 'Detalles del ticket - Servicio de asistencia',
  'admin' => 'Servicio de asistencia - Administración y estadísticas',
  'tickets' => 'Incidencias - Gestor de Incidencias',
  'statistics' => 'Estadísticas - Gestor de Incidencias'
];

$pageTitle = $pageTitles[$page] ?? 'Registro de incidencias';
?>
<!DOCTYPE html>
<html class="light" lang="es">
<?php include 'includes/head.php'; ?>

<?php if ($isLoginPage): ?>
  <!-- Login Page - No sidebar -->
  <?php include 'views/login.php'; ?>

<?php else: ?>
  <!-- Pages with sidebar -->

  <body class="font-body-md text-on-background">
    <div class="flex min-h-screen">
      <?php include 'includes/navbar.php'; ?>
      <div class="flex-1 pl-64 flex flex-col min-w-0">
        <?php include "views/{$page}.php"; ?>
      </div>
    </div>
  </body>
<?php endif; ?>

</html>