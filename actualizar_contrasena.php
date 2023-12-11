<?php
require_once 'adminzone/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $pregunta = $_POST['pregunta'];
    $respuesta = $_POST['respuesta'];
    $nueva_contraseña = $_POST['nueva_contraseña'];

    if (empty($usuario) || empty($pregunta) || empty($respuesta) || empty($nueva_contraseña)) {
        $response = array('status' => 'error', 'message' => 'Por favor, complete todos los campos');
    } else {
        $query = "SELECT * FROM `usuarios` WHERE `Cuenta` = '$usuario' AND `PreguntaID` = '$pregunta' AND `RespuestaP` = '$respuesta'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $hashed_password = sha1($nueva_contraseña);
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
