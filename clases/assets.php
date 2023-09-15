<?php
require_once "conexion/connection.php";

class assets extends connection{
# se crea función que permite obtener los primero  100 registros de la tabla bienes_servicios
    public function getAssets(){
        try{
            $query = "SELECT codigo_producto, nombre_producto FROM bienes_servicios LIMIT 100";
            return parent::getData($query);
        }catch(Exception $e){
            return "Se presentó un error al ejecutar este servicio: " . $e->getMessage();
        }
        
    }
}

?>