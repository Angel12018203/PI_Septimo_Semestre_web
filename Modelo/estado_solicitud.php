<?php
require_once '../config/configuracion.php';

// Función para limpiar entradas
function limpiarEntrada($entrada) {
    return htmlspecialchars(strip_tags(trim($entrada)), ENT_QUOTES, 'UTF-8');
}

$documento = isset($_GET['documento']) ? limpiarEntrada($_GET['documento']) : null;

if (!$documento) {
    echo "Documento no proporcionado.";
    exit;
}

try {
    $db = new Conexion();

    $sql = "SELECT nombre, documento, telefono, correo, departamento, nivel_estudio, desplazado, mensaje, fecha, estado, observacion
            FROM solicitudes
            WHERE documento = ?";

    $resultado = $db->executeQuery($sql, [$documento]);
    $solicitud = $resultado->fetch_assoc();

    if (!$solicitud) {
        echo "No se encontró una solicitud con ese documento.";
        exit;
    }

    $db->close();

} catch (Exception $e) {
    echo "Error al consultar la solicitud: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estado de tu Solicitud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Estado de tu Solicitud</h2>

        <ul class="list-group list-group-flush mb-3">
            <li class="list-group-item"><strong>Nombre:</strong> <?= $solicitud['nombre'] ?></li>
            <li class="list-group-item"><strong>Documento:</strong> <?= $solicitud['documento'] ?></li>
            <li class="list-group-item"><strong>Correo:</strong> <?= $solicitud['correo'] ?></li>
            <li class="list-group-item"><strong>Departamento:</strong> <?= $solicitud['departamento'] ?></li>
            <li class="list-group-item"><strong>Fecha de Envío:</strong> <?= date('d/m/Y H:i', strtotime($solicitud['fecha'])) ?></li>
        </ul>

        <div class="alert 
            <?php 
                if ($solicitud['estado'] == 'Enviado') echo 'alert-primary';
                elseif ($solicitud['estado'] == 'En proceso') echo 'alert-warning';
                elseif ($solicitud['estado'] == 'Aceptado') echo 'alert-success';
                elseif ($solicitud['estado'] == 'Rechazado') echo 'alert-danger';
                else echo 'alert-secondary';
            ?>
        " role="alert">
            <h4 class="alert-heading">Estado Actual:</h4>
            <p class="fs-5"><?= $solicitud['estado'] ?? 'Pendiente' ?></p>

            <?php if (!empty($solicitud['observacion'])): ?>
                <hr>
                <p class="mb-0"><strong>Comentario:</strong> <?= $solicitud['observacion'] ?></p>
            <?php endif; ?>
        </div>

        <div class="text-center">
            <a href="../Vista/solicitud.php" class="btn btn-secondary mt-3">Nueva Solicitud</a>
        </div>

    </div>
</div>

</body>
</html>
