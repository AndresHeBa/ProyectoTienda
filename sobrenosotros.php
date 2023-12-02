<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SobreNosotros</title>
    
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
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/sobrenos_styles.css">

    <!-- Animate -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
</head>
<body>
    <!-- Header -->

    <header>
        <?php
            include 'header.php';
        ?>
    </header>

    <!--  -->
    <div id="banner">
        <div class="header-title">
            <h1 data-aos="fade-up">Vision</h1>
            <p class="paragraph" data-aos="fade-up">
            "Ser la principal fuente de inspiración y soluciones tecnológicas para nuestros clientes, 
            ofreciendo una experiencia única que transforme sus vidas a través de la 
            innovación y la excelencia en TecnoGadget."
            </p>
        </div>
        <div class="separ animate__animated animate__fadeIn" data-aos="fade-up"></div>
        <div class="header-title">
            <h1 data-aos="fade-up">Mision</h1>
            <p class="paragraph" data-aos="fade-up">
            "En TecnoGadget, nos comprometemos a proporcionar productos y servicios tecnológicos de la más alta calidad, 
            siempre a la vanguardia de la innovación. Buscamos ser líderes en el mercado, brindando asesoramiento experto 
            y creando conexiones significativas entre las personas y la tecnología. Nuestra misión es simplificar la vida 
            digital de nuestros clientes, ofreciendo productos confiables y 
            soluciones personalizadas que impulsen su experiencia tecnológica."
            </p>
        </div>
        <div class="separ animate__animated animate__fadeIn" data-aos="fade-up"></div>
        <div class="header-title">
            <h1 data-aos="fade-up">Objetivo</h1>
            <p class="paragraph" data-aos="fade-up">
            "Nuestro principal objetivo en TecnoGadget es ser reconocidos como el destino preferido para los entusiastas de 
            la tecnología y aquellos que buscan soluciones inteligentes para sus necesidades digitales. Nos esforzamos por 
            construir relaciones a largo plazo con nuestros clientes, ofreciendo productos de calidad, servicio excepcional 
            y manteniéndonos a la vanguardia de las tendencias tecnológicas. Buscamos no solo satisfacer las expectativas, 
            sino superarlas, contribuyendo así al crecimiento y éxito continuo de TecnoGadget en el mercado de equipos de cómputo 
            y tecnología."
            </p>
        </div>
    </div>

    <!-- Footer -->
    <?php
        include 'footer.php';
    ?>
</body>
</html>