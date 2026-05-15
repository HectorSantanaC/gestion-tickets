let currentPage = 1;
let currentStatus = '';
const perPage = 10;
let totalTickets = 0;

function renderTickets(tickets) {
  const tbody = document.getElementById('tickets-table-body');
  if (!tickets || tickets.length === 0) {
    tbody.innerHTML = '<tr><td colspan="6" class="px-6 py-8 text-center text-on-surface-variant">No se encontraron incidencias</td></tr>';
    return;
  }

  tbody.innerHTML = tickets.map(ticket => `
        <tr class="hover:bg-surface-container-low transition-colors cursor-pointer group" onclick="window.location.href='?page=ticket-detail&id=${ticket.id}'">
            <td class="px-6 py-4 whitespace-nowrap font-label-sm text-primary">${ticket.ticket_number}</td>
            <td class="px-6 py-4">
                <div class="font-body-md font-semibold text-on-surface">${ticket.subject}</div>
                <div class="font-meta-xs text-on-surface-variant">${ticket.reporter_external_id === USER_ID ? 'Reportado por: ' + USER_NAME : `Reportado por: ID ${ticket.reporter_external_id}`}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                ${getPriorityBadge(ticket.priority)}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-on-surface-variant font-body-md">${ticket.category ? ticket.category.name : '-'}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    <span class="h-2 w-2 rounded-full ${getStatusDot(ticket.status)} mr-2"></span>
                    <span class="font-body-md text-on-surface">${getStatusLabel(ticket.status)}</span>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-on-surface-variant font-meta-xs">${formatTimeAgo(ticket.updated_at)}</td>
        </tr>
    `).join('');
}

function updatePaginationMeta() {
  const start = totalTickets === 0 ? 0 : (currentPage - 1) * perPage + 1;
  const end = Math.min(currentPage * perPage, totalTickets);
  document.getElementById('pagination-info').textContent =
    `Mostrando ${start} a ${end} de ${totalTickets} incidencias`;

  const btnAnterior = document.getElementById('btn-anterior');
  const btnSiguiente = document.getElementById('btn-siguiente');
  btnAnterior.disabled = currentPage <= 1;
  btnSiguiente.disabled = currentPage * perPage >= totalTickets;
}

async function loadDashboard() {
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

    await loadMetrics();
  } catch (error) {
    console.error('Error:', error);
    document.getElementById('tickets-table-body').innerHTML =
      '<tr><td colspan="6" class="px-6 py-8 text-center text-error">Error al cargar las incidencias</td></tr>';
  }
}

async function loadMetrics() {
  try {
    const response = await fetch(`${API_BASE}/statistics`);
    if (!response.ok) throw new Error('Error al cargar métricas');
    const data = await response.json();

    document.getElementById('metric-abiertas').textContent = data.data.abiertas;
    document.getElementById('metric-pendientes').textContent = data.data.pendientes;
    document.getElementById('metric-urgentes').textContent = data.data.urgentes;
    document.getElementById('metric-resueltas').textContent = data.data.resueltas_hoy;

    const tasa = data.data.total > 0
      ? Math.round((data.data.cerradas / data.data.total) * 100)
      : 0;
    document.getElementById('metric-resueltas-sub').textContent = tasa + '% tasa de resolución';
  } catch (error) {
    console.error('Error metrics:', error);
  }
}

function initDashboard() {
  document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.filter-btn').forEach(b => {
        b.classList.remove('bg-surface', 'shadow-sm', 'text-primary');
        b.classList.add('text-on-surface-variant');
      });
      this.classList.add('bg-surface', 'shadow-sm', 'text-primary');
      this.classList.remove('text-on-surface-variant');

      currentStatus = this.dataset.status;
      currentPage = 1;
      loadDashboard();
    });
  });

  document.getElementById('btn-anterior').addEventListener('click', () => {
    if (currentPage > 1) {
      currentPage--;
      loadDashboard();
    }
  });

  document.getElementById('btn-siguiente').addEventListener('click', () => {
    currentPage++;
    loadDashboard();
  });

  loadDashboard();
}

document.addEventListener('DOMContentLoaded', initDashboard);