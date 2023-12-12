<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
$config['base_url'] = 'http://' . $_SERVER["SERVER_NAME"];

require_once 'adminzone/includes/db.php';
$nameuser = $_SESSION["usuario"];
$sql = "SELECT * FROM usuarios WHERE Cuenta = '$nameuser'";
$result = $conn->query($sql);
$iduser = $result->fetch_assoc()['ClienteID'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreTarjeta = $_POST["Tarjeta"];
    $numeroTarjeta = $_POST["NumTar"];
    $fechaVencimiento = $_POST["Vencimiento"];
    $cvv = $_POST["CVV"];
    $envio = $_POST["Envio"];
    $desc = $_POST["Descr"];
    $precioTotal = $_POST['precioVenta'];
    $impuesto = $_POST['impuesto'];

    $totalPagar = $precioTotal + $impuesto;

    $cuponInput = isset($_POST['Cupon']) ? $_POST['Cupon'] : NULL;


    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "INSERT INTO pagos (Tarjeta, NumTar, Vencimiento, CVV, Envio, Descr, ClienteID) VALUES ('$nombreTarjeta', '$numeroTarjeta', '$fechaVencimiento', '$cvv', '$envio', '$desc', '$iduser')";

    if ($conn->query($sql) === TRUE) {
        // Obtener el ID del último pago insertado
        $pagosID = $conn->insert_id;

        // Actualizar productos en carrito a "En carrito"
        $updateCarrito = "UPDATE carrito SET Estado = 'Pagado' WHERE ClienteID = '$iduser' AND Estado = 'En carrito' ";
        $conn->query($updateCarrito);

        // Marcar el cupón como usado en carrito
        $updateCupon = "UPDATE carrito SET CuponID = (SELECT CuponID FROM cupon WHERE Codecup = '$cuponInput') WHERE ClienteID = '$iduser' AND CuponID IS NULL";
        $conn->query($updateCupon);

        // Crear una nueva venta
        $insertVenta = "INSERT INTO ventas (Fecha, Hora, CarritoID, PrecioVentaTotal, PagosID) 
                SELECT CURDATE(), CURTIME(), CarritoID, $totalPagar, $pagosID
                FROM carrito
                WHERE ClienteID = '$iduser' AND Estado='Pagado'";
        if ($conn->query($insertVenta) === TRUE) {
            // Redirigir a la página de confirmación
            header("Location: confirma.php");
            exit();
        } else {
            echo "Error al insertar la venta: " . $conn->error;
        }
    } else {
        echo "Error al insertar el pago: " . $conn->error;
    }

    $conn->close();
} else {
    exit();
}
