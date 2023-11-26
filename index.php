<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cambio 1</h1>
    <h1>Cambio remoto</h1>
    <h1>Cambio local 2</h1>
    <h1>Camibio 2</h1>
    <h1>Cambio dev</h1>
</body>
</html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Calculadora de Números Complejos</title>
    <style>
        canvas {
            border: 1px solid #000;
        }
    </style>
</head>
<body>
    <!-- <h1>Calculadora de Números Complejos</h1> -->
    <br>
    <form method="post" action="">
            <div class="card formulario">
                <div class="card-header titu">
                    Primer Numero
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <label for="real1">Parte Real:</label><br>
                        <input type="text" name="real1" required>
                    </li>
                    <li class="list-group-item">
                        <label for="imag1">Parte Imaginaria:</label><br>
                        <input type="text" name="imag1" required>
                    </li>
                </ul>
            </div>
            

            <select class="oper" name="operacion" required>
                <option value="suma">+</option>
                <option value="resta">-</option>
                <option value="multiplicacion">*</option>
                <option value="division">/</option>
            </select>

            <div class="card formulario">
                <div class="card-header titu">
                    Segundo Numero
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <label for="real2">Parte Real:</label><br>
                        <input type="text" name="real2" required>
                    </li>
                    <li class="list-group-item">
                        <label for="imag2">Parte Imaginaria:</label><br>
                        <input type="text" name="imag2" required>
                    </li>
                </ul>
            </div>
        <div class="boton">
            <button class="btn btn-primary" type="submit">Calcular</button>
        </div>
        
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $real1 = floatval($_POST["real1"]);
        $imag1 = floatval($_POST["imag1"]);
        $real2 = floatval($_POST["real2"]);
        $imag2 = floatval($_POST["imag2"]);

        $operacion = $_POST["operacion"];

        switch ($operacion) {
            case 'suma':
                $resultado_real = $real1 + $real2;
                $resultado_imag = $imag1 + $imag2;
                break;

            case 'resta':
                $resultado_real = $real1 - $real2;
                $resultado_imag = $imag1 - $imag2;
                break;

            case 'multiplicacion':
                $resultado_real = $real1 * $real2 - $imag1 * $imag2;
                $resultado_imag = $real1 * $imag2 + $imag1 * $real2;
                break;

            case 'division':
                $denominador = $real2 * $real2 + $imag2 * $imag2;
                $resultado_real = ($real1 * $real2 + $imag1 * $imag2) / $denominador;
                $resultado_imag = ($imag1 * $real2 - $real1 * $imag2) / $denominador;
                break;

        }
        $magnitud = sqrt($resultado_real ** 2 + $resultado_imag ** 2);
        $angulo_rad = atan2($resultado_imag, $resultado_real);
        $angulo_deg = rad2deg($angulo_rad);
        echo "<script>
            var resultado_real = $resultado_real;
            var resultado_imag = $resultado_imag;
            var angulo_rad = $angulo_rad;
            </script>";
    }
    ?>

    
    <div class="resul">
        <div class="graf">
            
        </div>
        <div class="val formulario">
            <div class="card">
                <div class="card-header titu">
                    Resultados
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <?php
                            //Resultado
                            echo "<p>Resultado = $resultado_real + $resultado_imag i</p>";
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php
                            //Forma polar
                            echo "<p>Forma Polar = $magnitud (cos($angulo_deg) + i sin($angulo_deg))</p>";
                        ?>
                    </li>
                    <li class="list-group-item">
                        <?php
                            //Angulo
                            echo "<p>Angulo = $angulo_deg ° </p>";
                        ?>
                    </li>
                </ul>
            </div>
            <?php
                
            ?>
        </div>
    </div>

</body>