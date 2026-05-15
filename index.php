<?php

session_start();

$uri = $_SERVER['REQUEST_URI'] ?? '/';

// Detect base path (works in subdirectory or root)
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
$apiPath = str_replace($basePath, '', $uri);
if (strpos($apiPath, '/api/') === 0) {
    require __DIR__ . '/api/index.php';
    exit;
}

// Load configuration
$config = require __DIR__ . '/config/app.php';

// Router - Entry point
$page = isset($_GET['page']) && is_string($_GET['page']) 
  ? $_GET['page'] 
  : $config['default_page'];

// Normalize page name (whitelist)
if (!in_array($page, $config['allowed_pages'], true)) {
  $page = $config['default_page'];
}

// Auth guard — redirect to login if not authenticated
if ($page !== 'login' && empty($_SESSION['user_id'])) {
    header('Location: ' . $basePath . '/?page=login');
    exit;
}

// Role guard — solo roles permitidos (no pacientes)
if ($page !== 'login') {
    $allowedRoles = ['admin', 'administracion', 'gestor', 'medico'];
    $userRoles = array_map('trim', explode(',', $_SESSION['user_role'] ?? ''));
    if (empty(array_intersect($userRoles, $allowedRoles))) {
        header('Location: ' . $basePath . '/?page=login');
        exit;
    }
}

// Set currentPage for navbar highlighting
$currentPage = $page;

// For login page, we don't include the sidebar
$isLoginPage = ($page === 'login');

// Get page title
$pageTitle = $config['page_titles'][$page] ?? $config['default_title'];

// Sidebar width for layout
$sidebarWidth = $config['sidebar_width'];

// API base URL for JavaScript
$apiBase = $basePath . '/api';
?>
<!DOCTYPE html>
<html class="light" lang="es">
<?php include_once 'includes/head.php'; ?>

<?php if ($isLoginPage): ?>
  <!-- Login Page - No sidebar -->
  <?php include_once 'views/login.php'; ?>

<?php else: ?>
  <!-- Pages with sidebar -->

  <body class="font-body-md text-on-background overflow-x-hidden">
    <div class="flex min-h-screen">
      <?php include_once 'includes/components/navbar.php'; ?>
      <div class="flex-1 pl-64 flex flex-col min-w-0">
        <?php include_once "views/{$page}.php"; ?>
      </div>
    </div>
  </body>
<?php endif; ?>

</html>