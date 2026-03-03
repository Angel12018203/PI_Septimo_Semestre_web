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
    $tipo_documento = htmlspecialchars(trim($_POST['tipo_documento'])); 

 // Validaciones del lado del servidor
 // Validación de nombres
if (empty($nombres) || strlen($nombres) < 5 || !preg_match("/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/u", $nombres)) {
    echo "<script>alert('El nombre debe tener al menos 5 caracteres y solo contener letras y espacios.'); window.history.back();</script>";
    exit();
}

// Validación de apellidos
if (empty($apellidos) || strlen($apellidos) < 5 || !preg_match("/^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/u", $apellidos)) {
    echo "<script>alert('El apellido debe tener al menos 5 caracteres y solo contener letras y espacios.'); window.history.back();</script>";
    exit();
}


//Validar el campo correo electronico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Correo electrónico no válido.'); window.history.back();</script>";
    exit();
    }


//Validar el campo numero de documento
if (empty($numero_documento) || !is_numeric($numero_documento) || strlen($numero_documento) < 8 || strlen($numero_documento) > 10) {
    echo "<script>alert('El número de documento debe tener entre 8 y 10 dígitos y ser numérico.'); window.history.back();</script>";
    exit();
    }

// Validación de la contraseña
if (
    strlen($password) < 8 || 
    !preg_match("/[A-ZÁÉÍÓÚÑ]/u", $password) || 
    !preg_match("/[a-záéíóúñ]/u", $password) || 
    !preg_match("/[0-9]/", $password) 
 
) {
    echo "<script>alert('La contraseña debe tener al menos 6 caracteres, incluyendo al menos una letra mayúscula, una letra minúscula y un número.'); window.history.back();</script>";
    exit();
}


if ($password !== $confirmPassword) {
    echo "<script>alert('Las contraseñas no coinciden.'); window.history.back();</script>";
    exit();
}

    try {
        $db = new Conexion(); // Crea una nueva instancia de la clase de conexión a la base de datos

        // Verificar si el correo ya existe
        $checkQuery = "SELECT * FROM usuarios WHERE correo_usuario = ?";
        $result = $db->executeQuery($checkQuery, [$email]);

        if ($result->num_rows > 0) {
            echo "<script>alert('El correo ya está registrado.'); window.location.href = '../Vista/registro.php';</script>";
            exit();
        }

        // Hash de la contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Se utiliza estas funciones para asegurarse de que la primera letra de cada palabra esté en mayúscula,
        // independientemente de cómo el usuario haya ingresado los datos.
        $nombres = ucwords(strtolower($nombres));
        $apellidos = ucwords(strtolower($apellidos));

        // Preparar la consulta de inserción
        $insertQuery = "INSERT INTO usuarios (tipo_documento, numero_documento, nombre_usuario, apellido_usuario, correo_usuario, password_usuario) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        
        // Ejecutar la consulta de inserción
        $db->executeUpdate($insertQuery, [
            $tipo_documento, // Agregar tipo de documento.
            $numero_documento, //Agregar numero de documento.
            $nombres,  //Agregar nombres.
            $apellidos,  //Agregar apellidos.
            $email,  //Agregar email.
            $hashedPassword //Agregar hash de password.
        ]);

        // Mensaje de éxito y redirección
        echo "<script>alert('Usuario registrado correctamente.'); window.location.href = '../Vista/Login.php';</script>";
    } catch (Exception $e) {
        // Manejo de excepciones
        error_log("Excepción: " . $e->getMessage());
        echo "<script>alert('Ocurrió un error inesperado. Por favor, inténtalo de nuevo.'); window.location.href = '../Vista/registro.php';</script>";
    } finally {
        // Cerrar la conexión a la base de datos
        $db->close();
    }
}
?>