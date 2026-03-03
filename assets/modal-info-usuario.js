document.addEventListener('DOMContentLoaded', function () {
    const btnActualizar = document.getElementById('btnActualizar');
    const modal = document.getElementById('modalActualizar');
    const closeBtn = modal ? modal.querySelector('.close') : null;

    if (btnActualizar && modal) {
        btnActualizar.addEventListener('click', () => {
            modal.style.display = 'flex';
        });
    }

    if (closeBtn && modal) {  
        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    }

    // Cerrar modal al hacer clic fuera del contenido
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
