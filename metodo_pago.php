<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

?>

<?php

include 'adminzone/includes/db.php';
$nameuser = $_SESSION["usuario"];
$sql = "SELECT * FROM usuarios WHERE Cuenta = '$nameuser'";
$result = $conn->query($sql);
$iduser = $result->fetch_assoc()['ClienteID'];

//sacar el total de la suma de los productos y si tiene descuento aplicarlo
$sql = "SELECT SUM((p.PrecioVenta - (p.PrecioVenta * (p.Descuento / 100))) * c.CantidadVendida) AS total FROM carrito c JOIN producto p ON c.ProductoID = p.ProductoID WHERE c.ClienteID =" . $iduser . " AND c.Estado = 'En carrito'";

$result = $conn->query($sql);
if ($result) {
    $total = $result->fetch_assoc()['total'];
}
$precioTotal = $total;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Método de Pago</title>

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
    <link rel="stylesheet" href="css/carrito.css">
    <link rel="stylesheet" href="css/pago.css">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>

</head>

<body onload='calcularCostoEnvio()'>

    <header>
        <?php
        include 'header.php';
        ?>
    </header>

    <div class="container mt-5">
        <div>
            <h1>Pago</h1>
            <p>Por favor, ingrese la información de su método de pago.</p>
            <!-- Formulario de Método de Pago -->
            <form action="procesar_pago.php" method="post">
                <div class="mb-3">
                    <label for="Tarjeta" class="form-label">Nombre en la Tarjeta</label>
                    <input type="text" class="form-control" id="Tarjeta" name="Tarjeta" required>
                </div>
                <div class="mb-3">
                    <label for="TipoTarjeta" class="form-label">Tipo de Tarjeta</label>
                    <select class="form-select" id="TipoTarjeta" name="TipoTarjeta" required>
                        <option value="default">-</option>
                        <option value="BBVA">BBVA</option>
                        <option value="Santander">Santander</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="NumTar" class="form-label">Número de la Tarjeta</label>
                    <input type="text" class="form-control" id="NumTar" name="NumTar" required>
                </div>
                <div class="mb-3">
                    <label for="Vencimiento" class="form-label">Fecha de Vencimiento</label>
                    <input type="text" class="form-control" id="Vencimiento" name="Vencimiento" placeholder="MM/AA" required>
                </div>
                <div class="mb-3">
                    <label for="CVV" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="CVV" name="CVV" required>
                </div>
                <div class="mb-3">
                    <label for="Region" class="form-label">Region</label>
                    <select class="form-select" id="Region" name="Region" required onchange="calcularImpuestos()">
                        <option value="default">-</option>
                        <option value="0.16">Mexico(16%)</option>
                        <option value="0.08">Estados Unidos(8%)</option>
                    </select>
                    <span class="mb-3">
                        Se hará un cargo de impuesto según tu región.
                    </span>
                </div>
                <input type="hidden" id="impuesto" name="impuesto" value="0">
                <div class="mb-3">
                    <label for="TipoEnvio" class="form-label">Tipo de Envío</label>
                    <select class="form-select" id="TipoEnvio" name="TipoEnvio" required onchange="calcularCostoEnvio()">
                        <option value="0">Local (Gratis)</option>
                        <option value="50">Nacional ($50)</option>
                        <option value="100">Global ($100)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Envio" class="form-label">Direccion de entrega</label>
                    <input type="text" class="form-control" id="Envio" name="Envio" required>
                    <label for="Descr" class="form-label">Se requiere una descripcion del lugar de entrega:</label>
                    <input type="text" class="form-control" id="Descr" name="Descr" required>
                </div>
                <div class="mb-3">
                    <label for="Cupon" class="form-label">Aplicar Cupon</label>
                    <input type="text" class="form-control" id="Cupon" name="Cupon" placeholder="Cupon">
                    <button type="button" class="btn btn-secondary" onclick="aplicarCupon()">Aplicar Cupón</button>
                    <input type="hidden" id="cuponAplicado" name="cuponAplicado" value="0">
                    <?php
                    echo '<input type="hidden" id="precioVenta" name="precioVenta" value="' . $total . '">';
                    echo '<div class="fila">';
                    echo '<strong>Tu Total</strong>';
                    echo '<span class="carrito-precio-total">$' . number_format($precioTotal, 2) . '</span>';
                    echo '</div>';
                    ?>
                </div>
                <button type="submit" class="btn btn-primary">Pagar</button>
            </form>
        </div>
        <div class="Resumen">
            <h1>Resumen de la Compra</h1>
            <?php
            $sql = "SELECT p.ProductoID,p.Imagen, p.Nombre, p.PrecioVenta, p.Descuento, c.CantidadVendida FROM carrito c JOIN producto p ON c.ProductoID = p.ProductoID WHERE c.ClienteID =" . $iduser . " AND c.Estado = 'En carrito'";
            $result = $conn->query($sql);
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="carrito-producto">';
                    echo '<img  src="' . $row['Imagen'] . '" alt="Producto">';
                    echo '<div class="carrito-producto-info">';
                    echo '<span class="carrito-producto-nombre">' . $row['Nombre'] . '</span>';
                    echo '<span class="carrito-producto-precio">$' . number_format($row['PrecioVenta'] - ($row['PrecioVenta'] * ($row['Descuento'] / 100)), 2) . '</span>';
                    echo '<span class="carrito-producto-cantidad">Cantidad: ' . $row['CantidadVendida'] . '</span>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
    </div>

    <!-- Footer -->
    <?php
    include "footer.php"
    ?>
    <script>
        function calcularImpuestos() {
            var regionSelect = document.getElementById("Region");
            var precioTotalInput = document.getElementById("precioVenta");
            var impuestoInput = document.getElementById("impuesto");
            var impuestoPorcentaje = 0;

            if (regionSelect.value === "Mex") {
                impuestoPorcentaje = 0.16;
            } else if (regionSelect.value === "EU") {
                impuestoPorcentaje = 0.08;
            } else {
                impuestoPorcentaje = 0;
            }

            var precioTotal = parseFloat(precioTotalInput.value);
            var impuesto = precioTotal * impuestoPorcentaje;
            var nuevoPrecioTotal = precioTotal + impuesto;

            impuestoInput.value = impuesto.toFixed(2);

            document.querySelector(".carrito-precio-total").innerText = "$" + nuevoPrecioTotal.toFixed(2);
        }

        function calcularCostoEnvio() {
            var tipoEnvioSelect = document.getElementById("TipoEnvio");
            var precioTotalInput = document.getElementById("precioVenta");
            var impuestoInput = document.getElementById("impuesto");
            var impuestoPorcentaje = 0;
            var precioTotal = parseFloat(precioTotalInput.value);
            var impuesto = precioTotal * impuestoPorcentaje;
            var costoEnvio = tipoEnvioSelect.value;

            var nuevoPrecioTotal = precioTotal + impuesto + costoEnvio;

            impuestoInput.value = impuesto.toFixed(2);

            document.querySelector(".carrito-precio-total").innerText = "$" + nuevoPrecioTotal.toFixed(2);
        }

        function aplicarCupon() {
            var cuponInput = document.getElementById("Cupon");
            var cuponAplicadoInput = document.getElementById("cuponAplicado");
            var precioTotalInput = document.getElementById("precioVenta");

            // Validar cupón
            if (cuponAplicadoInput.value === "0") {
                var precioTotal = parseFloat(precioTotalInput.value);
                var descuento = 0;
                if (cuponInput.value.trim() === "M45T3CN0") {
                    descuento = precioTotal * 0.15;
                    Swal.fire({
                        title: "Cupón de nuevo usuario aplicado",
                        icon: "success"
                    });
                } else if (cuponInput.value.trim() === "F4N4V1D4D") {
                    // Agregar el descuento del 50% en discos duros
                    descuento = precioTotal * 0.5;
                    Swal.fire({
                        title: "Cupón navideño aplicado(50% de descuento en discos duros)",
                        text: "¡Feliz Navidad!",
                        icon: "success"
                    });
                } else if (cuponInput.value.trim() === "PR0C354D0R") {
                    // Agregar el descuento del 10% den procesadores
                    descuento = precioTotal * 0.1;
                    Swal.fire({
                        title: "Cupón promocional aplicado(10% de descuento en procesadores)",
                        icon: "success"
                    });
                } else {
                    Swal.fire({
                        title: "Cupón no reconocido o no válido",
                        icon: "error"
                    });
                    return;
                }

                var nuevoPrecioTotal = precioTotal - descuento;
                precioTotalInput.value = nuevoPrecioTotal.toFixed(2);
                cuponAplicadoInput.value = "1";
                document.querySelector(".carrito-precio-total").innerText = "$" + nuevoPrecioTotal.toFixed(2);
            } else {
                Swal.fire({
                    title: "Solo se permite aplicar un cupón por compra.",
                    icon: "warning"
                });
            }
        }
    </script>

</body>

</html>