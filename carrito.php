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
                <div class="carrito-item">
                    <img src="img/amd9.jpg" width="80px" alt="">
                    <div class="carrito-item-detalles">
                        <span class="carrito-item-titulo">AMD Rayzen 9</span>
                        <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="1" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                        <span class="carrito-item-precio">$00,000,00</span>
                    </div>
                   <span class="btn-eliminar">
                        <i class="fa-solid fa-trash"></i>
                   </span>
                </div>
                <div class="carrito-item">
                    <img src="img/amd9.jpg" width="80px" alt="">
                    <div class="carrito-item-detalles">
                        <span class="carrito-item-titulo">Amd Rayzen 9</span>
                        <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="3" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                        <span class="carrito-item-precio">$00,000,00</span>
                    </div>
                   <button class="btn-eliminar">
                        <i class="fa-solid fa-trash"></i>
                   </button>
                </div>
                 
            </div>
            <div class="carrito-total">
                <div class="fila">
                    <strong>Tu Total</strong>
                    <span class="carrito-precio-total">
                        $000,000,00
                    </span>
                </div>
                <button class="btn-pagar">Pagar <i class="fa-solid fa-bag-shopping"></i> </button>
            </div>
        </div>
   
</section>

    
    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>
</body>

</html>