// JavaScript para abrir y cerrar modal
const btnActualizar = document.getElementById('btnActualizar');
const modal = document.getElementById('modalActualizar');
const closeBtn = modal.querySelector('.close');
const btnCerrarModal = document.getElementById('btnCerrarModal');

btnActualizar.addEventListener('click', () => {
  modal.style.display = 'flex';
});

closeBtn.addEventListener('click', () => {
  modal.style.display = 'none';
});

btnCerrarModal.addEventListener('click', () => {
  modal.style.display = 'none';
});

// También para cerrar el modal al hacer clic fuera del contenido
window.addEventListener('click', (e) => {
  if (e.target === modal) {
    modal.style.display = 'none';
  }
});
