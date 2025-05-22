<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: Login.php");
    exit();
}

$sesion_activa = isset($_SESSION['id_usuario']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Usuario</title>
  <link rel="stylesheet" href="../assets/navegador_menu_usuario.css">

</head>
<body>

  <!-- BARRA DE NAVEGACIÓN SUPERIOR -->
  <div class="navbar">
    <img src="../img/reeduca.png" alt="Logotipo" onclick="location.href='../Vista/inicio.php'">
    <div class="nav-links">
      <a href="../Vista/inicio.php">Inicio</a>
      <a href="#">Acerca de</a>
      <a href="#">Contacto</a>
      <a href="#">Ver solicitudes</a>
      <a href="../controlador/logout.php">Cerrar Sesión</a>
      <?php if (!$sesion_activa): ?>
        <a href="../Vista/Login.php">Iniciar Sesión</a>
        <a href="../Vista/registro.php">Registrarse</a>
      <?php endif; ?>
    </div>
  </div>

  <!-- CONTENIDO PRINCIPAL -->
  <main class="main-content">
    <h1>Bienvenido a tu panel</h1>
    <p>Por favor completa tu información para poder realizar solicitudes.</p>
    <a class="btn-completar" href="../Vista/completar_datos.php">Completar Información</a>
  </main>

</body>
</html>
