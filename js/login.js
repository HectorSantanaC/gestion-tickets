async function handleLogin(e) {
  e.preventDefault();

  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value;

  resetError();

  if (!email || !password) {
    showError('Email y contraseña son requeridos');
    return;
  }

  try {
    const response = await fetch(`${API_BASE}/auth/login`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email, password })
    });

    const data = await response.json();

    if (!response.ok) {
      showError(data.error || 'Credenciales inválidas');
      return;
    }

    window.location.href = '?page=dashboard';
  } catch (error) {
    showError('Error de conexión. Intente nuevamente.');
  }
}

function showError(message) {
  const errorEl = document.getElementById('login-error');
  if (errorEl) {
    errorEl.textContent = message;
    errorEl.classList.remove('hidden');
  }
}

function resetError() {
  const errorEl = document.getElementById('login-error');
  if (errorEl) {
    errorEl.classList.add('hidden');
    errorEl.textContent = '';
  }
}

document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('login-form');
  if (form) {
    form.addEventListener('submit', handleLogin);
  }
});
