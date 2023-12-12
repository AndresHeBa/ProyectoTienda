<?php
include_once '../includes/db.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener la cantidad vendida de cada producto
$sql = "SELECT p.Nombre, SUM(c.CantidadVendida) as CantidadVendida
FROM carrito c
JOIN producto p ON c.ProductoID = p.ProductoID
JOIN ventas v ON c.CarritoID = v.CarritoID
WHERE c.Estado = 'Pagado' AND v.PagosID IS NOT NULL
GROUP BY p.Nombre
ORDER BY CantidadVendida DESC
LIMIT 5";  // Limitar a los 5 productos más vendidos

$result = $conn->query($sql);

// Crear un array asociativo con los resultados
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Devolver los resultados como JSON
header('Content-Type: application/json');
echo json_encode($data);

// Cerrar la conexión
$conn->close();
