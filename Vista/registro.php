<?php
session_start();

if (isset($_SESSION['id_usuario'])) {
    header("location: pagina_principal.php");
    exit();
}
// Evitar el almacenamiento en caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>ReEduca</title>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/registro.css"> 
  <link rel="stylesheet" href="../assets/Campo_seleccionado.css">
  <link rel="stylesheet" href="../assets/navegador_registro.css">
  <link rel="stylesheet" href="../assets/validacion.css">
  <link rel="icon" href="../img/icono_de_icon_web_probando_formato_icon.ico">
</head>
<body>

<nav class="navbar">
  <a href="../Vista/index.php" class="logo-link">
    <img src="../img/reeduca.png" alt="Logotipo de ReEduca">
  </a>
  <div class="nav-links">
    <a href="../Vista/index.php">Inicio</a>
    <a href="../Vista/Portal_educativo.php">Portal Educativo</a>
    <a href="../Vista/acerda_de.php">Acerca de</a>
    <a href="#">Contacto</a>
  </div>
</nav>
<div class="container">
  <div class="left-section"></div>
  <div class="right-section">
    <div class="logo-container">
      <a href="../Vista/inicio.php">
        <img src="../img/reeduca.png" alt="Logo de ReEduca">
      </a>
    </div>
    <div class="form-container">
      <h2>Registrarse</h2>
      <form id="registroForm" action="../controlador/registro_fun.php" method="POST" autocomplete="off">
        <input type="text" name="nombres" placeholder="Nombres" 
        pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{5,}"
        title="El nombre debe tener al menos 5 letras y solo contener letras y espacios" 
        required>
        <input type="text" name="apellidos" placeholder="Apellidos"
        pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{5,}"
        title="El apellido debe tener al menos 5 letras y solo contener letras y espacios"  
        required>
        <input type="email" name="email" placeholder="Correo electrónico" 
        title="Ingrese un correo válido, por ejemplo usuario@gmail.com" 
        required>
          <!-- Nuevo campo para el tipo de documento -->
          <label for="tipo_documento">Tipo de Documento:</label>
            <select name="tipo_documento" id="tipo_documento" required>
            <option value="" disabled selected>Seleccione un tipo de documento</option>
            <option value="RC">Registro Civil (RC)</option>
            <option value="TI">Tarjeta de Identidad (TI)</option>
            <option value="CC">Cédula de Ciudadanía (CC)</option>
        </select>
        <input type="text" name="numero_documento" placeholder="Número de documento" 
         pattern="\d{8,10}" 
         title="Debe contener solo números y tener entre 8 y 10 dígitos"
        required>
        <input type="password" name="password" placeholder="Contraseña"
        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}" 
        title="Debe contener al menos 6 caracteres, una mayúscula, una minúscula y un número" 
        required>
        <input type="password" name="confirm_password" placeholder="Confirmar contraseña" required>
        
        <button type="submit">Registrarse</button>
      </form>
      <a href="../Vista/Login.php">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
  </div>
</div>
</body>
<script src="../assets/Verificacion_de_campo.js"></script>

</html>