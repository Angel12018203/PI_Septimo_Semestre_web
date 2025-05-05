<?php
session_start();
if (!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])) {
    session_unset();
    session_destroy();
    header("Location: ../Vista/Login.php?message=Debe iniciar sesión");
    exit();
}

?>