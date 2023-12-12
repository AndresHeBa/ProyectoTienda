<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET'&& isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM producto WHERE ProductoID = $id";
    $result = $conn->query($sql);

    if ($conn->affected_rows > 0) {
        $response = array('status' => 'success', 'message' => 'Producto eliminado correctamente.');
    } else {
        $response = array('status' => 'error', 'message' => 'Hubo un problema al eliminar el producto.');
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}
   
$conn->close();
?>
