<?php
require_once 'adminzone/includes/db.php';

function validatePassword($password)
{
    // Criterios de contraseña segura
    $minLength = 8; // Mínimo de 8 caracteres
    $hasUpperCase = preg_match('/[A-Z]/', $password); // Al menos una letra mayúscula
    $hasLowerCase = preg_match('/[a-z]/', $password); // Al menos una letra minúscula
    $hasDigit = preg_match('/\d/', $password); // Al menos un número
    $hasSpecialChar = preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/', $password); // Al menos un carácter especial

    // Verifica cumplimiento de criterios
    return strlen($password) >= $minLength &&
        $hasUpperCase &&
        $hasLowerCase &&
        $hasDigit &&
        $hasSpecialChar;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $pregunta = $_POST['pregunta'];
    $respuesta = $_POST['respuesta'];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Verifica que las contraseña cumpla con los criterios de seguridad
    if (validatePassword($password)) {
        // Si las contraseñas coinciden, realiza la lógica para cambiar la contraseña en tu base de datos
        if ($password === $confirmPassword) {
            $query = $conn->prepare("SELECT * FROM `usuarios` WHERE `Cuenta` = ? AND `PreguntaID` = ? AND `RespuestaP` = ?");
            $query->bind_param("sss", $usuario, $pregunta, $respuesta);
            $query->execute();

            if ($query->error) {
                // Manejar el error, por ejemplo:
                die('Error en la consulta: ' . $query->error);
            }

            $result = $query->get_result();

            if ($result->num_rows > 0) {
                $hashed_password = sha1($password);
                $update_query = "UPDATE `usuarios` SET `Contraseña` = '$hashed_password', `Estado` = 'activo' WHERE `Cuenta` = '$usuario'";
                $update_result = $conn->query($update_query);

                if ($update_result) {
                    $response = array('status' => 'success', 'message' => 'Contraseña actualizada con éxito');
                } else {
                    $response = array('status' => 'error', 'message' => 'Error al actualizar la contraseña');
                }
            } else {
                $response = array('status' => 'error', 'message' => 'Pregunta o respuesta incorrectas');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Las contraseñas no coinciden');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'La contraseña no cumple con los criterios de seguridad');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>
