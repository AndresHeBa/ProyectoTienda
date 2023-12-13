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

    <!-- Contactanos -->
    <div class="contact_form">
        <div class="formulario">
            <h1>Contactanos</h1>
            <h3>Envianos un mensaje, alguien de nuestro equipo se pondra en contacto con usted, para ello llene los campos siguientes:</h3>
            <form action="contactanos.php" method="post">
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
                    <input type="email" name="email" id="email" required="obligatorio" placeholder="Escribe tu Email">
                </p>
                <p>
                    <label for="telefone" class="colocar_telefono">Teléfono
                    </label>
                    <input type="tel" name="introducir_telefono" id="telefono" placeholder="Escribe tu teléfono">
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
            <?php

                if (isset($_POST['email'])) {
                    $email = $_POST["email"];

                    try {
                        //Server settings
                        //Enable verbose debug output
                        $mail->SMTPDebug=0;
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'adrianalonso.a4@gmail.com';                     //SMTP username
                        $mail->Password   = 'wtld iaxc ojfx dnbe';                               //SMTP password
                        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('adrianalonso.a4@gmail.com', 'InnovaCodeTech');
                        $mail->addAddress($email);     //Add a recipient

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->addAttachment("img/logo-2.png", "logo-2.png");
                        $mail->Body = 'Embedded Image: <img alt="PHPMailer" src="cid:my-attach"> Here is an image!';
                        $mail->Subject = 'Gracias por contactarnos';
                        $mail->CharSet = 'UTF-8';
                        $mail->Body  = 'Gracias por ponerte en contacto con nosotros, su solicitud esta siendo procesada.<br> 
                        Un miembro de nuestro equipo se pondra en contacto con usted dentro de las proximas 48 horas, agradecemos su paciencia.
                        <br>Atentamente,<br>
                        TecnoGadget';


                        $mail->send();
                    } catch (Exception $e) {
                    }
                }
            ?>

            <?php
                if (isset($_POST['email'])) {
                    ?>
                    <script>
                        Swal.fire({
                            icon: "success",
                            title: "Su solicitud ha sido recibida",
                            text: "Le enviamos un correo electronico de confirmacion"
                        });
                    </script>
                    <?php
                }
            ?>
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