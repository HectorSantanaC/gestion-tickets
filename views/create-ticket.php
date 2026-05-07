<?php
$pageTitle = 'Nueva Incidencia - Servicio de Asistencia';
$showTitle = false;
$searchPlaceholder = 'Buscar incidencias, etiquetas o usuarios...';
$profileImage = 'https://lh3.googleusercontent.com/aida-public/AB6AXuBvmIwUBTmDyFzDPY5TJQHdIROEKVkPpphN_YGzFElSQluoc3mGGV2mHoHVbcc-bevtLixCLZVHJaInPmQtAvNnsk7YSQYdbS6BfkcYkhUnwk0SYGL0GSqWwnVzNI7297E3XJERr-I2BFicakLS0efDvoLS2ONcEcQ4-SSZO1JxnKVJtc-4M1rWpcFL1OijrxDtz6GmFIMctFjUq7odPGnAqaMkR89R5leL0CMfkq6Meg8Ft-bZcc-cHdpg_QAs8rf3Ud2K8gHLmO0';
?>
<!-- SideNavBar Shell -->
<aside class="flex flex-col h-screen fixed left-0 top-0 py-margin-xl bg-surface bg-surface docked h-full w-64 border-r border-outline-variant border-outline-variant z-40 hidden md:flex">
  <div class="px-margin-lg mb-margin-xl">
    <h1 class="font-h3 text-h3 font-bold text-primary text-primary">Gestor de Incidencias</h1>
    <p class="font-label-sm text-label-sm text-on-surface-variant opacity-70">Soporte Empresarial</p>
  </div>
  <nav class="flex-1 px-margin-md space-y-margin-sm">
    <a class="flex items-center gap-margin-md px-margin-lg py-margin-md rounded-lg text-on-surface-variant text-on-surface-variant hover:bg-surface-container-high hover:bg-surface-container-high transition-all scale-98 active:scale-95 duration-200" href="?page=dashboard">
      <span class="material-symbols-outlined">dashboard</span>
      <span class="font-label-sm text-label-sm">Panel</span>
    </a>
    <a class="flex items-center gap-margin-md px-margin-lg py-margin-md rounded-lg text-on-surface-variant text-on-surface-variant hover:bg-surface-container-high hover:bg-surface-container-high transition-all scale-98 active:scale-95 duration-200" href="?page=tickets">
      <span class="material-symbols-outlined">confirmation_number</span>
      <span class="font-label-sm text-label-sm">Incidencias</span>
    </a>
    <!-- Active Tab: Create Ticket -->
    <a class="flex items-center gap-margin-md px-margin-lg py-margin-md rounded-lg text-primary text-primary font-bold border-r-4 border-primary bg-surface-container-low shadow-sm scale-98 active:scale-95 duration-200" href="?page=create-ticket">
      <span class="material-symbols-outlined">add_circle</span>
      <span class="font-label-sm text-label-sm">Nueva Incidencia</span>
    </a>
    <a class="flex items-center gap-margin-md px-margin-lg py-margin-md rounded-lg text-on-surface-variant text-on-surface-variant hover:bg-surface-container-high hover:bg-surface-container-high transition-all scale-98 active:scale-95 duration-200" href="?page=admin">
      <span class="material-symbols-outlined">admin_panel_settings</span>
      <span class="font-label-sm text-label-sm">Administración</span>
    </a>
    <a class="flex items-center gap-margin-md px-margin-lg py-margin-md rounded-lg text-on-surface-variant text-on-surface-variant hover:bg-surface-container-high hover:bg-surface-container-high transition-all scale-98 active:scale-95 duration-200" href="?page=statistics">
      <span class="material-symbols-outlined">query_stats</span>
      <span class="font-label-sm text-label-sm">Estadísticas</span>
    </a>
  </nav>
  <div class="px-margin-md mt-auto pt-margin-xl border-t border-outline-variant">
    <a class="flex items-center gap-margin-md px-margin-lg py-margin-md rounded-lg text-on-surface-variant text-on-surface-variant hover:bg-surface-container-high transition-all" href="#">
      <span class="material-symbols-outlined">settings</span>
      <span class="font-label-sm text-label-sm">Configuración</span>
    </a>
    <a class="flex items-center gap-margin-md px-margin-lg py-margin-md rounded-lg text-on-surface-variant text-on-surface-variant hover:bg-surface-container-high transition-all" href="#">
      <span class="material-symbols-outlined">logout</span>
      <span class="font-label-sm text-label-sm">Cerrar Sesión</span>
    </a>
  </div>
</aside>

<!-- Main Content Area -->
<div class="min-h-screen flex flex-col">
  <!-- TopAppBar -->
  <?php include 'includes/header.php'; ?>

  <!-- Form Canvas -->
  <main class="flex-1 p-6 max-w-5xl mx-auto w-full">
    <div class="mb-margin-xl">
      <h2 class="font-h1 text-h1 text-on-surface mb-margin-sm">Crear una Incidencia</h2>
      <p class="font-body-lg text-body-lg text-on-surface-variant">Por favor proporciona información detallada para ayudar a nuestro equipo de soporte a resolver tu incidencia rápidamente.</p>
    </div>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-margin-xl">
      <form class="space-y-margin-xl">
        <!-- Subject Row -->
        <div class="grid grid-cols-1 gap-margin-md">
          <label class="font-label-sm text-label-sm text-on-surface-variant">Asunto</label>
          <div class="relative">
            <input class="w-full bg-white border border-outline-variant rounded-lg p-3 text-body-md focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none" placeholder="Describe brevemente la incidencia" type="text" />
            <div class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant opacity-50 cursor-help" title="Enter a concise title for your request">
              <span class="material-symbols-outlined text-[18px]">info</span>
            </div>
          </div>
        </div>

        <!-- Category & Priority Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-margin-xl">
          <div class="space-y-margin-md">
            <label class="font-label-sm text-label-sm text-on-surface-variant">Categoría</label>
            <select class="w-full bg-white border border-outline-variant rounded-lg p-3 text-body-md focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none appearance-none">
              <option disabled="" selected="" value="">Seleccionar categoría</option>
              <option>Hardware</option>
              <option>Software</option>
              <option>Red</option>
              <option>Acceso a Cuentas</option>
              <option>Facturación</option>
              <option>Otro</option>
            </select>
          </div>
          <div class="space-y-margin-md">
            <label class="font-label-sm text-label-sm text-on-surface-variant">Prioridad</label>
            <div class="flex gap-margin-md">
              <label class="flex-1 cursor-pointer group">
                <input class="sr-only peer" name="priority" type="radio" />
                <div class="text-center py-2 px-3 border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface-variant peer-checked:bg-secondary-container peer-checked:border-secondary peer-checked:text-on-secondary-container transition-all group-hover:bg-surface-container-low">Baja</div>
              </label>
              <label class="flex-1 cursor-pointer group">
                <input checked="" class="sr-only peer" name="priority" type="radio" />
                <div class="text-center py-2 px-3 border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface-variant peer-checked:bg-primary-fixed peer-checked:border-primary-fixed-dim peer-checked:text-on-primary-fixed transition-all group-hover:bg-surface-container-low">Normal</div>
              </label>
              <label class="flex-1 cursor-pointer group">
                <input class="sr-only peer" name="priority" type="radio" />
                <div class="text-center py-2 px-3 border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface-variant peer-checked:bg-tertiary-fixed peer-checked:border-tertiary-fixed-dim peer-checked:text-on-tertiary-fixed transition-all group-hover:bg-surface-container-low">Alta</div>
              </label>
              <label class="flex-1 cursor-pointer group">
                <input class="sr-only peer" name="priority" type="radio" />
                <div class="text-center py-2 px-3 border border-outline-variant rounded-lg font-label-sm text-label-sm text-on-surface-variant peer-checked:bg-error-container peer-checked:border-error peer-checked:text-on-error-container transition-all group-hover:bg-surface-container-low">Urgente</div>
              </label>
            </div>
          </div>
        </div>

        <!-- Description Rich Text Simulation -->
        <div class="space-y-margin-md">
          <label class="font-label-sm text-label-sm text-on-surface-variant">Descripción</label>
          <div class="border border-outline-variant rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-primary transition-all">
            <div class="bg-surface-container-low border-b border-outline-variant p-2 flex gap-margin-sm">
              <button class="p-1.5 rounded hover:bg-surface-container-high transition-colors" type="button"><span class="material-symbols-outlined text-[20px]">format_bold</span></button>
              <button class="p-1.5 rounded hover:bg-surface-container-high transition-colors" type="button"><span class="material-symbols-outlined text-[20px]">format_italic</span></button>
              <button class="p-1.5 rounded hover:bg-surface-container-high transition-colors" type="button"><span class="material-symbols-outlined text-[20px]">format_list_bulleted</span></button>
              <button class="p-1.5 rounded hover:bg-surface-container-high transition-colors" type="button"><span class="material-symbols-outlined text-[20px]">link</span></button>
              <div class="w-[1px] bg-outline-variant mx-2 my-1"></div>
              <button class="p-1.5 rounded hover:bg-surface-container-high transition-colors" type="button"><span class="material-symbols-outlined text-[20px]">code</span></button>
            </div>
            <textarea class="w-full p-4 text-body-md border-none focus:ring-0 resize-none" placeholder="Describe los pasos para reproducir la incidencia..." rows="6"></textarea>
          </div>
        </div>

        <!-- File Attachment -->
        <div class="space-y-margin-md">
          <label class="font-label-sm text-label-sm text-on-surface-variant">Adjuntos</label>
          <div class="border-2 border-dashed border-outline-variant rounded-xl p-margin-xl flex flex-col items-center justify-center bg-surface hover:bg-surface-container transition-colors cursor-pointer group">
            <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center mb-margin-md group-hover:scale-110 transition-transform">
              <span class="material-symbols-outlined text-primary">cloud_upload</span>
            </div>
            <p class="font-label-sm text-label-sm text-on-surface">Haz clic para subir o arrastra y suelta</p>
            <p class="font-meta-xs text-meta-xs text-on-surface-variant opacity-60 mt-1">PNG, JPG o PDF (máx. 10MB)</p>
            <input class="hidden" type="file" />
          </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-margin-lg pt-margin-xl border-t border-outline-variant">
          <button class="px-margin-xl py-3 rounded-lg font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container-high transition-colors" type="button">Cancelar</button>
          <button class="px-margin-xl py-3 rounded-lg font-label-sm text-label-sm bg-primary text-on-primary hover:bg-primary-container hover:text-on-primary-container shadow-md hover:shadow-lg transition-all active:scale-95" type="submit">Enviar Incidencia</button>
        </div>
      </form>
    </div>

    <!-- Helpful Hints / Sidebar Cards (Bento Style) -->
    <div class="mt-margin-xl grid grid-cols-1 md:grid-cols-3 gap-margin-xl">
      <div class="bg-secondary-container p-margin-lg rounded-xl flex items-start gap-margin-md">
        <span class="material-symbols-outlined text-on-secondary-container" style="font-variation-settings: 'FILL' 1;">lightbulb</span>
        <div>
          <h4 class="font-label-sm text-label-sm text-on-secondary-container">Consejo</h4>
          <p class="font-meta-xs text-meta-xs text-on-secondary-container opacity-80">Sé lo más específico posible. Incluye capturas de pantalla de los mensajes de error si están disponibles.</p>
        </div>
      </div>
      <div class="bg-tertiary-fixed p-margin-lg rounded-xl flex items-start gap-margin-md">
        <span class="material-symbols-outlined text-on-tertiary-fixed" style="font-variation-settings: 'FILL' 1;">timer</span>
        <div>
          <h4 class="font-label-sm text-label-sm text-on-tertiary-fixed">Tiempo de Respuesta</h4>
          <p class="font-meta-xs text-meta-xs text-on-tertiary-fixed opacity-80">Nuestro tiempo de respuesta típico es menos de 4 horas para incidencias de alta prioridad.</p>
        </div>
      </div>
      <div class="bg-surface-container-high p-margin-lg rounded-xl flex items-start gap-margin-md">
        <span class="material-symbols-outlined text-on-surface" style="font-variation-settings: 'FILL' 1;">menu_book</span>
        <div>
          <h4 class="font-label-sm text-label-sm text-on-surface">Base de Conocimiento</h4>
          <p class="font-meta-xs text-meta-xs text-on-surface-variant opacity-80">Consulta primero nuestra sección de FAQ—tu incidencia podría estar ya resuelta ahí.</p>
        </div>
      </div>
    </div>
  </main>

  <footer class="mt-auto p-margin-xl text-center">
    <p class="font-meta-xs text-meta-xs text-on-surface-variant opacity-50">© 2024 Mesa de Ayuda Empresarial. Todos los derechos reservados.</p>
  </footer>
</div>

<!-- Mobile Navigation (BottomNavBar) -->
<nav class="md:hidden fixed bottom-0 left-0 right-0 bg-surface-container shadow-[0_-2px_10px_rgba(0,0,0,0.05)] flex justify-around items-center h-16 px-4 z-50">
  <a class="flex flex-col items-center gap-1 text-on-surface-variant" href="?page=dashboard">
    <span class="material-symbols-outlined">dashboard</span>
    <span class="text-[10px] font-medium">Inicio</span>
  </a>
  <a class="flex flex-col items-center gap-1 text-on-surface-variant" href="?page=tickets">
    <span class="material-symbols-outlined">confirmation_number</span>
    <span class="text-[10px] font-medium">Incidencias</span>
  </a>
  <a class="flex flex-col items-center gap-1 text-primary" href="?page=create-ticket">
    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add_circle</span>
    <span class="text-[10px] font-bold">Crear</span>
  </a>
  <a class="flex flex-col items-center gap-1 text-on-surface-variant" href="?page=statistics">
    <span class="material-symbols-outlined">query_stats</span>
    <span class="text-[10px] font-medium">Estadísticas</span>
  </a>
  <a class="flex flex-col items-center gap-1 text-on-surface-variant" href="#">
    <span class="material-symbols-outlined">person</span>
    <span class="text-[10px] font-medium">Perfil</span>
  </a>
</nav>