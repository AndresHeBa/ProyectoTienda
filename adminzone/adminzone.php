<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
$config['base_url'] = 'http://' . $_SERVER["SERVER_NAME"];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-colorschemes"></script>
    <link rel="stylesheet" href="https://unpkg.com/transition-style">
    <title>Tecnogadget - Panel de Administración</title>
</head>

<body>

    <header>
        <h1>Tecnogadget</h1>
        <nav>
            <a href="../index.php">Inicio</a>
        </nav>
    </header>

    <div class="container">
        <h2>Bienvenido a Tecnogadget - Panel de Administración</h2>
        <ul>
            <li><a href="admin/users.php">Administración de Usuarios</a></li>
            <li><a href="admin/products.php">Administración de Productos</a></li>
            <li><a href="admin/providers.php">Administración de Proveedores</a></li>
        </ul>
        <!-- Contenedor de las gráficas -->
        <div style="display: flex; justify-content: space-around;">

            <!-- Gráfica de Pastel -->
            <div>
                <h4>Gráfica de Categorías Más Vendidas</h4>
                <canvas id="myPieChart" width="300" height="200"></canvas>
            </div>

            <!-- Gráfica de Productos Más Vendidos -->
            <div>
                <h4>Gráfica de Productos Más Vendidos</h4>
                <canvas id="myBarChart" width="300" height="200"></canvas>
            </div>

        </div>

        <script>
            // Obtener datos desde el archivo PHP
            fetch('admin/Grafcat.php')
                .then(response => response.json())
                .then(data => {
                    // Procesar datos y crear la gráfica de pastel
                    var ctx = document.getElementById('myPieChart').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: data.map(item => item.DesCategoria),
                            datasets: [{
                                data: data.map(item => item.TotalVendido),
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(75, 192, 192, 0.7)',
                                    'rgba(153, 102, 255, 0.7)'
                                ]
                            }]
                        }
                    });
                });

            fetch('admin/Grafbar.php')
                .then(response => response.json())
                .then(data => {
                    var ctx = document.getElementById('myBarChart').getContext('2d');
                    var myBarChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.map(item => item.Nombre),
                            datasets: [{
                                label: 'Cantidad Vendida',
                                data: data.map(item => item.CantidadVendida),
                                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                                borderWidth: 1
                            }]
                        }
                    });
                });
        </script>
    </div>

    <?php include 'includes/footer.php'; ?>

</body>

</html>