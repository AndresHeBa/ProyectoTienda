<?php
// actualizar_descuento.php

if (isset($_GET['iduser'])) {
    $iduser = $_GET['iduser'];

    // Realiza la consulta para obtener el descuento del usuario
    include 'adminzone/includes/db.php'; // Asegúrate de incluir tu archivo de conexión a la base de datos

    //sacar el total de la suma de los productos y si tiene descuento aplicarlo
    $sql = "SELECT SUM((p.PrecioVenta - (p.PrecioVenta * (p.Descuento / 100))) * c.CantidadVendida) AS total FROM carrito c JOIN producto p ON c.ProductoID = p.ProductoID WHERE c.ClienteID =" . $iduser . " AND c.Estado = 'En carrito'";

    $result = $conn->query($sql);

    if ($result) {
        $total = $result->fetch_assoc()['total'];
        echo '
                <strong>Total</strong>
                <span class="carrito-precio-total">
                    $' . round($total, 2) . '
                </span>
            ';
    } else {
        echo "Carrito vacío o error en la consulta: " . $conn->error;
    }

    $conn->close();
} else {
    // Maneja el caso en el que no se proporciona el ID de usuario
    echo 'ID de usuario no proporcionado';
}
?>
