<?php
$pageTitle = 'Gestor de Incidencias - Panel';
?>
<!-- TopAppBar -->
<?php include_once 'includes/header.php'; ?>

<!-- Dashboard Content -->
<main class="flex-1 p-6 max-w-[1280px] mx-auto w-full">
  <!-- Summary Metrics (Bento Style) -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter mb-margin-xl">
    <div class="bg-surface shadow-sm border border-outline-variant p-margin-lg rounded-xl flex items-start justify-between">
      <div>
        <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Mis Incidencias Abiertas</p>
        <h3 class="font-h2 text-h2 font-black text-primary">24</h3>
        <p class="font-meta-xs text-meta-xs text-green-600 mt-2 flex items-center">
          <span class="material-symbols-outlined text-[14px] mr-1" data-icon="trending_down">trending_down</span>
          -12% desde la semana pasada
        </p>
      </div>
      <div class="bg-primary-container p-2 rounded-lg">
        <span class="material-symbols-outlined text-on-primary-fixed" data-icon="assignment">assignment</span>
      </div>
    </div>

    <div class="bg-surface shadow-sm border border-outline-variant p-margin-lg rounded-xl flex items-start justify-between">
      <div>
        <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Pendientes de Aprobación</p>
        <h3 class="font-h2 text-h2 font-black text-on-surface">08</h3>
        <p class="font-meta-xs text-meta-xs text-on-surface-variant mt-2 flex items-center">
          <span class="material-symbols-outlined text-[14px] mr-1" data-icon="schedule">schedule</span>
          Tiempo prom.: 4.2h
        </p>
      </div>
      <div class="bg-secondary-container p-2 rounded-lg">
        <span class="material-symbols-outlined text-on-secondary-container" data-icon="hourglass_empty">hourglass_empty</span>
      </div>
    </div>

    <div class="bg-error-container shadow-sm border border-error/20 p-margin-lg rounded-xl flex items-start justify-between">
      <div>
        <p class="font-label-sm text-label-sm text-on-error-container mb-1">Incidentes Urgentes</p>
        <h3 class="font-h2 text-h2 font-black text-error">03</h3>
        <p class="font-meta-xs text-meta-xs text-error mt-2 flex items-center">
          <span class="material-symbols-outlined text-[14px] mr-1" data-icon="warning">warning</span>
          Se requiere acción inmediata
        </p>
      </div>
      <div class="bg-error p-2 rounded-lg">
        <span class="material-symbols-outlined text-on-error" data-icon="priority_high">priority_high</span>
      </div>
    </div>

    <div class="bg-surface shadow-sm border border-outline-variant p-margin-lg rounded-xl flex items-start justify-between">
      <div>
        <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Resueltas Hoy</p>
        <h3 class="font-h2 text-h2 font-black text-green-600">14</h3>
        <p class="font-meta-xs text-meta-xs text-green-600 mt-2 flex items-center">
          <span class="material-symbols-outlined text-[14px] mr-1" data-icon="check_circle">check_circle</span>
          92% tasa de resolución
        </p>
      </div>
      <div class="bg-green-100 p-2 rounded-lg">
        <span class="material-symbols-outlined text-green-700" data-icon="task_alt">task_alt</span>
      </div>
    </div>
  </div>

  <!-- Main Area: Tickets Table -->
  <div class="bg-surface shadow-sm border border-outline-variant rounded-xl overflow-hidden">
    <!-- Filters Header -->
    <div class="p-margin-lg border-b border-outline-variant flex flex-col md:flex-row md:items-center justify-between gap-4 bg-surface-container-lowest">
      <div class="flex items-center space-x-1 p-1 bg-surface-container rounded-lg w-fit">
        <button class="px-4 py-1.5 rounded-md font-label-sm text-label-sm bg-surface shadow-sm text-primary">Todas</button>
        <button class="px-4 py-1.5 rounded-md font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container-high transition-colors">Abiertas</button>
        <button class="px-4 py-1.5 rounded-md font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container-high transition-colors">En Progreso</button>
        <button class="px-4 py-1.5 rounded-md font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container-high transition-colors">Cerradas</button>
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
        <tbody class="divide-y divide-outline-variant">
          <!-- Ticket Row 1 -->
          <tr class="hover:bg-surface-container-low transition-colors cursor-pointer group">
            <td class="px-6 py-4 whitespace-nowrap font-label-sm text-primary">#INC-2940</td>
            <td class="px-6 py-4">
              <div class="font-body-md font-semibold text-on-surface">Latencia de base de datos en producción-us-east</div>
              <div class="font-meta-xs text-on-surface-variant">Reportado por: Sarah Jenkins</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-error-container text-error">URGENTE</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-on-surface-variant font-body-md">Infraestructura</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <span class="h-2 w-2 rounded-full bg-orange-500 mr-2"></span>
                <span class="font-body-md text-on-surface">En Progreso</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-on-surface-variant font-meta-xs">hace 2 min</td>
          </tr>

          <!-- Ticket Row 2 -->
          <tr class="hover:bg-surface-container-low transition-colors cursor-pointer group">
            <td class="px-6 py-4 whitespace-nowrap font-label-sm text-primary">#REQ-8821</td>
            <td class="px-6 py-4">
              <div class="font-body-md font-semibold text-on-surface">Incorporación de nuevo desarrollador: Acceso SSH</div>
              <div class="font-meta-xs text-on-surface-variant">Reportado por: Alex Chen</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800">NORMAL</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-on-surface-variant font-body-md">Gestión de Accesos</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <span class="h-2 w-2 rounded-full bg-blue-500 mr-2"></span>
                <span class="font-body-md text-on-surface">Abierta</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-on-surface-variant font-meta-xs">hace 1 hora</td>
          </tr>

          <!-- Ticket Row 3 -->
          <tr class="hover:bg-surface-container-low transition-colors cursor-pointer group">
            <td class="px-6 py-4 whitespace-nowrap font-label-sm text-primary">#BUG-4402</td>
            <td class="px-6 py-4">
              <div class="font-body-md font-semibold text-on-surface">Página de checkout fallando en mobile safari</div>
              <div class="font-meta-xs text-on-surface-variant">Reportado por: Emily Clark</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-orange-100 text-orange-800">ALTA</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-on-surface-variant font-body-md">Comercio Electrónico</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <span class="h-2 w-2 rounded-full bg-orange-500 mr-2"></span>
                <span class="font-body-md text-on-surface">En Progreso</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-on-surface-variant font-meta-xs">hace 3 horas</td>
          </tr>

          <!-- Ticket Row 4 -->
          <tr class="hover:bg-surface-container-low transition-colors cursor-pointer group">
            <td class="px-6 py-4 whitespace-nowrap font-label-sm text-primary">#INC-2938</td>
            <td class="px-6 py-4">
              <div class="font-body-md font-semibold text-on-surface">Endpoint de API retornando 500 en dev sandbox</div>
              <div class="font-meta-xs text-on-surface-variant">Reportado por: Tech Lead</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-600">BAJA</span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-on-surface-variant font-body-md">API Backend</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <span class="h-2 w-2 rounded-full bg-green-500 mr-2"></span>
                <span class="font-body-md text-on-surface">Resuelta</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-on-surface-variant font-meta-xs">hace 5 horas</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination Footer -->
    <div class="p-margin-lg border-t border-outline-variant flex items-center justify-between bg-surface-container-low">
      <p class="font-meta-xs text-meta-xs text-on-surface-variant">Mostrando 1 a 4 de 124 incidencias</p>
      <div class="flex space-x-2">
        <button class="p-2 border border-outline-variant rounded hover:bg-surface-container transition-colors">
          <span class="material-symbols-outlined text-[20px]" data-icon="chevron_left">chevron_left</span>
        </button>
        <button class="p-2 border border-outline-variant rounded bg-primary text-white">1</button>
        <button class="p-2 border border-outline-variant rounded hover:bg-surface-container transition-colors">2</button>
        <button class="p-2 border border-outline-variant rounded hover:bg-surface-container transition-colors">3</button>
        <button class="p-2 border border-outline-variant rounded hover:bg-surface-container transition-colors">
          <span class="material-symbols-outlined text-[20px]" data-icon="chevron_right">chevron_right</span>
        </button>
      </div>
    </div>
  </div>
</main>

<!-- FAB: Create New Ticket -->
<button class="fixed bottom-10 right-10 bg-primary text-on-primary h-14 w-14 rounded-full shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 transition-all flex items-center justify-center group">
  <span class="material-symbols-outlined text-[28px]" data-icon="add" style="font-variation-settings: 'FILL' 0, 'wght' 600;">add</span>
  <span class="absolute right-full mr-4 bg-inverse-surface text-white px-3 py-1 rounded font-label-sm whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">Nueva Incidencia</span>
</button>