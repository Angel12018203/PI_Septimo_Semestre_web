<?php
require_once '../config/configuracion.php';

function limpiarEntrada($entrada) {
    return htmlspecialchars(strip_tags(trim($entrada)), ENT_QUOTES, 'UTF-8');
}

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id_solicitud = limpiarEntrada($_POST['id_solicitud']);
        $estado = limpiarEntrada($_POST['estado_solicitud']);
        $observaciones = limpiarEntrada($_POST['observaciones']);

        // Validar datos
        if (empty($id_solicitud) || empty($estado)) {
            throw new Exception("Faltan datos obligatorios.");
        }

        // Conectar a la base de datos
        $db = new Conexion();

        // Actualizar estado y observaciones en la tabla 'solicitudes'
        $sql = "UPDATE solicitudes SET estado_solicitud = ?, observaciones = ?, fecha_respuesta = CURDATE() WHERE id_solicitud = ?";
        $params = [$estado, $observaciones, $id_solicitud];

        $db->executeUpdate($sql, $params);
        $db->close();

        // Redirigir de vuelta al panel de administrador
        header("Location: panel_admin.php");
        exit;
    } else {
        throw new Exception("Método no permitido.");
    }
} catch (Exception $e) {
    echo "Error al actualizar la solicitud: " . $e->getMessage();
    exit;
}
?>
