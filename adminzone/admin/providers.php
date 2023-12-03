<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../css/style.css">
<div class="container">
    <h2>Administración de Proveedores</h2>
    <div class="prove_butt">
        <button class="btn btn-primary" onclick="window.location.href='../adminzone.php'">Regresar</button>
        <button class="btn btn-primary" onclick="window.location.href='add.php'">Agregar Proveedor</button>
        <!-- buscar a la derecha y js-->
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por nombre" title="Type in a name">

    </div>
    <?php
    include '../includes/db.php';
    $sql = "SELECT * FROM Proveedores";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table id='proveedoresTable'>";
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

<script>
    function search() {
        // Obtener el valor del input
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("proveedoresTable");
        tr = table.getElementsByTagName("tr");

        // Iterar sobre todas las filas y ocultar las que no coinciden con la búsqueda
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Columna del Nombre
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

<?php include '../includes/footer.php'; ?>