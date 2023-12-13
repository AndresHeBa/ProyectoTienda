<?php
require_once 'adminzone/includes/db.php';

function validatePassword($password)
{
    // Validate password strength
    // https://www.geeksforgeeks.org/how-to-validate-a-password-using-regular-expressions-in-php/
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        return false;
    } else {
        return true;
    }
}

// checar metodo de solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $pregunta = $_POST['pregunta'];
    $respuesta = $_POST['respuesta'];

    // Verifica que las contraseña cumpla con los criterios de seguridad
    if (validatePassword($password)) {
        // Si las contraseñas coinciden, realiza la lógica para cambiar la contraseña en tu base de datos
        if ($password === $confirmPassword) {
            // Suponiendo que estás usando MySQLi
            $stmt = $conn->prepare("INSERT INTO `usuarios` (
        `IsAdmin`,
        `Nombre`,
        `Dirección`,
        `NúmeroContacto`,
        `Correo`,
        `Contraseña`,
        `Cuenta`,
        `PreguntaID`,
        `RespuestaP`,
        `Estado`
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'activo')");

            $isAdmin = 0;
            // Encriptar contraseña
            $password = sha1($password);
            // Enlazar parámetros
            $stmt->bind_param("issssssis", $isAdmin, $nombre, $direccion, $telefono, $email, $password, $usuario, $pregunta, $respuesta);

            // Ejecutar la consulta
            $result = $stmt->execute();

            if ($result) {
                // Registro exitoso
                $response = array('status' => 'success', 'message' => 'User registered successfully');
            } else {
                // Registro fallido
                $response = array('status' => 'error', 'message' => 'Error registering user: ' . $stmt->error);
            }

            $stmt->close();
        } else {
            $response = array('status' => 'error', 'message' => 'Las contraseñas no coinciden');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'La contraseña no cumple con los criterios de seguridad');
    }


    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If not a POST request, return an error response
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
