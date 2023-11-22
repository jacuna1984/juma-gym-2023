<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="../../public/css/bootstrap-5.2.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/estilo.css">
</head>
<body style="background-image: url(../../public/img/index/gyjm.jpg)">
    <nav class="navbar" style="background-color: none;">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="../../index.php">Home</a>
            </li>
        </ul>
    </nav>
    <div class="fondo-juma1">
        <img src="../../public/img/index/logoJUMApreview-2.png">
    </div>
    <div class="login-box">
        <img src="../../public/img/index/logoJUMApreview-2.png" class="avatar" alt="Avatar Image">
        <h1>Inicio de sesión</h1>
        <form method="post" action="../../controllers/cliente/login_Cliente.php">
            <!-- USERNAME INPUT -->
            <label for="username">DNI</label>
            <input type="text" name="dni" placeholder="Escriba su DNI">
            <!-- PASSWORD INPUT -->
            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Escriba su contraseña">
            <input type="submit" value="Ingresar">
            <a id=btn-contraseña href="../../index.php">Olvidó su contraseña?</a><br>
        </form>
    </div>
</body>
</html>