<?php
require_once "././models/personas/Model_Personas.php";


    class Personal extends Personas{
        protected $id;
        protected $personal_id;
        protected $tipoPersonal;
        
        const TBL = "personal";

        public function __construct($id,$personal_id, $tipoPersonal){
            $this->id = $id;
            $this->personal_id = $personal_id;
            $this->tipoPersonal = $tipoPersonal;
    }

    public function getId(){
        return $this->personal_id;
    }

    public function getTipoPersonal(){
        return $this->tipoPersonal;
    }

    public function setTipoPersonal($tipoPersonal) {
        $this->tipoPersonal = $tipoPersonal;
    }

    public function setPersona(Personas $persona){
        $this->persona = $persona;
    }

    public function getPersona(){
        return $this->persona;
    }

    public static function MostrarTodos(){
        try{                
            $conexion = new Conexion();
            $sql= 'SELECT * FROM '. self::TBL;
            $consulta= $conexion->prepare($sql);
            $consulta->execute();
            $record = $consulta->fetch();
            $conexion = NULL;
            return $record;
        }catch  (PDOException $e){
            echo "Error en la consulta". $e -> getMessage();
            return [];          
        }
    }

    public static function buscarPersonalPorPersonaID($id){
        try {
        $conexion = new Conexion();
        $sql = 'SELECT * FROM ' . self::TBL . ' WHERE persona_id = :id';
        $consulta = $conexion->prepare($sql);
        $consulta->bindValue(':id', $id);
        $consulta->execute();
        $record = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($record) {
                return new Personal(
                                $record["id"],
                                $record["persona_id"],
                                $record["tipo_personal_id"],

                );
            } else {
                throw new Exception("No se encontro Personal para el ID: $id");
            }
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        } finally {
            $conexion = null;
        }
    }

    public static function getxDni($dni){
        $persona = parent::getByDni($dni);
        if ($persona instanceof Personas){
            $personal = self::buscarPersonalPorPersonaID($persona->getId());
            $personal->setPersona($persona);
            return $personal;
        }
        return null;
    }
}
?>