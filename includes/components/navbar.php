<?php
// Navbar Component
// $currentPage: 'dashboard', 'tickets', 'create-ticket', 'admin', 'statistics', 'settings', 'logout', 'login'

// If currentPage is 'login', we don't show the sidebar (it's a centered page)
if ($currentPage === 'login') {
  return; // Exit - login page has no sidebar
}

// Navigation items configuration
$navItems = [
  'dashboard' => ['icon' => 'dashboard', 'label' => 'Panel', 'href' => '?page=dashboard'],
  'tickets' => ['icon' => 'confirmation_number', 'label' => 'Incidencias', 'href' => '?page=tickets'],
  'create-ticket' => ['icon' => 'add_circle', 'label' => 'Nueva Incidencia', 'href' => '?page=create-ticket'],
  'admin' => ['icon' => 'admin_panel_settings', 'label' => 'Administración', 'href' => '?page=admin'],
  'statistics' => ['icon' => 'query_stats', 'label' => 'Estadísticas', 'href' => '?page=statistics'],
];

$bottomItems = [
  'settings' => ['icon' => 'settings', 'label' => 'Configuración', 'href' => '#'],
  'logout' => ['icon' => 'logout', 'label' => 'Cerrar Sesión', 'href' => '#'],
];

function isActive(string $page, string $current): string
{
  return $page === $current 
    ? 'text-primary font-bold border-r-4 border-primary bg-surface-container-high' 
    : 'text-on-surface-variant hover:bg-surface-container-high';
}
?>

<!-- SideNavBar -->
<aside class="flex flex-col h-screen fixed left-0 top-0 p-6 bg-surface w-64 border-r border-outline-variant shadow-sm z-50">
  <div class="px-6 mb-8">
    <h1 class="font-h3 text-h3 font-bold text-primary">Gestor de Incidencias</h1>
  </div>

  <nav class="flex-1 space-y-1 px-3">
    <?php foreach ($navItems as $key => $item): ?>
      <a class="flex items-center px-3 py-3 font-body-md <?php echo isActive($key, $currentPage); ?> transition-colors duration-200"
        href="<?php echo $item['href']; ?>">
        <span class="material-symbols-outlined mr-3" data-icon="<?php echo $item['icon']; ?>"><?php echo $item['icon']; ?></span>
        <span><?php echo $item['label']; ?></span>
      </a>
    <?php endforeach; ?>
  </nav>

  <div class="mt-auto px-3 space-y-1">
    <?php foreach ($bottomItems as $key => $item): ?>
      <a class="flex items-center px-3 py-3 font-body-md text-on-surface-variant hover:bg-surface-container-high transition-colors duration-200"
        href="<?php echo $item['href']; ?>"
        <?php echo $key === 'logout' ? 'id="logout-btn"' : ''; ?>>
        <span class="material-symbols-outlined mr-3" data-icon="<?php echo $item['icon']; ?>"><?php echo $item['icon']; ?></span>
        <span><?php echo $item['label']; ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</aside>

<script>
document.getElementById('logout-btn')?.addEventListener('click', async (e) => {
  e.preventDefault();
  await fetch(`${API_BASE}/auth/logout`, { method: 'POST' });
  window.location.href = '?page=login';
});
</script>