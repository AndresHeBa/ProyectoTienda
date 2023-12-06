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
    <h2>Administración de Usuarios</h2>
    <div class="prove_butt">
        <button class="btn btn-primary" onclick="window.location.href='../adminzone.php'">Regresar</button>
        <button class="btn btn-primary" onclick="window.location.href='add.php'">Agregar Usuario</button>
        <!-- buscar a la derecha y js-->
        <input type="text" id="myInput" onkeyup="searchWithFilter()" placeholder="Buscar" title="Type in a name">
        <!-- tipo de busqueda -->
        <select id="mySelect">
            <option value="1">ID</option>
            <option value="2">Nombre</option>
            <option value="3">Dirección</option>
            <option value="4">Número de contacto</option>
            <option value="5">Correo</option>
            <option value="6">Cuenta</option>
        </select>
    </div>
    <?php
    include '../includes/db.php';
    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='SQLTable'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>IsAdmin</th>";
        echo "<th>Nombre</th>";
        echo "<th>Dirección</th>";
        echo "<th>Número de contacto</th>";
        echo "<th>Correo</th>";
        echo "<th>Cuenta</th>";
        echo "<th>Acciones</th>";
        echo "</tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ClienteID"] . "</td>";
            echo "<td>" . $row["IsAdmin"] . "</td>";
            echo "<td>" . $row["Nombre"] . "</td>";
            echo "<td>" . $row["Dirección"] . "</td>";
            echo "<td>" . $row["NúmeroContacto"] . "</td>";
            echo "<td>" . $row["Correo"] . "</td>";
            echo "<td>" . $row["Cuenta"] . "</td>";
            echo "<td><a href='edit.php?id=" . $row["ClienteID"] . "'>Editar</a> | <a href='delete.php?id=" . $row["ClienteID"] . "'>Eliminar</a></td>";
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