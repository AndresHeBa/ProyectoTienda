<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
$config['base_url'] = 'http://' . $_SERVER["SERVER_NAME"];

include 'adminzone/includes/db.php';

if (isset($_GET['product_id'])) {
    $productId = $_GET['Product_id'];
    $sql = "SELECT * FROM producto WHERE ProductoID = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
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
                    <p><strong>Proveedor:</strong> <?php echo $product['Proveedor']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>
</body>
</html>