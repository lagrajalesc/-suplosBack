
<?php

require_once "conexion/connection.php";

class updateEventStatus extends connection{
# se crea función que actualiza automaticamente el estado de los eventos
# de acuerdo al tiempo
    public function updateStatus(){
            try{
                # se trae toda la infomación de la tabala events y se asigna a una variable 
                # para posteriormente realizar validaciones sobre esta
                $query = "SELECT * FROM EVENTS";
                $data = parent::getData($query);
                if(!empty($data)){
                    # se configura zona horaria de bototá
                    date_default_timezone_set('America/Bogota');
                    # se obtiene la fecha y hora del servidor en el momento en que se 
                    # realiza la solicitud 
                    $date = date("Y-m-d H:i:s");
                    # recorro todos los elementos obtenidos en la consulta anterior 
                    # valido la fecha y hora tanto del inicio con el final del evento respecto a la hora
                    # y fecha actual, en caso de que la fecha actual sea mayor, actualizo los estados de
                    # los eventos
                    foreach($data as $event){ 
                    $id = $event["id"];
                    if($event["startDate"] < $date){
                        $query = "UPDATE EVENTS SET status_id = 3 where id = '$id' ";
                        parent::updateRecord($query);
                    }
                    if($event["endDate"] < $date){
                        $query = "UPDATE EVENTS SET status_id = 4 where id = '$id' ";
                        parent::updateRecord($query);
                    }
                    }
                    # retorno los datos de la tabla events
                    $query = "SELECT * FROM EVENTS";
                    return parent::getData($query); 
                }
            }catch(Exception $e){
                return "Se presentó un error al ejecutar este servicio: " . $e->getMessage();
            }
    }
}
?>