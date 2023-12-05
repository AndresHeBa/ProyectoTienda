<?php
require_once 'adminzone/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['usuario'];
    $password = sha1($_POST['passwordl']);

    session_start();
    if (!isset($_SESSION['login_attempts'][$username])) {
        $_SESSION['login_attempts'][$username] = 0;
    }

    if ($_SESSION['login_attempts'][$username] < 3) {
        $query = "SELECT * FROM `Usuarios` WHERE `Cuenta` = ? AND `Contraseña` = ? AND `Estado` = 'activo';";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            unset($_SESSION['login_attempts'][$username]); 
            $response = array('status' => 'success', 'message' => 'Usuario ingresado exitosamente');
        } else {
            $_SESSION['login_attempts'][$username]++;
            $remaining_attempts = 3 - $_SESSION['login_attempts'][$username];
            $response = array('status' => 'error', 'message' => 'Nombre de usuario o contraseña incorrectos. Intentos restantes: ' . $remaining_attempts);
        }
    } else {
        $query = "UPDATE `Usuarios` SET `estado` = 'bloqueado' WHERE `Cuenta` = ?;";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $response = array('status' => 'error', 'message' => 'Cuenta bloqueada');
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