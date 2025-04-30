<?php
require_once '../config/configuracion.php'; //Se carga la ruta de conexion. 

try {
    $db = new Conexion();
    echo "<h2 style='color: green;'>✅ Conexión exitosa a la base de datos</h2>";
    $db->close();
} catch (Exception $e) {
    echo "<h2 style='color: red;'>❌ Error de conexión:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>
