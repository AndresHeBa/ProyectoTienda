<?php
     
     if (session_status() == PHP_SESSION_NONE) {
         session_start();
     }
     ob_start();
     $config['base_url'] = 'http://' . $_SERVER["SERVER_NAME"];

     include 'adminzone/includes/db.php'
       
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
</head>
<body>
    <!-- Header -->
    <header>
    <?php
        include 'header.php';
        ?>
        <h1>¡Pago Exitoso!</h1>
    </header>

    <main>
        <p>Gracias por tu compra. El pago se ha realizado con éxito.</p>
        <?php
        if (isset($_SESSION['Direccion'])) {
            echo '<p>El pedido será entregado a la siguiente dirección:</p>';
            echo '<p>' . $_SESSION['Envio'] . '</p>';
        }
        ?>
    </main>

    <footer>
        <!-- Footer -->
        <?php
        include 'footer.php';
        ?>
    </footer>
</body>
</html>

