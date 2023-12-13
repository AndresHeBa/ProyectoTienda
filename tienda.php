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

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    
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


        <section class="filters-container"
        aria-labelledby="filters-title">            
            

                <!--Encabezado del Filtro-->
                <div class="filters-heading-container">

                    <div class="filters-title">
                            <h4>FILTROS</h4>
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
                            <h6>Discos Duros</h6>
                        </label>
                        <label for= "procesadores" class="input-category in-line">
                            <input type="checkbox"
                                class="filter filter-category"
                                name="category" 
                                value="2"
                                id= "procesadores">
                            </input>
                            <h6>Procesadores</h6>
                        </label>
                        <br><br>
                        <input class="form-control" type="text" name="min" placeholder="Precio Minimo">
                        <br>
                        <input class="form-control" type="text" name="max" placeholder="Precio Maximo">
                        <br>
                        <button type="submit" class="btn btn-secondary btn-filtros">Filtrar</button>
                        
    
                </fieldset>

                </form>
                    
        </section>
    <section class="contenedor">
    <!-- Contenedor de elementos -->
    <div class="contenedor-items">
        <?php
            $sql = 'SELECT * FROM producto';//hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
            $resultado = $conn -> query($sql); //aplicamos sentencia
            if ($resultado->num_rows) {
                if (isset($_POST['min']) && $_POST['min'] >= 0 && isset($_POST['max']) ) {
                    $min = $_POST['min'];
                    $max = $_POST['max'];
                }else{
                    $min = 1;
                    $max = 99999;
                }
                if (isset($_POST['category'])) {
                    while ($fila = $resultado->fetch_assoc()) {
                        if ($_POST['category'] === $fila['CategoriaID']) {
                            $precioFin = round($fila['PrecioVenta'] - ($fila['PrecioVenta'] * ($fila['Descuento']) * (0.01)),2);
    
                            if ($precioFin >= $min && $precioFin <= $max) {
                                echo '<div class="item">';
                                echo '<div class="item-link">';
                                if ($fila['Descuento'] > 0) {
                                    echo '<span class="titulo-item" style="color: red;">¡Oferta!</span>';
                                    echo '<span class="texto-item" style="color: red;">' . round($fila['Descuento']) . '%</span>';
                                }
                                echo '<span class="titulo-item">' . $fila['Nombre'] . '</span>';
                                echo '<img src="' . $fila['Imagen'] . '" alt="' . $fila['Imagen'] . '" class="img-item">';
                                if ($fila['Descuento'] > 0) {
                                    echo '<span class="precio-orig">$' . round($fila['PrecioVenta'],2) . '</span>';
                                }
                                echo '<span class="precio-item">$' . round($precioFin,2) . '</span>';
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
                                echo '</div>';
                                
                                echo '</div>';
                            }
                        }
                    }
                }else{
                    while ($fila = $resultado->fetch_assoc()) {
                        $precioFin = round($fila['PrecioVenta'] - ($fila['PrecioVenta'] * ($fila['Descuento']) * (0.01)),2);
                        
                        if ($precioFin >= $min && $precioFin <= $max) {
                                echo '<div class="item">';
                                echo '<div class="item-link">';
                                if ($fila['Descuento'] > 0) {
                                    echo '<span class="titulo-item" style="color: red;">¡Oferta!</span>';
                                    echo '<span class="texto-item" style="color: red;">' . round($fila['Descuento']) . '%</span>';
                                }
                                echo '<span class="titulo-item">' . $fila['Nombre'] . '</span>';
                                echo '<img src="' . $fila['Imagen'] . '" alt="' . $fila['Imagen'] . '" class="img-item">';
                                if ($fila['Descuento'] > 0) {
                                    echo '<span class="precio-orig">$'. round($fila['PrecioVenta'],2) . '</span>';
                                }
                                echo '<span class="precio-item">$' . round($precioFin,2) . '</span>';
                                echo '<span class="texto-item">' . $fila['Descripción'] . '</span>';
                                echo '<div class="selector-cantidad" data-product-id="' . $fila['ProductoID'] . '" data-stock="' . $fila['CantidadStock'] . '">
                                        <i class="fa-solid fa-minus restar-cantidad"></i>
                                        <input type="text" value="1" class="carrito-item-cantidad" disabled>
                                        <i class="fa-solid fa-plus sumar-cantidad"></i>
                                    </div>
                                    <form action="carrito.php" method="post">
                                        <input type="hidden" name="product_id" value="' . $fila['ProductoID'] . '">
                                        <input type="hidden" name="product_' . $fila['ProductoID'] . '_quantity" value="1" class="hidden-quantity-input">

                                        <button type="submit" class="boton-item" name="add_to_cart">Agregar al Carrito</button>
                                    </form>';
                                echo '<span class="texto-item">Stock: ' . $fila['CantidadStock'] . '</span>';
                                echo '</div>';
                                
                                echo '</div>';
                            }
                    }
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
                const stock = parseInt(selector.getAttribute('data-stock'));

                restarBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    let cantidad = parseInt(inputCantidad.value);
                    if (cantidad > 1) {
                        cantidad--;
                        inputCantidad.value = cantidad;
                        updateHiddenQuantityInput(productId, cantidad);
                    }
                });

                sumarBtn.addEventListener('click', function (event) {
                    event.preventDefault();
                    let cantidad = parseInt(inputCantidad.value);

                    if (cantidad < stock) {
                        cantidad++;
                        inputCantidad.value = cantidad;
                        updateHiddenQuantityInput(productId, cantidad);
                    } else {
                        Swal.fire({
                            title: "¡Lamentablemente, la cantidad de productos disponibles es insuficiente!",
                            icon: "warning"
                        });
                    }
                });
            });
        });

        function updateHiddenQuantityInput(productId, quantity) {
        const hiddenInput = document.querySelector('input[name="product_' + productId + '_quantity"]');
        if (hiddenInput) {
            hiddenInput.value = quantity;
        }
    }
    </script>


    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>
</body>

</html>