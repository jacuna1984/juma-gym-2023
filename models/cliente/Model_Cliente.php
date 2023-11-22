<?php
require_once "././models/personas/Model_Personas.php";


    class Cliente extends Personas{
        protected $id;
        protected $persona_id;
        protected $persona;

        const TBL = "clientes";

        public function __construct($id, $persona_id){
            $this->id = $id;
            $this->persona_id = $persona_id;
        }

        public function getId(){
            return $this->id;
        } 
    
        public function getPersonaId(){
            return $this->persona_id;
        }

        public function setId($id) {
            $this->id=$id;
        }

        public function setPersonaId($persona_id) {
            $this->persona_id=$persona_id;
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

        public static function buscarClientesPorPersonaID($id){
            try {
            $conexion = new Conexion();
            $sql = 'SELECT * FROM ' . self::TBL . ' WHERE persona_id = :id';
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':id', $id);
            $consulta->execute();
            $record = $consulta->fetch(PDO::FETCH_ASSOC);
    
                if ($record) {
                    return new Cliente(
                                    $record["id"],
                                    $record["persona_id"],
                    );
                } else {
                    return null;
                }
            } catch (Exception $e) {
                throw new Exception("Error en la consulta: " . $e->getMessage());
            } finally {
                $conexion = null;
            }
        }
        

        public static function getxDni($dni){
            $personaid = parent::getByDni($dni);
            if ($personaid instanceof Personas){
                $cliente = self::buscarClientesPorPersonaID($personaid->getId());
                if ($cliente == null) {
                    return null;
                }
                $cliente->setPersona($personaid);
                return $cliente;
            }
            return null;
        }
    }
?>