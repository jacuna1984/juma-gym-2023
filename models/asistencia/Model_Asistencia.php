<?php

require_once "././models/cliente/Model_Cliente.php";
require_once "././models/personal/Model_personal.php";
require_once "././models/asistencia/Check_Asist_day.php";

    Class Asistencias{

        protected $id;
        protected $fecha_Asist;
        protected $turno;

        const TBL = "personas";
        const TBL_C = "clientes";
        const TBL_P = "personal";
        const TBL_NAME1 = "asistencias_clientes";
        const TBL_NAME2 = "asistencias_personal";

        public function __construct($id, $fecha_Asist, $turno) {
            $this->id = $id;
            $this->fecha_Asist = $fecha_Asist;
            $this->turno = $turno;
        }

        public function getId(){
            return $this->id;
        }

        public function getFecha_Asist(){
            return $this->fecha_Asist;
        }

        public function getTurno(){
            return $this->turno;
        }

        public function setId($id) {
            $this->id=$id;
        }

        public function setFecha_Asist($fecha_Asist) {
            $this->fecha_Asist=$fecha_Asist;
        }

        public function setTurno($turno) {
            $this->turno=$turno;
        }

    //Método para el registro de asistencias de los clientes

    public static function recordAsistClientes($id){
        try {
        $conexion = new Conexion();
        $cliente = Cliente::buscarPersonasPorID($id);

        if ($cliente) {
            $zonaHoraria = ZONA_HORARIA_DEFECTO;
            $fecha = new DateTime('now', $zonaHoraria);
            $fecha_formateada= $fecha->format('Y-m-d H:i:s');
            $sql = "INSERT INTO " . self::TBL_NAME1 . " (fecha_registro, cliente_id) VALUES (?, ?)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute([$fecha_formateada, $id]);
            } else {
                echo "El cliente no existe.";
            }
        } catch (PDOException $e) {
                echo "Error al registrar la fecha: " . $e->getMessage();
            }
    }

    //Método para el registro de asistencias de Personal

    public static function recordAsistPersonal(Personal $personal){
            $id = $personal->getId();
            $conexion = new Conexion();
            $zonaHoraria = ZONA_HORARIA_DEFECTO;
            $fecha = new DateTime('now', $zonaHoraria);
            $fecha_formateada= $fecha->format('Y-m-d H:i:s');
            $sql = "INSERT INTO " . self::TBL_NAME2 . " (fecha, personal_id) VALUES (?, ?)";
            $consulta = $conexion->prepare($sql);
            if (!$consulta->execute([$fecha_formateada, $id])){
                throw new Exception("Error al intentar registrar Asistencia del Personal", $id);
            }
            return true;
    }

    //Método para chequeo de asistencias dentro del plazo de 24hs

    public static function compruebaAsistenciaCliente($id) {
        try {
            $conexion = new Conexion();
                $fechaLimite = date('Y-m-d H:i:s', strtotime('-24 hours'));
                $sql = 'SELECT id FROM ' . self::TBL_NAME1 . ' WHERE cliente_id = ? AND fecha_registro >= ?';
                $consulta = $conexion->prepare($sql);
                $consulta->bindParam(1, $id, PDO::PARAM_INT);
                $consulta->bindParam(2, $fechaLimite, PDO::PARAM_STR);
                $consulta->execute();
                $asistenciaExistente = $consulta->fetch(PDO::FETCH_ASSOC);
                return !empty($asistenciaExistente);
            
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }

    public static function compruebaAsistenciaPersonal($id) {
        try {
                $conexion = new Conexion();
                $fechaLimite = date('Y-m-d H:i:s', strtotime('-24 hours'));
                $sql = 'SELECT id FROM ' . self::TBL_NAME2 . ' WHERE personal_id = ? AND fecha_registro >= ?';
                $consulta = $conexion->prepare($sql);
                $consulta->bindParam(1, $id, PDO::PARAM_INT);
                $consulta->bindParam(2, $fechaLimite, PDO::PARAM_STR);
                $consulta->execute();
                $asistenciaExistente = $consulta->fetch(PDO::FETCH_ASSOC);
                return !empty($asistenciaExistente);
            
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return false;
        }
    }
    
}

?>