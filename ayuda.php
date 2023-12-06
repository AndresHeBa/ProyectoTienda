<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
$config['base_url'] = 'http://' . $_SERVER["SERVER_NAME"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayuda</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.png">

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Iconos -->
    <script src="https://kit.fontawesome.com/bfdec4dace.js" crossorigin="anonymous"></script>

    <!-- Estilos -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/ayuda_styles.css">
</head>
<body>
    <!-- Header -->
    <header>
        <?php
            include 'header.php';
        ?>
    </header>
    
    <div id="banner">
        <div class="accordion preguntas" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    ¿Cuáles son las opciones de pago disponibles en TecnoGadget?
                </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    TecnoGadget acepta pagos mediante tarjetas de crédito (Visa, MasterCard, American Express) y otros métodos seguros como PayPal.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    ¿Cómo puedo realizar un seguimiento de mi pedido?
                </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Una vez que tu pedido sea enviado, recibirás un correo electrónico con un enlace de seguimiento. También puedes acceder a la sección "Seguimiento de Pedido" en nuestro sitio web e ingresar tu número de pedido para obtener actualizaciones en tiempo real.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                    ¿Cuál es la política de devolución de TecnoGadget?
                </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Nuestra política de devolución permite devoluciones dentro de los 30 días posteriores a la compra. Consulta nuestra página de "Devoluciones" para obtener detalles sobre cómo iniciar el proceso.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                    ¿Ofrecen garantía en sus productos?
                </button>
                </h2>
                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Sí, todos nuestros productos vienen con una garantía estándar. La duración específica de la garantía puede variar según el producto. Consulta la página de "Garantía" para obtener información detallada.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false" aria-controls="panelsStayOpen-collapseFive">
                    ¿Cuál es el tiempo estimado de entrega para los pedidos en línea?
                </button>
                </h2>
                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
                <div class="accordion-body">
                    El tiempo de entrega varía según la ubicación y el método de envío seleccionado. Por lo general, las entregas estándar toman entre 3 y 7 días hábiles. Puedes obtener detalles precisos durante el proceso de compra.               </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false" aria-controls="panelsStayOpen-collapseSix">
                    ¿TecnoGadget realiza envíos internacionales?
                </button>
                </h2>
                <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Sí, realizamos envíos internacionales. Durante el proceso de compra, podrás seleccionar tu país y conocer las opciones de envío disponibles.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false" aria-controls="panelsStayOpen-collapseSeven">
                    ¿Puedo cancelar o modificar mi pedido después de realizar la compra?
                </button>
                </h2>
                <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Lamentablemente, no podemos modificar pedidos después de ser confirmados. Por favor, revisa cuidadosamente tu pedido antes de completar la compra.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseEight" aria-expanded="false" aria-controls="panelsStayOpen-collapseEight">
                    ¿Cómo puedo contactar al servicio al cliente de TecnoGadget?
                </button>
                </h2>
                <div id="panelsStayOpen-collapseEight" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Puedes contactarnos a través de nuestro formulario en la página de "Contacto" o enviándonos un correo electrónico.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseNine" aria-expanded="false" aria-controls="panelsStayOpen-collapseNine">
                    ¿Ofrecen asesoramiento técnico para la instalación de productos?
                </button>
                </h2>
                <div id="panelsStayOpen-collapseNine" class="accordion-collapse collapse">
                <div class="accordion-body">
                Sí, nuestro equipo de soporte técnico está disponible para ayudarte con cualquier pregunta relacionada con la instalación. Ponte en contacto con nosotros a través de nuestro formulario de soporte.
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTen" aria-expanded="false" aria-controls="panelsStayOpen-collapseTen">
                    ¿TecnoGadget ofrece programas de lealtad, descuentos exclusivos o membresías especiales para clientes frecuentes?
                </button>
                </h2>
                <div id="panelsStayOpen-collapseTen" class="accordion-collapse collapse">
                <div class="accordion-body">
                Sí, ofrecemos un programa de lealtad donde los clientes frecuentes pueden disfrutar de descuentos exclusivos, ofertas especiales y beneficios adicionales. Visita nuestra página de "Programa de Lealtad" para obtener más detalles y unirte.
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
        include 'footer.php';
    ?>
</body>
</html>