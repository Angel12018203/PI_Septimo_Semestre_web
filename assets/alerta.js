
/*JS de validación con SweetAlert */
  document.getElementById('formSolicitud').addEventListener('submit', function (event) {
    if (!this.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();

      Swal.fire({
        icon: 'warning',
        title: 'Campos incompletos o inválidos',
        text: 'Por favor revisa que todos los campos requeridos estén correctamente diligenciados.',
        confirmButtonColor: '#3085d6'
      });
    }
    this.classList.add('was-validated');
  });
