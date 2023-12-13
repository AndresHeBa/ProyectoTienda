<link rel="stylesheet" href="css/footer_styles.css">

<footer>
    <?php
        if (isset($_POST['email'])){
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
                $mail->Subject = 'Gracias por contactarnos';
                $mail->CharSet = 'UTF-8';
                $mail->Body  = 'Gracias por suscribirte a nuestra pagina, como agradecimiento aqui tienes un cupon para un descuento del 10% en procesadores. <br> 
                Atentamente,<br>
                TecnoGadget';

                // Adjuntar cupon
                $mail->addAttachment('img/CuponCorreo.png', 'CuponCorreo.png');

                $mail->send();
            } catch (Exception $e) {
            }
        }

        
    ?>
    <div id="links">
        <div id="enlaces">
                
                    <div class="foo-col">
                        <h2 style="color: #E3E3E3;">Suscríbete <br> a la pagina</h2>
                        <form action="" method="POST">
                            <div class="f-input">
                                <input type="text" name="email" placeholder="Ingrese su correo">
                                <button type="submit" class="hm-btn-round btn-primary"><i class="far fa-paper-plane"></i></button>
                            </div>
                        </form>
                    </div>
                
        </div>
        <!--
        ICONOS PARA LA RED SOCIAL
        <div>
        <h2 style="color: #E3E3E3;">Siguenos <br> en nuestra redes</h2>
                        <div class="f-input">
                        <i class="fa-brands fa-facebook"></i>
                        <i class="fa-brands fa-discord" whidth="120"></i>
                            </div>
        -->
    </div>
        <div id="menulinks">
            <h3 class="titulofoot">Menú</h3>
            <ul class="listafoot">
                <li><a href="">Inicio</a></li>
                <li><a href="">Sobre Nosotros</a></li>
                <li><a href="">Contactanos</a></li>
                <li><a href="">Ayuda</a></li>
            </ul>
        </div>
    </div>
    <div id="nota">
        <p id="notafoot">
            Esta pagina es un proyecto academico sin fines comerciales
            <br>
            Copyright <i class="fa-regular fa-copyright fa-sm"></i> 2023 Equipo 4
            <br>
            <span class="letrita">
                Erik Omar Alba Davila
                <br>
                Adrian Alonso Arambula
                <br>
                Juan Rodolfo Aranda Cisneros
                <br>
                Hector Andres Gutierrez Esparza
                <br>
                Andres Heredia Ballin
                <br>
                Jose Luis Ornelas Valadez
            </span>
            <br>
        </p>
        <a id="btnfoot" href="#banner"><i class="fa-solid fa-arrow-up fa-lg"></i></a>
    </div>
</footer>
