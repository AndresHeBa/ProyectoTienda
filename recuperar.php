<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Iconos -->
    <script src="https://kit.fontawesome.com/bfdec4dace.js" crossorigin="anonymous"></script>

    <!-- Estilos -->
    <!-- <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/sobrenos_styles.css"> -->
    <link rel="stylesheet" href="css/logi.css">

    <!-- transiciones -->
    <link rel="stylesheet" href="https://unpkg.com/transition-style">

    <!-- Animate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <title>Recuperar Contraseña</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <form action="actualizar_contrasena.php" id="regs" class="regs" method="POST">
        <h1>Recuperar Contraseña</h1>
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required>
        <label for="pregunta">Pregunta de Seguridad:</label>
        <select name="pregunta">
            <?php
            include 'adminzone/includes/db.php';
            $query = "SELECT * FROM preguntas";
            $resultado = $conn->query($query);
            while ($row = $resultado->fetch_assoc()) {
                echo "<option value='" . $row['PreguntaID'] . "'>" . $row['Pregunta'] . "</option>";
            }
            $conn->close();
            ?>
        </select>
        <label for="respuesta">Respuesta:</label>
        <input type="text" name="respuesta" required>

        <label for="password">Nueva Contraseña:</label>
        <input type="password" name="password" id="password" oninput="validatecorrectPassword()" required>
        <p id="mensaje2"></p>

        <label for="confirmPassword">Repetir Contraseña:</label>
        <!-- cuando este escribiendo la nueva contraseña -->
        <input type="password" name="confirmPassword" id="confirmPassword" oninput="validatePassword()" required>
        <!-- mensaje de validacion -->
        <br>
        <p id="mensaje"></p>

        <input type="submit" value="Recuperar Cuenta" onclick="passwordact(event)">
    </form>

    <script src="js/validarpassword.js"></script>
    <script>

        function passwordact(event) {
        event.preventDefault(); // Prevent the default form submission

        var form = document.getElementById('regs');
        var formData = new FormData(form);

        fetch('actualizar_contrasena.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert(data.message);
                    window.location.href = "login.php";
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    </script>

    <?php include 'footer.php'; ?>

</body>

</html>