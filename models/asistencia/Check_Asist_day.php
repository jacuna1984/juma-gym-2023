<?php
require_once "././config/conecction.php";
require_once "Model_Asistencia.php";

// $archivo = '././config/conecction.php';
// if (file_exists($archivo)) {
//     require_once $archivo;
//     echo "El archivo $archivo existe.";
// } else {
//     echo "El archivo $archivo no existe.";
// }

    class Check_Asist_day {

        protected $id;
        

        public static function compruebaAsistenciaCliente($id) {

            $conexion = new Conexion();

            $fila = [];
            $sql = "SELECT id FROM asistencias_clientes WHERE DATE(fecha_registro) = DATE(NOW()) AND cliente_id = ?";
            if ($consulta = $conexion->prepare($sql)) {
                $consulta->bindParam(1, $id_cliente, PDO::PARAM_INT);
                if ($consulta->execute()) {
                    $cliente = $consulta->fetch(PDO::FETCH_ASSOC);
                    var_dump($cliente);
                    return !empty($cliente);
                }
            }
            return false;
        }

        public static function compruebaAsistenciaPersonal($id_personal) {

            $conexion = new Conexion();

            $fila = [];
            $sql = "SELECT 
                    id 
                    FROM 
                    asistencias_personal 
                    WHERE DATE
                    (fecha_registro) = 
                    DATE(NOW()) 
                    AND 
                    personal_id = ?";
            if ($consulta = $conexion->prepare($sql)) {
                $consulta->bindParam(1, $id_personal, PDO::PARAM_INT);
                if ($consulta->execute()) {
                    $personal = $consulta->fetch(PDO::FETCH_ASSOC);
                    return !empty($personal);
                }
            }
            return false;
        }
    }

    // $conexion = new Conexion();

    // $modelAsistencia = new Check_Asist_day($conexion);

    // if ($modelAsistencia->compruebaAsistenciaCliente($id_cliente)) {
    //     echo "La asistencia para este cliente ya fue registrada hoy.";
    // } else {
    //     $newAsist = Asistencias::recordAsistClientes($id_cliente);
    // }

    // if ($modelAsistencia->compruebaAsistenciaPersonal($id_personal)) {
    //     echo "La asistencia para este personal ya fue registrada hoy.";
    // } else {
    //     $newAsist = Asistencias::recordAsistPersonal($id_personal);
    // }

    ?>