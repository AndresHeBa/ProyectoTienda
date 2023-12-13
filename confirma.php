<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
$config['base_url'] = 'http://' . $_SERVER["SERVER_NAME"];

include 'adminzone/includes/db.php';
$nameuser = $_SESSION["usuario"];
$sql = "SELECT * FROM usuarios WHERE Cuenta = '$nameuser'";
$result = $conn->query($sql);
$iduser = $result->fetch_assoc()['ClienteID'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pago</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Iconos -->
    <script src="https://kit.fontawesome.com/bfdec4dace.js" crossorigin="anonymous"></script>

    <!-- Estilos -->
    <link rel="stylesheet" href="css/tienda.css">
    <link rel="stylesheet" href="css/carrito.css">
</head>

<body>
    <!-- Header -->
    <header>
        <?php
        include 'header.php';
        ?>

    </header>

    <main>
        <div class="envio-message-container" id="envio-message-container">
            <h1>¡Pago Exitoso!</h1>
            <p>Gracias por tu compra. El pago se ha realizado con éxito.</p>
            <p>Se te enviara un correo con los detalles de tu pedido.</p>
            <!-- <i class="fa-solid fa-truck-fast"></i> -->
            <?php
            $cupon = $_SESSION['cupon'];
            echo $cupon;
            $sql = "SELECT * FROM cupon WHERE Codecup = '$cupon'";
            $resulta = $conn->query($sql);
            //si no se puso cupon
            if ($resulta->num_rows == 0) {
                $cupon = 0;
            } else {
                $cupon = $resulta->fetch_assoc()['Descuento'];
                echo $cupon;
            }
            //mostar direccion de envio
            $envio = $_SESSION['envio'];
            $tipo = $_SESSION['tipoEnvio'];
            $impuesto = 0;
            $banco = $_SESSION['banco'];
            echo "<p id='envio-message' class='envio-message'>El envio se realizara a la siguiente direccion:</p>";
            echo "<p id='envio-message2' class='envio-message2'>$envio</p>";
            ?>
            <div class="carrito" id="carrito">
                <div class="header-carrito">
                    <h2>Tu Orden</h2>
                </div>
                <div class="carrito-items">
                    <?php

                    $sql = "SELECT c.*, p.Nombre, p.PrecioVenta, p.Imagen, p.Descuento
                            FROM carrito c
                            JOIN producto p ON c.ProductoID = p.ProductoID
                            WHERE c.ClienteID = " . $iduser . " AND c.Estado = 'En carrito'";
                    $prod = $conn->query($sql);

                    if ($prod->num_rows > 0) {
                        while ($product = $prod->fetch_assoc()) {
                            $precioFin = $product['PrecioVenta'];
                            echo '<div class="carrito-item">
                                <img src="' . $product['Imagen'] . '" width="80px" alt="">
                                <div class="carrito-item-detalles">
                                    <span class="carrito-item-titulo">' . $product['Nombre'] . '</span>';
                            if ($product['Descuento'] > 0) {
                                echo  '<span class="carrito-item-orig">$' . number_format($product['PrecioVenta'], 2) . '</span>';
                                $precioFin = $product['PrecioVenta'] - ($product['PrecioVenta'] * ($product['Descuento'] / 100));
                            }
                            echo  '<span class="carrito-item-precio">$' . number_format($precioFin, 2) . '</span>
                                </div>
                            </div>';
                        }
                    }
                    ?>
                </div>
                <div class="carrito-total">
                    <?php
                    //sacar el total de la suma de los productos y si tiene descuento aplicarlo
                    $sql = "SELECT SUM((p.PrecioVenta - (p.PrecioVenta * (p.Descuento / 100))) * c.CantidadVendida) AS total FROM carrito c JOIN producto p ON c.ProductoID = p.ProductoID WHERE c.ClienteID =" . $iduser . " AND c.Estado = 'En carrito'";

                    $result = $conn->query($sql);

                    if ($result) {
                        $total = $result->fetch_assoc()['total'];
                        $subtotal = $total;
                        $precio = $subtotal - ($subtotal * ($cupon / 100));
                        $total = $precio + $tipo + $impuesto;

                        echo '<div class="fila">
                                    <span class="nota">Subtotal:</span>
                                    <span class="nota">' . number_format($subtotal, 2) . '</span>
                                </div>';
                        echo '<div class="fila">
                                <span class="nota">Subtotal despues del cupon:</span>
                                <span class="nota">' . $precio . '</span>
                            </div>';
                        echo '<div class="fila">
                                    <span class="nota">Metodo de Pago:</span>
                                    <span class="nota">' . $banco . '</span>
                                </div>';
                        echo '<div class="fila">
                                    <span class="nota">Precio de Envio:</span>
                                    <span class="nota"> $' . $tipo . '</span>
                                </div>';
                        echo '<div class="fila">
                                    <span class="nota">Total de Impuestos:</span>
                                    <span class="nota"> $' . $impuesto . '</span>
                                </div>';
                        echo '<div class="fila">
                                    <strong>Total</strong>
                                    <span class="carrito-precio-total">
                                        $' . round($total, 2) . '
                                    </span>
                                </div>';
                    } else {
                        echo "Carrito vacío o error en la consulta: " . $conn->error;
                    }
                    ?>
                </div>
            </div>
            <?php
                //borrar sesion de envio
                // unset($_SESSION['envio']);
                
                //PDF
                if ($prod) {
                    require_once('TCPDF-6.6.5/tcpdf.php');
                    $pdf = new TCPDF();
                    $pdf->setPrintHeader(false);
                    $pdf->setPrintFooter(false);
                    $pdf->AddPage();
                    $pdf->Ln(10);
                    
                    $sql = "SELECT c.*, p.Nombre, p.PrecioVenta, p.Imagen, p.Descuento
                            FROM carrito c
                            JOIN producto p ON c.ProductoID = p.ProductoID
                            WHERE c.ClienteID = ".$iduser." AND c.Estado = 'En carrito'";
                    $prod = $conn->query($sql);

                    if ($prod->num_rows > 0){
                        while ($product = $prod->fetch_assoc()) {
                            $precioFin = $product['PrecioVenta'];
                            if ($product['Descuento'] > 0) {
                                $precioFin = $product['PrecioVenta'] - ($product['PrecioVenta']* ($product['Descuento']/100));
                            }
                            $pdf->Cell(0, 10, $product['Nombre'] . ': $' . number_format($precioFin, 2), 0, 1);
                        }
                    }



                    $pdf->Cell(0, 10, 'Subtotal: $' . number_format($subtotal, 2), 0, 1);
                    $pdf->Cell(0, 10, 'Subtotal despues del cupon: $' . number_format($precio, 2), 0, 1);
                    $pdf->Cell(0, 10, 'Envío: $' . number_format($tipo, 2), 0, 1);
                    $pdf->Cell(0, 10, 'Impuesto: $' . number_format($impuesto, 2), 0, 1);
                    $pdf->Cell(0, 10, 'Total a Pagar: $' . number_format($total, 2), 0, 1);
                
                    $pdf->Cell(0, 10, 'Modo de Pago: ' . $banco, 0, 1);
                
                    $dirEnvio = isset($envio) ? $envio : 'No especificada';
                    $pdf->Cell(0, 10, 'Dirección de Envío: ' . $dirEnvio);
                
                    // Guardar el PDF en el servidor
                    $pdf->Output(__DIR__ . '/pdf/nota_compra.pdf', 'F');
                }

                // Correo
                $email = isset($_SESSION['correo']) ? $_SESSION['correo'] : '';
                if (!empty($email)) {
                    try {
                        //Server settings
                        //Enable verbose debug output
                        $mail->SMTPDebug=0;
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'adrianalonso.a4@gmail.com';                     //SMTP username
                        $mail->Password   = 'wtld iaxc ojfx dnbe';                               //SMTP password
                        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('adrianalonso.a4@gmail.com', 'InnovaCodeTech');
                        $mail->addAddress($email);     //Add a recipient
                
                        $mail->addAddress($email);
                        $mail->isHTML(true);
                        $mail->Subject = 'Recibo de Compra';
                        $mail->Body = '<html>
                        <head>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    background-color: #f4f4f4;
                                    color: #333;
                                    margin: 0;
                                    padding: 0;
                                }
                                .container {
                                    max-width: 600px;
                                    margin: 0 auto;
                                    padding: 20px;
                                    background-color: #fff;
                                    border-radius: 5px;
                                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                }
                                h1 {
                                    color: #007bff;
                                }
                                ul {
                                    list-style-type: none;
                                    padding: 0;
                                }
                                li {
                                    margin-bottom: 10px;
                                }
                                .nota {
                                    display: block;
                                    margin-bottom: 5px;
                                }
                                .carrito-precio-total {
                                    font-weight: bold;
                                    font-size: 18px;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="container">
                                <h1>Nota de Compra</h1>
                                <p>Estos son los productos que compro y los detalles de la venta:</p>
                                <ul>';
                    $sql = "SELECT c.*, p.Nombre, p.PrecioVenta, p.Imagen, p.Descuento
                            FROM carrito c
                            JOIN producto p ON c.ProductoID = p.ProductoID
                            WHERE c.ClienteID = ".$iduser." AND c.Estado = 'En carrito'";
                    $prod = $conn->query($sql);
                    
                    if ($prod->num_rows > 0){
                        while ($product = $prod->fetch_assoc()) {
                            $precioFin = $product['PrecioVenta'];
                            if ($product['Descuento'] > 0) {
                                $precioFin = $product['PrecioVenta'] - ($product['PrecioVenta']* ($product['Descuento']/100));
                            }
                            $mail->Body .= '<li>
                                                <span class="carrito-item-titulo">' . $product['Nombre'] . '</span>
                                                <span class="carrito-item-precio">$' . number_format($precioFin, 2) . '</span>
                                            </li>';
                        }
                    }
                    
                    $mail->Body .= '</ul>
                                <div class="fila">
                                    <span class="nota">Subtotal:</span>
                                    <span class="nota">$' . number_format($subtotal, 2) . '</span>
                                </div>
                                <div class="fila">
                                    <span class="nota">Subtotal despues del cupón:</span>
                                    <span class="nota">$' . number_format($precio, 2) . '</span>
                                </div>
                                <div class="fila">
                                    <span class="nota">Metodo de Pago:</span>
                                    <span class="nota">' . $banco . '</span>
                                </div>
                                <div class="fila">
                                    <span class="nota">Precio de Envio:</span>
                                    <span class="nota">$' . $tipo . '</span>
                                </div>
                                <div class="fila">
                                    <span class="nota">Total de Impuestos:</span>
                                    <span class="nota">$' . $impuesto . '</span>
                                </div>
                                <div class="fila">
                                    <strong>Total</strong>
                                    <span class="carrito-precio-total">$' . round($total, 2) . '</span>
                                </div>
                                <div class="fila">
                                    <span class="nota">Direccion de Envio:</span>
                                    <span class="nota">' . $envio . '</span>
                                </div>
                            </div>
                        </body>
                    </html>';
                        $mail->addAttachment(__DIR__ . '/pdf/nota_compra.pdf', 'nota_compra.pdf');
                
                        $mail->send();
                    } catch (Exception $e) {
                        echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
                    }
                } else {
                    echo 'La dirección de correo electrónico no está disponible.';
                }
                
                $conn->close();
            ?>
            <?php
            include 'adminzone/includes/db.php';
            // restar stock
            $sql = "SELECT c.*, p.Nombre, p.PrecioVenta, p.Imagen, p.Descuento FROM carrito c JOIN producto p ON c.ProductoID = p.ProductoID WHERE c.ClienteID = " . $iduser . " AND c.Estado = 'En carrito'";
            $prodResult = $conn->query($sql);

            if ($prodResult->num_rows > 0) {
                $row = $prodResult->fetch_assoc();

                $cantidad = $row['CantidadVendida'];
                $idprod = $row['ProductoID'];

                $sql = "UPDATE producto SET CantidadStock = CantidadStock - $cantidad WHERE ProductoID = $idprod";
                $conn->query($sql);
            } else {
                // Manejar el caso donde no se encontraron productos en el carrito
                echo "No se encontraron productos en el carrito para restar el stock.";
            }

            //actualizar carrito
            $updateCarrito = "UPDATE carrito SET Estado = 'Pagado' WHERE ClienteID = '$iduser' AND Estado = 'En carrito' ";
            $conn->query($updateCarrito);

            $conn->close();
            ?>
        </div>
    </main>

    <footer>
        <!-- Footer -->
        <?php
        include 'footer.php';
        ?>
    </footer>
</body>

</html>