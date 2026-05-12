<?php
$pageTitle = 'Gestor de Incidencias - Panel';
?>
<!-- TopAppBar -->
<?php include_once 'includes/components/header.php'; ?>

<!-- Dashboard Content -->
<main class="flex-1 p-6 max-w-[1280px] mx-auto w-full">
  <!-- Summary Metrics (Bento Style) -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter mb-margin-xl">
    <div class="bg-surface shadow-sm border border-outline-variant p-margin-lg rounded-xl flex items-start justify-between">
      <div>
        <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Mis Incidencias Abiertas</p>
        <h3 id="metric-abiertas" class="font-h2 text-h2 font-black text-primary">-</h3>
        <p class="font-meta-xs text-meta-xs text-success mt-2 flex items-center">
          <span class="material-symbols-outlined text-[14px] mr-1" data-icon="trending_down">trending_down</span>
          <span id="metric-abiertas-trend">-12% desde la semana pasada</span>
        </p>
      </div>
      <span class="p-2 bg-primary-container text-on-primary-container rounded-lg material-symbols-outlined text-[20px]" data-icon="assignment">assignment</span>
    </div>

    <div class="bg-surface shadow-sm border border-outline-variant p-margin-lg rounded-xl flex items-start justify-between">
      <div>
        <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Pendientes de Aprobación</p>
        <h3 id="metric-pendientes" class="font-h2 text-h2 font-black text-on-surface">-</h3>
        <p class="font-meta-xs text-meta-xs text-on-surface-variant mt-2 flex items-center">
          <span class="material-symbols-outlined text-[14px] mr-1" data-icon="schedule">schedule</span>
          <span id="metric-pendientes-sub">Tiempo prom.: -</span>
        </p>
      </div>
      <span class="p-2 bg-secondary-container text-on-secondary-container rounded-lg material-symbols-outlined text-[20px]" data-icon="hourglass_empty">hourglass_empty</span>
    </div>

    <div class="bg-surface shadow-sm border border-outline-variant p-margin-lg rounded-xl flex items-start justify-between">
      <div>
        <p class="font-label-sm text-label-sm text-error mb-1">Incidentes Urgentes</p>
        <h3 id="metric-urgentes" class="font-h2 text-h2 font-black text-error">-</h3>
        <p class="font-meta-xs text-meta-xs text-error mt-2 flex items-center">
          <span class="material-symbols-outlined text-[14px] mr-1" data-icon="warning">warning</span>
          Se requiere acción inmediata
        </p>
      </div>
      <span class="p-2 bg-error text-on-error rounded-lg material-symbols-outlined text-[20px]" data-icon="priority_high">priority_high</span>
    </div>

    <div class="bg-surface shadow-sm border border-outline-variant p-margin-lg rounded-xl flex items-start justify-between">
      <div>
        <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Resueltas Hoy</p>
        <h3 id="metric-resueltas" class="font-h2 text-h2 font-black text-success">-</h3>
        <p class="font-meta-xs text-meta-xs text-success mt-2 flex items-center">
          <span class="material-symbols-outlined text-[14px] mr-1" data-icon="check_circle">check_circle</span>
          <span id="metric-resueltas-sub">0% tasa de resolución</span>
        </p>
      </div>
      <span class="p-2 bg-success-container text-on-success-container rounded-lg material-symbols-outlined text-[20px]" data-icon="task_alt">task_alt</span>
    </div>
  </div>

  <!-- Main Area: Tickets Table -->
  <div class="bg-surface shadow-sm border border-outline-variant rounded-xl overflow-hidden">
    <!-- Filters Header -->
    <div class="p-margin-lg border-b border-outline-variant flex flex-col md:flex-row md:items-center justify-between gap-4 bg-surface-container-lowest">
      <div class="flex items-center space-x-1 p-1 bg-surface-container rounded-lg w-fit">
        <button class="filter-btn px-4 py-1.5 rounded-md font-label-sm text-label-sm bg-surface shadow-sm text-primary" data-status="">Todas</button>
        <button class="filter-btn px-4 py-1.5 rounded-md font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container-high transition-colors" data-status="nueva">Abiertas</button>
        <button class="filter-btn px-4 py-1.5 rounded-md font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container-high transition-colors" data-status="en_progreso">En Progreso</button>
        <button class="filter-btn px-4 py-1.5 rounded-md font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container-high transition-colors" data-status="cerrada">Cerradas</button>
      </div>
      <div class="flex items-center space-x-3">
        <button class="flex items-center font-label-sm text-label-sm text-on-surface-variant border border-outline-variant px-3 py-2 rounded-lg hover:bg-surface-container transition-colors">
          <span class="material-symbols-outlined mr-2 text-[18px]" data-icon="filter_list">filter_list</span>
          Filtrar
        </button>
        <button class="flex items-center font-label-sm text-label-sm text-on-surface-variant border border-outline-variant px-3 py-2 rounded-lg hover:bg-surface-container transition-colors">
          <span class="material-symbols-outlined mr-2 text-[18px]" data-icon="sort">sort</span>
          Ordenar
        </button>
      </div>
    </div>

    <!-- Table View -->
    <div class="overflow-x-auto">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-surface-container-low text-left">
            <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">ID</th>
            <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Asunto</th>
            <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Prioridad</th>
            <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Categoría</th>
            <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Estado</th>
            <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Última Actualización</th>
          </tr>
        </thead>
        <tbody id="tickets-table-body" class="divide-y divide-outline-variant">
          <tr>
            <td colspan="6" class="px-6 py-8 text-center text-on-surface-variant">Cargando incidencias...</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Pagination Footer -->
  <div class="flex items-center justify-between mt-margin-xl">
    <span id="pagination-info" class="font-body-md text-body-md text-on-surface-variant">Mostrando 0 a 0 de 0 incidencias</span>
    <div id="pagination-buttons" class="flex items-center gap-margin-sm">
      <button id="btn-anterior" class="px-margin-md py-margin-sm border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface-variant hover:bg-surface-container-high transition-colors disabled:opacity-50" disabled>
        Anterior
      </button>
      <button id="btn-siguiente" class="px-margin-md py-margin-sm border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface-variant hover:bg-surface-container-high transition-colors disabled:opacity-50" disabled>
        Siguiente
      </button>
    </div>
  </div>
</main>

<!-- FAB: Create New Ticket -->
<a href="?page=create-ticket" class="fixed bottom-10 right-10 bg-primary text-on-primary h-14 w-14 rounded-full shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 transition-all flex items-center justify-center group">
  <span class="material-symbols-outlined text-[28px]" data-icon="add" style="font-variation-settings: 'FILL' 0, 'wght' 600;">add</span>
  <span class="absolute right-full mr-4 bg-inverse-surface text-white px-3 py-1 rounded font-label-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">Nueva Incidencia</span>
</a>

<script src="js/dashboard.js"></script>

