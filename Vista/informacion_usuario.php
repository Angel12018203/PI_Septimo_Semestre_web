<?php
session_start();

require_once '../config/configuracion.php';
require_once '../config/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../Vista/Login.php?message=Debe iniciar sesión");
    exit();
}

try {
    $conexion = new Conexion();
    $id_usuario = $_SESSION['id_usuario'];

    $sql = "SELECT id_usuario, nombre_usuario, apellido_usuario, tipo_documento, numero_documento, correo_usuario, celular, departamento, ciudad, fecha_nac FROM usuarios WHERE id_usuario = ?";
    $resultado = $conexion->executeQuery($sql, [$id_usuario]);

    $usuario = $resultado->fetch_assoc();

    if (!$usuario) {
        throw new Exception("No se encontró información para el usuario.");
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

$fecha_nac_val = ($usuario['fecha_nac'] === "0000-00-00" || empty($usuario['fecha_nac'])) ? '' : $usuario['fecha_nac'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Información de Usuario</title>
    <link rel="stylesheet" href="../assets/styles-principal-page.css">
    <link rel="icon" href="../img/icono_de_icon_web_probando_formato_icon.ico">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
<nav class="navbar-pagina-principal">
    <div class="logo-pagina-principal">
        <a href="pagina_principal.php">
            <img src="../img/icono_de_logo_sin_formato_icon.png" alt="Logo" class="logo-img">
        </a>
        <ul>
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

<main class="informacion-usuario">
    <h2>Información del perfil</h2>
    <div class="formulario_informacion_usuario">
        <!-- Formulario de solo lectura -->
        <form class="formulario-grid">
            <div class="form-row">
                <div class="form-group">
                    <label for="nombre_usuario">Nombre: </label>
                    <input type="text" id="nombre_usuario" value="<?= htmlspecialchars($usuario['nombre_usuario']) ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="apellido_usuario">Apellido: </label>
                    <input type="text" id="apellido_usuario" value="<?= htmlspecialchars($usuario['apellido_usuario']) ?>" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tipo_documento">Tipo de documento: </label>
                    <input type="text" id="tipo_documento" value="<?= htmlspecialchars($usuario['tipo_documento']) ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="numero_documento">Número de documento: </label>
                    <input type="text" id="numero_documento" value="<?= htmlspecialchars($usuario['numero_documento']) ?>" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="correo_usuario">Correo electrónico: </label>
                    <input type="email" id="correo_usuario" value="<?= htmlspecialchars($usuario['correo_usuario']) ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="celular">Celular: </label>
                    <input type="text" id="celular" value="<?= htmlspecialchars($usuario['celular']) ?>" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="departamento">Departamento: </label>
                    <input type="text" id="departamento" value="<?= htmlspecialchars($usuario['departamento']) ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" id="ciudad" value="<?= htmlspecialchars($usuario['ciudad']) ?>" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label for="fecha_nac">Fecha de nacimiento: </label>
                    <input type="date" id="fecha_nac" value="<?= htmlspecialchars($fecha_nac_val) ?>" readonly>
                </div>
            </div>

            <div class="form-row botones">
                <button type="button" class="actualizar" id="btnActualizar">Actualizar información</button>
            </div>
        </form>
    </div>

    <!-- Modal con formulario editable -->
    <div id="modalActualizar" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Actualizar información</h2>

            <form method="POST" id="formulario-actualizar-info" action="../Modelo/guardar_info_usuario.php">
                <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']) ?>">

                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre_usuario_modal">Nombre: </label>
                        <input type="text" id="nombre_usuario_modal" name="nombre_usuario_modal" value="<?= htmlspecialchars($usuario['nombre_usuario']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="apellido_usuario_modal">Apellido: </label>
                        <input type="text" id="apellido_usuario_modal" name="apellido_usuario_modal" value="<?= htmlspecialchars($usuario['apellido_usuario']) ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="tipo_documento_modal">Tipo de documento: </label>
                        <input type="text" id="tipo_documento_modal" name="tipo_documento_modal" value="<?= htmlspecialchars($usuario['tipo_documento']) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="numero_documento_modal">Número de documento: </label>
                        <input type="text" id="numero_documento_modal" name="numero_documento_modal" value="<?= htmlspecialchars($usuario['numero_documento']) ?>" readonly>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="correo_usuario_modal">Correo electrónico: </label>
                        <input type="email" id="correo_usuario_modal" name="correo_usuario_modal" value="<?= htmlspecialchars($usuario['correo_usuario']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="celular_modal">Celular: </label>
                        <input type="text" id="celular_modal" name="celular_modal" value="<?= htmlspecialchars($usuario['celular']) ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="departamento_modal">Departamento: </label>
                        <select name="departamento_modal" id="departamento_modal" required>
                            <option value="">Selecciona...</option>
                            <?php
                            $departamentos = [
                                "Amazonas", "Antioquia", "Arauca", "Atlántico", "Bogotá", "Bolívar", "Boyacá", "Caldas",
                                "Caquetá", "Casanare", "Cauca", "Cesar", "Chocó", "Córdoba", "Cundinamarca", "Guainía",
                                "Guaviare", "Huila", "Magdalena","La Guajira", "Meta", "Nariño", "Norte de Santander", "Putumayo",
                                "Quindío", "Risaralda", "Santander", "Sucre", "Tolima", "Valle del Cauca", "Vichada",
                                "San Andrés y Providencia"
                            ];
                            foreach ($departamentos as $dep) {
                                $selected = ($usuario['departamento'] === $dep) ? 'selected' : '';
                                echo "<option value=\"$dep\" $selected>$dep</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ciudad_modal">Ciudad: </label>
                        <input type="text" id="ciudad_modal" name="ciudad_modal" value="<?= htmlspecialchars($usuario['ciudad']) ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="fecha_nac_modal">Fecha de nacimiento: </label>
                        <input type="date" id="fecha_nac_modal" name="fecha_nac_modal" value="<?= htmlspecialchars($fecha_nac_val) ?>">
                    </div>
                </div>

                <div class="form-row botones">
                    <button type="submit" class="guardar">Guardar cambios</button>
                </div>
            </form>
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

<script src="../assets/modal-info-usuario.js"></script>
</body>
</html>
