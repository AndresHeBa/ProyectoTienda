<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/style.css">

<div class="container">
    <h2>Administración de Usuarios</h2>
    <?php
    include '../includes/db.php';
    $sql = "SELECT * FROM Usuarios";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>IsAdmin</th>";
        echo "<th>Nombre</th>";
        echo "<th>Dirección</th>";
        echo "<th>Número de contacto</th>";
        echo "<th>Correo</th>";
        echo "<th>Contraseña</th>";
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
            echo "<td>" . $row["Contraseña"] . "</td>";
            echo "<td>" . $row["Cuenta"] . "</td>";
            echo "<td><a href='edit.php?id=" . $row["id_usuario"] . "'>Editar</a> | <a href='delete.php?id=" . $row["id_usuario"] . "'>Eliminar</a></td>";
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