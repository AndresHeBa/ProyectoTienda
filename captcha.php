<?php

function generarTextoAleatorio($longitud)
{
    $caracteres = "abcdefghijkmnñlopqrstwxyz";
    $cadena = "";

    while (strlen($cadena) < $longitud) {
        $caracter = $caracteres[rand(0, strlen($caracteres) - 1)];

        // Verifica si el caracter ya está en la cadena
        if (strpos($cadena, $caracter) === false) {
            $cadena .= $caracter;
        }
    }

    return $cadena;
}
$image = imagecreatetruecolor(200, 50);
imageantialias($image, true);
$colors = [];
$red = rand(125, 175);
$green = rand(125, 175);
$blue = rand(125, 175);
for ($i = 0; $i < 5; $i++) {
    $colors[] = imagecolorallocate($image, $red - 20 * $i, $green - 20 * $i, $blue - 20 * $i);
}
imagefill($image, 0, 0, $colors[0]);
for ($i = 0; $i < 10; $i++) {
    imagesetthickness($image, rand(2, 10));
    $rect_color = $colors[rand(1, 4)];
    imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $rect_color);
}

$black = imagecolorallocate($image, 0, 0, 0);
$white = imagecolorallocate($image, 255, 255, 255);
$textcolors = [$black, $white];
$fonts = [dirname(__FILE__) . '/fonts/DeadStock-Demo.ttf', dirname(__FILE__) . '/fonts/bluefires_sample.ttf', dirname(__FILE__) . '/fonts/VampiroOne-Regular.ttf',dirname(__FILE__) . '/fonts/KaushanScript-Regular.ttf'];
// Define la longitud del texto (5 caracteres).
$captchaTexto = generarTextoAleatorio(5);

setcookie("captcha", $captchaTexto, time() + 300); // La cookie expirará en 5 minutos

for ($i = 0; $i < strlen($captchaTexto); $i++) {
    $letter_space = 170 / strlen($captchaTexto);
    $initial = 15;

    imagettftext($image, 20, rand(-15, 15), $initial + $i * $letter_space, rand(20, 40), $textcolors[rand(0, 1)], $fonts[array_rand($fonts)], $captchaTexto[$i]);
}
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);

?>