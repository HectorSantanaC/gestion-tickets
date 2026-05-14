let ticketId = null;

function getTicketId() {
  const params = new URLSearchParams(window.location.search);
  return params.get('id');
}

async function loadTicket(id) {
  const response = await fetch(`${API_BASE}/tickets?id=${id}`);
  if (!response.ok) throw new Error('Error al cargar ticket');
  const data = await response.json();
  return data.data;
}

async function loadComments(id) {
  const response = await fetch(`${API_BASE}/tickets/${id}/comments`);
  if (!response.ok) throw new Error('Error al cargar comentarios');
  const data = await response.json();
  return data.data;
}

async function loadAttachments(id) {
  const response = await fetch(`${API_BASE}/tickets/${id}/attachments`);
  if (!response.ok) throw new Error('Error al cargar adjuntos');
  const data = await response.json();
  return data.data;
}

function renderTicket(ticket) {
  document.getElementById('detail-ticket-number').textContent = ticket.ticket_number;

  document.getElementById('detail-priority').innerHTML = getPriorityBadge(ticket.priority);

  document.getElementById('detail-title').textContent = ticket.subject;

  const statusEl = document.getElementById('detail-status-badge');
  const statusDot = getStatusDot(ticket.status);
  statusEl.innerHTML = `
    <span class="w-2 h-2 rounded-full ${statusDot}"></span>
    ${getStatusLabel(ticket.status)}
  `;

  const descEl = document.getElementById('detail-description');
  if (ticket.description) {
    descEl.innerHTML = ticket.description
      .split('\n')
      .filter(p => p.trim())
      .map(p => `<p class="mb-2">${p}</p>`)
      .join('');
  } else {
    descEl.textContent = 'Sin descripción';
  }

  const reporterEl = document.getElementById('detail-reporter');
  reporterEl.querySelector('span:last-child').textContent = `Usuario #${ticket.reporter_external_id}`;

  const assigneeEl = document.getElementById('detail-assignee');
  if (ticket.assignee_external_id) {
    assigneeEl.querySelector('span:last-child').textContent = `Agente #${ticket.assignee_external_id}`;
  } else {
    assigneeEl.querySelector('span:last-child').textContent = 'Sin asignar';
  }

  document.getElementById('detail-created-at').textContent = formatDate(ticket.created_at);

  document.getElementById('detail-category').textContent = ticket.category ? ticket.category.name : '-';
  document.getElementById('detail-impact').textContent = ticket.impact_level || '-';

  const tagsEl = document.getElementById('detail-tags');
  if (ticket.tags && ticket.tags.length > 0) {
    tagsEl.innerHTML = ticket.tags.map(tag =>
      `<span class="px-2 py-1 bg-secondary-container text-on-secondary-container rounded font-meta-xs text-meta-xs">${tag.name}</span>`
    ).join('');
  }

  const statusSelect = document.getElementById('detail-status-select');
  statusSelect.value = ticket.status;
}

function renderComments(comments) {
  const container = document.getElementById('detail-comments');

  if (!comments || comments.length === 0) {
    container.innerHTML = `
      <div class="flex gap-margin-lg">
        <div class="mt-1">
          <span class="material-symbols-outlined text-outline text-[20px]">info</span>
        </div>
        <div>
          <p class="font-body-md text-body-md text-on-surface-variant">Sin actividad aún</p>
        </div>
      </div>
    `;
    return;
  }

  container.innerHTML = comments.map(comment => `
    <div class="flex gap-margin-lg">
      <div class="mt-1">
        <span class="material-symbols-outlined text-outline text-[20px]">forum</span>
      </div>
      <div class="flex-1 bg-surface-container-low p-margin-lg rounded-xl">
        <div class="flex justify-between items-center mb-2">
          <span class="font-label-sm text-label-sm text-primary">Usuario #${comment.author_external_id}</span>
          <span class="font-meta-xs text-meta-xs text-outline">${formatTimeAgo(comment.created_at)}</span>
        </div>
        <p class="font-body-md text-body-md text-on-surface-variant">${comment.content}</p>
      </div>
    </div>
  `).join('');
}

function renderAttachments(attachments) {
  const container = document.getElementById('detail-attachments');

  if (!attachments || attachments.length === 0) {
    container.innerHTML = '<p class="font-meta-xs text-meta-xs text-on-surface-variant">Sin adjuntos</p>';
    return;
  }

  container.innerHTML = attachments.map(file => {
    const icon = file.mime_type && file.mime_type.startsWith('image/') ? 'image' : 'description';
    const size = file.file_size
      ? (file.file_size / 1024).toFixed(1) + ' KB'
      : '';
    return `
      <div class="flex items-center gap-margin-md p-2 hover:bg-surface-container-low rounded-lg border border-transparent hover:border-outline-variant transition-all cursor-pointer">
        <span class="material-symbols-outlined text-outline">${icon}</span>
        <div class="flex-1 min-w-0">
          <p class="font-label-sm text-label-sm truncate">${file.filename}</p>
          <p class="font-meta-xs text-meta-xs text-outline">${size}</p>
        </div>
      </div>
    `;
  }).join('');
}

async function uploadFile(file) {
  const formData = new FormData();
  formData.append('file', file);
  formData.append('uploader_external_id', '1');

  const response = await fetch(`${API_BASE}/tickets/${ticketId}/attachments`, {
    method: 'POST',
    body: formData
  });

  if (!response.ok) {
    const data = await response.json();
    throw new Error(data.error || 'Error al subir archivo');
  }

  return response.json();
}

function showError(message) {
  document.getElementById('detail-ticket-number').textContent = 'Error';
  document.getElementById('detail-title').textContent = message;
}

async function initTicketDetail() {
  ticketId = getTicketId();
  if (!ticketId) {
    showError('ID de ticket no proporcionado');
    return;
  }

  try {
    const ticket = await loadTicket(ticketId);
    if (!ticket) {
      showError('Ticket no encontrado');
      return;
    }

    renderTicket(ticket);

    const [comments, attachments] = await Promise.all([
      loadComments(ticketId),
      loadAttachments(ticketId)
    ]);

    renderComments(comments);
    renderAttachments(attachments);

    document.getElementById('btn-attach-files')?.addEventListener('click', () => {
      document.getElementById('detail-file-input')?.click();
    });

    document.getElementById('btn-add-attachment')?.addEventListener('click', () => {
      document.getElementById('detail-file-input')?.click();
    });

    document.getElementById('detail-file-input')?.addEventListener('change', async function () {
      if (this.files.length === 0) return;
      try {
        await uploadFile(this.files[0]);
        const attachments = await loadAttachments(ticketId);
        renderAttachments(attachments);
      } catch (error) {
        console.error('Error:', error);
        alert('Error al subir archivo: ' + error.message);
      }
      this.value = '';
    });
  } catch (error) {
    console.error('Error:', error);
    showError('Error al cargar el ticket');
  }
}

document.addEventListener('DOMContentLoaded', initTicketDetail);
