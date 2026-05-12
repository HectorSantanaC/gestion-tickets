let categories = [];
let tags = [];

function getCategoryColor(index) {
  const colors = [
    'bg-error',
    'bg-tertiary',
    'bg-secondary',
    'bg-primary',
    'bg-success',
    'bg-warning',
    'bg-info',
    'bg-purple'
  ];
  return colors[index % colors.length];
}

function getTagColor(index) {
  const colors = [
    'bg-secondary-container',
    'bg-tertiary-fixed',
    'bg-primary-fixed-dim',
    'bg-error-container',
    'bg-surface-container-high',
    'bg-secondary-fixed-dim',
    'bg-tertiary-container',
    'bg-primary-container'
  ];
  return colors[index % colors.length];
}

function renderCategories() {
  const list = document.getElementById('categories-list');
  if (!list) return;
  
  if (categories.length === 0) {
    list.innerHTML = '<p class="text-on-surface-variant text-body-md p-3">No hay categorías</p>';
    return;
  }

  list.innerHTML = categories.map((cat, i) => `
    <li class="p-3 bg-surface border border-outline-variant rounded-lg flex items-center justify-between group hover:border-primary transition-all cursor-pointer" data-id="${cat.id}">
      <div class="flex items-center gap-3">
        <div class="w-2 h-2 rounded-full ${getCategoryColor(i)}"></div>
        <span class="font-body-md text-body-md text-on-surface">${cat.name}</span>
      </div>
      <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
        <button class="p-1 hover:bg-surface-container rounded edit-btn" title="Editar">
          <span class="material-symbols-outlined text-[16px] text-on-surface-variant">edit</span>
        </button>
        <button class="p-1 hover:bg-error-container rounded delete-btn" title="Eliminar">
          <span class="material-symbols-outlined text-[16px] text-error">delete</span>
        </button>
      </div>
    </li>
  `).join('');

  list.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const id = btn.closest('li').dataset.id;
      openCategoryModal(id);
    });
  });

  list.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const id = btn.closest('li').dataset.id;
      deleteCategory(id);
    });
  });
}

function renderTags() {
  const list = document.getElementById('tags-list');
  if (!list) return;
  
  if (tags.length === 0) {
    list.innerHTML = '<p class="text-on-surface-variant text-body-md p-3">No hay etiquetas</p>';
    return;
  }

  list.innerHTML = tags.map((tag, i) => `
    <li class="p-3 bg-surface border border-outline-variant rounded-lg flex items-center justify-between group hover:border-primary transition-all cursor-pointer" data-id="${tag.id}">
      <span class="font-body-md text-body-md text-on-surface">${tag.name}</span>
      <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
        <button class="p-1 hover:bg-surface-container rounded edit-btn" title="Editar">
          <span class="material-symbols-outlined text-[16px] text-on-surface-variant">edit</span>
        </button>
        <button class="p-1 hover:bg-error-container rounded delete-btn" title="Eliminar">
          <span class="material-symbols-outlined text-[16px] text-error">delete</span>
        </button>
      </div>
    </li>
  `).join('');

  list.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const id = btn.closest('li').dataset.id;
      openTagModal(id);
    });
  });

  list.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const id = btn.closest('li').dataset.id;
      deleteTag(id);
    });
  });
}

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

async function loadTags() {
  try {
    const response = await fetch(`${API_BASE}/tags`);
    if (!response.ok) throw new Error('Error al cargar etiquetas');
    const data = await response.json();
    tags = data.data;
    renderTags();
  } catch (error) {
    console.error('Error:', error);
  }
}

function openCategoryModal(id = null) {
  const modal = document.getElementById('category-modal');
  const form = document.getElementById('category-form');
  const title = document.getElementById('category-modal-title');
  
  form.reset();
  document.getElementById('category-id').value = '';
  
  if (id) {
    const cat = categories.find(c => c.id === id);
    if (cat) {
      title.textContent = 'Editar Categoría';
      document.getElementById('category-id').value = cat.id;
      document.getElementById('category-name').value = cat.name;
      document.getElementById('category-description').value = cat.description || '';
    }
  } else {
    title.textContent = 'Nueva Categoría';
  }
  
  modal.classList.remove('hidden');
}

function openTagModal(id = null) {
  const modal = document.getElementById('tag-modal');
  const form = document.getElementById('tag-form');
  const title = document.getElementById('tag-modal-title');
  
  form.reset();
  document.getElementById('tag-id').value = '';
  
  if (id) {
    const tag = tags.find(t => t.id === id);
    if (tag) {
      title.textContent = 'Editar Etiqueta';
      document.getElementById('tag-id').value = tag.id;
      document.getElementById('tag-name').value = tag.name;
    }
  } else {
    title.textContent = 'Nueva Etiqueta';
  }
  
  modal.classList.remove('hidden');
}

function closeCategoryModal() {
  document.getElementById('category-modal').classList.add('hidden');
}

function closeTagModal() {
  document.getElementById('tag-modal').classList.add('hidden');
}

async function saveCategory(e) {
  e.preventDefault();
  
  const id = document.getElementById('category-id').value;
  const name = document.getElementById('category-name').value.trim();
  const description = document.getElementById('category-description').value.trim();
  
  const payload = { name, description };
  let url = `${API_BASE}/categories`;
  let method = 'POST';
  
  if (id) {
    url += `?id=${id}`;
    method = 'PUT';
  }
  
  try {
    const response = await fetch(url, {
      method,
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    
    if (!response.ok) {
      const data = await response.json();
      alert(data.error || 'Error al guardar categoría');
      return;
    }
    
    closeCategoryModal();
    await loadCategories();
  } catch (error) {
    console.error('Error:', error);
    alert('Error al guardar categoría');
  }
}

async function deleteCategory(id) {
  if (!confirm('¿Estás seguro de eliminar esta categoría?')) return;
  
  try {
    const response = await fetch(`${API_BASE}/categories?id=${id}`, {
      method: 'DELETE'
    });
    
    if (!response.ok) {
      const data = await response.json();
      alert(data.error || 'Error al eliminar categoría');
      return;
    }
    
    await loadCategories();
  } catch (error) {
    console.error('Error:', error);
    alert('Error al eliminar categoría');
  }
}

async function saveTag(e) {
  e.preventDefault();
  
  const id = document.getElementById('tag-id').value;
  const name = document.getElementById('tag-name').value.trim();
  
  const payload = { name };
  let url = `${API_BASE}/tags`;
  let method = 'POST';
  
  if (id) {
    url += `?id=${id}`;
    method = 'PUT';
  }
  
  try {
    const response = await fetch(url, {
      method,
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    
    if (!response.ok) {
      const data = await response.json();
      alert(data.error || 'Error al guardar etiqueta');
      return;
    }
    
    closeTagModal();
    await loadTags();
  } catch (error) {
    console.error('Error:', error);
    alert('Error al guardar etiqueta');
  }
}

async function deleteTag(id) {
  if (!confirm('¿Estás seguro de eliminar esta etiqueta?')) return;
  
  try {
    const response = await fetch(`${API_BASE}/tags?id=${id}`, {
      method: 'DELETE'
    });
    
    if (!response.ok) {
      const data = await response.json();
      alert(data.error || 'Error al eliminar etiqueta');
      return;
    }
    
    await loadTags();
  } catch (error) {
    console.error('Error:', error);
    alert('Error al eliminar etiqueta');
  }
}

function initTabs() {
  const tabBtns = document.querySelectorAll('.tab-btn');
  const tabContents = document.querySelectorAll('.tab-content');
  
  tabBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const tabId = this.dataset.tab;
      
      tabBtns.forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      
      tabContents.forEach(content => {
        content.classList.add('hidden');
      });
      
      const targetTab = document.getElementById(`tab-${tabId}`);
      if (targetTab) {
        targetTab.classList.remove('hidden');
      }
    });
  });
}

function initAdmin() {
  initTabs();
  
  const addCategoryBtn = document.getElementById('add-category-btn');
  const addTagBtn = document.getElementById('add-tag-btn');
  
  if (addCategoryBtn) {
    addCategoryBtn.addEventListener('click', () => openCategoryModal());
  }
  
  if (addTagBtn) {
    addTagBtn.addEventListener('click', () => openTagModal());
  }
  
  document.getElementById('category-form')?.addEventListener('submit', saveCategory);
  document.getElementById('tag-form')?.addEventListener('submit', saveTag);
  
  document.getElementById('close-category-modal')?.addEventListener('click', closeCategoryModal);
  document.getElementById('close-tag-modal')?.addEventListener('click', closeTagModal);
  document.getElementById('close-category-modal-btn')?.addEventListener('click', closeCategoryModal);
  document.getElementById('close-tag-modal-btn')?.addEventListener('click', closeTagModal);
  
  loadCategories();
  loadTags();
}

document.addEventListener('DOMContentLoaded', initAdmin);
