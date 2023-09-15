<?php

require_once "conexion/connection.php";

class currency extends connection{
# se crea función que permite obtener las distintas divisas 
    public function getCurrency(){
        try{
            $query = "SELECT * FROM currency";
            return parent::getData($query);
        }catch(Exception $e){
            return "Se presentó un error al ejecutar este servicio: " . $e->getMessage();
        }

    }
}
?>