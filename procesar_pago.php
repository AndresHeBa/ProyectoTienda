<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
$config['base_url'] = 'http://' . $_SERVER["SERVER_NAME"];

require_once 'adminzone/includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreTarjeta = $_POST["Tarjeta"];
    $numeroTarjeta = $_POST["NumTar"];
    $fechaVencimiento = $_POST["Vencimiento"];
    $cvv = $_POST["CVV"];
    $envio = $_POST["Envio"];
    $desc = $_POST["Descr"];

    $cuponInput = isset($_POST['Cupon']) ? $_POST['Cupon'] : '';
    $cuponAplicado = false;
    if ($cuponInput == "M45T3CN0") {
        $cuponAplicado = true;
        $codigoCupon = "M45T3CN0";
        $consulta = "UPDATE pagos SET Cupon = 1 WHERE Cupon = ?";
        $stmt = $conn->prepare($consulta);
        $stmt->bind_param("s", $codigoCupon);
        if (!$stmt->execute()) {
            echo "Error al marcar el cupón como usado: " . $stmt->error;
            exit();
        }
        $stmt->close();
    }

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "INSERT INTO pagos (Tarjeta, NumTar, Vencimiento, CVV, Envio, Descr) VALUES ('$nombreTarjeta', '$numeroTarjeta', '$fechaVencimiento', '$cvv', '$envio', '$desc')";

    if ($conn->query($sql) === TRUE) {
        header("Location: confirma.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    exit();
}
?>