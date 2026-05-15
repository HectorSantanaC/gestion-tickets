let currentPage = 1;
let currentStatus = '';
const perPage = 10;
let totalTickets = 0;

function getStatusBadge(status) {
  const configs = {
    'abierta': { bg: 'bg-primary-fixed', text: 'text-primary', label: 'Abierta' },
    'en_proceso': { bg: 'bg-tertiary-fixed', text: 'text-tertiary', label: 'En Proceso' },
    'en_progreso': { bg: 'bg-tertiary-fixed', text: 'text-tertiary', label: 'En Proceso' },
    'pendiente_verificacion': { bg: 'bg-secondary-fixed', text: 'text-on-secondary-fixed', label: 'Pendiente' },
    'resuelta': { bg: 'bg-success-container', text: 'text-success', label: 'Resuelta' },
    'cerrada': { bg: 'bg-success-container', text: 'text-success', label: 'Cerrado' }
  };
  const c = configs[status] || configs['abierta'];
  return `<span class="px-margin-md py-1 rounded-full ${c.bg} ${c.text} font-label-sm text-label-sm">${c.label}</span>`;
}

function getPriorityBadge(priority) {
  const configs = {
    'urgente': { bg: 'bg-error-container', text: 'text-error', label: 'Urgente' },
    'alta': { bg: 'bg-warning-container', text: 'text-warning', label: 'Alta' },
    'normal': { bg: 'bg-info-container', text: 'text-info', label: 'Normal' },
    'baja': { bg: 'bg-neutral-container', text: 'text-neutral', label: 'Baja' }
  };
  const c = configs[priority] || configs['normal'];
  return `<span class="px-margin-md py-1 rounded-full ${c.bg} ${c.text} font-label-sm text-label-sm">${c.label}</span>`;
}

function renderTickets(tickets) {
  const tbody = document.getElementById('tickets-table-body');
  if (!tickets || tickets.length === 0) {
    tbody.innerHTML = '<tr><td colspan="7" class="px-margin-lg py-8 text-center text-on-surface-variant">No se encontraron incidencias</td></tr>';
    return;
  }

  tbody.innerHTML = tickets.map(ticket => `
        <tr class="hover:bg-surface-container-high transition-colors cursor-pointer" onclick="window.location.href='?page=ticket-detail&id=${ticket.id}'">
            <td class="px-margin-lg py-4">
                <span class="font-label-sm text-label-sm text-primary">${ticket.ticket_number}</span>
            </td>
            <td class="px-margin-lg py-4">
                <div class="flex items-center gap-margin-md">
                    <span class="material-symbols-outlined ${ticket.priority === 'urgente' ? 'text-tertiary' : 'text-on-surface-variant'} text-[20px]">${ticket.priority === 'urgente' ? 'priority_high' : 'info'}</span>
                    <span class="font-body-md text-body-md text-on-surface">${ticket.subject}</span>
                </div>
            </td>
            <td class="px-margin-lg py-4">
                ${getStatusBadge(ticket.status)}
            </td>
            <td class="px-margin-lg py-4">
                ${getPriorityBadge(ticket.priority)}
            </td>
            <td class="px-margin-lg py-4">
                ${ticket.assignee_external_id
      ? `<div class="flex items-center gap-2"><div class="w-6 h-6 rounded-full bg-secondary-fixed flex items-center justify-center text-[10px] font-bold text-secondary">${ticket.assignee_initial || '?'}</div><span class="font-body-md text-body-md">${ticket.assignee_name}</span></div>`
      : '<span class="font-body-md text-body-md text-on-surface-variant">Sin asignar</span>'
    }
            </td>
            <td class="px-margin-lg py-4">
                <span class="font-body-md text-body-md text-on-surface-variant">${formatDate(ticket.created_at)}</span>
            </td>
            <td class="px-margin-lg py-4">
                <button class="p-2 hover:bg-surface-container rounded transition-colors" onclick="event.stopPropagation()">
                    <span class="material-symbols-outlined text-on-surface-variant">more_vert</span>
                </button>
            </td>
        </tr>
    `).join('');
}

function updatePaginationMeta() {
  const start = totalTickets === 0 ? 0 : (currentPage - 1) * perPage + 1;
  const end = Math.min(currentPage * perPage, totalTickets);
  document.getElementById('pagination-info').textContent =
    `Mostrando ${start}-${end} de ${totalTickets} incidencias`;

  const btnAnterior = document.getElementById('btn-anterior');
  const btnSiguiente = document.getElementById('btn-siguiente');
  btnAnterior.disabled = currentPage <= 1;
  btnSiguiente.disabled = currentPage * perPage >= totalTickets;
}

async function loadTickets() {
  try {
    let url = `${API_BASE}/tickets?page=${currentPage}&per_page=${perPage}`;
    if (currentStatus) {
      url += `&status=${currentStatus}`;
    }

    const response = await fetch(url);
    if (!response.ok) throw new Error('Error al cargar tickets');
    const data = await response.json();

    totalTickets = data.meta.total;
    renderTickets(data.data);
    updatePaginationMeta();
  } catch (error) {
    console.error('Error:', error);
    document.getElementById('tickets-table-body').innerHTML =
      '<tr><td colspan="7" class="px-margin-lg py-8 text-center text-error">Error al cargar las incidencias</td></tr>';
  }
}

function initTickets() {
  document.getElementById('btn-anterior').addEventListener('click', () => {
    if (currentPage > 1) {
      currentPage--;
      loadTickets();
    }
  });

  document.getElementById('btn-siguiente').addEventListener('click', () => {
    currentPage++;
    loadTickets();
  });

  loadTickets();
}

document.addEventListener('DOMContentLoaded', initTickets);