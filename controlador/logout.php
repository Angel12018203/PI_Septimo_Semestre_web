<?php
session_start();
session_unset(); // Elimina todas las variables de sesión
session_destroy(); //Destruye la sesión. 

// Evitar caché tras logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

header("Location: ../Vista/Login.php"); // Redirige a la vista login 
exit();
?>
