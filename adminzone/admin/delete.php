<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $productoID = $_GET['id'];

    $sql = "DELETE FROM Producto WHERE ProductoID = $productoID";
    $result = $conn->query($sql);

    if ($result) {
        echo "Producto eliminado con éxito.";
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
} else {
    echo "ID de producto no proporcionado.";
}

$conn->close();
?>
