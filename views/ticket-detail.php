<?php
$pageTitle = 'Detalle de Incidencia - Servicio de Asistencia';
$showTitle = false;
$zIndex = 40;
$profileImage = 'https://lh3.googleusercontent.com/aida-public/AB6AXuAtTtmNJolhLXTA_nTiUUyJMkOMy4oxwaSdP_CSU76HJ8-crxgViwXP8N4fojewg2i39P1t2qNOc15eB-NH-bQxh1yU7TQvBlZa_XgIKuEKpCMjNBysR7vEHtZzKma-vJ3ksCrTPJT7CkzOI2i9pJO5Pm4AoyKk_QBaB7zLZzHzWCKgsvkvnZBDCDGodkWa1OQ6KVngCM--M7oqK1lS1WbmRDgVfSCSJg9xOM7_bzEllQlSfIli9i5JRgCwmCEh58BRViL3MqAzfaM';
?>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col min-w-0">
  <!-- TopAppBar -->
  <?php include_once 'includes/components/header.php'; ?>

  <!-- Main Workspace -->
  <div class="flex-1 p-6 max-w-[1280px] mx-auto w-full">
    <!-- Ticket Header -->
    <div class="mb-margin-xl bg-surface-container-lowest p-margin-xl rounded-xl shadow-soft border border-outline-variant">
      <div class="flex items-start justify-between">
        <div>
          <div class="flex items-center gap-margin-md mb-margin-sm">
            <span id="detail-ticket-number" class="font-meta-xs text-meta-xs text-on-surface-variant bg-surface-container-high px-2 py-0.5 rounded">-</span>
            <div id="detail-priority" class="flex items-center gap-1 text-tertiary">
            </div>
          </div>
          <h2 id="detail-title" class="font-h1 text-h1 text-on-surface">-</h2>
        </div>
        <div class="flex items-center gap-margin-md">
          <span id="detail-status-badge" class="px-margin-lg py-1 rounded-full bg-tertiary-fixed text-tertiary font-label-sm text-label-sm flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-tertiary"></span>
            -
          </span>
        </div>
      </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-margin-xl mb-margin-xl">
      <!-- Left Column: Details -->
      <div class="lg:col-span-2 space-y-margin-xl">
        <div class="bg-surface-container-lowest p-margin-xl rounded-xl shadow-soft border border-outline-variant">
          <h3 class="font-h3 text-h3 text-on-surface mb-margin-lg">Descripción Detallada</h3>
          <div id="detail-description" class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
            -
          </div>
          <div class="mt-margin-xl pt-margin-xl border-t border-outline-variant grid grid-cols-2 md:grid-cols-3 gap-margin-xl">
            <div id="detail-reporter">
              <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Creado por</p>
              <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-primary-fixed-dim flex items-center justify-center text-[10px] font-bold text-primary">?</div>
                <span class="font-body-md text-body-md">-</span>
              </div>
            </div>
            <div id="detail-assignee">
              <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Asignado a</p>
              <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-secondary-fixed flex items-center justify-center text-[10px] font-bold text-secondary">?</div>
                <span class="font-body-md text-body-md">Sin asignar</span>
              </div>
            </div>
            <div>
              <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Fecha de Creación</p>
              <span id="detail-created-at" class="font-body-md text-body-md">-</span>
            </div>
          </div>
        </div>

        <!-- Activity Feed & Comments -->
        <div class="bg-surface-container-lowest p-margin-xl rounded-xl shadow-soft border border-outline-variant">
          <h3 class="font-h3 text-h3 text-on-surface mb-margin-xl">Actividad y Discusión</h3>
          <div id="detail-comments" class="space-y-margin-xl">
            <div class="flex gap-margin-lg">
              <div class="mt-1">
                <span class="material-symbols-outlined text-outline text-[20px]">info</span>
              </div>
              <div>
                <p class="font-body-md text-body-md text-on-surface-variant">
                  Sin actividad aún
                </p>
              </div>
            </div>
          </div>

          <!-- Rich Text Editor Placeholder -->
          <div class="mt-margin-xl border border-outline-variant rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-primary/20 transition-all">
            <div class="bg-surface-container-high p-margin-md border-b border-outline-variant flex gap-margin-md">
              <button class="p-1 hover:bg-surface-container rounded transition-colors"><span class="material-symbols-outlined text-[20px]">format_bold</span></button>
              <button class="p-1 hover:bg-surface-container rounded transition-colors"><span class="material-symbols-outlined text-[20px]">format_italic</span></button>
              <button class="p-1 hover:bg-surface-container rounded transition-colors"><span class="material-symbols-outlined text-[20px]">link</span></button>
              <button class="p-1 hover:bg-surface-container rounded transition-colors"><span class="material-symbols-outlined text-[20px]">format_list_bulleted</span></button>
              <div class="w-[1px] bg-outline-variant mx-1"></div>
              <button class="p-1 hover:bg-surface-container rounded transition-colors"><span class="material-symbols-outlined text-[20px]">image</span></button>
            </div>
            <textarea class="w-full p-margin-xl border-none focus:ring-0 font-body-md text-body-md min-h-[120px] bg-surface-container-lowest" placeholder="Añadir un comentario o actualización..."></textarea>
            <div class="bg-surface-container-lowest p-margin-md flex justify-end gap-margin-md">
              <button id="btn-attach-files" class="px-margin-lg py-margin-md font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container-high rounded transition-colors">Adjuntar archivos</button>
              <button class="px-margin-xl py-margin-md bg-primary text-on-primary font-label-sm text-label-sm rounded-lg hover:shadow-lg transition-all active:scale-95">Publicar Comentario</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column: Controls -->
      <div class="space-y-margin-xl">
        <!-- Status & Actions Card -->
        <div class="bg-surface-container-lowest p-margin-xl rounded-xl shadow-soft border border-outline-variant">
          <h4 class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-margin-lg">Estado de la Incidencia</h4>
          <div class="relative mb-margin-xl">
            <select id="detail-status-select" class="w-full appearance-none bg-surface-container-low border border-outline-variant rounded-lg px-margin-lg py-margin-md font-label-sm text-label-sm focus:ring-2 focus:ring-primary/20 outline-none cursor-pointer">
              <option value="abierta">Abierta</option>
              <option value="en_progreso">En Progreso</option>
              <option value="pendiente_verificacion">Pendiente de Verificación</option>
              <option value="resuelta">Resuelta</option>
              <option value="cerrada">Cerrada</option>
            </select>
            <span class="material-symbols-outlined absolute right-margin-lg top-1/2 -translate-y-1/2 pointer-events-none text-outline">expand_more</span>
          </div>
          <div class="space-y-margin-md">
            <button class="w-full flex items-center justify-center gap-margin-md py-margin-md border border-outline-variant rounded-lg font-label-sm text-label-sm hover:bg-surface-container-high transition-colors">
              <span class="material-symbols-outlined text-[20px]">person_add</span>
              Reasignar Incidencia
            </button>
            <button class="w-full flex items-center justify-center gap-margin-md py-margin-md border border-outline-variant rounded-lg font-label-sm text-label-sm hover:bg-surface-container-high transition-colors">
              <span class="material-symbols-outlined text-[20px]">flag</span>
              Actualizar Prioridad
            </button>
            <button class="w-full flex items-center justify-center gap-margin-md py-margin-md border border-error/20 text-error rounded-lg font-label-sm text-label-sm hover:bg-error-container/20 transition-colors">
              <span class="material-symbols-outlined text-[20px]">block</span>
              Cerrar como Duplicado
            </button>
          </div>
        </div>

        <!-- Meta Info Card -->
        <div class="bg-surface-container-lowest p-margin-xl rounded-xl shadow-soft border border-outline-variant">
          <h4 class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-margin-lg">Información Adicional</h4>
          <div class="space-y-margin-lg">
            <div class="flex items-center justify-between">
              <span class="font-body-md text-body-md text-on-surface-variant">Categoría</span>
              <span id="detail-category" class="font-label-sm text-label-sm">-</span>
            </div>
            <div class="flex items-center justify-between">
              <span class="font-body-md text-body-md text-on-surface-variant">Fecha límite SLA</span>
              <span class="font-label-sm text-label-sm text-error">Hoy, 16:00</span>
            </div>
            <div class="flex items-center justify-between">
              <span class="font-body-md text-body-md text-on-surface-variant">Impacto</span>
              <span id="detail-impact" class="font-label-sm text-label-sm">-</span>
            </div>
          </div>
          <div class="mt-margin-xl pt-margin-lg border-t border-outline-variant">
            <p class="font-label-sm text-label-sm text-on-surface-variant mb-margin-md">Etiquetas</p>
            <div id="detail-tags" class="flex flex-wrap gap-2">
              <span class="font-meta-xs text-meta-xs text-on-surface-variant">Sin etiquetas</span>
            </div>
          </div>
        </div>

        <!-- Attachments Card -->
        <div class="bg-surface-container-lowest p-margin-xl rounded-xl shadow-soft border border-outline-variant">
          <div class="flex justify-between items-center mb-margin-lg">
            <h4 class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Adjuntos</h4>
            <button id="btn-add-attachment" class="text-primary hover:underline font-label-sm text-label-sm">Añadir</button>
          </div>
          <div id="detail-attachments" class="space-y-2">
            <p class="font-meta-xs text-meta-xs text-on-surface-variant">Sin adjuntos</p>
          </div>
          <input id="detail-file-input" type="file" hidden accept=".png,.jpg,.jpeg,.pdf" />
        </div>
      </div>
    </div>
  </div>
</main>

<script src="js/ticket-detail.js"></script>