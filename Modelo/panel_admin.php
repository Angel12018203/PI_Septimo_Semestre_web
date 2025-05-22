<?php
require_once '../config/configuracion.php';

function limpiarEntrada($entrada) {
    return htmlspecialchars(strip_tags(trim($entrada)), ENT_QUOTES, 'UTF-8');
}

try {
    $db = new Conexion();

    // Consulta para obtener todas las solicitudes con datos del usuario
    $sql = "SELECT s.id_solicitud, u.nombre_usuario, u.numero_documento, s.descripcion, s.estado_solicitud, s.observaciones
            FROM solicitudes s
            JOIN usuarios u ON s.id_usuario = u.id_usuario";
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
                <th>Descripción</th>
                <th>Estado</th>
                <th>Observación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudes as $solicitud): ?>
                <tr>
                    <td><?= $solicitud['id_solicitud'] ?></td>
                    <td><?= $solicitud['nombre_usuario'] ?></td>
                    <td><?= $solicitud['numero_documento'] ?></td>
                    <td><?= nl2br(htmlspecialchars($solicitud['descripcion'])) ?></td>
                    <td>
                        <span class="badge 
                            <?php 
                                if ($solicitud['estado_solicitud'] == 'Enviado') echo 'bg-primary';
                                elseif ($solicitud['estado_solicitud'] == 'En proceso') echo 'bg-warning';
                                elseif ($solicitud['estado_solicitud'] == 'Aceptado') echo 'bg-success';
                                elseif ($solicitud['estado_solicitud'] == 'Rechazado') echo 'bg-danger';
                                else echo 'bg-secondary';
                            ?>">
                            <?= $solicitud['estado_solicitud'] ?>
                        </span>
                    </td>
                    <td><?= $solicitud['observaciones'] ?: 'Ninguna' ?></td>
                    <td>
                        <button class="btn btn-info btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editarModal" 
                            data-id="<?= $solicitud['id_solicitud'] ?>" 
                            data-estado="<?= $solicitud['estado_solicitud'] ?>" 
                            data-observacion="<?= htmlspecialchars($solicitud['observaciones']) ?>">Editar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal para editar estado y observación -->
    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form-editar" method="POST" action="procesar_editar_solicitud.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarModalLabel">Editar Solicitud</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_solicitud" id="solicitud-id">
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" id="estado" name="estado_solicitud">
                                <option value="Enviado">Enviado</option>
                                <option value="En proceso">En proceso</option>
                                <option value="Aceptado">Aceptado</option>
                                <option value="Rechazado">Rechazado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="observacion" class="form-label">Observación</label>
                            <textarea class="form-control" id="observacion" name="observaciones" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var editarModal = document.getElementById('editarModal');
    editarModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var estado = button.getAttribute('data-estado');
        var observacion = button.getAttribute('data-observacion');

        var form = editarModal.querySelector('#form-editar');
        form.querySelector('#solicitud-id').value = id;
        form.querySelector('#estado').value = estado;
        form.querySelector('#observacion').value = observacion;
    });
</script>

</body>
</html>
