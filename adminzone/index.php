<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/transition-style">
    <title>Tecnogadget - Panel de Administración</title>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="container" transition-style="out:square:center">
    <h2>Bienvenido a Tecnogadget - Panel de Administración</h2>
    <ul>
        <li><a href="admin/users.php">Administración de Usuarios</a></li>
        <li><a href="admin/products.php">Administración de Productos</a></li>
        <li><a href="admin/providers.php">Administración de Proveedores</a></li>
    </ul>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>