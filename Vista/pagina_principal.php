<?php

require_once '../controlador/validacion_sesion.php'; //Llamar la funcion validacion de sesion. 

//Prevenir el cache del navegador.
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../Vista/Login.php?message=Debe iniciar sesión");
    exit();
}
?>
<!DOCTYPE html>
<head>
    <title>
        Página Principal
    </title>
    <link rel="stylesheet" href="../assets/styles-principal-page.css">
    <link rel="icon" href="../img/icono_de_icon_web_probando_formato_icon.ico">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/pagina_principal_whatssaqpt.css">
</head>
    <body>
        <nav class="navbar-pagina-principal">
            <div class="logo-pagina-principal">
                    <div class="logo-pagina-principal">
                        <a href="pagina_principal.php">
                            <img src="../img/icono_de_logo_sin_formato_icon.png" alt="Logo" class="logo-img">
                        </a>
                    </div>
                <ul>
                    <li></li>
                    <li><a href="pagina_principal.php">🏠Página Principal</a></li>
                    <li><a href="solicitudes.php">📝Solicitudes</a></li>
                    <li><a href="mis_cursos.php">📚Mis Cursos</a></li>
                    <li><a href="biblioteca.php">💡Biblioteca Virtual</a></li>
                </ul>
            </div>

            <div class="menu-desplegable">
                <ul>
                    <li class="dropdown">
                        <a href="#" class="dropbtn">👤Mi Perfil</a>
                        <div class="dropdown-content">
                            <a href="informacion_usuario.php">Mi Información</a>
                            <a href="../controlador/logout.php">Cerrar Sesión</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    
    <main class="contenido-pagina-principal">
        <div class="container-main">
            <div class="msg-bienvenida">
            <?php echo "<h1>💫 " . htmlspecialchars($_SESSION['nombre_usuario']) . ", bienvenido a tu plataforma virtual educativa 💫</h1>"; ?>
            <h2>¡Aprende, crece y transforma!</h2>
            </div>

            <div class="descripcion-sitio">
                <h2>👥¿Quiénes somos?</h2>
                <h3>ReEduca es una plataforma web enfocada en la reinserción de personas desplazadas. Esta plataforma permite a los estudiantes adquirir competencias básicas para completar su formación académica.</h3>
            </div>

            <div class="empieza-ahora">
                <h2>📚 ¡Empieza ahora! 🚀</h2>
                <ul>
                    <li><a href="solicitudes.php" class="btn-solicitudes">Solicitudes</a></li>
                    <li><a href="mis_cursos.php" class="btn-Mis-cursos">Mis cursos</a></li>
                    <li><a href="biblioteca.php" class="btn-biblioteca-virtual">Biblioteca Virtual</a></li>
                </ul>
            </div>

            <div class="preguntas-frecuentes">
                <h2>❓Preguntas Frecuentes</h2>
                <ul>
                <li>
                    <button class="faq-question" onclick="toggleAnswer(1)">¿La plataforma es gratuita?</button>
                    <div class="faq-answer" id="answer-1">
                        <p>Sí, la plataforma es completamente gratuita. Sin embargo, para acceder a todos los recursos académicos y materiales, es necesario crear una solicitud. Este proceso nos permite gestionar el acceso según las necesidades y el perfil de cada usuario.</p>
                    </div>
                </li>
                <li>
                    <button class="faq-question" onclick="toggleAnswer(2)">¿Qué tipo de recursos están disponibles en la plataforma?</button>
                    <div class="faq-answer" id="answer-2">
                        <p>La plataforma ofrece una amplia variedad de recursos, incluidos cursos, materiales educativos y herramientas de apoyo. Estos recursos están diseñados para facilitar el aprendizaje a tu propio ritmo, y están disponibles para todos los usuarios registrados.</p>
                    </div>
                </li>
                <li>
                    <button class="faq-question" onclick="toggleAnswer(3)">¿Cómo puedo registrarme para acceder a los cursos?</button>
                    <div class="faq-answer" id="answer-3">
                        <p>Para registrarte, solo necesitas crear una cuenta en nuestra plataforma. Después de registrarte, podrás acceder a los cursos y materiales disponibles. Sin embargo, para obtener acceso completo a los cursos y recursos, necesitarás crear una solicitud que será revisada según tu perfil y necesidades educativas.</p>
                    </div>
                </li>
                <li>
                    <button class="faq-question" onclick="toggleAnswer(4)">¿Puedo acceder a cursos si aún no tengo respuesta de mi solicitud?</button>
                    <div class="faq-answer" id="answer-4">
                        <p>Sí, puedes acceder a ciertos contenidos diseñados para quienes desean ser autodidactas, disponibles en la sección de <a href="#">Biblioteca Virtual</a>. Estos cursos están disponibles sin necesidad de crear una solicitud, pero el acceso completo a la plataforma requiere pasar por ese proceso.</p>
                    </div>
                </li>

                </ul>
            </div>

            <div class="ans-catalogo">
                <h2>📦Gestión de Servicios</h2>
                <div class="catalogo">
                    <a href="ANS.pdf" target="_blank" class="btn-pdf">Catálogo de Servicios</a>
                </div>
                <div class="ans">
                    <a href="CATÁLOGO.pdf" target="_blank" class="btn-pdf">Catálogo de Servicios</a>
                </div>
            </div>
        </div>
    </main>

    <section class="seccion-logo">
    <div class="logo-container">
        <img src="../img/imagen_3.png" alt="Logo">
    </div>
    <div class="linea-separadora"></div>
    <div class="text-container">
        <p>Reeduca es una plataforma web diseñada para brindarte la oportunidad de finalizar tus estudios. Ofrecemos segundas oportunidades
        a aquellas personas que han sido víctimas del conflicto armado en nuestro país, permitiéndoles acceder a una educación flexible y de calidad.</p>
    </div>
</section>
<!-- Botón flotante de WhatsApp con imagen -->
<a href="https://wa.me/573228337441?text=Necesito%20su%20colaboracion" 
   class="whatsapp-float" 
   target="_blank" 
   title="Contáctanos por WhatsApp">
    <img src="../assets/whatsapp-icon-free-png.webp" alt="WhatsApp" class="whatsapp-icon">
</a>

</body>
<script src="../assets/principal.js"></script>