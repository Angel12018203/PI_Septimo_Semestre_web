<?php
session_start();
require_once '../config/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: Login.php");
    exit();
}

$db = new Conexion();
$id_usuario = $_SESSION['id_usuario'];

// Verificar si ya completó los datos
$query = "SELECT tipo_documento, departamento, ciudad, celular, fecha_nac FROM usuarios WHERE id_usuario = ?";
$resultado = $db->executeQuery($query, [$id_usuario]);
$datos = $resultado->fetch_assoc();

if ($datos['tipo_documento'] && $datos['departamento'] && $datos['ciudad'] && $datos['celular'] && $datos['fecha_nac']) {
    header("Location: usuario.php");
    exit();
}

// Procesar envío
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo_documento = $_POST['tipo_documento'];
    $departamento = $_POST['departamento'];
    $ciudad = $_POST['ciudad'];
    $celular = $_POST['celular'];
    $fecha_nac = $_POST['fecha_nac'];

    if (empty($tipo_documento) || empty($departamento) || empty($ciudad) || empty($celular) || empty($fecha_nac)) {
        echo "<script>alert('Todos los campos son obligatorios.');</script>";
    } else {
        $update = "UPDATE usuarios SET tipo_documento=?, departamento=?, ciudad=?, celular=?, fecha_nac=? WHERE id_usuario=?";
        $db->executeUpdate($update, [$tipo_documento, $departamento, $ciudad, $celular, $fecha_nac, $id_usuario]);
        echo "<script>alert('Información completada con éxito.'); window.location.href='usuario.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Completar Información</title>
  <link rel="stylesheet" href="../assets/formulario.css">
  <link rel="stylesheet" href="../assets/navegador_menu_usuario.css">
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    .form-container {
      max-width: 600px;
      margin: 60px auto;
      background-color: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    form label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
      color: #333;
    }

    form input[type="text"],
    form input[type="date"],
    form select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    form button {
      margin-top: 25px;
      padding: 12px;
      width: 100%;
      background-color: #007BFF;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    form button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <!-- BARRA DE NAVEGACIÓN SUPERIOR -->
  <div class="navbar">
    <img src="../img/reeduca.png" alt="Logotipo" onclick="location.href='../Vista/inicio.php'">
    <div class="nav-links">
      <a href="../Vista/inicio.php">Inicio</a>
      <a href="#">Acerca de</a>
      <a href="#">Contacto</a>
      <a href="../Vista/crear_solicitud.php">Ver solicitudes</a>
      <a href="../controlador/logout.php">Cerrar Sesión</a>
    </div>
  </div>

  <div class="form-container">
    <h2>Completa tu Información</h2>
    <form method="POST" action="">
      <label for="tipo_documento">Tipo de Documento:</label>
      <select name="tipo_documento" required>
        <option value="">Selecciona...</option>
        <option value="CC">Cédula de Ciudadanía (CC)</option>
        <option value="TI">Tarjeta de Identidad (TI)</option>
        <option value="RC">Registro Civil (RC)</option>
      </select>

      <label for="departamento">Departamento:</label>
      <select name="departamento" id="departamento" required onchange="setCiudad()">
        <option value="">Selecciona...</option>
        <option value="Amazonas">Amazonas</option>
        <option value="Antioquia">Antioquia</option>
        <option value="Arauca">Arauca</option>
        <option value="Atlántico">Atlántico</option>
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
        <option value="Distrito Capital">Distrito Capital</option>
      </select>

      <label for="ciudad">Ciudad Capital:</label>
      <input type="text" id="ciudad" name="ciudad" readonly required>

      <label for="celular">Teléfono/Celular:</label>
      <input type="text" name="celular" pattern="[0-9]{7,10}" placeholder="Ej: 3101234567" required>

      <label for="fecha_nac">Fecha de Nacimiento:</label>
      <input type="date" name="fecha_nac" required>

      <button type="submit">Guardar Información</button>
    </form>
  </div>

  <script>
    const capitales = {
      "Amazonas": "Leticia", "Antioquia": "Medellín", "Arauca": "Arauca",
      "Atlántico": "Barranquilla", "Bolívar": "Cartagena de Indias", "Boyacá": "Tunja",
      "Caldas": "Manizales", "Caquetá": "Florencia", "Casanare": "Yopal",
      "Cauca": "Popayán", "Cesar": "Valledupar", "Chocó": "Quibdó",
      "Córdoba": "Montería", "Cundinamarca": "Bogotá", "Guainía": "Inírida",
      "Guaviare": "San José del Guaviare", "Huila": "Neiva", "Magdalena": "Santa Marta",
      "Meta": "Villavicencio", "Nariño": "Pasto", "Norte de Santander": "Cúcuta",
      "Putumayo": "Mocoa", "Quindío": "Armenia", "Risaralda": "Pereira",
      "Santander": "Bucaramanga", "Sucre": "Sincelejo", "Tolima": "Ibagué",
      "Valle del Cauca": "Cali", "Vichada": "Puerto Carreño",
      "San Andrés y Providencia": "San Andrés", "Distrito Capital": "Bogotá"
    };

    function setCiudad() {
      const departamento = document.getElementById("departamento").value;
      document.getElementById("ciudad").value = capitales[departamento] || "";
    }
  </script>
</body>
</html>
