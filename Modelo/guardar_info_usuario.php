<?php
require_once '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitización de los datos
    $id_usuario = $_POST['id_usuario'];
    $nombre = htmlspecialchars(trim($_POST['nombre_usuario_modal']));
    $apellido = htmlspecialchars(trim($_POST['apellido_usuario_modal']));
    $correo = htmlspecialchars(trim($_POST['correo_usuario_modal']));
    $celular = htmlspecialchars(trim($_POST['celular_modal']));
    $departamento = htmlspecialchars(trim($_POST['departamento_modal']));
    $ciudad = htmlspecialchars(trim($_POST['ciudad_modal']));
    $fecha_nac = $_POST['fecha_nac_modal'];

    try {
        $db = new Conexion();

        $query = "UPDATE usuarios 
                  SET nombre_usuario = ?, apellido_usuario = ?, correo_usuario = ?, celular = ?, departamento = ?, ciudad = ?, fecha_nac = ?
                  WHERE id_usuario = ?";

        $params = [$nombre, $apellido, $correo, $celular, $departamento, $ciudad, $fecha_nac, $id_usuario];

        $db->executeUpdate($query, $params);
        $db->close();

        echo "<script>alert('Información actualizada correctamente.'); window.location.href = '../Vista/informacion_usuario.php?id_usuario=$id_usuario';</script>";
        exit();
    } catch (Exception $e) {
        echo "<script>alert('Error al actualizar la información: " . $e->getMessage() . "'); window.history.back();</script>";
        exit();
    }
} else {
    echo "<script>alert('Solicitud no válida.'); window.history.back();</script>";
    exit();
}
