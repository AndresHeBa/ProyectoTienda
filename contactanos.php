<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contactanos</title>
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
    <link rel="stylesheet" href="css/contactanos_styles.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <!-- Header -->

    <header>
        <?php
        include 'header.php';
        ?>
    </header>

    <!-- Contactanos -->
    <div class="contact_form">
        <div class="formulario">
            <h1>Contactanos</h1>
            <h3>Envianos un mensaje, alguien de nuestro equipo se pondra en contacto con usted, para ello llene los campos siguientes:</h3>
            <form action="submeter-formulario.php" method="post">
                <p>
                    <label for="nombre" class="colocar_nombre">Nombre completo
                        <span class="obligatorio">*</span>
                    </label>
                    <input type="text" name="introducir_nombre" id="nombre" required="obligatorio" placeholder="Escribe tu nombre">
                </p>
                <p>
                    <label for="email" class="colocar_email">Correo Electronico
                        <span class="obligatorio">*</span>
                    </label>
                    <input type="email" name="introducir_email" id="email" required="obligatorio" placeholder="Escribe tu Email">
                </p>
                <p>
                    <label for="telefone" class="colocar_telefono">Teléfono
                    </label>
                    <input type="tel" name="introducir_telefono" id="telefono" placeholder="Escribe tu teléfono">
                </p>
                <p>
                    <label for="website" class="colocar_website">Sitio web
                    </label>
                    <input type="url" name="introducir_website" id="website" placeholder="Escribe la URL de tu web">
                </p>
                <p>
                    <label for="asunto" class="colocar_asunto">Asunto
                        <span class="obligatorio">*</span>
                    </label>
                    <input type="text" name="introducir_asunto" id="assunto" required="obligatorio" placeholder="Escribe un asunto">
                </p>
                <p>
                    <label for="mensaje" class="colocar_mensaje">Mensaje
                        <span class="obligatorio">*</span>
                    </label>
                    <textarea name="introducir_mensaje" class="texto_mensaje" id="mensaje" required="obligatorio" placeholder="Deja aquí tu comentario..."></textarea>
                </p>
                <button type="submit" name="enviar_formulario" id="enviar">
                    <p>Enviar</p>
                </button>
                <p class="aviso">
                    <span class="obligatorio"> * </span>Por favor llene los campos obliatorios
                </p>
            </form>
        </div>
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

    <!-- Footer -->
    <footer>
        <?php
        include 'footer.php';
        ?>
    </footer>

</body>

</html>