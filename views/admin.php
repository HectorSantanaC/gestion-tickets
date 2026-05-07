<?php
$pageTitle = 'Servicio de Asistencia - Administración y Estadísticas';
$showTitle = false;
$searchPlaceholder = 'Buscar recursos...';
$profileImage = 'https://lh3.googleusercontent.com/aida-public/AB6AXuAIAUWnYnK1nq4pZjh8G8Ujy6juO-mpljCFp15GZm7_SU0zjgp_8YlSLV0f_WkvRqv-KjK1ugH76-Oqr0BDX-2ZkxOjRxbif__KOnHxfEQq1ev5YcodMKjJvjNdCDNYtIh7Fk_Yw4FQEzfSTyEs6D-DnkZyiiVlJKdXatxmhHYdOxQ1DXvT6OcRWyO5fxxSf2CGrVOUNG9hk0tNDjqdzvNsPQcN9SI7alIonJ8BfbM80SPF-enO7_G8-tMEMk8I9hvZyIXpN9Y5uzA';
?>

<!-- Main Content Area -->
<main class="flex-1 flex flex-col min-h-screen">
  <!-- TopAppBar -->
  <?php include_once 'includes/header.php'; ?>

  <!-- Page Canvas -->
  <div class="flex-1 p-6 max-w-[1400px] mx-auto w-full">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-gutter mb-margin-xl">
      <div>
        <h1 class="font-h1 text-h1 text-on-background mb-1">Resumen de Administración</h1>
        <p class="font-body-lg text-body-lg text-on-surface-variant">Administra la infraestructura empresarial, roles y métricas de rendimiento en tiempo real.</p>
      </div>
      <div class="flex gap-margin-md">
        <button class="flex items-center gap-2 px-margin-lg py-2 bg-primary text-on-primary rounded-lg font-label-sm text-label-sm shadow-sm hover:brightness-110 transition-all">
          <span class="material-symbols-outlined text-[18px]">download</span>
          Exportar Informe
        </button>
        <button class="flex items-center gap-2 px-margin-lg py-2 bg-surface-container-high border border-outline-variant text-on-surface rounded-lg font-label-sm text-label-sm shadow-sm hover:bg-surface-container-highest transition-all">
          <span class="material-symbols-outlined text-[18px]">refresh</span>
          Actualizar Sincronización
        </button>
      </div>
    </div>

    <!-- Tabbed Interface -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden mb-margin-xl">
      <div class="flex border-b border-outline-variant bg-surface-container-low px-margin-lg">
        <button class="px-margin-xl py-4 font-label-sm text-label-sm border-b-2 border-primary text-primary flex items-center gap-2">
          <span class="material-symbols-outlined text-[20px]" data-icon="groups">groups</span>
          Gestión de Usuarios
        </button>
        <button class="px-margin-xl py-4 font-label-sm text-label-sm border-b-2 border-transparent text-on-surface-variant hover:text-on-surface transition-colors flex items-center gap-2">
          <span class="material-symbols-outlined text-[20px]" data-icon="query_stats">query_stats</span>
          Estadísticas del Sistema
        </button>
        <button class="px-margin-xl py-4 font-label-sm text-label-sm border-b-2 border-transparent text-on-surface-variant hover:text-on-surface transition-colors flex items-center gap-2">
          <span class="material-symbols-outlined text-[20px]" data-icon="tune">tune</span>
          Configuración de Categorías
        </button>
      </div>

      <!-- Bento Grid Content (Stats Overview) -->
      <div class="p-margin-lg grid grid-cols-1 md:grid-cols-4 gap-gutter">
        <!-- Quick Stats Cards -->
        <div class="bg-surface p-margin-lg rounded-lg border border-outline-variant flex flex-col justify-between shadow-sm hover:shadow-md transition-shadow">
          <div class="flex justify-between items-start">
            <span class="text-on-surface-variant font-label-sm text-label-sm">Agentes Activos</span>
            <span class="p-2 bg-secondary-container text-on-secondary-container rounded-lg material-symbols-outlined text-[20px]">person</span>
          </div>
          <div class="mt-4">
            <h3 class="font-h1 text-h1 text-primary">42</h3>
            <p class="text-meta-xs font-meta-xs text-on-secondary-container mt-1">+3 desde ayer</p>
          </div>
        </div>

        <div class="bg-surface p-margin-lg rounded-lg border border-outline-variant flex flex-col justify-between shadow-sm hover:shadow-md transition-shadow">
          <div class="flex justify-between items-start">
            <span class="text-on-surface-variant font-label-sm text-label-sm">Tiempo de Respuesta Prom.</span>
            <span class="p-2 bg-tertiary-fixed-dim/20 text-tertiary-container rounded-lg material-symbols-outlined text-[20px]">schedule</span>
          </div>
          <div class="mt-4">
            <h3 class="font-h1 text-h1 text-primary">14m</h3>
            <p class="text-meta-xs font-meta-xs text-error mt-1">-5.2% desde pico</p>
          </div>
        </div>

        <div class="bg-surface p-margin-lg rounded-lg border border-outline-variant flex flex-col justify-between shadow-sm hover:shadow-md transition-shadow">
          <div class="flex justify-between items-start">
            <span class="text-on-surface-variant font-label-sm text-label-sm">Tasa de Resolución</span>
            <span class="p-2 bg-primary-fixed-dim/30 text-primary rounded-lg material-symbols-outlined text-[20px]">check_circle</span>
          </div>
          <div class="mt-4">
            <h3 class="font-h1 text-h1 text-primary">94.8%</h3>
            <p class="text-meta-xs font-meta-xs text-on-secondary-fixed mt-1">Meta: 95%</p>
          </div>
        </div>

        <div class="bg-surface p-margin-lg rounded-lg border border-outline-variant flex flex-col justify-between shadow-sm hover:shadow-md transition-shadow">
          <div class="flex justify-between items-start">
            <span class="text-on-surface-variant font-label-sm text-label-sm">Incidencias Escaladas</span>
            <span class="p-2 bg-error-container text-on-error-container rounded-lg material-symbols-outlined text-[20px]">warning</span>
          </div>
          <div class="mt-4">
            <h3 class="font-h1 text-h1 text-error">7</h3>
            <p class="text-meta-xs font-meta-xs text-error-container bg-error px-2 py-0.5 rounded-full inline-block mt-1">Alta Prioridad</p>
          </div>
        </div>
      </div>

      <!-- Main Section: User Management -->
      <div class="p-margin-lg">
        <div class="flex justify-between items-center mb-margin-lg">
          <h4 class="font-h3 text-h3 text-on-surface">Usuarios Registrados</h4>
          <div class="flex gap-margin-sm">
            <div class="relative">
              <span class="material-symbols-outlined absolute left-2 top-1/2 -translate-y-1/2 text-on-surface-variant text-[16px]">filter_list</span>
              <select class="pl-8 pr-4 py-1.5 bg-surface border border-outline-variant rounded-md text-label-sm font-label-sm outline-none focus:border-primary">
                <option>Filtrar por Rol</option>
                <option>Admin</option>
                <option>Agente</option>
                <option>Supervisor</option>
              </select>
            </div>
          </div>
        </div>

        <div class="overflow-x-auto border border-outline-variant rounded-lg">
          <table class="w-full text-left border-collapse">
            <thead class="bg-surface-container-low border-b border-outline-variant">
              <tr>
                <th class="px-margin-lg py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Usuario</th>
                <th class="px-margin-lg py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Rol</th>
                <th class="px-margin-lg py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Estado</th>
                <th class="px-margin-lg py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Última Actividad</th>
                <th class="px-margin-lg py-4 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider text-right">Acciones</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant font-body-md text-body-md">
              <tr class="hover:bg-surface-container-low transition-colors">
                <td class="px-margin-lg py-4">
                  <div class="flex items-center gap-3">
                    <img alt="User" class="w-8 h-8 rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCq52Nrl-R-oLa6u_Q5K-_aLOXrOZsDRNAC7Er8OshIZSkRgpXeH7Bl_Esa7AUy-B8gBa_9Q3mz2mGSxaiBEGWAQptrswuY9Aa4FPsEc_F8Pv2KQz_qY7izZk-ufQtptjBS5Dyz3sBzAarqQF1P22twqKImt6aOWIfUJAC_4rx1HYku9QbJgNLgP7lW4PNPorzPj80cCy_o64f6QILR01gA7fkTV7gV2S_LQsRQV79xUZhpVynhGwoXYlVj6e_g0E53arl8wJfYf6c" />
                    <div>
                      <div class="font-bold text-on-surface">Marcus Thorne</div>
                      <div class="text-meta-xs text-on-surface-variant">m.thorne@enterprise.com</div>
                    </div>
                  </div>
                </td>
                <td class="px-margin-lg py-4"><span class="bg-primary-fixed text-on-primary-fixed-variant px-3 py-1 rounded-full text-meta-xs font-bold">Admin</span></td>
                <td class="px-margin-lg py-4">
                  <div class="flex items-center gap-1.5 text-on-tertiary-fixed-variant">
                    <div class="w-2 h-2 rounded-full bg-on-tertiary-fixed-variant"></div>
                    Activo
                  </div>
                </td>
                <td class="px-margin-lg py-4 text-on-surface-variant">hace 2 min</td>
                <td class="px-margin-lg py-4 text-right">
                  <button class="material-symbols-outlined text-on-surface-variant hover:text-primary">more_vert</button>
                </td>
              </tr>

              <tr class="hover:bg-surface-container-low transition-colors">
                <td class="px-margin-lg py-4">
                  <div class="flex items-center gap-3">
                    <img alt="User" class="w-8 h-8 rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBK8KfGC9xoA0ttB8L_mUsCp2DEyMcqWm73cs_aeJD9Y0SHtnjcBLOY7MIyHaZb7uaS9o5Hjr2EMCUOI_MRvCQtfXERUGVvDzvNYYhUuCcFWgiEgqBHBz7BRX3-gl-QqLbdSOxLZN_rh4fn5-3JrfKfkMhjOpFv4EgCxYLfnvcZowBnUPfPjRdXQU4LOeGMBQ5YDJc8CJghzlbwKOwHljSPnl4xMRo1rBeBglpzuBuF1XeR1l08c_Q41v9dwdKE2lXSb_0vfaEbaBM" />
                    <div>
                      <div class="font-bold text-on-surface">Elena Rodriguez</div>
                      <div class="text-meta-xs text-on-surface-variant">e.rod@enterprise.com</div>
                    </div>
                  </div>
                </td>
                <td class="px-margin-lg py-4"><span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-meta-xs font-bold">Agente</span></td>
                <td class="px-margin-lg py-4">
                  <div class="flex items-center gap-1.5 text-on-tertiary-fixed-variant">
                    <div class="w-2 h-2 rounded-full bg-on-tertiary-fixed-variant"></div>
                    Activo
                  </div>
                </td>
                <td class="px-margin-lg py-4 text-on-surface-variant">hace 45 min</td>
                <td class="px-margin-lg py-4 text-right">
                  <button class="material-symbols-outlined text-on-surface-variant hover:text-primary">more_vert</button>
                </td>
              </tr>

              <tr class="hover:bg-surface-container-low transition-colors">
                <td class="px-margin-lg py-4">
                  <div class="flex items-center gap-3">
                    <img alt="User" class="w-8 h-8 rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjeCsF3XkOxPYdNMlhjcFKKUH5_REhcRtLlp7MamyWLE0pH2Z3wiDpboo0qeVTu3tBy6rqXCY1jfWxiOhiNuOcISnGQ4Szl-7kqhBMjJUobkOw0vsb6tZGkc-ma1v4tOmu91idcIwEqe7uE8o1-6AfStqAMk2F80J6I9yAUOS7wPCgaq9kCcHg_Pel9b0SusgBQz7USdBYew4G8i3WNGWgNHN0NVShEWXSOjYxHWxRLukH1YtjGCS6moE68qw4r412y2r7YwySUpw" />
                    <div>
                      <div class="font-bold text-on-surface">James Chen</div>
                      <div class="text-meta-xs text-on-surface-variant">j.chen@enterprise.com</div>
                    </div>
                  </div>
                </td>
                <td class="px-margin-lg py-4"><span class="bg-surface-variant text-on-surface-variant px-3 py-1 rounded-full text-meta-xs font-bold">Supervisor</span></td>
                <td class="px-margin-lg py-4">
                  <div class="flex items-center gap-1.5 text-on-surface-variant/50">
                    <div class="w-2 h-2 rounded-full bg-on-surface-variant/30"></div>
                    Desconectado
                  </div>
                </td>
                <td class="px-margin-lg py-4 text-on-surface-variant">hace 5 horas</td>
                <td class="px-margin-lg py-4 text-right">
                  <button class="material-symbols-outlined text-on-surface-variant hover:text-primary">more_vert</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Bottom Asymmetric Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-margin-xl">
      <!-- System Stats Visualizations -->
      <div class="lg:col-span-2 space-y-margin-xl">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-margin-xl">
          <div class="flex justify-between items-center mb-margin-lg">
            <div>
              <h3 class="font-h3 text-h3 text-on-surface">Volumen de Incidencias por Categoría</h3>
              <p class="text-meta-xs text-on-surface-variant">Distribución según los tipos principales de incidentes</p>
            </div>
            <button class="material-symbols-outlined text-on-surface-variant">fullscreen</button>
          </div>

          <!-- Simulated Bar Chart -->
          <div class="flex items-end gap-gutter h-64 pt-margin-xl">
            <div class="flex-1 flex flex-col items-center gap-2 group">
              <div class="w-full bg-primary-fixed-dim rounded-t-lg transition-all group-hover:bg-primary" style="height: 85%;"></div>
              <span class="font-meta-xs text-meta-xs text-on-surface-variant">Red</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-2 group">
              <div class="w-full bg-primary-fixed-dim rounded-t-lg transition-all group-hover:bg-primary" style="height: 60%;"></div>
              <span class="font-meta-xs text-meta-xs text-on-surface-variant">Hardware</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-2 group">
              <div class="w-full bg-primary-fixed-dim rounded-t-lg transition-all group-hover:bg-primary" style="height: 40%;"></div>
              <span class="font-meta-xs text-meta-xs text-on-surface-variant">Cuentas</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-2 group">
              <div class="w-full bg-primary-fixed-dim rounded-t-lg transition-all group-hover:bg-primary" style="height: 95%;"></div>
              <span class="font-meta-xs text-meta-xs text-on-surface-variant">Seguridad</span>
            </div>
            <div class="flex-1 flex flex-col items-center gap-2 group">
              <div class="w-full bg-primary-fixed-dim rounded-t-lg transition-all group-hover:bg-primary" style="height: 25%;"></div>
              <span class="font-meta-xs text-meta-xs text-on-surface-variant">Facturación</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Category Settings Sidebar-style List -->
      <div class="space-y-margin-xl">
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-margin-xl h-full">
          <div class="flex justify-between items-center mb-margin-lg">
            <h3 class="font-h3 text-h3 text-on-surface">Categorías</h3>
            <button class="p-1.5 bg-primary/10 text-primary rounded-full hover:bg-primary/20 transition-all">
              <span class="material-symbols-outlined text-[18px]">add</span>
            </button>
          </div>
          <ul class="space-y-3">
            <li class="p-3 bg-surface border border-outline-variant rounded-lg flex items-center justify-between group hover:border-primary transition-all cursor-pointer">
              <div class="flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-error"></div>
                <span class="font-body-md text-body-md text-on-surface">Infraestructura Crítica</span>
              </div>
              <span class="material-symbols-outlined text-[16px] opacity-0 group-hover:opacity-100 transition-opacity">edit</span>
            </li>
            <li class="p-3 bg-surface border border-outline-variant rounded-lg flex items-center justify-between group hover:border-primary transition-all cursor-pointer">
              <div class="flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-tertiary"></div>
                <span class="font-body-md text-body-md text-on-surface">Errores de Software</span>
              </div>
              <span class="material-symbols-outlined text-[16px] opacity-0 group-hover:opacity-100 transition-opacity">edit</span>
            </li>
            <li class="p-3 bg-surface border border-outline-variant rounded-lg flex items-center justify-between group hover:border-primary transition-all cursor-pointer">
              <div class="flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-secondary"></div>
                <span class="font-body-md text-body-md text-on-surface">Solicitudes de Acceso</span>
              </div>
              <span class="material-symbols-outlined text-[16px] opacity-0 group-hover:opacity-100 transition-opacity">edit</span>
            </li>
            <li class="p-3 bg-surface border border-outline-variant rounded-lg flex items-center justify-between group hover:border-primary transition-all cursor-pointer">
              <div class="flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-primary"></div>
                <span class="font-body-md text-body-md text-on-surface">Problemas de Red</span>
              </div>
              <span class="material-symbols-outlined text-[16px] opacity-0 group-hover:opacity-100 transition-opacity">edit</span>
            </li>
            <li class="p-3 bg-surface border border-outline-variant rounded-lg flex items-center justify-between group hover:border-primary transition-all cursor-pointer">
              <div class="flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                <span class="font-body-md text-body-md text-on-surface">Consulta General</span>
              </div>
              <span class="material-symbols-outlined text-[16px] opacity-0 group-hover:opacity-100 transition-opacity">edit</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</main>