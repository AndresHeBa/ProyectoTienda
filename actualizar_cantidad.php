<?php
include 'adminzone/includes/db.php';

if (isset($_POST['product_id']) && isset($_POST['cantidad'])) {
    $productId = $_POST['product_id'];
    $cantidad = $_POST['cantidad'];

    // Actualizar la cantidad en la base de datos
    $sqlUpdateCantidad = "UPDATE producto SET CantidadStock = $cantidad WHERE ProductoID = $productId";
    $resultadoUpdate = $conn->query($sqlUpdateCantidad);

    if ($resultadoUpdate) {
        echo json_encode(['success' => true, 'message' => 'Cantidad actualizada correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar la cantidad en la base de datos']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Parámetros no válidos']);
}
?>
