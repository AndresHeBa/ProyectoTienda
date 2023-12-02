<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/style.css">
<div class="container">
    <h2>Administración de Productos</h2>
    <?php include '../includes/db.php';
    $sql = "SELECT * FROM Producto";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nombre</th>";
        echo "<th>Descripción</th>";
        echo "<th>Modelo</th>";
        echo "<th>Número de Serie</th>";
        echo "<th>Proveedor</th>";
        echo "<th>Precio de Compra</th>";
        echo "<th>Precio de Venta</th>";
        echo "<th>Stock</th>";
        echo "<th>Categoria</th>";
        echo "<th>Acciones</th>";
        echo "</tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$row["ProductoID"]."</td>";
            echo "<td>".$row["Nombre"]."</td>";
            echo "<td>".$row["Descripción"]."</td>";
            echo "<td>".$row["Modelo"]."</td>";
            echo "<td>".$row["NúmeroSerie"]."</td>";
            echo "<td>".$row["ProveedorID"]."</td>";
            echo "<td>".$row["PrecioCompra"]."</td>";
            echo "<td>".$row["PrecioVenta"]."</td>";
            echo "<td>".$row["CantidadStock"]."</td>";
            echo "<td>".$row["Categoria"]."</td>";
            echo "<td><a href='edit.php?id=".$row["ProductoID"]."'>Editar</a> | <a href='delete.php?id=".$row["ProductoID"]."'>Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</table>";

    }else{
        echo "0 results";
    }
    $conn->close();
    ?>
</div>

<?php include '../includes/footer.php'; ?>