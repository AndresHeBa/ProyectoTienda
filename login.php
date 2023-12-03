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
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

    <title>Registro/Longin</title>
</head>
<body>
    <!-- registro dinamico -->
    <div class="regs">
        <div class="prove_butt">
            <button id="btn-registro" onclick="showFormreg()">Registro</button>
            <button id="btn-login" onclick="showFormlog()">Login</button>
        </div>
        <div class="regist" id="regist" style="display: block;" transition-style="in:wipe:down">
            <h1>Registro</h1>
            <form action="registro.php" method="POST">
                <input type="text" name="nombre" placeholder="Nombre">
                <input type="text" name="apellido" placeholder="Apellido">
                <input type="text" name="email" placeholder="Email">
                <input type="text" name="usuario" placeholder="Usuario">
                <input type="password" name="password" placeholder="Contraseña">
                <input type="submit" value="Registrar">
            </form>
        </div>
        <div class="login" id="login" style="display: none;" transition-style="in:wipe:up">
            <h1>Login</h1>
            <form action="login.php" method="POST">
                <input type="text" name="usuario" placeholder="Usuario">
                <input type="password" name="password" placeholder="Contraseña">
                <input type="submit" value="Ingresar">
            </form>
        </div>
    </div>
    <script>
        var btnRegistro = document.getElementById("btn-registro");
        var btnLogin = document.getElementById("btn-login");
        var registro = document.getElementById("regist");
        var login = document.getElementById("login");

        function showFormreg() {
            registro.style.display="block";
            login.style.display="none";
        }

        function showFormlog() {
            login.style.display="block";
            registro.style.display="none";
        }
    </script>

</body>
</html>