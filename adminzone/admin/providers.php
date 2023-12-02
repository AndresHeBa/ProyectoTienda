<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/style.css">
<div class="container">
    <h2>Administración de Proveedores</h2>
    <?php
    include '../includes/db.php';
    $sql = "SELECT * FROM Proveedores";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>";
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

<?php include '../includes/footer.php'; ?>