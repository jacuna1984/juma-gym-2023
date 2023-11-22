<?php
require "././config/conecction.php";

class Personas {
    protected $id;
    protected $dni;
    protected $nombre;
    protected $apellido;
    protected $email;
    protected $fecha_nac;
    protected $telefono;
    protected $persona;

    const TBL = "personas";

    public function __construct($id, $dni, $nombre, $apellido, $email, $fecha_nac, $telefono) {
        $this->id = $id;
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->fecha_nac = $fecha_nac;
        $this->telefono = $telefono;
    }

    public function getId(){
        return $this->id;
    }

    public function getDni(){
        return $this->dni;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre=$nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido=$apellido;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email) {
        $this->email=$email;
    }

    public function getFecha_Nac(){
        return $this->fecha_nac;
    }

    public function setFecha_Nac($fecha_nac) {
        $this->fecha_nac=$fecha_nac;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono=$telefono;
    }

    public function getNombreCompleto(){
        return "{$this->apellido}, {$this->nombre}";
    }

    public static function MostrarTodos(){
        try{                
            $conexion = new Conexion();
            $sql= 'SELECT * FROM '. self::TBL;
            $consulta= $conexion->prepare($sql);
            $consulta->execute();
            $record = $consulta->fetchAll();
            $conexion = NULL;
            return $record;
        }catch  (PDOException $e){
            echo "Error en la consulta". $e -> getMessage();
            return [];          
        }
    }

    public static function buscarPersonasPorID($id){
        try {
            $conexion = new Conexion();
            $sql = 'SELECT * FROM ' . self::TBL . ' WHERE id = :id';
            $consulta = $conexion->prepare($sql);
            $consulta->bindParam(':id', $id);
            $consulta->execute();
    
            $record = $consulta->fetch(PDO::FETCH_ASSOC);
    
            if ($record) {
                return $record;
            } else {
                throw new Exception("No se encontraron Personas con el ID: $id");
            }
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        } finally {
            $conexion = null;
        }
    }

    public static function getByDni($dni){
        try{                
            $conexion = new Conexion();
            $sql= 'SELECT * FROM '. self::TBL . ' WHERE dni = :dni';
            $consulta= $conexion->prepare($sql);
            // $consulta->bindParam(':dni', $dni);
            $consulta->bindValue(':dni', $dni);
            $consulta->execute();
            // $record = $consulta->fetch();
            $record = $consulta->fetch(PDO::FETCH_ASSOC);
            $conexion = NULL;

            if($record){
                return new Personas(
                    $record["id"],
                    $record["dni"],
                    $record["nombre"],
                    $record["apellido"],
                    $record["email"],
                    $record["fecha_nac"],
                    $record["telefono"]
                );
            } else{
                return null;
            }
        }catch  (PDOException $e){
            // echo "Error en la consulta". $e -> getMessage();
            // return null;
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }
}

?>