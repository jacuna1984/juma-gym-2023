<?php
    class Conexion extends PDO{
        private $db = "jumagim2023";
        private $host = "localhost";
        private $usuario = "root";
        private $pass = "";
        private $tipoDB = "mysql";  

        public function __construct(){
            try{
                parent::__construct("{$this->tipoDB}:dbname={$this->db};
                                                    host={$this->host};
                                                    charset=utf8",
                                                    $this->usuario,
                                                    $this->pass);
            }catch (PDOException $e){
                echo "Error en la conexion de la Base de Datos". $e -> getMessage();
                exit();
            }
        }
    }
?>