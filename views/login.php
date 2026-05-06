<?php
$pageTitle = 'Iniciar Sesión - Gestor de Incidencias';

// Override body classes for login page (centered, no sidebar)
$bodyClass = 'bg-background text-on-background min-h-screen flex flex-col items-center justify-center p-container-padding';
?>

<body class="<?php echo $bodyClass; ?>">
  <!-- Background Decoration -->
  <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
    <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-primary/5 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[0%] right-[0%] w-[30%] h-[30%] bg-secondary-container/20 rounded-full blur-[100px]"></div>
  </div>

  <main class="relative z-10 w-full max-w-[440px]">
    <!-- Branding Header -->
    <div class="flex flex-col items-center mb-margin-xl">
      <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center shadow-lg mb-margin-lg">
        <span class="material-symbols-outlined text-on-primary text-[28px]" style="font-variation-settings: 'FILL' 1;">confirmation_number</span>
      </div>
      <h1 class="font-h1 text-h1 text-primary">Gestor de Incidencias</h1>
      <p class="font-body-md text-body-md text-on-surface-variant mt-margin-sm">Excelencia en Soporte Empresarial</p>
    </div>

    <!-- Auth Card -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-[0px_1px_3px_rgba(0,0,0,0.05),0px_10px_15px_-3px_rgba(0,0,0,0.03)] p-8">
      <!-- Tab Switcher -->
      <div class="flex bg-surface-container rounded-lg p-1 mb-8">
        <button class="flex-1 py-2 font-label-sm text-label-sm rounded-md bg-surface-container-lowest text-primary shadow-sm transition-all">
          Iniciar Sesión
        </button>
        <button class="flex-1 py-2 font-label-sm text-label-sm rounded-md text-on-surface-variant hover:text-on-surface transition-all">
          Registrarse
        </button>
      </div>

      <div class="relative flex items-center gap-4 mb-8">
        <div class="flex-grow border-t border-outline-variant"></div>
        <span class="font-meta-xs text-meta-xs text-outline uppercase tracking-wider">o correo electrónico</span>
        <div class="flex-grow border-t border-outline-variant"></div>
      </div>

      <!-- Login Form -->
      <form action="#" class="space-y-6" onsubmit="return false;">
        <div class="space-y-2">
          <label class="font-label-sm text-label-sm text-on-surface ml-1" for="email">Correo Corporativo</label>
          <div class="relative group">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors text-[20px]">mail</span>
            <input class="w-full pl-10 pr-4 py-2.5 bg-surface border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" id="email" placeholder="nombre@empresa.com" type="email" />
          </div>
        </div>

        <div class="space-y-2">
          <div class="flex justify-between items-center px-1">
            <label class="font-label-sm text-label-sm text-on-surface" for="password">Contraseña</label>
            <a class="font-label-sm text-label-sm text-primary hover:text-on-primary-fixed-variant transition-colors" href="#">¿Olvidaste tu contraseña?</a>
          </div>
          <div class="relative group">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors text-[20px]">lock</span>
            <input class="w-full pl-10 pr-4 py-2.5 bg-surface border border-outline-variant rounded-lg font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all" id="password" placeholder="••••••••" type="password" />
            <button class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface" type="button">
              <span class="material-symbols-outlined text-[20px]">visibility</span>
            </button>
          </div>
        </div>

        <div class="flex items-center gap-2 px-1">
          <input class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary" id="remember" type="checkbox" />
          <label class="font-body-md text-body-md text-on-surface-variant" for="remember">Mantener sesión iniciada</label>
        </div>

        <button class="w-full py-3 bg-primary text-on-primary font-label-sm text-label-sm rounded-lg shadow-md hover:bg-on-primary-fixed-variant active:scale-[0.98] transition-all" type="submit">
          Iniciar Sesión
        </button>
      </form>
    </div>

    <!-- Footer Links -->
    <div class="mt-margin-xl text-center flex flex-col gap-margin-md">
      <p class="font-body-md text-body-md text-on-surface-variant">
        ¿Nuevo en el Gestor de Incidencias?
        <a class="text-primary font-bold hover:underline" href="#">Solicitar invitación</a>
      </p>
      <div class="flex justify-center gap-gutter text-outline font-meta-xs text-meta-xs">
        <a class="hover:text-on-surface" href="#">Política de Privacidad</a>
        <span>•</span>
        <a class="hover:text-on-surface" href="#">Términos de Servicio</a>
        <span>•</span>
        <a class="hover:text-on-surface" href="#">Soporte</a>
      </div>
    </div>
  </main>
</body>