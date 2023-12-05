<?php
require_once 'adminzone/includes/db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['usuario'];
    $password = sha1($_POST['passwordl']);

    $query = "SELECT * FROM `Usuarios` WHERE `Cuenta` = ? AND `Contraseña` = ?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login successful
        $response = array('status' => 'success', 'message' => 'User logged in successfully');
    } else {
        // Login failed
        $response = array('status' => 'error', 'message' => 'Invalid username or password');
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
