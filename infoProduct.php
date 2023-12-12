<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
$config['base_url'] = 'http://' . $_SERVER["SERVER_NAME"];

include 'adminzone/includes/db.php';

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $sql = "SELECT * FROM producto WHERE ProductoID = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        $proveedorId = $product['ProveedorID'];
        $sqlProveedor = "SELECT Nombre FROM proveedores WHERE ProveedorID = $proveedorId";
        $resultProveedor = $conn->query($sqlProveedor);

        if ($resultProveedor->num_rows > 0) {
            $proveedor = $resultProveedor->fetch_assoc();
            $nombreProveedor = $proveedor['Nombre'];
        } else {
            $nombreProveedor = "Proveedor no encontrado";
        }

    } else {
        echo "Producto no encontrado";
        exit();
    }
} else {
    echo "ID de producto no proporcionado";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['Nombre']; ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Iconos -->
    <script src="https://kit.fontawesome.com/bfdec4dace.js" crossorigin="anonymous"></script>

    <!-- Estilos -->
    <link rel="stylesheet" href="css/tienda.css">

</head>

<body>

    <!-- Header -->
    <header>
        <?php
        include 'header.php';
        ?>
    </header>

    <!-- Información del Producto -->
    <section class="producto-info">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo $product['Imagen']; ?>" alt="<?php echo $product['Nombre']; ?>" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2><?php echo $product['Nombre']; ?></h2>
                    <p><?php echo $product['Descripción']; ?></p>
                    <p><strong>Stock:</strong> <?php echo $product['CantidadStock']; ?></p>
                    <p><strong>Proveedor:</strong> <?php echo $nombreProveedor; ?></p>
                    <p><strong>Cantidad:</strong>
                    <div class="selector-cantidad" data-product-id="<?php echo $productId; ?>">
                        <i class="fa-solid fa-minus restar-cantidad"></i>
                        <input type="text" value="1" class="carrito-item-cantidad" disabled>
                        <i class="fa-solid fa-plus sumar-cantidad"></i>
                    </div>
                    </p>
                    <form action="carrito.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                        <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cantidadSelector = document.querySelector('.selector-cantidad');
            const inputCantidad = cantidadSelector.querySelector('.carrito-item-cantidad');
            const restarBtn = cantidadSelector.querySelector('.restar-cantidad');
            const sumarBtn = cantidadSelector.querySelector('.sumar-cantidad');
            const maxStock = <?php echo $product['CantidadStock']; ?>;

            restarBtn.addEventListener('click', function (event) {
                event.preventDefault();
                actualizarCantidadEnCarrito(inputCantidad, -1, maxStock);
            });

            sumarBtn.addEventListener('click', function (event) {
                event.preventDefault();
                actualizarCantidadEnCarrito(inputCantidad, 1, maxStock);
            });

            function actualizarCantidadEnCarrito(inputCantidad, cantidad, maxStock) {
                let nuevaCantidad = parseInt(inputCantidad.value) + cantidad;
                nuevaCantidad = Math.min(Math.max(1, nuevaCantidad), maxStock);
                inputCantidad.value = nuevaCantidad;
            }
        });
    </script>

</body>

</html>
