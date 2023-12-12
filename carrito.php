<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
$config['base_url'] = 'http://' . $_SERVER["SERVER_NAME"];
// sacar id del usuario
if (isset($_SESSION['usuario'])) {
    $nameuser = $_SESSION["usuario"];
    include 'adminzone/includes/db.php';
    $sql = "SELECT * FROM usuarios WHERE Cuenta = '$nameuser'";
    $result = $conn->query($sql);
    $iduser = $result->fetch_assoc()['ClienteID'];
} else {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $productQuantity = $_POST['product_' . $productId . '_quantity'];

    include 'adminzone/includes/db.php';

    $sql = "SELECT * FROM producto WHERE ProductoID = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        $sql = "SELECT * FROM carrito WHERE ClienteID = $iduser AND ProductoID = $productId AND Estado = 'En carrito'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            //saber cuentos productos similares hay en el carrito
            $sql = "SELECT SUM(CantidadVendida) AS total FROM carrito WHERE ClienteID = $iduser AND ProductoID = $productId AND Estado = 'En carrito'";
            $result = $conn->query($sql);
            $total = $result->fetch_assoc()['total'];
            //si la cantidad que se quiere agregar es mayor a la cantidad que hay en el carrito
            if ($total + $productQuantity > $product['CantidadStock']) {
                //si es mayor se agrega la cantidad que falta para llegar al limite
                $productQuantity = $product['CantidadStock']-$total;
            }
            //si la cantidad que se quiere agregar es menor a la cantidad que hay en el carrito
            $sql = "UPDATE carrito SET CantidadVendida = CantidadVendida + $productQuantity WHERE ClienteID = $iduser AND ProductoID = $productId AND Estado = 'En carrito'";
            $result = $conn->query($sql);
            if ($result) {
                header("Location: carrito.php");
                echo "Producto agregado al carrito";
            } else {
                echo "Error al agregar producto al carrito";
            }
        } else {
            $estado = 'En carrito';
            $insertarDetalle = "INSERT INTO carrito (ClienteID ,ProductoID, CantidadVendida, PrecioVenta, Estado, Activo) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertarDetalle);
            $stmt->bind_param("iiidsi", $iduser, $productId, $productQuantity, $product['PrecioVenta'], $estado, $activo);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header("Location: carrito.php");
                echo "Producto agregado al carrito";
            } else {
                echo "Error al agregar producto al carrito";
            }
        }
        header("Location: carrito.php");
        exit();
    } else {
        echo "Producto no encontrado";
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
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
    <link rel="stylesheet" href="css/carrito.css">

</head>

<body>

    <!-- Header -->

    <header>
        <?php
        include 'header.php';
        ?>
    </header>

    <div class="header-title">
        <h1>Carrito</h1>
    </div>
    <section class="contenedor">
        <!-- Carrito de Compras -->
        <div class="carrito" id="carrito">
            <div class="header-carrito">
                <h2>Tu Carrito</h2>
            </div>
            <div class="carrito-items">
                <?php
                include 'adminzone/includes/db.php';

                $sql = "SELECT c.*, p.Nombre, p.PrecioVenta, p.Imagen, p.Descuento
                    FROM carrito c
                    JOIN producto p ON c.ProductoID = p.ProductoID
                    WHERE c.ClienteID = " . $iduser . " AND c.Estado = 'En carrito'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                        $precioFin = $product['PrecioVenta'];
                        echo '<div class="carrito-item">
                            <img src="' . $product['Imagen'] . '" width="80px" alt="">
                            <div class="carrito-item-detalles">
                                <span class="carrito-item-titulo">' . $product['Nombre'] . '</span>
                                <div class="selector-cantidad">
                                    <i class="fa-solid fa-minus restar-cantidad"></i>
                                    <input type="text" value="' . $product['CantidadVendida'] . '" class="carrito-item-cantidad" disabled>
                                    <i class="fa-solid fa-plus sumar-cantidad"></i>
                                </div> 
                                <div>';
                                if ($product['Descuento'] > 0) {
                                    echo  '<span class="carrito-item-orig">$' . round($product['PrecioVenta'],2) . '</span>';
                                    $precioFin = $product['PrecioVenta'] - ($product['PrecioVenta']* ($product['Descuento']/100));
                                }
                                echo '
                                <span class="carrito-item-precio">$' . round($precioFin,2) . '</span>
                                </div>
                            </div>
                            <span class="btn-eliminar">
                                <i class="fa-solid fa-trash"></i>
                            </span>
                        </div>';
                    }
                } else {
                    echo "Carrito vacío";
                }

                ?>

            </div>
            <div class="carrito-total">
                <?php
                //precio sin descuento
                $sql = "SELECT SUM(p.PrecioVenta * c.CantidadVendida) AS total FROM carrito c JOIN producto p ON c.ProductoID = p.ProductoID WHERE c.ClienteID = " . $iduser . " AND c.Estado = 'En carrito'";

                $result = $conn->query($sql);

                if ($result) {
                    $total = $result->fetch_assoc()['total'];
                    echo '<div class="fila">
                            <strong>Total sin descuento</strong>
                            <span class="carrito-precio-total">
                                $' . round($total, 2) . '
                            </span>
                        </div>';
                } else {
                    echo "Carrito vacío o error en la consulta: " . $conn->error;
                }


                //sacar el total de la suma de los productos y si tiene descuento aplicarlo
                $sql = "SELECT SUM((p.PrecioVenta - (p.PrecioVenta * (p.Descuento / 100))) * c.CantidadVendida) AS total FROM carrito c JOIN producto p ON c.ProductoID = p.ProductoID WHERE c.ClienteID =" . $iduser . " AND c.Estado = 'En carrito'";

                $result = $conn->query($sql);

                if ($result) {
                    $total = $result->fetch_assoc()['total'];
                    echo '<div class="fila">
                            <strong>Total</strong>
                            <span class="carrito-precio-total">
                                $' . round($total, 2) . '
                            </span>
                        </div>';
                } else {
                    echo "Carrito vacío o error en la consulta: " . $conn->error;
                }


                $conn->close();
                ?>
                <button class="btn-pagar" onclick="redirectToPago()">Pagar <i class="fa-solid fa-bag-shopping"></i> </button>
            </div>
        </div>

    </section>


    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>
    <script>
        function redirectToPago() {
            window.location.href = "metodo_pago.php";
        }
    </script>
</body>

</html>