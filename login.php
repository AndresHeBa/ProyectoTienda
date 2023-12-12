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

    <title>Registro/Longin</title>
</head>

<body>

    <!-- siempre al iniciar marcar login -->
    <script>
        window.onload = function() {
            showFormlog();
        }
    </script>
    <!-- Header -->
    <header>
        <?php
        include "header.php";
        ?>
    </header>

    <!-- registro dinamico -->
    <div class="regs">
        <div class="prove_butt">
            <button id="btn-registro" onclick="showFormreg()">Registro</button>
            <button id="btn-login" onclick="showFormlog()">Login</button>
        </div>

        <div class="login" id="login" style="display: block;" transition-style="in:wipe:up">
            <h1>Login</h1>
            <form action="loginu.php" method="POST" id="loginFrom">
                <input type="text" name="usuario" placeholder="Usuario" value="<?php if (isset($_COOKIE["username"])) {
                                                                                    echo $_COOKIE["username"];
                                                                                } ?>" required>
                <input type="password" name="passwordl" placeholder="Contraseña" value="<?php if (isset($_COOKIE["password"])) {
                                                                                            echo $_COOKIE["password"];
                                                                                        } ?>" required>
                <a href="recuperar.php">¿Olvidaste tu contraseña?</a>
                <br>
                <img id="captcha" class="captcha-image" src="captcha.php" alt="Captcha Image"/><i class="fa-solid fa-arrows-rotate refresh-captcha"></i>
                <input type="text" name="captcha_code" placeholder="Captcha" required>
                <input type="checkbox" name="remember" id="remember" value="1" <?php if (isset($_COOKIE["remember"])) { echo 'checked'; } ?>>Recuérdame

                <input type="hidden" name="loginop" id="loginop" value="0">
                <input type="submit" value="Ingresar" onclick="loginUser(event)">
            </form>
        </div>

        <div class="regist" id="regist" style="display: none;" transition-style="in:wipe:down">
            <!-- onsubmit="return validarFormulario()" -->
            <h1>Registro</h1>
            <form action="registro.php" method="POST" id="registrationForm">
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="direccion" placeholder="Dirección" required>
                <input type="tel" name="telefono" placeholder="Teléfono" pattern="\(\d{3}\) \d{3}[-\s]\d{4}" title="Un número de teléfono válido consta de un código de 3 cifras entre paréntesis, un espacio, las tres primeras cifras del número, un espacio o guión (-) y cuatro cifras más" required>
                <input type="text" name="email" placeholder="Email" required>
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="password" id="password" placeholder="Contraseña" oninput="validatecorrectPassword()" required>
                <p id="mensaje2"></p>
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirmar Contraseña" oninput="validatePassword()" required>
                <p id="mensaje"></p>
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
                <input type="text" name="respuesta" placeholder="Respuesta" required>
                <input type="submit" value="Registrar" onclick="registerUser(event)">
            </form>
        </div>

        <!--bloqueado  -->
        <div class="bloqueado" id="bloqueado" style="display: none;" transition-style="in:wipe:down">
            <h1>Usuario bloqueado</h1>
            <p>Ha excedido el número de intentos permitidos. Por favor, reactive su cuenta</p>
            <button onclick="redirectToInicioPage()">Inicio</button>
            <button onclick="redirectToRecuperarPage()">Recuperar contraseña</button>
        </div>

    </div>
    <!-- Footer -->
    <?php
    include "footer.php"
    ?>
    <script src="js/validarpassword.js"></script>
    <script>
        var btnRegistro = document.getElementById("btn-registro");
        var btnLogin = document.getElementById("btn-login");
        var registro = document.getElementById("regist");
        var login = document.getElementById("login");
        var loginAttempts = 1;
        document.getElementById("loginop").value = loginAttempts;

        var refreshButton = document.querySelector(".refresh-captcha");
        refreshButton.onclick = function() {
            document.querySelector(".captcha-image").src = 'captcha.php?' + Date.now();
        }

        function showFormreg() {
            registro.style.display = "block";
            login.style.display = "none";
        }

        function showFormlog() {
            login.style.display = "block";
            registro.style.display = "none";
        }

        function registerUser(event) {
            event.preventDefault(); // Prevent the default form submission

            var form = document.getElementById('registrationForm');
            var formData = new FormData(form);

            fetch('registro.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text()) // Parse as text
                .then(data => {
                    // Handle the response data, e.g., show a success message
                    console.log(data);
                    alert("Usuario registrado exitosamente");
                })
                .catch(error => {
                    // Handle errors, e.g., show an error message
                    console.error('Error:', error);
                });
        }

        function loginUser(event) {
            event.preventDefault(); // Prevent the default form submission

            var form = document.getElementById('loginFrom');
            var formData = new FormData(form);
            fetch('loginu.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        alert("Usuario loggeado exitosamente");
                        window.location.href = "index.php";
                        loginAttempts = 0; // Restablecer intentos después de un inicio de sesión exitoso
                    } else if (data.status === "error") {
                        alert("Usuario o contraseña incorrectos\n Intentos restantes: " + (3 - loginAttempts));
                        loginAttempts++;
                        document.getElementById("loginop").value = loginAttempts;
                        if (loginAttempts > 3) {
                            showBlockedButtons();
                        }
                        // Manejar cuenta bloqueada
                    } else if (data.status === "bc") {
                        showBlockedButtons();
                    } else if (data.status === "error-captcha") {
                        alert("Captcha incorrecto");
                    } else {
                        alert("Error desconocido");
                    }

                })
                .catch(error => {
                    console.error('Error:', error);
                });

        }

        function showBlockedButtons() {
            document.getElementById("login").style.display = "none";
            document.getElementById("bloqueado").style.display = "block";
            //esconder botones
            btnRegistro.style.display = "none";
            btnLogin.style.display = "none";

        }

        function redirectToRecuperarPage() {
            window.location.href = "recuperar.php";
        }

        function redirectToInicioPage() {
            window.location.href = "index.php";
        }
    </script>

</body>

</html>