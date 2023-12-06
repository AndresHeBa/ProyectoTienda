<?php
require_once 'adminzone/includes/db.php';

// checar metodo de solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    // Contraseña con SHA1
    $password = sha1($_POST['password']);
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $pregunta = $_POST['pregunta'];
    $respuesta = $_POST['respuesta'];

    $query = "INSERT INTO `usuarios`(
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
            )
            VALUES(
                '0',
                '$nombre',
                '$direccion',
                '$telefono',
                '$email',
                '$password',
                '$usuario',
                '$pregunta',
                '$respuesta',
                'activo'
            )";

    // Execute the query
    $result = $conn->query($query);

    if ($result) {
        // Registration successful
        $response = array('status' => 'success', 'message' => 'User registered successfully');
    } else {
        // Registration failed
        $response = array('status' => 'error', 'message' => 'Error registering user');
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
?>