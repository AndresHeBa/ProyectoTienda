<?php

function generarTextoAleatorio($longitud)
{
    $caracteres = "0123456789abcdefghijkmnñlopqrstwxyz";
    $cadena = "";

    for ($i = 0; $i < $longitud; $i++) {
        $cadena .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $cadena;
}

// Define la longitud del texto (5 caracteres).
$captchaTexto = generarTextoAleatorio(5);

setcookie("captcha", $captchaTexto, time() + 300); // La cookie expirará en 5 minutos

// Crea una imagen nueva con fondo blanco.
$captcha = imagecreatetruecolor(120, 40);
$colorFondo = imagecolorallocate($captcha, 255, 255, 255);
imagefill($captcha, 0, 0, $colorFondo);

// Establece el color del texto.
$colorTexto = imagecolorallocate($captcha, 0, 0, 0);

// Agrega el texto a la imagen.
imagestring($captcha, 5, 16, 7, $captchaTexto, $colorTexto);

// Envía el encabezado de la imagen.
header("Content-type: image/png");

// Muestra la imagen PNG en lugar de GIF.
imagepng($captcha);

// Libera la memoria utilizada por la imagen.
imagedestroy($captcha);

// Puedes usar $captchaTexto en tu aplicación donde necesites verificar el captcha.
?>
