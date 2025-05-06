
const campos = document.querySelectorAll("input, select");

campos.forEach(campo => {
    campo.addEventListener("blur", () => {
        campo.classList.add("tocado");
    });

    campo.addEventListener("input", () => {
        campo.classList.add("tocado");
    });
});

//Cargar el formulario registro para limpiar los campos del formulario. 
window.onload = function() {
  document.getElementById("registroForm").reset();
};

//Validacion de password o contraseña antes de enviar el formulario. 
document.getElementById("registroForm").addEventListener("submit", function(e) {
    const pwd = this.password.value;
    const confirm = this.confirm_password.value;
    if (pwd !== confirm) {
      e.preventDefault();
      alert("Las contraseñas no coinciden.");
    }
  });

  // Función para limpiar el formulario al cargar la página
  window.onload = function() {
    // Limpiar todos los campos del formulario
    document.getElementById("registroForm").reset();
  };

