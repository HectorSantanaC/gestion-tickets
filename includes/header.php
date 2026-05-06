<?php
// TopAppBar Component
// Parameters:
// - $headerTitle: title to display (default: "Servicio de Asistencia")
// - $searchType: 'default' or 'rounded' (default: 'default')
// - $showNav: show navigation links (default: true)
// - $searchPlaceholder: placeholder text for search input
// - $searchVisible: show/hide search box (default: true)
// - $profileImage: URL for profile image
// - $zIndex: z-index for header (default: 50)
// - $topNav: active top navigation item

$headerTitle = $headerTitle ?? 'Servicio de Asistencia';
$showTitle = $showTitle ?? false; // Mostrar título grande a la izquierda
$searchType = $searchType ?? 'default';
$showNav = $showNav ?? true;
$searchPlaceholder = $searchPlaceholder ?? 'Buscar incidencias, etiquetas o usuarios...';
$searchVisible = $searchVisible ?? true;
$profileImage = $profileImage ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuCAVqFxa2siyHif6RdnWXrhSalsh1Mxujt2M56nlDYWQ-N8TnGx9DcGbGzgf4y5uK-dC20UZbL94J-ybb3SeGtiPAeff5scXmHM-yCI0BkrZw8TI0_uSOgSzFdp3_-zTJIcoqYWmPH98T9MHYTltx9c8Ak10Yph_39LS4wUN0E8uNBZkx6JmYBOOoM1f-grFInWZcDXK8C0jSs1mmX9MyfFL40W90wmJTomX6Z3TP46MI_9ocUH3n-l3Uhr-S1tsOq3fue4j1jHH7c';
$zIndex = $zIndex ?? 50;

$topNav = $_GET['top_nav'] ?? 'my-issues';

function isTopNavActive($item) {
    global $topNav;
    return $item === $topNav ? 'text-primary dark:text-inverse-primary border-b-2 border-primary py-1' : 'text-on-surface-variant dark:text-surface-variant hover:text-primary transition-colors py-1';
}

// Search input classes based on type
$searchClasses = ($searchType === 'rounded') 
    ? 'bg-surface-container-high border-none rounded-full pl-10 pr-4 py-2 text-body-md focus:ring-2 focus:ring-primary w-64 transition-all'
    : 'w-full pl-10 pr-4 py-2 bg-surface-container border border-outline-variant rounded-lg font-body-md focus:outline-none focus:border-primary transition-colors';

$searchContainerClass = ($searchType === 'rounded')
    ? 'relative hidden sm:block'
    : 'relative w-full max-w-md';
?>

<!-- TopAppBar -->
<header class="flex justify-between items-center w-full px-6 py-margin-md sticky top-0 z-<?php echo $zIndex; ?> bg-surface-container-lowest dark:bg-surface-container shadow-sm">
  <div class="flex items-center <?php echo ($searchVisible || $showTitle) ? 'flex-1' : ''; ?>">
    <?php if ($showTitle): ?>
    <span class="font-h2 text-h2 font-black text-primary dark:text-primary-fixed"><?php echo $headerTitle; ?></span>
    <?php endif; ?>
    
    <?php if ($searchVisible): ?>
    <div class="<?php echo $searchContainerClass; ?>">
      <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
      <input class="<?php echo $searchClasses; ?>" placeholder="<?php echo $searchPlaceholder; ?>" type="text" />
    </div>
    <?php endif; ?>
    
    <?php if ($showNav && !$showTitle): // Solo mostrar nav si no hay título grande ?>
    <nav class="ml-8 flex space-x-6">
      <a class="font-body-md <?php echo isTopNavActive('my-issues'); ?>" href="?top_nav=my-issues">Mis Incidencias</a>
      <a class="font-body-md <?php echo isTopNavActive('recent'); ?>" href="?top_nav=recent">Recientes</a>
      <a class="font-body-md <?php echo isTopNavActive('starred'); ?>" href="?top_nav=starred">Destacadas</a>
    </nav>
    <?php elseif ($showNav && $showTitle): // Si hay título, mostrar nav a la derecha del título ?>
    <nav class="hidden lg:flex items-center gap-margin-lg ml-margin-xl">
      <a class="font-body-md text-body-md text-on-surface-variant dark:text-surface-variant hover:text-primary dark:hover:text-inverse-primary transition-colors" href="#">Mis Incidencias</a>
      <a class="font-body-md text-body-md text-on-surface-variant dark:text-surface-variant hover:text-primary dark:hover:text-inverse-primary transition-colors" href="#">Recientes</a>
      <a class="font-body-md text-body-md text-on-surface-variant dark:text-surface-variant hover:text-primary dark:hover:text-inverse-primary transition-colors" href="#">Destacadas</a>
    </nav>
    <?php endif; ?>
  </div>
  <div class="flex items-center gap-4">
    <button class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-colors">
      <span class="material-symbols-outlined">notifications</span>
    </button>
    <button class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-colors">
      <span class="material-symbols-outlined">help_outline</span>
    </button>
    <img alt="User Profile" class="w-8 h-8 rounded-full object-cover border border-outline-variant" src="<?php echo $profileImage; ?>" />
  </div>
</header>