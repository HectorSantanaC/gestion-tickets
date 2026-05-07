<?php
$pageTitle = 'Incidencias - Gestor de Incidencias';
$searchPlaceholder = 'Buscar incidencias, etiquetas o usuarios...';
?>

<!-- TopAppBar -->
<?php include_once 'includes/components/header.php'; ?>

<!-- Main Content -->
<main class="flex-1 p-6 max-w-[1280px] mx-auto w-full">
  <!-- Page Header -->
  <div class="mb-margin-xl">
    <h2 class="font-h1 text-h1 text-on-surface mb-margin-sm">Mis Incidencias</h2>
    <p class="font-body-md text-body-md text-on-surface-variant">Gestiona y haz seguimiento de todas tus incidencias reportadas</p>
  </div>

  <!-- Filters & Actions -->
  <div class="flex flex-wrap items-center justify-between gap-margin-lg mb-margin-xl">
    <div class="flex flex-wrap gap-margin-md">
      <button class="flex items-center gap-margin-sm px-margin-lg py-margin-md bg-primary text-on-primary font-label-sm text-label-sm rounded-lg hover:bg-primary-container transition-colors">
        <span class="material-symbols-outlined text-[18px]">filter_list</span>
        Filtros
      </button>
      <button class="flex items-center gap-margin-sm px-margin-lg py-margin-md border border-outline-variant text-on-surface-variant font-label-sm text-label-sm rounded-lg hover:bg-surface-container-high transition-colors">
        <span class="material-symbols-outlined text-[18px]">sort</span>
        Ordenar
      </button>
    </div>
    <div class="flex gap-margin-md">
      <button class="flex items-center gap-margin-sm px-margin-lg py-margin-md border border-outline-variant text-on-surface-variant font-label-sm text-label-sm rounded-lg hover:bg-surface-container-high transition-colors">
        <span class="material-symbols-outlined text-[18px]">download</span>
        Exportar
      </button>
      <a href="?page=create-ticket" class="flex items-center gap-margin-sm px-margin-lg py-margin-md bg-primary text-on-primary font-label-sm text-label-sm rounded-lg hover:shadow-lg transition-all">
        <span class="material-symbols-outlined text-[18px]">add</span>
        Nueva Incidencia
      </a>
    </div>
  </div>

  <!-- Tickets Table -->
  <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant overflow-hidden">
    <table class="w-full text-left border-collapse">
      <thead>
        <tr class="bg-surface-container-low">
          <th class="px-margin-lg py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">ID</th>
          <th class="px-margin-lg py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Título</th>
          <th class="px-margin-lg py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Estado</th>
          <th class="px-margin-lg py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Prioridad</th>
          <th class="px-margin-lg py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Asignado a</th>
          <th class="px-margin-lg py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Fecha</th>
          <th class="px-margin-lg py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider"></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-outline-variant">
        <!-- Row 1 -->
        <tr class="hover:bg-surface-container-high transition-colors cursor-pointer">
          <td class="px-margin-lg py-4">
            <span class="font-label-sm text-label-sm text-primary">TIC-2849</span>
          </td>
          <td class="px-margin-lg py-4">
            <div class="flex items-center gap-margin-md">
              <span class="material-symbols-outlined text-tertiary text-[20px]">priority_high</span>
              <span class="font-body-md text-body-md text-on-surface">Picos de latencia en la base de datos</span>
            </div>
          </td>
          <td class="px-margin-lg py-4">
            <span class="px-margin-md py-1 rounded-full bg-tertiary-fixed text-tertiary font-label-sm text-label-sm">En Proceso</span>
          </td>
          <td class="px-margin-lg py-4">
            <span class="px-margin-md py-1 rounded-full bg-error-container text-error font-label-sm text-label-sm">Urgente</span>
          </td>
          <td class="px-margin-lg py-4">
            <div class="flex items-center gap-2">
              <div class="w-6 h-6 rounded-full bg-secondary-fixed flex items-center justify-center text-[10px] font-bold text-secondary">AM</div>
              <span class="font-body-md text-body-md">Alex Miller</span>
            </div>
          </td>
          <td class="px-margin-lg py-4">
            <span class="font-body-md text-body-md text-on-surface-variant">24 Oct, 2023</span>
          </td>
          <td class="px-margin-lg py-4">
            <button class="p-2 hover:bg-surface-container rounded transition-colors">
              <span class="material-symbols-outlined text-on-surface-variant">more_vert</span>
            </button>
          </td>
        </tr>
        <!-- Row 2 -->
        <tr class="hover:bg-surface-container-high transition-colors cursor-pointer">
          <td class="px-margin-lg py-4">
            <span class="font-label-sm text-label-sm text-primary">TIC-2847</span>
          </td>
          <td class="px-margin-lg py-4">
            <div class="flex items-center gap-margin-md">
              <span class="material-symbols-outlined text-tertiary text-[20px]">warning</span>
              <span class="font-body-md text-body-md text-on-surface">Error 500 en API de pagos</span>
            </div>
          </td>
          <td class="px-margin-lg py-4">
            <span class="px-margin-md py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed font-label-sm text-label-sm">Pendiente</span>
          </td>
          <td class="px-margin-lg py-4">
            <span class="px-margin-md py-1 rounded-full bg-tertiary-fixed text-tertiary font-label-sm text-label-sm">Alta</span>
          </td>
          <td class="px-margin-lg py-4">
            <div class="flex items-center gap-2">
              <div class="w-6 h-6 rounded-full bg-primary-fixed-dim flex items-center justify-center text-[10px] font-bold text-primary">SJ</div>
              <span class="font-body-md text-body-md">Sarah Jenkins</span>
            </div>
          </td>
          <td class="px-margin-lg py-4">
            <span class="font-body-md text-body-md text-on-surface-variant">23 Oct, 2023</span>
          </td>
          <td class="px-margin-lg py-4">
            <button class="p-2 hover:bg-surface-container rounded transition-colors">
              <span class="material-symbols-outlined text-on-surface-variant">more_vert</span>
            </button>
          </td>
        </tr>
        <!-- Row 3 -->
        <tr class="hover:bg-surface-container-high transition-colors cursor-pointer">
          <td class="px-margin-lg py-4">
            <span class="font-label-sm text-label-sm text-primary">TIC-2845</span>
          </td>
          <td class="px-margin-lg py-4">
            <div class="flex items-center gap-margin-md">
              <span class="material-symbols-outlined text-on-surface-variant text-[20px]">info</span>
              <span class="font-body-md text-body-md text-on-surface">Solicitud de acceso a nuevo sistema</span>
            </div>
          </td>
          <td class="px-margin-lg py-4">
            <span class="px-margin-md py-1 rounded-full bg-primary-fixed text-primary font-label-sm text-label-sm">Nuevo</span>
          </td>
          <td class="px-margin-lg py-4">
            <span class="px-margin-md py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm">Baja</span>
          </td>
          <td class="px-margin-lg py-4">
            <span class="font-body-md text-body-md text-on-surface-variant">Sin asignar</span>
          </td>
          <td class="px-margin-lg py-4">
            <span class="font-body-md text-body-md text-on-surface-variant">22 Oct, 2023</span>
          </td>
          <td class="px-margin-lg py-4">
            <button class="p-2 hover:bg-surface-container rounded transition-colors">
              <span class="material-symbols-outlined text-on-surface-variant">more_vert</span>
            </button>
          </td>
        </tr>
        <!-- Row 4 -->
        <tr class="hover:bg-surface-container-high transition-colors cursor-pointer">
          <td class="px-margin-lg py-4">
            <span class="font-label-sm text-label-sm text-primary">TIC-2842</span>
          </td>
          <td class="px-margin-lg py-4">
            <div class="flex items-center gap-margin-md">
              <span class="material-symbols-outlined text-on-surface-variant text-[20px]">check_circle</span>
              <span class="font-body-md text-body-md text-on-surface">Actualización de permisos completada</span>
            </div>
          </td>
          <td class="px-margin-lg py-4">
            <span class="px-margin-md py-1 rounded-full bg-green-100 text-green-800 font-label-sm text-label-sm">Cerrado</span>
          </td>
          <td class="px-margin-lg py-4">
            <span class="px-margin-md py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm text-label-sm">Baja</span>
          </td>
          <td class="px-margin-lg py-4">
            <div class="flex items-center gap-2">
              <div class="w-6 h-6 rounded-full bg-secondary-fixed flex items-center justify-center text-[10px] font-bold text-secondary">MC</div>
              <span class="font-body-md text-body-md">Michael Chen</span>
            </div>
          </td>
          <td class="px-margin-lg py-4">
            <span class="font-body-md text-body-md text-on-surface-variant">20 Oct, 2023</span>
          </td>
          <td class="px-margin-lg py-4">
            <button class="p-2 hover:bg-surface-container rounded transition-colors">
              <span class="material-symbols-outlined text-on-surface-variant">more_vert</span>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="flex items-center justify-between mt-margin-xl">
    <span class="font-body-md text-body-md text-on-surface-variant">Mostrando 1-4 de 24 incidencias</span>
    <div class="flex items-center gap-margin-sm">
      <button class="px-margin-md py-margin-sm border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface-variant hover:bg-surface-container-high transition-colors disabled:opacity-50" disabled>
        Anterior
      </button>
      <button class="px-margin-md py-margin-sm bg-primary text-on-primary rounded-lg font-body-md text-body-md hover:bg-primary-container transition-colors">
        1
      </button>
      <button class="px-margin-md py-margin-sm border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface-variant hover:bg-surface-container-high transition-colors">
        2
      </button>
      <button class="px-margin-md py-margin-sm border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface-variant hover:bg-surface-container-high transition-colors">
        3
      </button>
      <button class="px-margin-md py-margin-sm border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface-variant hover:bg-surface-container-high transition-colors">
        Siguiente
      </button>
    </div>
  </div>
</main>