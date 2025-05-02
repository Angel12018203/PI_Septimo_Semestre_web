<?php
include_once '../config/configuracion.php'; // Incluye la configuración de la base de datos
require_once '../config/conexion.php'; // Incluye la clase de conexión

session_start(); // Inicia la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verifica si la solicitud es de tipo POST
    $email = trim($_POST['username']); // Obtiene el correo electrónico
    $password = $_POST['password']; // Obtiene la contraseña

    // Validación básica
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Verifica si el correo es válido
        header("Location: ../Vista/Login.php?error=Correo electrónico no válido.");
        exit();
    }

    if (empty($password)) { // Verifica si la contraseña está vacía
        header("Location: ../Vista/Login.php?error=Por favor ingresa tu contraseña.");
        exit ();

    }

    try {
        // Usar la clase Conexion
        $db = new Conexion();

        // Consulta segura usando executeQuery()
        $query = "SELECT id_usuario, nombre_usuario, password_usuario FROM usuarios WHERE correo_usuario = ?";
        $result = $db->executeQuery($query, [$email]); // Ejecuta la consulta

        // Verificar si se encontró el usuario
        if ($result->num_rows == 1) { // Si se encuentra un usuario
            // Obtener los resultados
            $row = $result->fetch_assoc();
            $id_usuario = $row['id_usuario'];
            $nombres = $row['nombre_usuario'];
            $password_hash = $row['password_usuario'];

            // Verifica la contraseña
            if (password_verify($password, $password_hash)) {
                // Login exitoso
                $_SESSION['usuario'] = $email; // Almacena el correo en la sesión
                $_SESSION['nombre_usuario'] = $nombres; // Almacena el nombre en la sesión
                $_SESSION['id_usuario'] = $id_usuario; // Almacena el ID en la sesión
                header("Location: ../Vista/usuario.php"); // Redirige a la vista de usuario
                exit();
            } else {
                // Contraseña incorrecta
                error_log("Contraseña incorrecta para el usuario: " . $email); // Log de error
                header("Location: ../Vista/Login.php?error=Contraseña incorrecta."); // Mensaje de error
                exit();
            }
        } else {
            // El correo no está registrado
            error_log("El correo no está registrado: " . $email); // Log de error
            header("Location: ../Vista/Login.php?error=El correo no está registrado."); // Mensaje de error
            exit();
        }
    } catch (Exception $e) {
        // En caso de error de conexión o consulta
        error_log("Error en la conexión o consulta: " . $e->getMessage()); // Log de error
        header("Location: ../Vista/Login.php?error=" . urlencode($e->getMessage())); // Redirige con el mensaje de error
        exit();
    }
} else {
    header("Location: ../Vista/Login.php"); // Redirige si no es una solicitud POST
    exit();
}
?>