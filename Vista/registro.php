<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>ReEduca</title>

  <!-- Fuente League Spartan -->
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/registro.css"> 
  <link rel="stylesheet" href="../assets/navegador_registro.css">
  <link rel="icon" href="../img/icono_de_icon_web_probando_formato_icon.ico">
</head>
<body>

  <!-- Barra de navegación -->
<nav class="navbar">
  <a href="../Vista/inicio.php" class="logo-link">
    <img src="../img/reeduca.png" alt="Logotipo de ReEduca">
  </a>
  <div class="nav-links">
    <a href="../Vista/inicio.php">Inicio</a>
    <a href="../Vista/Portal_educativo.php">Portal Educativo</a>
    <a href="#">Acerca de</a>
    <a href="#">Contacto</a>
  </div>
</nav>

  <!-- Contenedor principal dividido en dos secciones -->
  <div class="container">

    <!-- Sección izquierda con el fondo -->
    <div class="left-section"></div>

    <!-- Sección derecha con el formulario de registro -->
    <div class="right-section">
      <div class="logo-container">
        <a href="../Vista/inicio.php">
          <img src="../img/reeduca.png" alt="Logo de ReEduca">
        </a>
      </div>
      <div class="form-container">
        <h2>Registrarse</h2>
        <form action="../ruta/a/tu/script.php" method="post"> <!-- Cambia la ruta aquí -->
          <input type="text" name="nombres" placeholder="Nombres" required>
          <input type="text" name="apellidos" placeholder="Apellidos" required>
          <input type="email" name="email" placeholder="Correo electrónico" required>
          <input type="password" name="password" placeholder="Contraseña" required>
          <input type="password" name="confirm_password" placeholder="Confirmar contraseña" required>
          <button type="submit">Registrarse</button>
        </form>
        <a href="../Vista/Login.php">¿Ya tienes cuenta? Inicia sesión</a>
      </div>
    </div>

  </div>

</body>
</html>