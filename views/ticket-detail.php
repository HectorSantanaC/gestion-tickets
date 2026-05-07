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
            <span class="font-meta-xs text-meta-xs text-on-surface-variant bg-surface-container-high px-2 py-0.5 rounded">TIC-2849</span>
            <div class="flex items-center gap-1 text-tertiary">
              <span class="material-symbols-outlined text-[14px]">priority_high</span>
              <span class="font-label-sm text-label-sm">URGENTE</span>
            </div>
          </div>
          <h2 class="font-h1 text-h1 text-on-surface">Picos de latencia en base de datos durante horas pico de APAC</h2>
        </div>
        <div class="flex items-center gap-margin-md">
          <span class="px-margin-lg py-1 rounded-full bg-tertiary-fixed text-tertiary font-label-sm text-label-sm flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-tertiary"></span>
            En Progreso
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
          <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
            Estamos observando picos significativos de latencia en la base de datos de producción (Postgres-Cluster-01) coincidiendo con el inicio del día laboral de APAC. Las métricas muestran que la latencia de lectura salta de 10ms a más de 450ms entre las 01:00 y 03:00 UTC.
          </p>
          <p class="font-body-lg text-body-lg text-on-surface-variant mt-margin-lg leading-relaxed">
            La investigación preliminar sugiere que un trabajo pesado de generación de informes podría estar provocando un escaneo secuencial en la tabla 'transaction_logs', que ha crecido significativamente durante el último sprint.
          </p>
          <div class="mt-margin-xl pt-margin-xl border-t border-outline-variant grid grid-cols-2 md:grid-cols-3 gap-margin-xl">
            <div>
              <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Creado por</p>
              <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-primary-fixed-dim flex items-center justify-center text-[10px] font-bold text-primary">JD</div>
                <span class="font-body-md text-body-md">Jane Doe</span>
              </div>
            </div>
            <div>
              <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Asignado a</p>
              <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-full bg-secondary-fixed flex items-center justify-center text-[10px] font-bold text-secondary">AM</div>
                <span class="font-body-md text-body-md">Alex Miller</span>
              </div>
            </div>
            <div>
              <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Fecha de Creación</p>
              <span class="font-body-md text-body-md">24 oct 2023 • 09:12</span>
            </div>
          </div>
        </div>

        <!-- Activity Feed & Comments -->
        <div class="bg-surface-container-lowest p-margin-xl rounded-xl shadow-soft border border-outline-variant">
          <h3 class="font-h3 text-h3 text-on-surface mb-margin-xl">Actividad y Discusión</h3>
          <div class="space-y-margin-xl">
            <!-- Change Log Entry -->
            <div class="flex gap-margin-lg">
              <div class="mt-1">
                <span class="material-symbols-outlined text-outline text-[20px]">history</span>
              </div>
              <div>
                <p class="font-body-md text-body-md text-on-surface-variant">
                  <span class="font-bold text-on-surface">Sistema</span> cambió el estado de <span class="bg-surface-container-high px-2 py-0.5 rounded">Nueva</span> a <span class="bg-tertiary-fixed text-tertiary px-2 py-0.5 rounded">En Progreso</span>
                </p>
                <p class="font-meta-xs text-meta-xs text-outline mt-1">hace 2 horas</p>
              </div>
            </div>

            <!-- Comment Entry -->
            <div class="flex gap-margin-lg">
              <img alt="Avatar" class="w-10 h-10 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDOk-a6a1q4bLh6gRiwcxXV7oqSXLL2pBIyoc5kbQMp67NJyP7MZM1RNZ7ezGVM7-60ZJi7fwJlb3yWyZNgkagtkDPTuxlmNZbm6gVezoxkBggu3o-rDyl72elheAkcomn2IKKa8yR-3MF1maEw4LU0ULQBfyC7bxezqdY3VZq7pnLPsUZJhHLSDOtZvzjQj5j7tYPI6qdPZ878EqYsShqVzEZ25-ff321FbYqwwDDguVfUj7EyffyLqPp6GP95TmTTxvOT2JPvhIs" />
              <div class="flex-1 bg-surface-container-low p-margin-lg rounded-xl">
                <div class="flex justify-between items-center mb-2">
                  <span class="font-label-sm text-label-sm text-primary">Alex Miller</span>
                  <span class="font-meta-xs text-meta-xs text-outline">hace 1 hora</span>
                </div>
                <p class="font-body-md text-body-md text-on-surface-variant">
                  Estoy revisando el plan de ejecución de los scripts de informes nocturnos. Parece que el índice en 'created_at' está siendo ignorado debido a una incompatibilidad de tipo en la consulta.
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
              <button class="px-margin-lg py-margin-md font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container-high rounded transition-colors">Adjuntar archivos</button>
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
            <select class="w-full appearance-none bg-surface-container-low border border-outline-variant rounded-lg px-margin-lg py-margin-md font-label-sm text-label-sm focus:ring-2 focus:ring-primary/20 outline-none cursor-pointer">
              <option>Nueva</option>
              <option selected="">En Progreso</option>
              <option>Pendiente de Verificación</option>
              <option>Resuelta</option>
              <option>Cerrada</option>
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
              <span class="font-label-sm text-label-sm">Backend / DB</span>
            </div>
            <div class="flex items-center justify-between">
              <span class="font-body-md text-body-md text-on-surface-variant">Fecha límite SLA</span>
              <span class="font-label-sm text-label-sm text-error">Hoy, 16:00</span>
            </div>
            <div class="flex items-center justify-between">
              <span class="font-body-md text-body-md text-on-surface-variant">Impacto</span>
              <span class="font-label-sm text-label-sm">Nivel Enterprise</span>
            </div>
          </div>
          <div class="mt-margin-xl pt-margin-lg border-t border-outline-variant">
            <p class="font-label-sm text-label-sm text-on-surface-variant mb-margin-md">Etiquetas</p>
            <div class="flex flex-wrap gap-2">
              <span class="px-2 py-1 bg-secondary-container text-on-secondary-container rounded font-meta-xs text-meta-xs">Postgres</span>
              <span class="px-2 py-1 bg-secondary-container text-on-secondary-container rounded font-meta-xs text-meta-xs">Latency</span>
              <span class="px-2 py-1 bg-secondary-container text-on-secondary-container rounded font-meta-xs text-meta-xs">APAC</span>
            </div>
          </div>
        </div>

        <!-- Attachments Card -->
        <div class="bg-surface-container-lowest p-margin-xl rounded-xl shadow-soft border border-outline-variant">
          <div class="flex justify-between items-center mb-margin-lg">
            <h4 class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Adjuntos</h4>
            <button class="text-primary hover:underline font-label-sm text-label-sm">Añadir</button>
          </div>
          <div class="space-y-2">
            <div class="flex items-center gap-margin-md p-2 hover:bg-surface-container-low rounded-lg border border-transparent hover:border-outline-variant transition-all cursor-pointer">
              <span class="material-symbols-outlined text-outline">description</span>
              <div class="flex-1 min-w-0">
                <p class="font-label-sm text-label-sm truncate">latency_report_oct_24.pdf</p>
                <p class="font-meta-xs text-meta-xs text-outline">1.2 MB</p>
              </div>
            </div>
            <div class="flex items-center gap-margin-md p-2 hover:bg-surface-container-low rounded-lg border border-transparent hover:border-outline-variant transition-all cursor-pointer">
              <span class="material-symbols-outlined text-outline">image</span>
              <div class="flex-1 min-w-0">
                <p class="font-label-sm text-label-sm truncate">grafana_dashboard_screenshot.png</p>
                <p class="font-meta-xs text-meta-xs text-outline">842 KB</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>