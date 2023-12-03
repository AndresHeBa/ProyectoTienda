<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/style.css">
<div class="container">
    <h2>Administración de Productos</h2>
    <div class="prove_butt">
        <button class="btn btn-primary" onclick="window.location.href='../adminzone.php'">Regresar</button>
        <button class="btn btn-primary" onclick="window.location.href='add.php'">Agregar Usuario</button>
        <!-- buscar a la derecha y js-->
        <input type="text" id="myInput" onkeyup="searchWithFilter()" placeholder="Buscar" title="Type in a name">
        <!-- tipo de busqueda -->
        <select id="mySelect">
            <option value="1">ID</option>
            <option value="2">Nombre</option>
            <option value="3">Descripción</option>
            <option value="4">Modelo</option>
            <option value="5">Número de Serie</option>
            <option value="6">Proveedor</option>
            <option value="7">Precio de Compra</option>
            <option value="8">Precio de Venta</option>
            <option value="9">Stock</option>
            <option value="10">Categoria</option>
        </select>
    </div>
    <?php include '../includes/db.php';
    $sql = "SELECT p.ProductoID, p.Nombre AS NombreProducto, p.Descripción, p.Modelo, p.NúmeroSerie, pr.Nombre AS NombreProveedor, p.PrecioCompra, p.PrecioVenta, p.CantidadStock, p.Imagen, c.DesCategoria FROM Producto p INNER JOIN Categoria c ON p.CategoriaID = c.CategoriaID LEFT JOIN Proveedores pr ON p.ProveedorID = pr.ProveedorID;";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo "<table id='SQLTable'>";
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
            echo "<td>".$row["CategoriaID"]."</td>";
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
<script src="../js/sqltab.js"></script>

<?php include '../includes/footer.php'; ?>