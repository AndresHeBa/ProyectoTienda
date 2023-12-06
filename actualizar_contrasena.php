<?php
require_once 'adminzone/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $nueva_contrasena = sha1($_POST['nueva_contrasena']);

    $query = "UPDATE Usuarios SET Contraseña = '$nueva_contrasena' WHERE Usuario = '$usuario'";
    $result = $conn->query($query);

    if ($result) {
        $response = array('status' => 'success', 'message' => 'Contraseña actualizada exitosamente');
    } else {
        $response = array('status' => 'error', 'message' => 'Error al actualizar la contraseña');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Método de solicitud no válido');
    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>
