<?php
     
    $servidor='localhost';
    $cuenta='root';
    $password='';
    $bd='tecnobd';
   
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno){
         die('Error en la conexion');
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
            $resultado = $conexion -> query($sql); //aplicamos sentencia
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
    <section class="filters-container in-line"
        aria-labelledby="filters-title">            
            <aside class= "filters-aside">
                <button
                type="button"
                class="close-filters-btn is-hidden"
                aria-label="Cerrar filtros">
                <i class="fas fa-times" aria-hidden="true"></i>
                </button>

                <!--Encabezado del Filtro-->
                <div class="filters-heading-container in-line">

                    <div class="filters-title">
                        <h2 aria-label= "Agilice la búsqueda del producto utilizando:">
                            FILTROS</h2>
                    </div>
                    <div class="filters-clear-btn-container">
                        <button type="button" class="clear-btn in-line"
                                aria-label="¿Desea quitar los filtros seleccionados?">
                            <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            <h3 class="clear-title">
                                Limpiar
                            </h3>
                        </button>
                    </div>
                </div>

                <!-- Inicio de Busqueda -->
                <form>
                    <div class="filters-search-container">
                        <div>
                            <h3>BUSQUEDA</h3>
                        </div>
                        <label for="input-search" 
                            class="input-search-container in-line">
                            <input type="text"
                                id="input-search"
                                placeholder="¿Qué está buscando?"
                                aria-label="Escriba el nombre del producto que busca">
                            </input>
                            <i class="fas fa-search search-icon"
                            aria-hidden="true">
                            </i>
                        </label>
                    </div>
                    
                <!-- Inicio para filtrar por categoria -->
                    <fieldset class="filters-category-container ">
                        <legend>
                            <h3 aria-label="Filtre los productos 
                                por la categoria a la que pertenecen">
                                CATEGORIA
                            </h3>
                        </legend>
                        <div class="checkboxes-container input-category-container">
                            <label for= "consolas" class="input-category in-line">
                                <input type="checkbox"
                                    class=" filter filter-category"
                                    name="category"
                                    value="consolas"
                                    id= "consolas">
                                </input>
                                <h4>CONSOLAS</h4>
                            </label>

                            <label for= "notebooks" class="input-category in-line">
                                <input type="checkbox"
                                    class="filter filter-category"
                                    name="category" 
                                    value="notebooks"
                                    id= "notebooks">
                                </input>
                                <h4>NOTEBOOKS</h4>
                            </label>

                            <label for= "camaras" class="input-category in-line">
                                <input type="checkbox"
                                    class="filter filter-category"
                                    name="category"
                                    value="camaras"
                                    id= "camaras">
                                </input>
                                <h4>CÁMARAS</h4>
                            </label>

                            <label for ="celulares" class="input-category in-line">
                                <input type="checkbox"
                                    class="filter filter-category"
                                    name="category"
                                    value="celulares"
                                    id= "celulares">
                                </input>
                                <h4>CELULARES</h4>
                            </label>

                            <label for= "accesorios" class="input-category in-line">
                                <input type="checkbox"
                                    class="filter filter-category"
                                    name="category"
                                    value="accesorios"
                                    id= "accesorios">
                                </input>
                                <h4>ACCESORIOS</h4>
                            </label>                 
                        </fieldset>

                <!-- Inicio de filtro de puntuaciones -->
                    <fieldset class="filters-review-container">
                        <legend>
                            <h3 aria-label="Filtre los productos
                            por su cantidad de estrellas de una a cinco">
                            PUNTAJE
                            </h3>
                        <legend>
                        <div class="filters-review">
                            <label for="cinco" 
                                   class="input-review in-line">
                                <input type="checkbox"
                                    name="review"
                                    class="filter filter-review"
                                    value="5"
                                    id="cinco"
                                    aria-label="Cantidad de estrellas:">
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <h4>(5)</h4>
                                </input>
                            </label>
                            <label for="cuatro" 
                                   class="input-review in-line">
                                <input type="checkbox"
                                    name="review" 
                                    class="filter filter-review"
                                    value="4"
                                    id="cuatro"
                                    aria-label="Cantidad de estrellas:">
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="far fa-star"  aria-hidden="true"></i>
                                <h4>(4)</h4>
                                </input>
                            </label>
                            <label for= "tres"
                                   class="input-review in-line">
                                <input type="checkbox"
                                    name="review"
                                    class="filter filter-review"
                                    value="3"
                                    id="tres"
                                    aria-label="Cantidad de estrellas:">
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="far fa-star"  aria-hidden="true"></i>
                                <i class="far fa-star"  aria-hidden="true"></i>
                                <h4>(3)</h4>
                                </input>
                            </label>
                            <label for="dos"
                                   class="input-review in-line">
                                <input type="checkbox"
                                    name="review"
                                    class="filter filter-review"
                                    value="2"
                                    id="dos"
                                    aria-label="Cantidad de estrellas:">
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="far fa-star"  aria-hidden="true"></i>
                                <i class="far fa-star"  aria-hidden="true"></i>
                                <i class="far fa-star"  aria-hidden="true"></i>
                                <h4>(2)</h4>
                                </input>
                            </label>
                            <label for="uno" class="input-review in-line">
                                <input type="checkbox"
                                    name="review"
                                    class="filter filter-review" 
                                    value="1"
                                    id="uno"
                                    aria-label="Cantidad de estrellas:">
                                <i class="fas fa-star"  aria-hidden="true"></i>
                                <i class="far fa-star"  aria-hidden="true"></i>
                                <i class="far fa-star"  aria-hidden="true"></i>
                                <i class="far fa-star"  aria-hidden="true"></i>
                                <i class="far fa-star"  aria-hidden="true"></i>
                                <h4>(1)</h>
                                    </input>
                            </label>
                        </fieldset>
                    </div>
            </aside>
        </section>
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