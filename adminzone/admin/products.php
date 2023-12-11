<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
$config['base_url'] = 'http://' . $_SERVER["SERVER_NAME"];
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<?php include '../includes/header.php'; ?>
<div class="container">
    <h2>Administración de Productos</h2>
    <div class="prove_butt">
        <button class="btn btn-primary" onclick="window.location.href='../adminzone.php'">Regresar</button>
        <button class="btn btn-primary" id="addButton" onclick="showAddForm()">Agregar Producto</button>
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
    $sql = "SELECT\n"

        . "    p.ProductoID,\n"

        . "    p.Nombre AS NombreProducto,\n"

        . "    p.Descripción,\n"

        . "    p.Modelo,\n"

        . "    p.NúmeroSerie,\n"

        . "    pr.Nombre AS NombreProveedor,\n"

        . "    p.Descuento,\n"

        . "    p.PrecioVenta,\n"

        . "    p.CantidadStock,\n"

        . "    p.Imagen,\n"

        . "    c.DesCategoria\n"

        . "FROM\n"

        . "    producto p\n"

        . "INNER JOIN categoria c ON\n"

        . "    p.CategoriaID = c.CategoriaID\n"

        . "LEFT JOIN proveedores pr ON\n"

        . "    p.ProveedorID = pr.ProveedorID;";
    $result = $conn->query($sql);
    echo "<table id='SQLTable'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nombre</th>";
    echo "<th>Descripción</th>";
    echo "<th>Modelo</th>";
    echo "<th>Número de Serie</th>";
    echo "<th>Proveedor</th>";
    echo "<th>Descuento</th>";
    echo "<th>Precio de Venta</th>";
    echo "<th>Stock</th>";
    echo "<th>Categoria</th>";
    echo "<th>Imagen</th>";
    echo "<th>Acciones</th>";
    echo "</tr>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ProductoID"] . "</td>";
            echo "<td>" . (isset($row["NombreProducto"]) ? $row["NombreProducto"] : "") . "</td>";
            echo "<td>" . (isset($row["Descripción"]) ? $row["Descripción"] : "") . "</td>";
            echo "<td>" . (isset($row["Modelo"]) ? $row["Modelo"] : "") . "</td>";
            echo "<td>" . (isset($row["NúmeroSerie"]) ? $row["NúmeroSerie"] : "") . "</td>";
            echo "<td>" . (isset($row["NombreProveedor"]) ? $row["NombreProveedor"] : "") . "</td>";
            echo "<td>" . (isset($row["Descuento"]) ? $row["Descuento"] : "0") . "%</td>";
            echo "<td>" . (isset($row["PrecioVenta"]) ? $row["PrecioVenta"] : "") . "</td>";
            echo "<td>" . (isset($row["CantidadStock"]) ? $row["CantidadStock"] : "") . "</td>";
            echo "<td>" . (isset($row["DesCategoria"]) ? $row["DesCategoria"] : "") . "</td>";
            echo "<td><img src='../../{$row["Imagen"]}' alt='Imagen del Producto' style='width: 50px; height: 50px;'></td>";
            echo "<td><a onclick='editactive(" . $row["ProductoID"] . ")' href='#'>Editar</a> | <a onclick='deleteProduct(" . $row["ProductoID"] . ")' href='#'>Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<tr>";
        echo "<td colspan='11'>No hay datos</td>";
        echo "</tr>";
        echo "</table>";
    }
    $conn->close();
    ?>

    <div class="add" id="add" style="display: none;">
        <h3>Agregar Nuevo Producto</h3>
        <form action="insert_product.php" method="POST" id="addproduct" enctype="multipart/form-data">
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
                $query = "SELECT * FROM proveedores";
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
                $query = "SELECT * FROM categoria";
                $resultado = $conn->query($query);
                while ($row = $resultado->fetch_assoc()) {
                    echo "<option value='" . $row['CategoriaID'] . "'>" . $row['DesCategoria'] . "</option>";
                }
                $conn->close();
                ?>
            </select>

            <label for="descuento">Descuento:</label>
            <input type="number" id="descuento" name="descuento" required>

            <label for="precioVenta">Precio de Venta:</label>
            <input type="number" step="0.01"  id="precioVenta" name="precioVenta" required>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required>

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" class="form-control-file" required>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Agregar Producto" onclick="insertproduct(event)">
        </form>
    </div>

    <div class="edit" id="edit" style="display: none;">
        <h3>Editar Producto</h3>
        <form method="POST" id="editproducto" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id">

            <label for="nombreE">Nombre:</label>
            <input type="text" id="nombreE" name="nombreE" required>

            <label for="descripcionE">Descripción:</label>
            <textarea id="descripcionE" name="descripcionE" required></textarea>

            <label for="modeloE">Modelo:</label>
            <input type="text" id="modeloE" name="modeloE" required>

            <label for="numeroSerieE">Número de Serie:</label>
            <input type="text" id="numeroSerieE" name="numeroSerieE" required>

            <label for="proveedorE">Proveedor:</label>
            <select id="proveedorE" name="proveedorE" required>
                <?php

                include '../includes/db.php';
                $query = "SELECT * FROM proveedores";
                $resultado = $conn->query($query);
                while ($row = $resultado->fetch_assoc()) {
                    echo "<option value='" . $row['ProveedorID'] . "'>" . $row['Nombre'] . "</option>";
                }
                $conn->close();
                ?>
            </select>

            <label for="categoriaE">Categoría:</label>
            <select id="categoriaE" name="categoriaE" required>
                <?php

                include '../includes/db.php';
                $query = "SELECT * FROM categoria";
                $resultado = $conn->query($query);
                while ($row = $resultado->fetch_assoc()) {
                    echo "<option value='" . $row['CategoriaID'] . "'>" . $row['DesCategoria'] . "</option>";
                }
                $conn->close();
                ?>
            </select>

            <label for="descuentoE">Descuento:</label>
            <input type="number" id="descuentoE" name="descuentoE" required>

            <label for="precioVentaE">Precio de Venta:</label>
            <input type="number" step="0.01" id="precioVentaE" name="precioVentaE" required>

            <label for="stockE">Stock:</label>
            <input type="number" id="stockE" name="stockE" required>

            <!-- imagen actual -->
            <label for="imgact">Imagen Actual:</label>
            <img src="" alt="Imagen del Producto" id="imgact" style="width: 50px; height: 50px;">
            <input type="hidden" id="imgenE" name="imgenE">

            <label for="imagenNew">Imagen:</label>
            <input type="file" id="imagenNew" name="imagenNew" class="form-control-file" required>
            <br>
            <br>
            <input type="submit" class="btn btn-success" value="Editar Producto" onclick="editproduct(event)">
        </form>
    </div>
</div>

<br>

<script>
    function showAddForm() {
        var addForm = document.getElementById("add");
        addForm.style.display = (addForm.style.display === "none") ? "block" : "none";
        //desactivar tabla
        var table = document.getElementById("SQLTable");
        table.style.display = (table.style.display === "none") ? "block" : "none";

        var editForm = document.getElementById("edit");
        editForm.style.display = "none";
        //cambiar contenido del boton
        var button = document.getElementById("addButton");
        button.innerHTML = (button.innerHTML === "Agregar Producto") ? "Tabla" : "Agregar Producto";

        if (addForm.style.display === "block") {
            //vacia los campos
            document.getElementById("nombre").value = "";
            document.getElementById("descripcion").value = "";
            document.getElementById("modelo").value = "";
            document.getElementById("numeroSerie").value = "";
            document.getElementById("proveedor").value = "";
            document.getElementById("categoria").value = "";
            document.getElementById("descuento").value = "";
            document.getElementById("precioVenta").value = "";
            document.getElementById("stock").value = "";
            //quitar si se subio una imagen pero se dejo de editar
            document.getElementById("imagen").value = "";
        }
    }

    function insertproduct(event) {
        event.preventDefault(); // Prevent the default form submission

        var form = document.getElementById('addproduct');
        var formData = new FormData(form);

        fetch('insert_product.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === "success") {
                    alert(data.message);
                    window.location.href = "products.php";
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function deleteProduct(productID) {
        fetch('delete.php?id=' + productID, {
                method: 'GET', // especificar explícitamente el método GET
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === "success") {
                    alert(data.message);
                    window.location.href = "products.php";
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function editactive(productID) {
        var editForm = document.getElementById("edit");
        editForm.style.display = (editForm.style.display === "none") ? "block" : "none";

        if (editForm.style.display === "block") {
            objedit(productID);
        }else if(editForm.style.display === "none"){
            //vacia los campos
            document.getElementById("id").value = "";
            document.getElementById("nombreE").value = "";
            document.getElementById("descripcionE").value = "";
            document.getElementById("modeloE").value = "";
            document.getElementById("numeroSerieE").value = "";
            document.getElementById("proveedorE").value = "";
            document.getElementById("categoriaE").value = "";
            document.getElementById("descuentoE").value = "";
            document.getElementById("precioVentaE").value = "";
            document.getElementById("stockE").value = "";
            document.getElementById("imgact").src = "";
            //quitar si se subio una imagen pero se dejo de editar
            document.getElementById("imagenNew").value = "";
        }
        //desactivar tabla
        var table = document.getElementById("SQLTable");
        table.style.display = (table.style.display === "none") ? "block" : "none";

        var addForm = document.getElementById("add");
        addForm.style.display = "none";

        //cambiar contenido del boton
        var button = document.getElementById("addButton");
        button.innerHTML = (button.innerHTML === "Agregar Producto") ? "Tabla" : "Agregar Producto";
        button.onclick = (button.innerHTML === "Tabla") ? function(){editactive(productID)}: function(){showAddForm()} ;
    }

    function objedit(productID){
        fetch('get_product.php?id=' + productID, {
                method: 'GET', // especificar explícitamente el método GET
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === "success") {
                    document.getElementById("id").value = data.product.ProductoID;
                    document.getElementById("nombreE").value = data.product.Nombre;
                    document.getElementById("descripcionE").value = data.product.Descripción;
                    document.getElementById("modeloE").value = data.product.Modelo;
                    document.getElementById("numeroSerieE").value = data.product.NúmeroSerie;
                    document.getElementById("proveedorE").value = data.product.ProveedorID;
                    document.getElementById("categoriaE").value = data.product.CategoriaID;
                    document.getElementById("descuentoE").value = data.product.PrecioCompra;
                    document.getElementById("precioVentaE").value = data.product.PrecioVenta;
                    document.getElementById("stockE").value = data.product.CantidadStock;
                    document.getElementById("imgact").src = "../../" + data.product.Imagen;
                    document.getElementById("imgenE").value = data.product.Imagen;
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function editproduct(event) {
        event.preventDefault(); // Prevent the default form submission

        var form = document.getElementById('editproducto');
        var formData = new FormData(form);

        fetch('edit.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status === "success") {
                    alert(data.message);
                    window.location.href = "products.php";
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }    
</script>
<script src="../js/sqltab.js"></script>

<?php include '../includes/footer.php'; ?>