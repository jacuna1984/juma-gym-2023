<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencias</title>
    <link rel="stylesheet" href="../../public/css/bootstrap-5.2.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="http://localhost/juma_gym_2023/public/js/Asist_controller.js"></script>
</head>
<body style="background-image: url(public/img/index/gyjm.jpg)">
    <nav class="navbar" style="background-color: none;">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="./personalLogin.php">Personal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="views/cliente/cliente_Login.php">Cliente</a>
            </li>
        </ul>
    </nav>
    <div class="fondo-juma">
        <img src="./public/img/index/logoJUMApreview-2.png">
    </div>
        <div class="asistencia-box">
            <h1>ASISTENCIAS</h1>
            <form method="post" action="index.php?controller=Asist&action=Asist_Controller::marcar_Asistencia">
                <label for="username">DNI</label>
                <input type="text" name="dni" placeholder="Escriba su DNI">                
                <input type="submit" name="submit" value="Aceptar" >
            </form>
        </div>
<?php
    require_once "Views/Template/footer.php";
?>  