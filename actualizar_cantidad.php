<?php
// actualizar_cantidad.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && isset($_POST['change'])) {
    $productId = $_POST['product_id'];
    $change = (int)$_POST['change'];
    $iduser = $_POST['iduser'];

    include 'adminzone/includes/db.php';

    $sql = "SELECT CantidadVendida FROM carrito WHERE ClienteID = $iduser AND ProductoID = $productId AND Estado = 'En carrito'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $currentQuantity = $result->fetch_assoc()['CantidadVendida'];
        $newQuantity = $currentQuantity + $change;

        // Verificar si la nueva cantidad está dentro del límite del stock
        $sql = "SELECT CantidadStock FROM producto WHERE ProductoID = $productId";
        $result = $conn->query($sql);
        $stockLimit = $result->fetch_assoc()['CantidadStock'];

        if ($newQuantity >= 1 && $newQuantity <= $stockLimit) {
            $sql = "UPDATE carrito SET CantidadVendida = $newQuantity WHERE ClienteID = $iduser AND ProductoID = $productId AND Estado = 'En carrito'";
            $result = $conn->query($sql);

            if ($result) {
                $response = array('success' => true, 'updatedQuantity' => $newQuantity);
                echo json_encode($response);
            } else {
                $message = 'Error al obtener la cantidad actualizada';
                $response = array('success' => false, 'message' => $message);
                echo json_encode($response);
            }
        } else {
            $mensaje = 'La cantidad no puede ser menor a 1 ni mayor al stock disponible';
            $response = array('success' => true, 'updatedQuantity' => $stockLimit, 'message' => $message);
            echo json_encode($response);
        }
    } else {
        $message = 'Parámetros no válidos';
        $response = array('success' => false, 'message' => $message);
        echo json_encode($response);
    }

    $conn->close();
} else {
    echo 'Parámetros no válidos';
}
?>
