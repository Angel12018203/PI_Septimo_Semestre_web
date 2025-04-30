<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>ReEduca</title>

  <!-- Fuente League Spartan -->
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/login.css">

  <link rel="icon" href="../img/icono_de_icon_web_probando_formato_icon.ico">

  
</head>
<body>

  <!-- Barra de navegación -->
  <div class="navbar">
    <img src="../img/reeduca.png" href="../Vista/inicio.php" alt="Logotipo">
    <a href="../Vista/inicio.php">Inicio</a>
    <a href="../Vista/Portal_educativo.php">Portal Educativo</a>
    <a href="#">Acerca de</a>
    <a href="#">Contacto</a>
  </div>

  <!-- Contenedor principal dividido en dos secciones -->
  <div class="container">

    <!-- Sección izquierda con el fondo -->
    <div class="left-section"></div>

    <!-- Sección derecha con el formulario de login -->
    <div class="right-section">
      <div class="logo-container">
        <img src="../img/reeduca.png" alt="Logo">
      </div>
      <div class="form-container">
        <h2>Iniciar sesión</h2>
        <form action="#" method="post">
          <input type="text" name="username" placeholder="Correo electrónico" required>
          <input type="password" name="password" placeholder="Contraseña" required>
          <button type="submit">Iniciar sesión</button>
        </form>
        <a href="#">¿Olvidaste tu contraseña?</a>
        <a href="../Vista/registro.php">¿No tienes cuenta? Regístrate</a>
      </div>
    </div>

  </div>

</body>
</html>