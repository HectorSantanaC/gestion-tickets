<?php
$pageTitle = 'Estadísticas - Gestor de Incidencias';
$searchPlaceholder = 'Buscar insights, métricas o reportes...';
?>

<!-- TopAppBar -->
<?php include_once 'includes/header.php'; ?>

<!-- Main Content -->
<main class="flex-1 p-6 max-w-[1600px] mx-auto w-full">
  <!-- Page Header -->
  <div class="flex flex-col md:flex-row md:items-end justify-between gap-margin-lg mb-margin-xl">
    <div>
      <h2 class="font-h1 text-h1 text-on-surface mb-margin-sm">Estadísticas e Insights</h2>
      <p class="font-body-md text-body-md text-on-surface-variant">Análisis integral de rendimiento de los últimos 30 días.</p>
    </div>
    <div class="flex items-center gap-margin-md bg-surface-container-lowest p-1 rounded-xl shadow-sm border border-outline-variant">
      <button class="px-4 py-2 font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container rounded-lg transition-colors">7 Días</button>
      <button class="px-4 py-2 font-label-sm text-label-sm bg-primary text-white rounded-lg shadow-md transition-colors">30 Días</button>
      <button class="px-4 py-2 font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container rounded-lg transition-colors">90 Días</button>
      <div class="w-px h-6 bg-outline-variant mx-1"></div>
      <button class="flex items-center gap-2 px-4 py-2 font-label-sm text-label-sm text-on-surface-variant hover:bg-surface-container rounded-lg transition-colors">
        <span class="material-symbols-outlined text-[18px]">calendar_today</span>
        Rango Personalizado
      </button>
    </div>
  </div>

  <!-- KPI Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter mb-margin-xl">
    <!-- KPI Card 1 -->
    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant group hover:shadow-md transition-shadow">
      <div class="flex justify-between items-start mb-4">
        <div class="p-3 bg-secondary-container rounded-xl text-primary">
          <span class="material-symbols-outlined">timer</span>
        </div>
        <span class="flex items-center gap-1 text-[12px] font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full">
          <span class="material-symbols-outlined text-[14px]">arrow_downward</span> 12%
        </span>
      </div>
      <p class="text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider mb-1">Tiempo Prom. de Resolución</p>
      <h3 class="text-h2 font-h2 text-on-surface">4h 22m</h3>
    </div>
    <!-- KPI Card 2 -->
    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant group hover:shadow-md transition-shadow">
      <div class="flex justify-between items-start mb-4">
        <div class="p-3 bg-secondary-container rounded-xl text-primary">
          <span class="material-symbols-outlined">reply_all</span>
        </div>
        <span class="flex items-center gap-1 text-[12px] font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full">
          <span class="material-symbols-outlined text-[14px]">arrow_downward</span> 8%
        </span>
      </div>
      <p class="text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider mb-1">Tiempo de Primera Respuesta</p>
      <h3 class="text-h2 font-h2 text-on-surface">24m</h3>
    </div>
    <!-- KPI Card 3 -->
    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant group hover:shadow-md transition-shadow">
      <div class="flex justify-between items-start mb-4">
        <div class="p-3 bg-secondary-container rounded-xl text-primary">
          <span class="material-symbols-outlined">sentiment_satisfied</span>
        </div>
        <span class="flex items-center gap-1 text-[12px] font-bold text-primary bg-primary-fixed px-2 py-1 rounded-full">
          <span class="material-symbols-outlined text-[14px]">trending_up</span> 2%
        </span>
      </div>
      <p class="text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider mb-1">Puntuación CSAT</p>
      <h3 class="text-h2 font-h2 text-on-surface">4.8/5.0</h3>
    </div>
    <!-- KPI Card 4 -->
    <div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant group hover:shadow-md transition-shadow">
      <div class="flex justify-between items-start mb-4">
        <div class="p-3 bg-error-container rounded-xl text-error">
          <span class="material-symbols-outlined">gavel</span>
        </div>
        <span class="flex items-center gap-1 text-[12px] font-bold text-error bg-red-50 px-2 py-1 rounded-full">
          <span class="material-symbols-outlined text-[14px]">warning</span> -0.5%
        </span>
      </div>
      <p class="text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider mb-1">Cumplimiento SLA</p>
      <h3 class="text-h2 font-h2 text-on-surface">98.4%</h3>
    </div>
  </div>

  <!-- Charts Grid -->
  <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter mb-margin-xl">
    <!-- Ticket Volume Trend -->
    <div class="lg:col-span-8 bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant">
      <div class="flex justify-between items-center mb-6">
        <h4 class="font-h3 text-h3 text-on-surface">Tendencia de Volumen de Incidencias</h4>
        <div class="flex items-center gap-4">
          <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-primary"></span>
            <span class="text-meta-xs font-meta-xs text-on-surface-variant">Creadas</span>
          </div>
          <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-primary-fixed-dim"></span>
            <span class="text-meta-xs font-meta-xs text-on-surface-variant">Resueltas</span>
          </div>
        </div>
      </div>
      <div class="h-64 flex items-end justify-between gap-1 mt-4 relative">
        <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
          <div class="border-t border-dashed border-outline-variant w-full h-0"></div>
          <div class="border-t border-dashed border-outline-variant w-full h-0"></div>
          <div class="border-t border-dashed border-outline-variant w-full h-0"></div>
        </div>
        <div class="flex-1 flex flex-col items-center gap-1 group">
          <div class="w-full bg-primary-fixed-dim rounded-t-sm h-[40%]"></div>
          <div class="w-full bg-primary rounded-t-sm h-[60%]"></div>
          <span class="mt-2 text-[10px] text-on-surface-variant">01 Oct</span>
        </div>
        <div class="flex-1 flex flex-col items-center gap-1">
          <div class="w-full bg-primary-fixed-dim rounded-t-sm h-[45%]"></div>
          <div class="w-full bg-primary rounded-t-sm h-[55%]"></div>
          <span class="mt-2 text-[10px] text-on-surface-variant">05 Oct</span>
        </div>
        <div class="flex-1 flex flex-col items-center gap-1">
          <div class="w-full bg-primary-fixed-dim rounded-t-sm h-[70%]"></div>
          <div class="w-full bg-primary rounded-t-sm h-[50%]"></div>
          <span class="mt-2 text-[10px] text-on-surface-variant">10 Oct</span>
        </div>
        <div class="flex-1 flex flex-col items-center gap-1">
          <div class="w-full bg-primary-fixed-dim rounded-t-sm h-[30%]"></div>
          <div class="w-full bg-primary rounded-t-sm h-[40%]"></div>
          <span class="mt-2 text-[10px] text-on-surface-variant">15 Oct</span>
        </div>
        <div class="flex-1 flex flex-col items-center gap-1">
          <div class="w-full bg-primary-fixed-dim rounded-t-sm h-[60%]"></div>
          <div class="w-full bg-primary rounded-t-sm h-[80%]"></div>
          <span class="mt-2 text-[10px] text-on-surface-variant">20 Oct</span>
        </div>
        <div class="flex-1 flex flex-col items-center gap-1">
          <div class="w-full bg-primary-fixed-dim rounded-t-sm h-[80%]"></div>
          <div class="w-full bg-primary rounded-t-sm h-[90%]"></div>
          <span class="mt-2 text-[10px] text-on-surface-variant">25 Oct</span>
        </div>
        <div class="flex-1 flex flex-col items-center gap-1">
          <div class="w-full bg-primary-fixed-dim rounded-t-sm h-[55%]"></div>
          <div class="w-full bg-primary rounded-t-sm h-[65%]"></div>
          <span class="mt-2 text-[10px] text-on-surface-variant">Hoy</span>
        </div>
      </div>
    </div>
    <!-- Tickets by Category -->
    <div class="lg:col-span-4 bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant flex flex-col">
      <h4 class="font-h3 text-h3 text-on-surface mb-6">Incidencias por Categoría</h4>
      <div class="flex-1 flex flex-col justify-center items-center relative">
        <div class="w-40 h-40 rounded-full border-[12px] border-primary-fixed flex items-center justify-center relative overflow-hidden">
          <div class="absolute inset-0 border-[12px] border-primary rounded-full rotate-[45deg]" style="clip-path: polygon(50% 50%, 100% 0, 100% 100%);"></div>
          <div class="absolute inset-0 border-[12px] border-secondary-container rounded-full rotate-[180deg]" style="clip-path: polygon(50% 50%, 100% 0, 100% 50%);"></div>
          <div class="text-center">
            <p class="text-h2 font-h2 text-on-surface">1,248</p>
            <p class="text-meta-xs font-meta-xs text-on-surface-variant">Total</p>
          </div>
        </div>
        <div class="grid grid-cols-2 w-full gap-2 mt-8">
          <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-primary"></span>
            <span class="text-meta-xs text-on-surface-variant">Software (42%)</span>
          </div>
          <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-secondary-container"></span>
            <span class="text-meta-xs text-on-surface-variant">Hardware (28%)</span>
          </div>
          <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-primary-fixed-dim"></span>
            <span class="text-meta-xs text-on-surface-variant">Acceso (18%)</span>
          </div>
          <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-surface-variant"></span>
            <span class="text-meta-xs text-on-surface-variant">Otros (12%)</span>
          </div>
        </div>
      </div>
    </div>
    <!-- Resolution by Priority -->
    <div class="lg:col-span-12 bg-surface-container-lowest p-6 rounded-xl shadow-sm border border-outline-variant">
      <div class="flex justify-between items-center mb-6">
        <h4 class="font-h3 text-h3 text-on-surface">Tiempo de Resolución por Prioridad</h4>
        <span class="text-meta-xs font-meta-xs text-on-surface-variant">Horas promedio hasta cierre</span>
      </div>
      <div class="space-y-6">
        <div class="relative pt-1">
          <div class="flex mb-2 items-center justify-between">
            <div><span class="text-label-sm font-label-sm inline-block py-1 px-2 uppercase rounded-full text-error bg-error-container">Urgente</span></div>
            <div class="text-right"><span class="text-label-sm font-bold inline-block text-error">1.2 Horas</span></div>
          </div>
          <div class="overflow-hidden h-3 mb-4 text-xs flex rounded bg-surface-container">
            <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-error" style="width:15%"></div>
          </div>
        </div>
        <div class="relative pt-1">
          <div class="flex mb-2 items-center justify-between">
            <div><span class="text-label-sm font-label-sm inline-block py-1 px-2 uppercase rounded-full text-on-tertiary-fixed-variant bg-tertiary-fixed">Alta</span></div>
            <div class="text-right"><span class="text-label-sm font-bold inline-block text-tertiary">4.5 Horas</span></div>
          </div>
          <div class="overflow-hidden h-3 mb-4 text-xs flex rounded bg-surface-container">
            <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-tertiary" style="width:35%"></div>
          </div>
        </div>
        <div class="relative pt-1">
          <div class="flex mb-2 items-center justify-between">
            <div><span class="text-label-sm font-label-sm inline-block py-1 px-2 uppercase rounded-full text-primary bg-primary-fixed">Media</span></div>
            <div class="text-right"><span class="text-label-sm font-bold inline-block text-primary">12.8 Horas</span></div>
          </div>
          <div class="overflow-hidden h-3 mb-4 text-xs flex rounded bg-surface-container">
            <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary" style="width:65%"></div>
          </div>
        </div>
        <div class="relative pt-1">
          <div class="flex mb-2 items-center justify-between">
            <div><span class="text-label-sm font-label-sm inline-block py-1 px-2 uppercase rounded-full text-on-secondary-fixed-variant bg-secondary-fixed">Baja</span></div>
            <div class="text-right"><span class="text-label-sm font-bold inline-block text-on-secondary-fixed-variant">32.4 Horas</span></div>
          </div>
          <div class="overflow-hidden h-3 mb-4 text-xs flex rounded bg-surface-container">
            <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-on-secondary-fixed-variant" style="width:90%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Agent Performance Table -->
  <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant overflow-hidden">
    <div class="p-6 border-b border-outline-variant flex justify-between items-center bg-surface-container-lowest">
      <h4 class="font-h3 text-h3 text-on-surface">Agentes con Mejor Rendimiento</h4>
      <button class="text-primary font-label-sm text-label-sm hover:underline">Ver Todos los Reportes</button>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-surface-container-low">
            <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Agente</th>
            <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Incidencias Resueltas</th>
            <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">CSAT Prom.</th>
            <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Carga Activa</th>
            <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Eficiencia</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-outline-variant">
          <!-- Row 1 -->
          <tr class="hover:bg-surface-container-high transition-colors">
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <img alt="Avatar de Agente" class="w-10 h-10 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAVQMJFDoVxyux5VsBzEsMN7JxaJvzQWtCvRkZVic--hjgwQLpdTF9qX8xAL9f2dh__A1q15XIGNtRHjYWWGAQ4LqO7OchjjopDl_PXb4GgHRZOjBMK0BDKqJgRp7q8Sm1_3EiTR0Fs2uXaEzXy4TZPRBAhKAq9AfjmkSo2NGdYZoD6p5zRYM_SS8gsX9iBiTcMGrDzdjjwCKgEu2lxFgMqNmx3PXGLtk842ZEp1BkohNvKoyUkWvEnFjDJzqpKBmTnDT3J6SycmyE" />
                <div>
                  <p class="font-label-sm text-label-sm text-on-surface">Sarah Jenkins</p>
                  <p class="text-meta-xs text-on-surface-variant">Ingeniera Senior</p>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <span class="text-body-md font-bold text-on-surface">248</span>
              <span class="text-meta-xs text-green-600 ml-1">+12%</span>
            </td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px] text-primary" style="font-variation-settings: 'FILL' 1;">star</span>
                <span class="text-body-md font-bold text-on-surface">4.92</span>
              </div>
            </td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-2">
                <div class="w-16 h-2 bg-surface-container rounded-full overflow-hidden">
                  <div class="w-1/3 h-full bg-primary"></div>
                </div>
                <span class="text-meta-xs text-on-surface-variant">4 Activas</span>
              </div>
            </td>
            <td class="px-6 py-4">
              <span class="bg-green-100 text-green-800 text-[11px] font-bold px-2 py-1 rounded">EXCEPCIONAL</span>
            </td>
          </tr>
          <!-- Row 2 -->
          <tr class="hover:bg-surface-container-high transition-colors">
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <img alt="Avatar de Agente" class="w-10 h-10 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2QojK7Q74ZkUJTcaZt0Oo-2x0I4ZPuZBX36mz9uwwIZssLqr75JknS8NToOdy1OIjApE_vFU1GWVmwqzpZzCdricF8PaZbkOv8Ut-8SuoEKJpk2mtUSYJtDeSIzGgBfQDwAwHH381p4oQ_nG-2RjgIjoYRuc1CuxlgW2z3ZDyar-DL2IssGR-dYJYwlFTCyF1g2-WszR6qLFMp99aw9GCd1gIhEMoFuNxrSC_miha8nIjvjNySUmoMFZA_W8UR9vH8i5eOPtlG_E" />
                <div>
                  <p class="font-label-sm text-label-sm text-on-surface">Michael Chen</p>
                  <p class="text-meta-xs text-on-surface-variant">Lead de Soporte</p>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <span class="text-body-md font-bold text-on-surface">212</span>
              <span class="text-meta-xs text-green-600 ml-1">+5%</span>
            </td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px] text-primary" style="font-variation-settings: 'FILL' 1;">star</span>
                <span class="text-body-md font-bold text-on-surface">4.85</span>
              </div>
            </td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-2">
                <div class="w-16 h-2 bg-surface-container rounded-full overflow-hidden">
                  <div class="w-2/3 h-full bg-primary"></div>
                </div>
                <span class="text-meta-xs text-on-surface-variant">7 Activas</span>
              </div>
            </td>
            <td class="px-6 py-4">
              <span class="bg-green-100 text-green-800 text-[11px] font-bold px-2 py-1 rounded">ALTA</span>
            </td>
          </tr>
          <!-- Row 3 -->
          <tr class="hover:bg-surface-container-high transition-colors">
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <img alt="Avatar de Agente" class="w-10 h-10 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDhqgg_t9WP3GiNXqYjvVjczppN1ivZpec7IoaAQecloVYFuMSMdsQCv7wfbLXRBZJvlFKxMadcftQhjF4w8LYFMS6JDLs4aNPhhne_M3xE4qIe8rP2zkTCcJMDOR3DMePIF-3GU0fRXgWdHs_dHfffPj7x_wr7hn2Z-VPr3P8xeiukV6tSBbTA8g6ekxqPr0L8kTN16EXzmiChx-M0R_WzEAgn6wC0qxi8DQ2kJnoq6PEgsLeYAIdAD4KXpkTxvnbLr9iGI43X-BY" />
                <div>
                  <p class="font-label-sm text-label-sm text-on-surface">Elena Rodriguez</p>
                  <p class="text-meta-xs text-on-surface-variant">Associada Junior</p>
                </div>
              </div>
            </td>
            <td class="px-6 py-4">
              <span class="text-body-md font-bold text-on-surface">186</span>
              <span class="text-meta-xs text-error ml-1">-2%</span>
            </td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px] text-primary" style="font-variation-settings: 'FILL' 1;">star</span>
                <span class="text-body-md font-bold text-on-surface">4.71</span>
              </div>
            </td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-2">
                <div class="w-16 h-2 bg-surface-container rounded-full overflow-hidden">
                  <div class="w-full h-full bg-error"></div>
                </div>
                <span class="text-meta-xs text-error">12 Activas</span>
              </div>
            </td>
            <td class="px-6 py-4">
              <span class="bg-yellow-100 text-yellow-800 text-[11px] font-bold px-2 py-1 rounded">SOBRECARGADO</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</main>