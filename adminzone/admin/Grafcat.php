<?php
include_once '../includes/db.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT c.DesCategoria, SUM(crt.CantidadVendida) as TotalVendido
        FROM carrito crt
        INNER JOIN producto p ON crt.ProductoID = p.ProductoID
        INNER JOIN categoria c ON p.CategoriaID = c.CategoriaID
        INNER JOIN ventas v ON crt.CarritoID = v.CarritoID
        GROUP BY c.CategoriaID
        ORDER BY TotalVendido DESC
        LIMIT 5";

$result = $conn->query($sql);

$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>
