<?php
require_once "././models/asistencia/Model_Asistencia.php";
require_once "././models/cliente/Model_Cliente.php";



Class Asist_Controller{

    public static function mostrar_Bienvenida(){
        require_once "./views/asistencia/view_Asistencia.php";
    }

    public static function marcar_Asistencia(){
        try {
            $dni = $_POST['dni'];
            $usuario = Cliente::getxDni($dni) ?? Personal::getxDni($dni);

            if(!isset($usuario)){
                throw new Exception("Usuario no encontrado1.");
            }

            $message = "";
            if ($usuario instanceof Cliente ) {
                if (!Asistencias::compruebaAsistenciaCliente($usuario->getId())) {
                    Asistencias::recordAsistClientes($usuario->getId());
                    $nombre = $usuario->getPersona()->getNombreCompleto();
                    $message = "Asistencia Guardada: $nombre.";
                } else {
                    $message = "Ya se registró asistencia para hoy.";
                }
            }

            if($usuario instanceof Personal) {
                if($usuario->getTipoPersonal() !== 2){
                    throw new Exception("Usuario no es profesor, no se registra asistencia.");
                }

                if(Asistencias::compruebaAsistenciaPersonal($usuario->getId())){
                    throw new Exception("Ya se registró asistencia para hoy.");
                }

                Asistencias::recordAsistPersonal($usuario);
                    $fullname = $usuario->getPersona()->getNombreCompleto();
                    $message = "Asistencia Guardada: $fullname.";
        

                header("Location: index.php?type=success&message={$message}");
                exit;
            }

        } catch(Exception $e){
            header("Location: index.php?type=error&message={$e->getMessage()}");
            exit;
        }
    }

}


?>