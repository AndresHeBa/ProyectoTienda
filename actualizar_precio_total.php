<?php
// actualizar_precio_total.php

if (isset($_GET['iduser'])) {
    $iduser = $_GET['iduser'];

    include 'adminzone/includes/db.php';

    $sql = "SELECT SUM(p.PrecioVenta * c.CantidadVendida) AS total FROM carrito c JOIN producto p ON c.ProductoID = p.ProductoID WHERE c.ClienteID = " . $iduser . " AND c.Estado = 'En carrito'";

    $result = $conn->query($sql);

    if ($result) {
        $total = $result->fetch_assoc()['total'];
        echo '
                <strong>Total sin descuento</strong>
                <span class="carrito-precio-total">
                    $' . round($total, 2) . '
                </span>
            ';
    } else {
        echo "Carrito vacío o error en la consulta: " . $conn->error;
    }

    $conn->close();
} else {
    echo 'Parámetros no válidos';
}
