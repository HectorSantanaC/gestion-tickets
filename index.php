<?php

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$apiPath = str_replace('/gestion-tickets', '', $uri);
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

// Set currentPage for navbar highlighting
$currentPage = $page;

// For login page, we don't include the sidebar
$isLoginPage = ($page === 'login');

// Get page title
$pageTitle = $config['page_titles'][$page] ?? $config['default_title'];

// Sidebar width for layout
$sidebarWidth = $config['sidebar_width'];
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