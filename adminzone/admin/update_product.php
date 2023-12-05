<?php
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productoID = $_POST['productoID'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $modelo = $_POST['modelo'];
    $numeroSerie = $_POST['numeroSerie'];
    $proveedor = $_POST['proveedor'];
    $categoria = $_POST['categoria'];
    $precioCompra = $_POST['precioCompra'];
    $precioVenta = $_POST['precioVenta'];
    $stock = $_POST['stock'];

    $sql = "UPDATE Producto 
            SET Nombre=?, Descripción=?, Modelo=?, NúmeroSerie=?, ProveedorID=?, CategoriaID=?, PrecioCompra=?, PrecioVenta=?, CantidadStock=?
            WHERE ProductoID=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiiiiii", $nombre, $descripcion, $modelo, $numeroSerie, $proveedor, $categoria, $precioCompra, $precioVenta, $stock, $productoID);

    if ($stmt->execute()) {
        echo "Producto actualizado con éxito.";
    } else {
        echo "Error al actualizar el producto: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Acceso no autorizado.";
}

$conn->close();
?>

<p><a href="../adminzone.php">Regresar</a></p>