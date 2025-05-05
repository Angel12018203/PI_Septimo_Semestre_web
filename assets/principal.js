// Obtén el botón de menú y el contenedor desplegable
    const dropdown = document.querySelector('.menu-desplegable .dropdown');

    // Agrega un evento de clic para alternar la clase "active"
    dropdown.addEventListener('click', function (event) {
        // Evitar que el clic en el botón de menú cierre el menú
        event.stopPropagation();
        this.classList.toggle('active');
    });

    // Cerrar el menú si se hace clic fuera de él
    document.addEventListener('click', function (event) {
        // Si el clic no se realizó en el botón de menú ni en el menú desplegable, cerrarlo
        if (!dropdown.contains(event.target)) {
            dropdown.classList.remove('active');
        }
    });

    function toggleAnswer(id) {
        const answer = document.getElementById(`answer-${id}`);
        
        // Alternar clase para mostrar u ocultar
        if (answer.style.display === "block") {
            answer.style.display = "none";
        } else {
            answer.style.display = "block";
        }
    }

    // Opcional: Ocultar todas las respuestas al inicio
    document.addEventListener("DOMContentLoaded", () => {
        const answers = document.querySelectorAll(".faq-answer");
        answers.forEach(ans => ans.style.display = "none");
    });
