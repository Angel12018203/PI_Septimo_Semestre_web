<?php
session_start();
require_once '../config/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: Login.php");
    exit();
}

$db = new Conexion();
$id_usuario = $_SESSION['id_usuario'];

// Verificar si ya completó los datos personales
$datos = $db->executeQuery("SELECT tipo_documento, departamento, ciudad, celular, fecha_nac FROM usuarios WHERE id_usuario = ?", [$id_usuario])->fetch_assoc();
if (!$datos['tipo_documento'] || !$datos['departamento'] || !$datos['ciudad'] || !$datos['celular'] || !$datos['fecha_nac']) {
    header("Location: completar_datos.php");
    exit();
}

// Contar cuántas solicitudes tiene el usuario
$consultaSolicitudes = $db->executeQuery("SELECT COUNT(*) AS total FROM solicitudes WHERE id_usuario = ?", [$id_usuario]);
$totalSolicitudes = $consultaSolicitudes->fetch_assoc()['total'];

if ($totalSolicitudes >= 3) {
    echo "<script>alert('Ya has alcanzado el límite de 3 solicitudes.'); window.location.href='usuario.php';</script>";
    exit();
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $descripcion = trim($_POST['descripcion']);
    $estado = "Enviado";
    $fecha_envio = date("Y-m-d");

    if (empty($descripcion)) {
        $mensaje = "<div class='alert alert-danger'>La descripción no puede estar vacía.</div>";
    } else {
        $insertar = "INSERT INTO solicitudes (id_usuario, fecha_envio, estado_solicitud, descripcion) VALUES (?, ?, ?, ?)";
        $db->executeUpdate($insertar, [$id_usuario, $fecha_envio, $estado, $descripcion]);
        echo "<script>alert('Solicitud enviada exitosamente.'); window.location.href='usuario.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Solicitud</title>
    <link rel="stylesheet" href="../assets/formulario.css">
    <link rel="stylesheet" href="../assets/navegador_menu_usuario.css">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-container {
            max-width: 600px;
            margin: 60px auto;
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            resize: vertical;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            width: 100%;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
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
            <a href="usuario.php">Panel</a>
            <a href="../controlador/logout.php">Cerrar Sesión</a>
        </div>
    </div>

    <div class="form-container">
        <h2>Crear Nueva Solicitud</h2>
        <?php if (isset($mensaje)) echo $mensaje; ?>
        <form method="POST" action="">
            <label for="descripcion">Describe tu caso (máx. 1000 caracteres):</label>
            <textarea name="descripcion" maxlength="1000" required></textarea>
            <button type="submit">Enviar Solicitud</button>
        </form>
    </div>
</body>
</html>
