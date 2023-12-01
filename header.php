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
    <!-- <header>
        <div class="row menu z-3">
            <div class="col-4 head logo_head">
                <img id="logo" src="img/logo_transparent.png" alt="" height="60px">
            </div>
            <div class="col head">
                <ul id="enlaces">
                    <li><a href="principal.php">Inicio</a></li>
                    <li><a href="">Tienda</a></li>
                    <li><a href="">Sobre Nosotros</a></li>
                    <li><a href="">Contactanos</a></li>
                    <li><a href="">Ayuda</a></li>
                    <li><a href=""><i class="fa-solid fa-cart-shopping fa-2xl"></i></a></li>
                    <li><a href="">Iniciar Sesion</a></li>
                </ul>
            </div>
        </div>
    </header> -->
    <!-- <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img id="logo" src="img/logo_transparent.png" alt="" height="50px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Tienda</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Sobre Nosotros</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Contactanos</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Ayuda</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Iniciar Sesion</a>
                </li>
            </ul>
            <a href=""><i class="fa-solid fa-cart-shopping fa-2xl icono"></i></a>
            </div>
        </div>
    </nav> -->
    <!-- =================================
           HEADER MENU
        ================================== -->
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
                        <li><a href="http://">Productos</a></li>
                        <li><a href="http://">Campañas</a></li>
                        <li><a href="http://">Nosotros</a></li>
                        <li><a href="http://">Contacto</a></li>
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
            <li><a href="#">Productos</a></li>
            <li><a href="#">Campañas</a></li>
            <li><a href="#">Nosotros</a></li>
            <li><a href="#">Contacto</a></li>
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