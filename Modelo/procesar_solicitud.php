<?php
require_once '../config/configuracion.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Función para limpiar entradas contra XSS y espacios
function limpiarEntrada($entrada) {
    return htmlspecialchars(strip_tags(trim($entrada)), ENT_QUOTES, 'UTF-8');
}

// Validar email
function validarEmail($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL);
}

// Validar solo números para documento y teléfono
function validarNumero($dato) {
    return preg_match('/^[0-9]+$/', $dato);
}

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Limpiar y validar cada campo
        $nombre = limpiarEntrada($_POST['nombre']);
        $documento = limpiarEntrada($_POST['documento']);
        $telefono = isset($_POST['telefono']) ? limpiarEntrada($_POST['telefono']) : null;
        $correo = isset($_POST['correo']) ? limpiarEntrada($_POST['correo']) : null;
        $departamento = limpiarEntrada($_POST['departamento']);
        $nivel_estudio = limpiarEntrada($_POST['nivel_estudio']);
        $desplazado = limpiarEntrada($_POST['desplazado']);
        $mensaje = limpiarEntrada($_POST['mensaje']);

        // Validaciones básicas del lado servidor
        if (empty($nombre) || empty($documento) || empty($departamento) || empty($nivel_estudio) || empty($desplazado)) {
            throw new Exception("Faltan campos obligatorios.");
        }

        if (!validarNumero($documento)) {
            throw new Exception("Número de documento inválido.");
        }

        if (!empty($telefono) && !validarNumero($telefono)) {
            throw new Exception("Número de teléfono inválido.");
        }

        if (!empty($correo) && !validarEmail($correo)) {
            throw new Exception("Correo electrónico inválido.");
        }

        // Conectar a la base de datos
        $db = new Conexion();

        // Consulta preparada para evitar SQL injection
        $sql = "INSERT INTO solicitudes (
                    nombre, documento, telefono, correo, 
                    departamento, nivel_estudio, desplazado, mensaje,estado
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $params = [
            $nombre, $documento, $telefono, $correo,
            $departamento, $nivel_estudio, $desplazado, $mensaje, 'Enviado'
        ];

        $db->executeUpdate($sql, $params);
        $db->close();

        // Mostrar mensaje de éxito con SweetAlert2 y redirigir al panel de estado
        header("Location: estado_solicitud.php?documento=" . $documento);
        exit;

    } else {
        throw new Exception("Método no permitido.");
    }

} catch (Exception $e) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '" . limpiarEntrada($e->getMessage()) . "',
            confirmButtonColor: '#d33'
        }).then(() => {
            window.history.back();
        });
    </script>
    ";
}
?>
