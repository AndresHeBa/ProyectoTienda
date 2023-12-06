<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
$config['base_url'] = 'http://' . $_SERVER["SERVER_NAME"];

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
// Destruye la sesión actual
session_destroy();

// Redirige a la página de inicio o a donde desees
header("Location: index.php"); // Cambia "index.php" al lugar donde desees redirigir al usuario
?>