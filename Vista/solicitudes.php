<?php
session_start();
require_once '../config/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: Login.php");
    exit();
}

$db = new Conexion();
$id_usuario = $_SESSION['id_usuario'];

$datos = $db->executeQuery("SELECT tipo_documento, departamento, ciudad, celular, fecha_nac FROM usuarios WHERE id_usuario = ?", [$id_usuario])->fetch_assoc();
if (!$datos['tipo_documento'] || !$datos['departamento'] || !$datos['ciudad'] || !$datos['celular'] || !$datos['fecha_nac']) {
    echo "<script>alert('Tiene que completar sus datos en la sección: Mi perfil -> Mi información'); window.location.href='informacion_usuario.php';</script>";
    exit();
}

// Contar cuántas solicitudes tiene el usuario
$consultaSolicitudes = $db->executeQuery("SELECT COUNT(*) AS total FROM solicitudes WHERE id_usuario = ?", [$id_usuario]);
$totalSolicitudes = $consultaSolicitudes->fetch_assoc()['total'];
/*
if ($totalSolicitudes >= 3) {
    echo "<script>alert('Ya has alcanzado el límite de 3 solicitudes.'); window.location.href='usuario.php';</script>";
    exit();
}*/

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $descripcion = trim($_POST['descripcion']);
    $estado = "Enviado";
    $fecha_envio = date("Y-m-d");

    if (empty($descripcion)) {
        $mensaje = "<div class='alert alert-danger'>La descripción no puede estar vacía.</div>";
    } else {
        $insertar = "INSERT INTO solicitudes (id_usuario, fecha_envio, estado_solicitud, descripcion) VALUES (?, ?, ?, ?)";
        $db->executeUpdate($insertar, [$id_usuario, $fecha_envio, $estado, $descripcion]);
        echo "<script>alert('Solicitud enviada exitosamente.'); window.location.href='usuario.php';</script>";
        exit();
    }
}

$sql = "SELECT * FROM solicitudes WHERE id_usuario = ? ORDER BY fecha_envio DESC";
$resultado = $db->executeQuery($sql, [$id_usuario]);
?>


<!DOCTYPE html>
    <head>
        <title>Solicitudes Reinserción Académica</title>
        <link rel="stylesheet" href="../assets/styles-principal-page.css">
        <link rel="icon" href="../img/icono_de_icon_web_probando_formato_icon.ico">
        <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
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

        <main class="solicitudes">
            <div class="contenedor-solicitudes">
                <div class="encabezado-solicitudes">
                    <div class="titulos-solicitudes">
                        <h2>Bienvenido a solicitudes</h2>
                        <h3>Aquí podrás gestionar y obtener un seguimiento de tus solicitudes hechas, con el fin de poder dar continuidad a tus estudios.</h3>
                    </div>
                    <a href="crear_solicitud.php" class="btn-crear-solicitud">+ Crear Solicitud</a>
                </div>

                <div class="tabla-solicitudes">
                    <?php
                    if (mysqli_num_rows($resultado) > 0) {
                        echo "<table>";
                        echo "<thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha Envío</th>
                                    <th>Descripción</th>
                                    <th>Observaciones</th>
                                    <th>Fecha Respuesta</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>";
                        echo "<tbody>";
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($fila['id_solicitud']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['fecha_envio']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['descripcion']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['observaciones']) . "</td>";
                            echo "<td>" . htmlspecialchars($fila['fecha_respuesta']) . "</td>";

                            // Aquí cambiamos solo la celda del estado_solicitud con clase para el color de texto
                            echo '<td class="';
                            if ($fila['estado_solicitud'] == 'Enviado') echo 'text-primary';
                            elseif ($fila['estado_solicitud'] == 'En proceso') echo 'text-warning';
                            elseif ($fila['estado_solicitud'] == 'Aceptado') echo 'text-success';
                            elseif ($fila['estado_solicitud'] == 'Rechazado') echo 'text-danger';
                            else echo 'text-secondary';
                            echo '">' . htmlspecialchars($fila['estado_solicitud']) . '</td>';

                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<p>No has creado ninguna solicitud aún.</p>";
                    }
                    ?>
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
    </body>
    <script src="../assets/principal.js"></script>
</html>