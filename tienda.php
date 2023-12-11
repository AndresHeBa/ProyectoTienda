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
    </header>

<!-- productos -->
        <div class="header-title">
            <h1>Productos</h1>
        </div>


        <section class="filters-container in-line"
        aria-labelledby="filters-title">            
            <aside class= "filters-aside">

                <!--Encabezado del Filtro-->
                <div class="filters-heading-container in-line">

                    <div class="filters-title">
                        <h4 aria-label= "Agilice la búsqueda del producto utilizando:">
                            FILTROS</h4>
                    </div>
                </div>

                <!-- Inicio de Busqueda -->
                <form action="tienda.php" method="post">
                    

                <!-- Inicio para filtrar por categoria -->
                <fieldset class="filters-category-container ">
                    <div class="checkboxes-container input-category-container">

                        <label for= "discosduros" class="input-category in-line">
                            <input type="checkbox"
                                class=" filter filter-category"
                                name="category"
                                value="1"
                                id= "discosduros">
                            </input>
                            <h5>DISCOS DUROS</h5>
                        </label>
                        <label for= "procesadores" class="input-category in-line">
                            <input type="checkbox"
                                class="filter filter-category"
                                name="category" 
                                value="2"
                                id= "procesadores">
                            </input>
                            <h5>PROCESADORES</h5>
                        </label>
                        <button type="submit" class="btn btn-secondary">Filtrar</button>
                        
    
                </fieldset>

                </form>
                    
            </aside>
        </section>
    <section class="contenedor">
    <!-- Contenedor de elementos -->
    <div class="contenedor-items">
        <?php
            $sql = 'SELECT * FROM producto';//hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
            $resultado = $conn -> query($sql); //aplicamos sentencia
            if ($resultado->num_rows) {
                while ($fila = $resultado->fetch_assoc()) {
                    $precioFin = ($fila['PrecioVenta'] - ($fila['PrecioVenta'] * ($fila['PrecioCompra']) * (0.01)));

                    echo '<div class="item">';
                    echo '<a href="infoProduct.php?product_id=' . $fila['ProductoID'] . '" class="item-link">';
                    if ($fila['PrecioCompra'] > 0) {
                        echo '<span class="titulo-item" style="color: red;">¡Oferta!</span>';
                        echo '<span class="texto-item" style="color: red;">' . round($fila['PrecioCompra']) . '%</span>';
                    }
                    echo '<span class="titulo-item">' . $fila['Nombre'] . '</span>';
                    echo '<img src="' . $fila['Imagen'] . '" alt="' . $fila['Imagen'] . '" class="img-item">';
                    echo '<span class="precio-item">' . $precioFin . '</span>';
                    echo '<span class="texto-item">' . $fila['Descripción'] . '</span>';
                    echo '<div class="selector-cantidad" data-product-id="' . $fila['ProductoID'] . '" data-stock="' . $fila['CantidadStock'] . '">
                              <i class="fa-solid fa-minus restar-cantidad"></i>
                              <input type="text" value="1" class="carrito-item-cantidad" disabled>
                              <i class="fa-solid fa-plus sumar-cantidad"></i>
                          </div>
                          <form action="carrito.php" method="post">
                              <input type="hidden" name="product_id" value="' . $fila['ProductoID'] . '">
                              <button type="submit" class="boton-item" name="add_to_cart">Agregar al Carrito</button>
                          </form>';
                    echo '<span class="texto-item">Stock: ' . $fila['CantidadStock'] . '</span>';
                    echo '</a>';
                    
                    echo '</div>';
                }
            } else {
                echo "No hay datos";
            }
            ?>
</section>

    <!-- Animaciones : AOS-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <!-- Mi Script -->
    <script src="js/app.js"></script>
    <script>
    
        AOS.init({
            duration: 1200,
        })


    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cantidadSelectors = document.querySelectorAll('.selector-cantidad');

            cantidadSelectors.forEach(function (selector) {
                const productId = selector.getAttribute('data-product-id');
                const inputCantidad = selector.querySelector('.carrito-item-cantidad');
                const restarBtn = selector.querySelector('.restar-cantidad');
                const sumarBtn = selector.querySelector('.sumar-cantidad');

                restarBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    let cantidad = parseInt(inputCantidad.value);
                    if (cantidad > 1) {
                        cantidad--;
                        inputCantidad.value = cantidad;
                    }
                });

                sumarBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    let cantidad = parseInt(inputCantidad.value);
                    let stock = parseInt(selector.getAttribute('data-stock'));
                    if (cantidad < stock) {
                        cantidad++;
                        inputCantidad.value = cantidad;
                    }
                });
            });
        });
    </script>


    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>
</body>

</html>