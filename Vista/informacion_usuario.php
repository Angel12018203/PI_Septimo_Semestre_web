<?php
session_start();

require_once '../config/configuracion.php';  // Constantes DB
require_once '../config/conexion.php';       // Clase Conexion

// Validar sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../Vista/Login.php?message=Debe iniciar sesión");
    exit();
}

try {
    $conexion = new Conexion();

    // Obtener id de usuario de sesión
    $id_usuario = $_SESSION['id_usuario'];

    // Consulta para obtener datos del usuario
    $sql = "SELECT nombre_usuario, apellido_usuario, tipo_documento, numero_documento, correo_usuario, celular, departamento, ciudad, fecha_nac FROM usuarios WHERE id_usuario = ?";
    $resultado = $conexion->executeQuery($sql, [$id_usuario]);

    $usuario = $resultado->fetch_assoc();

    if (!$usuario) {
        throw new Exception("No se encontró información para el usuario.");
    }

} catch (Exception $e) {
    // Mostrar error simple (puedes mejorarlo)
    die("Error: " . $e->getMessage());
}

?>

<!DOCTYPE html>
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

        <main class="informacion-usuario">
            <h2>Información del perfil</h2>
            <div class="formulario_informacion_usuario">
                <form class="formulario-grid">
                <!-- Fila 1: Nombre y Apellido -->
                <div class="form-row">
                    <div class="form-group">
                    <label for="nombre_usuario">Nombre: </label>
                    <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo htmlspecialchars($usuario['nombre_usuario']); ?>" readonly>
                    </div>
                    <div class="form-group">
                    <label for="apellido_usuario">Apellido: </label>
                    <input type="text" id="apellido_usuario" name="apellido_usuario" value="<?php echo htmlspecialchars($usuario['apellido_usuario']); ?>" readonly>
                    </div>
                </div>

                <!-- Fila 2: Tipo y número de documento -->
                <div class="form-row">
                    <div class="form-group">
                    <label for="tipo_documento">Tipo de documento: </label>
                    <input type="text" id="tipo_documento" name="tipo_documento" value="<?php echo htmlspecialchars($usuario['tipo_documento']); ?>" readonly>
                    </div>
                    <div class="form-group">
                    <label for="numero_documento">Número de documento: </label>
                    <input type="text" id="numero_documento" name="numero_documento" value="<?php echo htmlspecialchars($usuario['numero_documento']); ?>" readonly>
                    </div>
                </div>

                <!-- Fila 3: Correo y celular -->
                <div class="form-row">
                    <div class="form-group">
                    <label for="correo_usuario">Correo electrónico: </label>
                    <input type="email" id="correo_usuario" name="correo_usuario" value="<?php echo htmlspecialchars($usuario['correo_usuario']); ?>" readonly>
                    </div>
                    <div class="form-group">
                    <label for="celular">Celular: </label>
                    <input type="text" id="celular" name="celular" value="<?php echo htmlspecialchars($usuario['celular']); ?>">
                    </div>
                </div>

                <!-- Fila 4: Departamento y ciudad -->
                <div class="form-row">
                    <div class="form-group">
                    <label for="departamento">Departamento: </label>
                    <select name="departamento" id="departamento" required onchange="setCiudad()">
                        <option value="">Selecciona...</option>
                        <option value="Amazonas">Amazonas</option>
                        <option value="Antioquia">Antioquia</option>
                        <option value="Arauca">Arauca</option>
                        <option value="Atlántico">Atlántico</option>
                        <option value="Distrito Capital">Bogotá D.C</option>
                        <option value="Bolívar">Bolívar</option>
                        <option value="Boyacá">Boyacá</option>
                        <option value="Caldas">Caldas</option>
                        <option value="Caquetá">Caquetá</option>
                        <option value="Casanare">Casanare</option>
                        <option value="Cauca">Cauca</option>
                        <option value="Cesar">Cesar</option>
                        <option value="Chocó">Chocó</option>
                        <option value="Córdoba">Córdoba</option>
                        <option value="Cundinamarca">Cundinamarca</option>
                        <option value="Guainía">Guainía</option>
                        <option value="Guaviare">Guaviare</option>
                        <option value="Huila">Huila</option>
                        <option value="Magdalena">Magdalena</option>
                        <option value="Meta">Meta</option>
                        <option value="Nariño">Nariño</option>
                        <option value="Norte de Santander">Norte de Santander</option>
                        <option value="Putumayo">Putumayo</option>
                        <option value="Quindío">Quindío</option>
                        <option value="Risaralda">Risaralda</option>
                        <option value="Santander">Santander</option>
                        <option value="Sucre">Sucre</option>
                        <option value="Tolima">Tolima</option>
                        <option value="Valle del Cauca">Valle del Cauca</option>
                        <option value="Vichada">Vichada</option>
                        <option value="San Andrés y Providencia">San Andrés y Providencia</option>
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" id="ciudad" name="ciudad" value="<?php echo htmlspecialchars($usuario['ciudad']); ?>">
                    </div>
                </div>

                <!-- Fila 5: Fecha de nacimiento (único campo) -->
                <div class="form-row">
                    <div class="form-group full-width">
                    <label for="fecha_nac">Fecha de nacimiento: </label>
                    <input type="date" id="fecha_nac" name="fecha_nac" value="<?php echo htmlspecialchars($usuario['fecha_nac']); ?>">
                    </div>
                </div>
                </form>
                <div class="form-row botones">
                    <button type="button" class="actualizar" id="btnActualizar">Actualizar información</button>
                </div>

                <div id="modalActualizar" class="modal" style="display:none;">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Actualizar información</h2>
                        <!-- Aquí puedes poner el formulario o campos para editar -->
                        <p>Aquí va el formulario para actualizar los datos.</p>
                    </div>
                </div>

            </div>
            <script src="../assets/modal-info-usuario.js"></script>
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