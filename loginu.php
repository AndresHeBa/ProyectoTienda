<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
$config['base_url'] = 'http://' . $_SERVER["SERVER_NAME"];

require_once 'adminzone/includes/db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (($_POST['captcha_code'] === $_COOKIE['captcha'])) {
        setcookie("captcha", "", time() - 3600);
        $username = $_POST['usuario'];
        $password = sha1($_POST['passwordl']);
        $password2 = $_POST['passwordl'];
        $loginop = $_POST['loginop'];


        $query = "SELECT * FROM `usuarios` WHERE `Cuenta` = ? AND `Contraseña` = ? AND `Estado` = 'bloqueado';";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $response = array('status' => 'bc', 'message' => 'Cuenta bloqueada');
        } else {
            if ($loginop >= 3) {
                $query = "UPDATE `usuarios` SET `Estado` = 'bloqueado' WHERE `Cuenta` = ?;";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('s', $username);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    $response = array('status' => 'bc', 'message' => 'Cuenta bloqueada');
                } else {
                    $response = array('status' => 'error', 'message' => 'Error al bloquear la cuenta');
                }
            } else {
                $query = "SELECT * FROM `usuarios` WHERE `Cuenta` = ? AND `Contraseña` = ? AND `Estado` = 'activo';";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ss', $username, $password);
                $stmt->execute();
                $result = $stmt->get_result();
                if (!empty($_POST["remember"])) {
                    setcookie("username", $username, time() + 3600);
                    setcookie("password", $password2, time() + 3600);
                } else {
                    setcookie("username", "");
                    setcookie("password", "");
                }

                if ($result->num_rows > 0) {
                    // Login successful
                    $response = array('status' => 'success', 'message' => 'User logged in successfully');
                    $_SESSION["usuario"] = $username;
                    $fila = $result->fetch_assoc();
                    $_SESSION["admin"] = $fila["IsAdmin"];

                    header("refresh:3;url=principal.php");
                } else {
                    // Login failed
                    $response = array('status' => 'error', 'message' => 'Login failed');
                    //regresar captcha
                    setcookie("captcha", $_POST['captcha_code'], time() + 300);
                }
            }
        }
    } else {
        $response = array('status' => 'error-captcha', 'message' => 'Invalid captcha');
    }
    // Send the JSON response
    http_response_code(200);
    header('Content-Type: application/json; charset=utf-8');
    ob_clean(); // Limpiar el buffer de salida
    echo json_encode($response);
    exit; // Asegura que no haya más salida después de enviar la respuesta JSON
} else {
    // If not a POST request, return an error response
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    http_response_code(400);
    header('Content-Type: application/json; charset=utf-8');
    ob_clean(); // Limpiar el buffer de salida
    echo json_encode($response);
    exit; // Asegura que no haya más salida después de enviar la respuesta JSON
}

// Close the database connection
$conn->close();
