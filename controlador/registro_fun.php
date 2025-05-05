<?php
require_once '../config/conexion.php'; // Incluye el archivo de conexión a la base de datos
session_start(); // Inicia la sesión para manejar la autenticación del usuario

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Verifica si la solicitud es de tipo POST
    // Sanitización de entradas
    $nombres = htmlspecialchars(trim($_POST['nombres']));
    $apellidos = htmlspecialchars(trim($_POST['apellidos']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password']; // La contraseña no se sanitiza aquí porque se va a hashear
    $confirmPassword = $_POST['confirm_password'];
    $numero_documento = htmlspecialchars(trim($_POST['numero_documento']));
    $tipo_documento = htmlspecialchars(trim($_POST['tipo_documento'])); // Nuevo campo

    // Validaciones del lado del servidor
    if (empty($nombres) || strlen($nombres) < 5) {
        echo "<script>alert('El nombre debe tener al menos 5 caracteres.'); window.history.back();</script>";
        exit();
    }

    if (empty($apellidos) || strlen($apellidos) < 5) {
        echo "<script>alert('El apellido debe tener al menos 5 caracteres.'); window.history.back();</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Correo electrónico no válido.'); window.history.back();</script>";
        exit();
    }

    if ($password !== $confirmPassword) {
        echo "<script>alert('Las contraseñas no coinciden.'); window.history.back();</script>";
        exit();
    }

    if (empty($numero_documento) || !is_numeric($numero_documento)) {
        echo "<script>alert('El número de documento es obligatorio y debe ser numérico.'); window.history.back();</script>";
        exit();
    }

    try {
        $db = new Conexion(); // Crea una nueva instancia de la clase de conexión a la base de datos

        // Verificar si el correo ya existe
        $checkQuery = "SELECT * FROM usuarios WHERE correo_usuario = ?";
        $result = $db->executeQuery($checkQuery, [$email]);

        if ($result->num_rows > 0) {
            echo "<script>alert('El correo ya está registrado.'); window.history.back();</script>";
            exit();
        }

        // Hash de la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta de inserción
        $insertQuery = "INSERT INTO usuarios (tipo_documento, numero_documento, nombre_usuario, apellido_usuario, correo_usuario, password_usuario) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        
        // Ejecutar la consulta de inserción
        $db->executeUpdate($insertQuery, [
            $tipo_documento, // Agregar tipo de documento
            $numero_documento, 
            $nombres, 
            $apellidos, 
            $email, 
            $hashedPassword
        ]);

        // Mensaje de éxito y redirección
        echo "<script>alert('Usuario registrado correctamente.'); window.location.href = '../Vista/Login.php';</script>";
    } catch (Exception $e) {
        // Manejo de excepciones
        error_log("Excepción: " . $e->getMessage());
        echo "<script>alert('Ocurrió un error inesperado. Por favor, inténtalo de nuevo.'); window.history.back();</script>";
    } finally {
        // Cerrar la conexión a la base de datos
        $db->close();
    }
}
?>