<?php

require_once "conexion/connection.php";

class operation extends connection{
# se crea función que permite obtener las distintas operaciones existentes en la base de datos
    public function getOperation(){
        try{
            $query = "SELECT * FROM operation";
            return parent::getData($query);
        }catch(Exception $e){
            return "Se presentó un error al ejecutar este servicio: " . $e->getMessage();
        }
    }
}
?>