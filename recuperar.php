<?php include 'header.php'; ?>
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

    <title>Recuperar Cuenta</title>
</head>
<body>
    <div class="recuperar-container">
        <h1>Recuperar Cuenta</h1>
        <form id="recuperarForm">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <select name="pregunta">
                <?php
                include 'adminzone/includes/db.php';
                $query = "SELECT * FROM Preguntas";
                $resultado = $conn->query($query);
                while ($row = $resultado->fetch_assoc()) {
                    echo "<option value='" . $row['PreguntaID'] . "'>" . $row['Pregunta'] . "</option>";
                }
                $conn->close();
                ?>
            </select>
            <input type="text" name="respuesta" placeholder="Respuesta" required>
            <input type="password" name="nueva_contrasena" id="nueva_contrasena" placeholder="Nueva Contraseña" required>
            <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" placeholder="Confirmar Contraseña" required>
            <span id="mensaje-contrasenas"></span>
            <button type="submit" onclick="recuperarCuenta()">Recuperar Cuenta</button>
        </form>
    </div>

    <script>
        function recuperarCuenta() {
            var form = document.getElementById('recuperarForm');
            var formData = new FormData(form);

            if (validarContrasenas()) {
                fetch('recuperar.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        actualizarContrasena();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }

        function validarContrasenas() {
            var nuevaContrasena = document.getElementById("nueva_contrasena").value;
            var confirmarContrasena = document.getElementById("confirmar_contrasena").value;
            var mensaje = document.getElementById("mensaje-contrasenas");

            if (nuevaContrasena !== confirmarContrasena) {
                mensaje.innerHTML = "Las contraseñas no coinciden.";
                mensaje.style.color = "red";
                return false;
            } else {
                mensaje.innerHTML = "";
                return true;
            }
        }

        function actualizarContrasena() {
            var form = document.getElementById('recuperarForm');
            var formData = new FormData(form);

            fetch('actualizar_contrasena.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert("Contraseña actualizada exitosamente. Puedes iniciar sesión con tu nueva contraseña.");
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
</body>
</html>

