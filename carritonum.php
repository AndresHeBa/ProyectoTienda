<?php
include 'adminzone/includes/db.php';

$nameuser= $_SESSION["usuario"];
$sql = "SELECT * FROM usuarios WHERE Cuenta = '$nameuser'";
$result = $conn->query($sql);
$iduser = $result->fetch_assoc()['ClienteID'];

// Consulta para obtener el número de filas con el ClienteID y el estado específico
$sql = "SELECT COUNT(*) AS numFilas FROM carrito WHERE ClienteID = ? AND Estado = 'En carrito' AND Activo = 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $iduser);
$stmt->execute();
$stmt->bind_result($numFilas);

// Obtener el resultado
$stmt->fetch();

echo "<span class='num-cart'>$numFilas</span>";

// Cerrar sentencia
$stmt->close();

?>