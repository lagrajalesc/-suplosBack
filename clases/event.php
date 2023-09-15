<?php

require_once "conexion/connection.php";
require_once "validaciones/eventValidator.php";

class event extends connection{
# se crea función que permite crear un nuevo evento    
    public function createEvent($data){
        try {
            # se crea objeto de tipo eventValidator con la finalidad de validar 
            # que se hayan enviado los datos pertinentes desde la solicitud
            $validator = new eventValidator;
            $validator = $validator->validateEvent($data);
            if(!empty($validator)){
                # retorna el error en caso de que falle alguna de las validaciones
                return $validator;
            }
            # decodifica los valor enviados desde la solicitud
            $event = json_decode($data,true);
            # tomo el token del usuario luego de que este se haya logeado
            $token = $event["token"];
            # se crea query que permite obtener el id del usuario dueño del token que 
            # realiza la solicitud
            $query = "SELECT user_id FROM user_token WHERE token = '$token'"; 
            $user = parent::getData($query);
            # se asigman los valores provenientes de la solicitud a variables
            $user_id = $user[0]["user_id"];
            $operation = $event["operation_id"];
            $description = $event["description"];
            $currency = $event["currency"];
            # convierto los datos de fecha y hora tanto de creación como de finalizacón
            # del evento 
            $endDateTime = date("Y-m-d H:i:s",strtotime($event["endDate"] .  $event["endTime"]));
            $startDateTime = date("Y-m-d H:i:s",strtotime($event["startDate"]. $event["startTime"]));
            $budget = $event["budget"];
            $assets = $event["assets"];
            # se crea query que permite crear un nuevo evento
            $query = "INSERT INTO events (operation_id, event_description, currency_id, startDate, endDate, status_id, user_id, budget, asset) 
                        VALUES ('$operation', '$description', '$currency', '$startDateTime', '$endDateTime', 1, '$user_id', '$budget', '$assets')";
            if(!parent::createRecord($query) >= 1){
                return "Se presentó un error tratando de crear el nuevo usuario";
            }
        }catch(Exception $e){
            return "Se presentó un error al ejecutar este servicio: " . $e->getMessage();
        }
        
    }
}



?>