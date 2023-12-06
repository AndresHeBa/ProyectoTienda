<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // Fetch product details from the database based on the ID
    $query = "SELECT * FROM producto WHERE ProductoID = $productID";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $productData = $result->fetch_assoc();
        $response = array('status' => 'success','message'=> 'Objeto encontrado', 'product' => $productData);
    } else {
        // Handle the case where the product ID is not valid or not found
        $response = array('status' => 'error', 'message' => 'Product not found');
    }
} else {
    // Handle the case where the product ID is not provided
    $response = array('status' => 'error', 'message' => 'Product ID not provided');
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
