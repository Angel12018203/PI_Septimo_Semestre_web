<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: vista_usuario.php"); // Cambia esto a la ruta real de tu vista de usuario
    exit();
}
?>