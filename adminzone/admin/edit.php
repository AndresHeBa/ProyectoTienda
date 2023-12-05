<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $productoID = $_GET['id'];

    $sql = "SELECT * FROM Producto WHERE ProductoID = $productoID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <h3>Editar Producto</h3>
        <form action="update_product.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" required>

            <label for="numeroSerie">Número de Serie:</label>
            <input type="text" id="numeroSerie" name="numeroSerie" required>

            <label for="proveedor">Proveedor:</label>
            <select id="proveedor" name="proveedor" required>
                <?php

                include '../includes/db.php';
                $query = "SELECT * FROM Proveedores";
                $resultado = $conn->query($query);
                while ($row = $resultado->fetch_assoc()) {
                    echo "<option value='" . $row['ProveedorID'] . "'>" . $row['Nombre'] . "</option>";
                }
                $conn->close();
                ?>
            </select>

            <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria" required>
                <?php

                include '../includes/db.php';
                $query = "SELECT * FROM Categoria";
                $resultado = $conn->query($query);
                while ($row = $resultado->fetch_assoc()) {
                    echo "<option value='" . $row['CategoriaID'] . "'>" . $row['DesCategoria'] . "</option>";
                }
                $conn->close();
                ?>
            </select>

            <label for="precioCompra">Precio de Compra:</label>
            <input type="number" id="precioCompra" name="precioCompra" required>

            <label for="precioVenta">Precio de Venta:</label>
            <input type="number" id="precioVenta" name="precioVenta" required>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required>

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" required>
            <br>
            <br>
            <button type="submit" class="btn btn-success">Agregar Producto</button>
        </form>
<?php
    } else {
        echo "Producto no encontrado.";
    }
} else {
    echo "ID de producto no proporcionado.";
}

//$conn->close();
?>
<p><a href="../adminzone.php">Regresar</a></p>