<?php
     
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
    <section class="contenedor">
    <!-- Contenedor de elementos -->
    <div class="contenedor-items">
        <?php
            $sql = 'select * from producto';//hacemos cadena con la sentencia mysql que consulta todo el contenido de la tabla
            $resultado = $conn -> query($sql); //aplicamos sentencia
            if ($resultado -> num_rows){ //si la consulta genera registros
                    while( $fila = $resultado -> fetch_assoc()){ //recorremos los registros obtenidos de la tabla
                        echo '<div class="item">';
                            echo '<span class="titulo-item">'.$fila['Nombre'].'</span>';
                            echo '<img src="'.$fila['Imagen'].'" alt="'.$fila['Imagen'].'" class="img-item">';
                            echo '<span class="precio-item">'.$fila['PrecioVenta'].'</span>';
                            echo '<span class="texto-item">'.$fila['Descripción'].'</span>';
                            echo '<div class="selector-cantidad">
                                    <i class="fa-solid fa-minus restar-cantidad"></i>
                                    <input type="text" value="3" class="carrito-item-cantidad" disabled>
                                    <i class="fa-solid fa-plus sumar-cantidad"></i>
                                  </div>
                                  <button class="boton-item">Agregar al Carrito</button>';
                            echo '<span class="texto-item">Stock: '.$fila['CantidadStock'].'</span>';
                        echo '</div>';
                    }   
                    echo '</table">';
                echo '</div>';
            }
            else{
                echo "no hay datos";
            }
        ?>
            <!-- <div class="item">
                <span class="titulo-item">Procesador RYZEN 9 5900X</span>
                <img src="img/barracuda_1tb.webp" alt="" class="img-item">
                <span class="precio-item">$5,620</span>
                <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="3" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="titulo-item">Procesador RYZEN 9 5900X</span>
                <img src="img/amd9.jpg" alt="" class="img-item">
                <span class="precio-item">$5,620</span>
                <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="3" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="titulo-item">Procesador RYZEN 9 5900X</span>
                <img src="img/amd9.jpg" alt="" class="img-item">
                <span class="precio-item">$5,620</span>
                <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="3" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="titulo-item">Procesador RYZEN 9 5900X</span>
                <img src="img/amd9.jpg" alt="" class="img-item">
                <span class="precio-item">$5,620</span>
                <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="3" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="titulo-item">Procesador RYZEN 9 5900X</span>
                <img src="img/amd9.jpg" alt="" class="img-item">
                <span class="precio-item">$5,620</span>
                <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="3" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="titulo-item">Procesador RYZEN 9 5900X</span>
                <img src="img/amd9.jpg" alt="" class="img-item">
                <span class="precio-item">$5,620</span>
                <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="3" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="titulo-item">Procesador RYZEN 9 5900X</span>
                <img src="img/amd9.jpg" alt="" class="img-item">
                <span class="precio-item">$5,620</span>
                <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="3" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
            <div class="item">
                <span class="titulo-item">Procesador RYZEN 9 5900X</span>
                <img src="img/amd9.jpg" alt="" class="img-item">
                <span class="precio-item">$5,620</span>
                <div class="selector-cantidad">
                            <i class="fa-solid fa-minus restar-cantidad"></i>
                            <input type="text" value="3" class="carrito-item-cantidad" disabled>
                            <i class="fa-solid fa-plus sumar-cantidad"></i>
                        </div>
                <button class="boton-item">Agregar al Carrito</button>
            </div>
        </div> -->
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
    <!-- Footer -->
    <?php
    include 'footer.php';
    ?>
</body>

</html>