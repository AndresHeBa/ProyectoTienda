<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES["imagen"]) && !(empty($_FILES["imagen"]["tmp_name"]))) {
    $targetDir = "../../img/";  // Directorio donde se guardarán las imágenes
    $targetFile = $targetDir . basename($_FILES["imagen"]["name"]);

    // Verificar si el archivo es una imagen real
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $modelo = $_POST['modelo'];
            $numeroSerie = $_POST['numeroSerie'];
            $proveedor = $_POST['proveedor'];
            $categoria = $_POST['categoria'];
            $descuento = $_POST['descuento'];
            $precioVenta = $_POST['precioVenta'];
            $stock = $_POST['stock'];
            $query = "INSERT INTO producto (Nombre, Descripción, Modelo, NúmeroSerie, ProveedorID, CategoriaID, Descuento, PrecioVenta, CantidadStock, Imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $imagen = "img/" . basename($_FILES["imagen"]["name"]); // "img/imagen.jpg
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssssiiisss', $nombre, $descripcion, $modelo, $numeroSerie, $proveedor, $categoria, $descuento, $precioVenta, $stock, $imagen);
            $stmt->execute();

            // Verificar cuántas filas se vieron afectadas
            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Producto agregado correctamente.');
            } else {
                $response = array('status' => 'error', 'message' => 'Hubo un problema al agregar el producto.');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Hubo un problema al subir el archivo.');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Invalid image');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
