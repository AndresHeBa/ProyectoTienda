<?php
    // Path: adminzone/includes/db.php
    // Conexión a la base de datos (utilizando mysqli)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tecnobd";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
?>