let categories = [];

async function loadCategories() {
  try {
    const response = await fetch(`${API_BASE}/categories`);
    if (!response.ok) throw new Error('Error al cargar categorías');
    const data = await response.json();
    categories = data.data;
    renderCategories();
  } catch (error) {
    console.error('Error:', error);
  }
}

function renderCategories() {
  const select = document.getElementById('ticket-category');
  if (!select) return;
  
  select.innerHTML = '<option value="">Seleccionar categoría</option>' + 
    categories.map(cat => `<option value="${cat.id}">${cat.name}</option>`).join('');
}

async function submitTicket(e) {
  e.preventDefault();
  
  const subject = document.getElementById('ticket-subject').value.trim();
  const description = document.getElementById('ticket-description').value.trim();
  const categoryId = document.getElementById('ticket-category').value;
  const priorityInput = document.querySelector('input[name="priority"]:checked');
  const priority = priorityInput ? priorityInput.value : 'normal';
  
  if (!subject) {
    alert('El asunto es requerido');
    return;
  }
  
  if (!description) {
    alert('La descripción es requerida');
    return;
  }
  
  const payload = {
    subject,
    description,
    priority,
    category_id: categoryId || null,
    reporter_external_id: 1
  };
  
  try {
    const response = await fetch(`${API_BASE}/tickets`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    
    if (!response.ok) {
      const data = await response.json();
      alert(data.error || 'Error al crear ticket');
      return;
    }
    
    const data = await response.json();
    window.location.href = `?page=ticket-detail&id=${data.data.id}`;
  } catch (error) {
    console.error('Error:', error);
    alert('Error al crear ticket');
  }
}

function initCreateTicket() {
  const form = document.getElementById('create-ticket-form');
  if (form) {
    form.addEventListener('submit', submitTicket);
  }
  
  document.getElementById('cancel-btn')?.addEventListener('click', () => {
    window.location.href = '?page=dashboard';
  });
  
  loadCategories();
}

document.addEventListener('DOMContentLoaded', initCreateTicket);
