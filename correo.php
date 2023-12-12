<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include 'header.php';
    ?>

    <?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
      
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';


        

        $mail = new PHPMailer;
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
            $mail->Body  = 'Gracias por suscribirte a nuestra pagina, como agradecimiento aqui tienes un cupon para un descuento del 10% en cualquier compra <br> 
            Atentamente,<br>
            TecnoGadget';

            // Adjuntar cupon
            $mail->addAttachment('img/CuponCorreo.png', 'CuponCorreo.png');

            $mail->send();
        } catch (Exception $e) {
        }
    ?>
</body>
</html>