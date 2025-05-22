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
        <title>Mis Cursos</title>
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

        <main class="mis-cursos">
            <h2>Bienvenido a tus cursos</h2>
            <h3>Aquí podrás encontrar los cursos que te han sido habilitados de acuerdo a los registros que se encuentran en la base de datos del Ministerio de Educación. Los niveles de los cursos dependerán de tu nivel de conocimientos.</h3>
            <section class="contenedor-tarjetas-cursos">
                <a href="#" class="tarjeta-curso">
                    <div class="imagen-curso">
                        <img src="../assets/matematicas.jpg" alt="Matemáticas 1">
                    </div>
                    <div class="nombre-curso">Matemáticas 1</div>
                </a>

                <a href="#" class="tarjeta-curso">
                    <div class="imagen-curso">
                        <img src="../assets/ciencias_sociales.jpg" alt="Ciencias Sociales 1">
                    </div>
                    <div class="nombre-curso">Ciencias Sociales 1</div>
                </a>

                <a href="#" class="tarjeta-curso">
                    <div class="imagen-curso">
                        <img src="../assets/lengua_castellana.jpg" alt="Lengua Castellana 2">
                    </div>
                    <div class="nombre-curso">Lengua Castellana 2</div>
                </a>

                <a href="#" class="tarjeta-curso">
                    <div class="imagen-curso">
                        <img src="../assets/fisica.jpg" alt="Física 1">
                    </div>
                    <div class="nombre-curso">Física 1</div>
                </a>

                <a href="#" class="tarjeta-curso">
                    <div class="imagen-curso">
                        <img src="../assets/ciencias_naturales.jpg" alt="Ciencias Naturales 1">
                    </div>
                    <div class="nombre-curso">Ciencias Naturales 1</div>
                </a>

                <a href="#" class="tarjeta-curso">
                    <div class="imagen-curso">
                        <img src="../assets/tecnologia_e_informatica.jpg" alt="Tecnología e Informática">
                    </div>
                    <div class="nombre-curso">Tecnología e Informática</div>
                </a>

                <a href="#" class="tarjeta-curso">
                    <div class="imagen-curso">
                        <img src="../assets/ciencias_politicas.jpg" alt="Ciencias Políticas">
                    </div>
                    <div class="nombre-curso">Ciencias Políticas</div>
                </a>

                <a href="#" class="tarjeta-curso">
                    <div class="imagen-curso">
                        <img src="../assets/quimica.jpg" alt="Química 1">
                    </div>
                    <div class="nombre-curso">Química 1</div>
                </a>
            </section>
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
        <a href="https://wa.me/573228337441?text=Necesito%20su%20colaboracion" 
            class="whatsapp-float" 
            target="_blank" 
            title="Contáctanos por WhatsApp">
                <img src="../assets/whatsapp-icon-free-png.webp" alt="WhatsApp" class="whatsapp-icon">
        </a>
    </body>
    <script src="../assets/principal.js"></script>
</html>