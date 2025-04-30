<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario ReEduca</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-header text-center bg-primary text-white">
      <h3><i class="bi bi-file-earmark-text"></i> Solicitud de Reinserción Académica</h3>
    </div>
    <div class="card-body">
      <form id="formSolicitud" action="../Modelo/procesar_solicitud.php" method="POST" novalidate>

        <div class="mb-3">
          <label for="nombre" class="form-label"><i class="bi bi-person-fill"></i> Nombre completo:</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required pattern="^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$">
        </div>

        <div class="mb-3">
          <label for="documento" class="form-label"><i class="bi bi-credit-card-2-front"></i> Número de documento:</label>
          <input type="text" class="form-control" id="documento" name="documento" required pattern="^\d{5,15}$">
        </div>

        <div class="mb-3">
          <label for="telefono" class="form-label"><i class="bi bi-telephone-fill"></i> Teléfono (opcional):</label>
          <input type="text" class="form-control" id="telefono" name="telefono" pattern="^\d{7,15}$">
        </div>

        <div class="mb-3">
          <label for="correo" class="form-label"><i class="bi bi-envelope-fill"></i> Correo electrónico (si tiene):</label>
          <input type="email" class="form-control" id="correo" name="correo">
        </div>

        <div class="mb-3">
          <label for="departamento" class="form-label"><i class="bi bi-geo-alt-fill"></i> Departamento donde vive:</label>
          <select class="form-select" id="departamento" name="departamento" required>
            <option value="">Seleccione un departamento</option>
            <option value="La Guajira">La Guajira</option>
            <option value="Chocó">Chocó</option>
            <option value="Antioquia">Antioquia</option>
            <!-- Agrega más según necesites -->
          </select>
        </div>

        <div class="mb-3">
          <label for="nivel_estudio" class="form-label"><i class="bi bi-mortarboard-fill"></i> Último grado que estudió:</label>
          <select class="form-select" id="nivel_estudio" name="nivel_estudio" required>
            <option value="">Seleccione una opción</option>
            <option value="Primaria">Primaria</option>
            <option value="Secundaria">Secundaria</option>
            <option value="Técnica">Técnica</option>
            <option value="No estudió">No estudió</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="desplazado" class="form-label"><i class="bi bi-exclamation-circle-fill"></i> ¿Fue desplazado por la violencia?</label>
          <select class="form-select" id="desplazado" name="desplazado" required>
            <option value="">Seleccione</option>
            <option value="Sí">Sí</option>
            <option value="No">No</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="mensaje" class="form-label"><i class="bi bi-chat-left-text-fill"></i> Cuéntenos su caso o necesidad:</label>
          <textarea class="form-control" id="mensaje" name="mensaje" rows="4" placeholder="Escriba con ayuda si necesita..." required></textarea>
        </div>

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-success btn-lg">
            <i class="bi bi-send-fill me-1"></i> Enviar solicitud
          </button>
        </div>

      </form>
    </div>
  </div>
</div>
<script src="../assets/alerta.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
