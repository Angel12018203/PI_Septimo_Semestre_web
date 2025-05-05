<?php
// Cerrar sesión
session_start();
session_unset();
session_destroy();
header("Location: ../Vista/Login.php");
exit();
?>