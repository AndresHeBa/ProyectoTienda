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
                            WHERE c.ClienteID = ".$iduser." AND c.Estado = 'En carrito'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0){
                        while ($product = $result->fetch_assoc()) {
                            $precioFin = $product['PrecioVenta'];
                            echo '<div class="carrito-item">
                                <img src="' . $product['Imagen'] . '" width="80px" alt="">
                                <div class="carrito-item-detalles">
                                    <span class="carrito-item-titulo">' . $product['Nombre'] . '</span>';
                            if ($product['Descuento'] > 0) {
                                echo  '<span class="carrito-item-orig">$' . round($product['PrecioVenta'],2) . '</span>';
                                $precioFin = $product['PrecioVenta'] - ($product['PrecioVenta']* ($product['Descuento']/100));
                            }
                            echo  '<span class="carrito-item-precio">$' . round($precioFin,2) . '</span>
                                </div>
                            </div>';
                        }
                    }
                    ?>
                </div>
                <div class="carrito-total">
                    <?php
                        //sacar el total de la suma de los productos y si tiene descuento aplicarlo
                        $sql = "SELECT SUM((p.PrecioVenta - (p.PrecioVenta * (p.Descuento / 100))) * c.CantidadVendida) AS total FROM carrito c JOIN producto p ON c.ProductoID = p.ProductoID WHERE c.ClienteID =".$iduser." AND c.Estado = 'En carrito'";

                        $result = $conn->query($sql);

                        if ($result) {
                            $total = $result->fetch_assoc()['total'];
                            $total += $tipo;
                            echo '<div class="fila">
                                    <span class="nota">Metodo de Pago:</span>
                                    <span class="nota">'. $banco .'</span>
                                </div>';
                            echo '<div class="fila">
                                    <span class="nota">Precio de Envio:</span>
                                    <span class="nota"> $'. $tipo .'</span>
                                </div>';
                            echo '<div class="fila">
                                    <span class="nota">Total de Impuestos:</span>
                                    <span class="nota"> $'. $impuesto .'</span>
                                </div>';
                            echo '<div class="fila">
                                    <strong>Total</strong>
                                    <span class="carrito-precio-total">
                                        $' . round($total,2) . '
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
                
                // Correo
                $correo = $_SESSION['correo'];
                if (isset($correo)) {
                    $email = $correo;

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

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->addAttachment("img/logo-2.png", "logo-2.png");
                        $mail->Body = 'Embedded Image: <img alt="PHPMailer" src="cid:my-attach"> Here is an image!';
                        $mail->Subject = 'Gracias por contactarnos';
                        $mail->CharSet = 'UTF-8';
                        $mail->Body  = '<html>
                        <head>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    background-color: #f4f4f4;
                                    color: #333;
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
                                h3{
                                    text-align:center;
                                    color:rgb(134,15,90);
                                    }
                                    </style>
                        </head>
                        <body>
                            <div class="container">
                                <h1>Proceso de solicitud</h1>
                                <p>Gracias por ponerte en contacto con nosotros, su solicitud esta siendo procesada.<br> 
                                Un miembro de nuestro equipo se pondra en contacto con usted dentro de las proximas 48 horas, agradecemos su paciencia.
                                  <br>
                                <br>Atentamente<br>
                                  <br>
                                    
                                <h3>TecnoGadget<h/3> </p>
                            </div>
                        </body>
                        </html>';


                        $mail->send();
                    } catch (Exception $e) {
                    }
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
