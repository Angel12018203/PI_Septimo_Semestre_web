<?php
require_once '../config/configuracion.php';

function limpiarEntrada($entrada) {
    return htmlspecialchars(strip_tags(trim($entrada)), ENT_QUOTES, 'UTF-8');
}

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = limpiarEntrada($_POST['id']);
        $estado = limpiarEntrada($_POST['estado']);
        $observacion = limpiarEntrada($_POST['observacion']);

        // Validar datos
        if (empty($id) || empty($estado)) {
            throw new Exception("Faltan datos obligatorios.");
        }

        // Conectar a la base de datos
        $db = new Conexion();

        // Actualizar estado y observación
        $sql = "UPDATE solicitudes SET estado = ?, observacion = ? WHERE id = ?";
        $params = [$estado, $observacion, $id];

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
