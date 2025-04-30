<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Educativo para Estudiantes</title>
   <link rel="stylesheet" href="../assets/porta_web.css">
   <link rel="icon" href="../img/icono_de_icon_web_probando_formato_icon.ico">
</head>
<body>
    <header>
        <!-- Logo en la parte superior izquierda -->
        <div class="logo">
            <a href="../Vista/inicio.php">
            <img src="../img/reeduca.png" alt="Logo">
        </a>
    </div>


        <!-- Mensaje de bienvenida centrado -->
        <div class="welcome-text">
            <h1>Bienvenido, Estudiante</h1>
            <p>Tu portal educativo para el desarrollo de tus competencias</p>
        </div>
    </header>

    <div class="container">
        <!-- Lado izquierdo (Información del estudiante) -->
        <div class="left-sidebar">
            <div class="student-info">
                <img src="https://via.placeholder.com/150" alt="Foto del estudiante">
                <h2>Nombre del Estudiante</h2>
                <p>ID: 123456789</p>
                <p>Carrera: Bachillerato Académico</p>
                <p>Grupo: A</p>
                <input type="file" id="file-input" name="profile-picture">
                <p>Sube una nueva foto</p>
            </div>
        </div>

        <!-- Lado derecho (Competencias educativas) -->
        <div class="right-content">
            <section id="lectura">
                <h2>Lectura Crítica</h2>
                <p>En esta sección, aprenderás a desarrollar tus habilidades de lectura crítica. Aquí podrás encontrar recursos, actividades y consejos para mejorar tu capacidad de comprender, analizar y reflexionar sobre textos complejos.</p>
                <div class="button-container">
                    <button>Guía de lectura crítica</button>
                    <button>Ejercicios de análisis de textos</button>
                    <button>Clase personalizada</button>
                </div>
            </section>

            <section id="escritura">
                <h2>Escritura</h2>
                <p>En esta sección, te proporcionamos herramientas para mejorar tu capacidad de escribir de manera clara, coherente y efectiva. Trabajarás en la redacción de ensayos, resúmenes y otros tipos de textos.</p>
                <div class="button-container">
                    <button>Guía de escritura académica</button>
                    <button>Ejercicios de redacción</button>
                    <button>Clase personalizada</button>
                </div>
            </section>

            <section id="matematicas">
                <h2>Matemáticas</h2>
                <p>Aquí encontrarás recursos para fortalecer tus competencias en matemáticas, desde operaciones básicas hasta temas más avanzados. Aprende a resolver problemas matemáticos y a comprender conceptos fundamentales de la disciplina.</p>
                <div class="button-container">
                    <button>Lecciones de álgebra</button>
                    <button>Ejercicios prácticos</button>
                    <button>Clase personalizada</button>
                </div>
            </section>

            <section id="ciencias-sociales">
                <h2>Ciencias Sociales</h2>
                <p>En esta sección podrás explorar temas relacionados con la historia, la geografía y la sociedad. Aprenderás a analizar los eventos históricos y comprender el impacto de las ciencias sociales en la vida cotidiana.</p>
                <div class="button-container">
                    <button>Guía de historia mundial</button>
                    <button>Recursos de geografía</button>
                    <button>Clase personalizada</button>
                </div>
            </section>

            <section id="ciencias-naturales">
                <h2>Ciencias Naturales</h2>
                <p>Descubre el fascinante mundo de las ciencias naturales, incluyendo biología, química y física. Esta sección te ayudará a comprender los principios científicos fundamentales y a aplicar el método científico en diferentes situaciones.</p>
                <div class="button-container">
                    <button>Lecciones de biología</button>
                    <button>Experimentos de química</button>
                    <button>Clase personalizada</button>
                </div>
            </section>
        </div>
    </div>

</body>
</html>
