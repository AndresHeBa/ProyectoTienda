<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
$config['base_url'] = 'http://' . $_SERVER["SERVER_NAME"];
?>
<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/style.css">
<div class="container">
    <h2>Administración de Proveedores</h2>
    <div class="prove_butt">
        <button class="btn btn-primary" onclick="window.location.href='../adminzone.php'">Regresar</button>
        <button class="btn btn-primary" onclick="window.location.href='add.php'">Agregar Proveedor</button>
        <!-- buscar a la derecha y js-->
        <input type="text" id="myInput" onkeyup="searchWithFilter()" placeholder="Buscar" title="Type in a name">
        <!-- tipo de busqueda -->
        <select id="mySelect">
            <option value="1">ID</option>
            <option value="2">Nombre</option>
            <option value="3">Dirección</option>
            <option value="4">Número de contacto</option>
        </select>
    </div>
    <?php
    include '../includes/db.php';
    $sql = "SELECT * FROM proveedores";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='SQLTable'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nombre</th>";
        echo "<th>Dirección</th>";
        echo "<th>Número de contacto</th>";
        echo "<th>Acciones</th>";
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ProveedorID"] . "</td>";
            echo "<td>" . $row["Nombre"] . "</td>";
            echo "<td>" . $row["Dirección"] . "</td>";
            echo "<td>" . $row["NúmeroContacto"] . "</td>";
            echo "<td><a href='edit.php?id=" . $row["ProveedorID"] . "'>Editar</a> | <a href='delete.php?id=" . $row["ProveedorID"] . "'>Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</div>

<script src="../js/sqltab.js"></script>

<?php include '../includes/footer.php'; ?>