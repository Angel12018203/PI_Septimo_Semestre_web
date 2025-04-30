<?php
require_once '../config/configuracion.php';

// Función para limpiar entradas contra XSS
function limpiarEntrada($entrada) {
    return htmlspecialchars(strip_tags(trim($entrada)), ENT_QUOTES, 'UTF-8');
}

try {
    $db = new Conexion();

    // Consulta para obtener todas las solicitudes
    $sql = "SELECT id, nombre, documento, telefono, correo, departamento, nivel_estudio, desplazado, mensaje, fecha, estado, observacion
            FROM solicitudes";
    $result = $db->executeQuery($sql);
    $solicitudes = $result->fetch_all(MYSQLI_ASSOC);

    $db->close();
} catch (Exception $e) {
    echo "Error al consultar las solicitudes: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador - Solicitudes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Gestión de Solicitudes</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Estado</th>
                <th>Observación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudes as $solicitud): ?>
                <tr>
                    <td><?= $solicitud['id'] ?></td>
                    <td><?= $solicitud['nombre'] ?></td>
                    <td><?= $solicitud['documento'] ?></td>
                    <td>
                        <!-- Mostrar el estado de la solicitud con color basado en su estado -->
                        <span class="badge 
                            <?php 
                                if ($solicitud['estado'] == 'Enviado') echo 'bg-primary';
                                elseif ($solicitud['estado'] == 'En proceso') echo 'bg-warning';
                                elseif ($solicitud['estado'] == 'Aceptado') echo 'bg-success';
                                elseif ($solicitud['estado'] == 'Rechazado') echo 'bg-danger';
                                else echo 'bg-secondary';
                            ?>">
                            <?= $solicitud['estado'] ?: 'Pendiente' ?>
                        </span>
                    </td>
                    <td><?= $solicitud['observacion'] ?: 'Ninguna' ?></td>
                    <td>
                        <!-- Botón para editar el estado y agregar observaciones -->
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editarModal" data-id="<?= $solicitud['id'] ?>" data-estado="<?= $solicitud['estado'] ?>" data-observacion="<?= $solicitud['observacion'] ?>">Editar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal para editar estado y observación -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar Solicitud</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-editar" method="POST" action="procesar_editar_solicitud.php">
                        <input type="hidden" name="id" id="solicitud-id">
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado">
                                <option value="Enviado">Enviado</option>
                                <option value="En proceso">En proceso</option>
                                <option value="Aceptado">Aceptado</option>
                                <option value="Rechazado">Rechazado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="observacion" class="form-label">Observación</label>
                            <textarea class="form-control" id="observacion" name="observacion" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Llenar el modal con la información de la solicitud seleccionada
    var editarModal = document.getElementById('editarModal');
    editarModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var estado = button.getAttribute('data-estado');
        var observacion = button.getAttribute('data-observacion');

        var modalTitle = editarModal.querySelector('.modal-title');
        var form = editarModal.querySelector('#form-editar');
        form.querySelector('#solicitud-id').value = id;
        form.querySelector('#estado').value = estado;
        form.querySelector('#observacion').value = observacion;
    });
</script>

</body>
</html>
