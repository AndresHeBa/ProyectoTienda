<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES["imagenNew"]) && !(empty($_FILES["imagenNew"]["tmp_name"]))) {
    $targetDir = "../../img/";  // Directorio donde se guardarán las imágenes
    $targetFile = $targetDir . basename($_FILES["imagenNew"]["name"]);

    // Verificar si el archivo es una imagen real
    $check = getimagesize($_FILES["imagenNew"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["imagenNew"]["tmp_name"], $targetFile)) {
            $id = $_POST['id'];
            $nombre = $_POST['nombreE'];
            $descripcion = $_POST['descripcionE'];
            $modelo = $_POST['modeloE'];
            $numeroSerie = $_POST['numeroSerieE'];
            $proveedor = $_POST['proveedorE'];
            $categoria = $_POST['categoriaE'];
            $descuento = $_POST['descuentoE'];
            $precioVenta = $_POST['precioVentaE'];
            $stock = $_POST['stockE'];
            $imagenbor = $_POST['imgenE'];
            unlink("../../" . $imagenbor);
            $imgen = "img/" . basename($_FILES["imagenNew"]["name"]);
            $query = "UPDATE producto SET Nombre=?, Descripción=?, Modelo=?, NúmeroSerie=?, ProveedorID=?, CategoriaID=?, Descuento=?, PrecioVenta=?, CantidadStock=?, Imagen=? WHERE ProductoID=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssssiiisssi', $nombre, $descripcion, $modelo, $numeroSerie, $proveedor, $categoria, $descuento, $precioVenta, $stock, $imgen, $id);
            $stmt->execute();

            //verificar cuantas filas se vieron afectadas
            if ($stmt->affected_rows > 0) {
                $response = array('status' => 'success', 'message' => 'Producto actualizado correctamente.');
            } else {
                $response = array('status' => 'error', 'message' => 'Hubo un problema al actualizar el producto.');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Hubo un problema al subir el archivo.');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Invalid image');
    }
    // si no se envio una nueva imagen, se deja la que ya estaba
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['imagenNew'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombreE'];
    $descripcion = $_POST['descripcionE'];
    $modelo = $_POST['modeloE'];
    $numeroSerie = $_POST['numeroSerieE'];
    $proveedor = $_POST['proveedorE'];
    $categoria = $_POST['categoriaE'];
    $descuento = $_POST['descuentoE'];
    $precioVenta = $_POST['precioVentaE'];
    $stock = $_POST['stockE'];
    $query = "UPDATE producto SET Nombre=?, Descripción=?, Modelo=?, NúmeroSerie=?, ProveedorID=?, CategoriaID=?, descuento=?, PrecioVenta=?, CantidadStock=? WHERE ProductoID=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssiiisss', $nombre, $descripcion, $modelo, $numeroSerie, $proveedor, $categoria, $descuento, $precioVenta, $stock, $id);
    $stmt->execute();

    // verificar cuántas filas se vieron afectadas
    if ($stmt->affected_rows > 0) {
        $response = array('status' => 'success', 'message' => 'Producto actualizado correctamente.');
    } else {
        $response = array('status' => 'error', 'message' => 'Hubo un problema al actualizar el producto.');
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}

header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>