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

    $_SESSION['tipoEnvio'] = $_POST["TipoEnvio"];
    $_SESSION['banco'] = $_POST["TipoTarjeta"];
    $_SESSION['cupon'] = $_POST['Cupon'];
    $_SESSION['impuesto'] = $_POST['Region'];
    $totalPagar = $precioTotal + ($precioTotal*$impuesto);

    $cuponInput = isset($_POST['Cupon']) ? $_POST['Cupon'] : NULL;

    //revisar si los datos enviados ya estan registrados
    $sql = "SELECT * FROM pagos WHERE Tarjeta = '$nombreTarjeta' AND NumTar = '$numeroTarjeta' AND Vencimiento = '$fechaVencimiento' AND CVV = '$cvv' AND Envio = '$envio' AND Descr = '$desc' AND ClienteID = '$iduser'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Obtener el ID del último pago insertado
        $pagosID = $result->fetch_assoc()['PagosID'];
        // Insertar la venta
        $insertVenta = "INSERT INTO ventas (Fecha, Hora, CarritoID, PrecioVentaTotal, PagosID) 
                SELECT CURDATE(), CURTIME(), CarritoID, $totalPagar, $pagosID
                FROM carrito
                WHERE ClienteID = '$iduser' AND Estado='En carrito'";
        $conn->query($insertVenta);

        //Aqui estaba actualizar carrito

        // Marcar el cupón como usado en carrito
        $updateCupon = "UPDATE carrito SET CuponID = (SELECT CuponID FROM cupon WHERE Codecup = '$cuponInput') WHERE ClienteID = '$iduser' AND CuponID IS NULL";

        if ($conn->query($updateCupon) === TRUE) {
            //sesion de envio
            $_SESSION['envio'] = $envio;
            // Redirigir a la página de confirmación
            header("Location: confirma.php");
            exit();
        } else {
            echo "Error al insertar la venta: " . $conn->error;
        }
    } else {

        $sql = "INSERT INTO pagos (Tarjeta, NumTar, Vencimiento, CVV, Envio, Descr, ClienteID) VALUES ('$nombreTarjeta', '$numeroTarjeta', '$fechaVencimiento', '$cvv', '$envio', '$desc', '$iduser')";

        if ($conn->query($sql) === TRUE) {
            // Obtener el ID del último pago insertado
            $pagosID = $conn->insert_id;
            // Insertar la venta
            $insertVenta = "INSERT INTO ventas (Fecha, Hora, CarritoID, PrecioVentaTotal, PagosID) 
                SELECT CURDATE(), CURTIME(), CarritoID, $totalPagar, $pagosID
                FROM carrito
                WHERE ClienteID = '$iduser' AND Estado='En carrito'";
            $conn->query($insertVenta);

            //Aqui estaba actualizar carrito

            // Marcar el cupón como usado en carrito
            $updateCupon = "UPDATE carrito SET CuponID = (SELECT CuponID FROM cupon WHERE Codecup = '$cuponInput') WHERE ClienteID = '$iduser' AND CuponID IS NULL";

            if ($conn->query($updateCupon) === TRUE) {
                //sesion de envio
                $_SESSION['envio'] = $envio;
                // Redirigir a la página de confirmación
                header("Location: confirma.php");
                exit();
            } else {
                echo "Error al insertar la venta: " . $conn->error;
            }
        } else {
            echo "Error al insertar el pago: " . $conn->error;
        }
    }
    $conn->close();
} else {
    exit();
}
