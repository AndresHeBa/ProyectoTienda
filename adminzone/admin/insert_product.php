<?php
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $modelo = $_POST['modelo'];
    $numeroSerie = $_POST['numeroSerie'];
    $proveedor = $_POST['proveedor'];
    $categoria = $_POST['categoria'];
    $precioCompra = $_POST['precioCompra'];
    $precioVenta = $_POST['precioVenta'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO Producto (Nombre, Descripción, Modelo, NúmeroSerie, ProveedorID, CategoriaID, PrecioCompra, PrecioVenta, CantidadStock) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiiiii", $nombre, $descripcion, $modelo, $numeroSerie, $proveedor, $categoria, $precioCompra, $precioVenta, $stock);

    if ($stmt->execute()) {
        echo "Producto agregado con éxito.";
    } else {
        echo "Error al agregar el producto: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Acceso no autorizado.";
}

$conn->close();
?>

<p><a href="../adminzone.php">Regresar</a></p>