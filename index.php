<?php
define ('CARPETA_POR_DEFECTO', "controllers/");
define ('CONTROLADOR_POR_DEFECTO', "Asist");
define ('ACCION_POR_DEFECTO', "Asist_Controller::mostrar_Bienvenida");
define ('ZONA_HORARIA_DEFECTO', new DateTimeZone('America/Argentina/Buenos_Aires'));

$controller = CONTROLADOR_POR_DEFECTO;

if (!empty($_GET['controller'])){
    $controller = $_GET['controller'];
}

$action = ACCION_POR_DEFECTO;

if (!empty($_GET ['action'])){
    $action = $_GET['action'];
}

$controller = CARPETA_POR_DEFECTO.$controller.'_Controller.php';

try{
    if(is_file($controller)){
        require_once $controller;
    } else {
        throw new Exception('EL controlador no existe - 404 not found'); 
        }
    if(is_callable ($action)){ 
        $action();
    } else{
            throw new Exception('La action no existe - 404 not found'); 
        }
} catch (Exception $e){
        echo $e-> getMessage();
    }
?>