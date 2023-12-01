<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="css/header_style.css">
    <!-- FUENTE GOOGLE FONTS : Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- ICONS: Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <!-- ICONS: Line Awesome -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Animaciones AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css">

</head>

<body>
    <!-- =================================
           HEADER MENU
        ================================== -->
    <div class="hm-header">

        <div class="container">
            <div class="header-menu">

                <div class="hm-logo">
                    <a href="#">
                        <img class="img-logo" src="img/logo_transparent-2.png" alt="">
                    </a>
                </div>

                <nav class="hm-menu">
                    <ul>
                    <li><a href="index.php">Inicio</a></li>
            <li><a href="#">Tienda</a></li>
            <li><a href="sobrenosotros.php">Nosotros</a></li>
            <li><a href="contactanos.php">Contactanos</a></li>
            <li><a href="#">Ayuda</a></li>
                    </ul>


                    <div class="hm-icon-cart">
                        <a href="#">
                            <i class="las la-shopping-cart"></i>
                            <span>0</span>
                        </a>
                    </div>

                    <div class="icon-menu">
                        <button type="button"><i class="fas fa-bars"></i></button>
                    </div>

                </nav>

            </div>
        </div>

    </div>

    <!-- =================================
           HEADER MENU Movil
        ================================== -->
    <div class="header-menu-movil">
        <button class="cerrar-menu"><i class="fas fa-times"></i></button>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="#">Tienda</a></li>
            <li><a href="sobrenosotros.php">Nosotros</a></li>
            <li><a href="contactanos.php">Contactanos</a></li>
            <li><a href="#">Ayuda</a></li>
        </ul>
    </div>

    <!-- Animaciones : AOS-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <!-- Mi Script -->
    <script src="js/app.js"></script>

    <script>
        AOS.init({
            duration: 1200,
        })
    </script>
</body>

</html>