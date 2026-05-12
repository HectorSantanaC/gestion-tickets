const API_BASE = '/gestion-tickets/api';

function getStatusLabel(status) {
  const labels = {
    'abierta': 'Abierta',
    'en_proceso': 'En Proceso',
    'en_progreso': 'En Progreso',
    'pendiente_verificacion': 'Pendiente de Verificación',
    'resuelta': 'Resuelta',
    'cerrada': 'Cerrada'
  };
  return labels[status] || status;
}

function getStatusDot(status) {
  const colors = {
    'abierta': 'bg-info',
    'en_proceso': 'bg-warning',
    'en_progreso': 'bg-warning',
    'pendiente_verificacion': 'bg-tertiary',
    'resuelta': 'bg-success',
    'cerrada': 'bg-neutral'
  };
  return colors[status] || 'bg-neutral';
}

function getPriorityBadge(priority) {
  const configs = {
    'urgente': { bg: 'bg-error-container', text: 'text-error', label: 'URGENTE' },
    'alta': { bg: 'bg-warning-container', text: 'text-warning', label: 'ALTA' },
    'normal': { bg: 'bg-info-container', text: 'text-info', label: 'NORMAL' },
    'baja': { bg: 'bg-neutral-container', text: 'text-neutral', label: 'BAJA' }
  };
  const c = configs[priority] || configs['normal'];
  return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold ${c.bg} ${c.text}">${c.label}</span>`;
}

function getPriorityText(priority) {
  const labels = {
    'urgente': 'Urgente',
    'alta': 'Alta',
    'normal': 'Normal',
    'baja': 'Baja'
  };
  return labels[priority] || priority;
}

function formatTimeAgo(dateStr) {
  if (!dateStr) return '-';
  const date = new Date(dateStr);
  const now = new Date();
  const diff = Math.floor((now - date) / 1000);

  if (diff < 60) return 'hace ' + diff + 's';
  if (diff < 3600) return 'hace ' + Math.floor(diff / 60) + ' min';
  if (diff < 86400) return 'hace ' + Math.floor(diff / 3600) + 'h';
  return 'hace ' + Math.floor(diff / 86400) + ' días';
}

function formatDate(dateStr) {
  if (!dateStr) return '-';
  const date = new Date(dateStr);
  return date.toLocaleDateString('es-ES', {
    day: '2-digit',
    month: 'short',
    year: 'numeric'
  });
}