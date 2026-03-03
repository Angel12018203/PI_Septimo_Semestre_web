<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acerca de ReEduca</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/pagina_principal_whatssaqpt.css">
  <style>
 @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  color: #333;
  line-height: 1.6;
  background-color: #f5f7fa;
}

/* Navbar */
.navbar {
  background-color: #fff;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000;
}

.navbar-content {
  max-width: 1200px;
  margin: auto;
  padding: 15px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.navbar-logo img {
  height: 60px;
}

.navbar-links {
  display: flex;
  gap: 25px;
}

.navbar-links a {
  text-decoration: none;
  color: #333;
  font-weight: 600;
  transition: color 0.3s;
  position: relative;
}

.navbar-links a:hover {
  color: #007BFF;
}

.navbar-links a.active::after {
  content: '';
  position: absolute;
  bottom: -6px;
  left: 0;
  width: 100%;
  height: 3px;
  background:rgb(78, 93, 108);
  border-radius: 4px;
}

/* Sección principal */
.main-content {
  max-width: 900px;
  margin: 140px auto 60px;
  padding: 0 20px;
}

.main-content h1 {
  font-size: 2.5rem;
  margin-bottom: 20px;
  color:rgb(36, 102, 182);
}

.main-content h2 {
  margin-top: 40px;
  font-size: 1.6rem;
  color: #007BFF;
}

.main-content p {
  margin-top: 10px;
  font-size: 1rem;
  color: #555;
}

/* Sección Logo inferior */
.seccion-logo {
  background-color:rgb(39, 33, 33, 0.836);
  color: white;
  padding: 50px 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
}

.logo-container {
  flex: 0 0 120px;
  margin-right: 30px;
  display: flex;
  justify-content: flex-start;
}

.logo-container img {
  height: 100px;
}

.linea-separadora {
  width: 2px;
  height: 100px;
  background-color: #fff;
  margin-right: 30px;
}

.text-container {
  flex: 1;
  font-size: 1rem;
}

/* WhatsApp Botón flotante */
.whatsapp-float {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 999;
}

.whatsapp-icon {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  transition: transform 0.3s ease;
}

.whatsapp-icon:hover {
  transform: scale(1.1);
}

/* Responsive */
@media (max-width: 768px) {
  .navbar-content {
    flex-direction: column;
    align-items: center;
    gap: 10px;
  }

  .navbar-links {
    flex-direction: column;
    gap: 10px;
  }

  .main-content {
    margin-top: 160px;
  }

  .seccion-logo {
    flex-direction: column;
    text-align: center;
  }

  .linea-separadora {
    display: none;
  }

  .logo-container {
    margin-bottom: 20px;
  }
}

  </style>
</head>
<body>

 <!-- Barra de navegación  -->

<div class="navbar">
  <div class="navbar-content">
    <div class="navbar-logo">
      <a href="../Vista/index.php">
        <img src="../img/reeduca.png" alt="Logotipo">
      </a>
    </div>
    <nav class="navbar-links">
      <a href="../Vista/index.php">Inicio</a>
      <a href="../Vista/Login.php">Portal Educativo</a>
      <a href="../Vista/acerda_de.php" class="active">Acerca de</a>
      <a href="#">Contacto</a>
    </nav>
  </div>
</div>
  <!-- Contenido principal -->
  <div class="main-content">
    <h1>Acerca de ReEduca</h1>
    <p>
      ReEduca es una plataforma web diseñada para facilitar la reinserción académica y social de las personas víctimas de desplazamiento forzado en Colombia. A través de esta herramienta, buscamos restituir el derecho a la educación como parte del proceso de reparación integral.
    </p>
    <h2>¿Quiénes somos?</h2>
    <p>
      ReEduca es una plataforma web enfocada en la reinserción de personas desplazadas. Esta plataforma permite a los estudiantes adquirir competencias básicas para completar su formación académica.
    </p>

     <h2>Objetivo General</h2>
    <p>
      Desarrollar una aplicación web que facilite la reinserción académica de las personas víctimas de desplazamiento forzado en Colombia, contribuyendo activamente a su reparación integral.
    </p>
    <h2>Misión</h2>
    <p>
      Facilitar la reinserción académica y social de las personas cuyos derechos han sido vulnerados por el conflicto armado en Colombia, ofreciendo oportunidades educativas accesibles que contribuyan a su reparación integral y desarrollo personal.
    </p>

    <h2>Visión</h2>
    <p>
        Ser una plataforma innovadora y solidaria que garantice el acceso a la educación como un derecho fundamental a las víctimas del desplazamiento forzado, para que reconstruyan sus proyectos de vida y contribuyan al desarrollo de una Colombia más equitativa e inclusiva.
    </p>

   

  </div>

  <!-- Sección inferior con logo -->
  <section class="seccion-logo">
    <div class="logo-container">
      <img src="../img/imagen_3.png" alt="Logo">
    </div>
    <div class="linea-separadora"></div>
    <div class="text-container">
      <p>
        Reeduca es una plataforma web diseñada para brindarte la oportunidad de finalizar tus estudios. Ofrecemos segundas oportunidades a aquellas personas que han sido víctimas del conflicto armado en nuestro país, permitiéndoles acceder a una educación flexible y de calidad.
      </p>
    </div>
  </section>

  <!-- Botón flotante de WhatsApp -->
  <a href="https://wa.me/573228337441?text=Necesito%20su%20colaboracion" 
     class="whatsapp-float" 
     target="_blank" 
     title="Contáctanos por WhatsApp">
    <img src="../assets/whatsapp-icon-free-png.webp" alt="WhatsApp" class="whatsapp-icon">
  </a>
</body>
</html>
