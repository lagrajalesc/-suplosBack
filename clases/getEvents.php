<?php
require_once "conexion/connection.php";

class getEvents extends connection{
# se crea función que me retorna la información necesaria 
# para graficar en tabla los eventos y descargar archivo con esta información
    public function getEvents(){
        try{
            $query = "SELECT EVENTS.id, EVENTS.event_description, EVENTS.startDate, 
            EVENTS.endDate, EVENTS.budget, operation.operation_name, 
            currency.currency, bienes_servicios.nombre_producto,
            statuses.status_name, CONCAT(users.firstName, ' ', users.LastName) AS userName
            FROM operation
            INNER JOIN EVENTS ON operation.id = EVENTS.operation_id
            INNER JOIN currency ON EVENTS.currency_id = currency.id
            INNER JOIN bienes_servicios ON bienes_servicios.codigo_producto = EVENTS.asset
            INNER JOIN statuses ON EVENTS.status_id = statuses.id
            INNER JOIN users ON EVENTS.user_id = users.id
            ORDER BY EVENTS.id";
            return parent::getData($query);
        }catch(Exception $e){
            return "Se presentó un error al ejecutar este servicio: " . $e->getMessage();
        }
        
    }
}

?>