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
      <tbody id="tickets-table-body" class="divide-y divide-outline-variant">
        <tr>
          <td colspan="7" class="px-margin-lg py-8 text-center text-on-surface-variant">Cargando incidencias...</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div class="flex items-center justify-between mt-margin-xl">
    <span id="pagination-info" class="font-body-md text-body-md text-on-surface-variant">Mostrando 0-0 de 0 incidencias</span>
    <div class="flex items-center gap-margin-sm">
      <button id="btn-anterior" class="px-margin-md py-margin-sm border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface-variant hover:bg-surface-container-high transition-colors disabled:opacity-50" disabled>
        Anterior
      </button>
      <button id="btn-siguiente" class="px-margin-md py-margin-sm border border-outline-variant rounded-lg font-body-md text-body-md text-on-surface-variant hover:bg-surface-container-high transition-colors disabled:opacity-50" disabled>
        Siguiente
      </button>
    </div>
  </div>
</main>

<script src="js/tickets.js"></script>