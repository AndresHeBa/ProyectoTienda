<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && isset($_POST['iduser'])) {
    $productId = $_POST['product_id'];
    $iduser = $_POST['iduser'];

    include 'adminzone/includes/db.php';

    // Verificar si el producto está en el carrito del usuario
    $sql = "DELETE FROM carrito WHERE ClienteID = $iduser AND ProductoID = $productId AND Estado = 'En carrito'";
    $result = $conn->query($sql);

    if ($result) {
        // Si la eliminación fue exitosa, puedes enviar una respuesta JSON al cliente
        $response = ['success' => true, 'message' => 'Producto eliminado exitosamente'];
        echo json_encode($response);
    } else {
        // Si hay un error en la eliminación, también envía una respuesta JSON con un mensaje de error
        $response = ['success' => false, 'message' => 'Error al borrar el producto: ' . $conn->error];
        echo json_encode($response);
    }

    $conn->close();
} else {
    // Si la solicitud no es válida, también puedes enviar una respuesta JSON con un mensaje de error
    $response = ['success' => false, 'message' => 'Solicitud no válida'];
    echo json_encode($response);
}
?>
