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
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $rutaImagenes = '../../img';

        $nombreArchivo = time() . '_' . $_FILES['imagen']['name'];

        $rutaCompleta = $rutaImagenes . $nombreArchivo;

        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaCompleta);
    } else {
        $rutaCompleta = '';
    }

    // Query de inserción
    $sql = "INSERT INTO Producto (Nombre, Descripción, Modelo, NúmeroSerie, ProveedorID, CategoriaID, PrecioCompra, PrecioVenta, CantidadStock, Imagen) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiiisss", $nombre, $descripcion, $modelo, $numeroSerie, $proveedor, $categoria, $precioCompra, $precioVenta, $stock, $rutaCompleta);

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