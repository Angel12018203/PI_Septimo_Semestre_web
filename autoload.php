<?php
// Ruta base del proyecto
define('BASE_PATH', realpath(__DIR__));

// Cargar configuración
require_once BASE_PATH . '/config/configuracion.php';

// Cargar clases del sistema
require_once BASE_PATH . '/modelo/conexion.php';
?>