<?php

class eventValidator {
# se crea función que permite validar que se hayan proporcionado 
# los datos necesarios para la creación de un nuevo evento
    public function validateEvent($data){
        $event = json_decode($data,true);
        if(empty($event["operation_id"])){
            return "Debe indicar el tipo de operación, por favor, valide";
        }
        if(empty($event["description"])){
            return "Debe indicar la descripción o alcance de la operación, por favor, valide";
        }
        if(empty($event["currency"])){
            return "Debe indicar la el tipo de moneda, por favor, valide";
        }
        if(empty($event["startDate"]) || empty($event["startTime"])){
            return "Debe indicar la fecha y hora de inicio del proceso, por favor, valide";
        }
        if(empty($event["endDate"]) || empty($event["endTime"])){
            return "Debe indicar la fecha y hora del fin del proceso, por favor, valide";
        }
        date_default_timezone_set('America/Bogota');
        $current = date("Y-m-d H:i:s");
        $endDateTime = date("Y-m-d H:i:s",strtotime($event["endDate"] .  $event["endTime"]));
        $startDateTime = date("Y-m-d H:i:s",strtotime($event["startDate"]. $event["startTime"]));
        if($startDateTime < $current ){
            return "La fecha y hora de inicio del proceso debe ser posterior a la fecha y hora actual, por favor, valide";
        }
        if($endDateTime < $current){
            return "La fecha y hora del fin del proceso debe ser posterior a la fecha y hora actual, por favor, valide";
        }
        if($endDateTime < $startDateTime){
            return "La fecha y hora del fin del proceso debe ser posterior a la fecha y hora de inicio del proceso, por favor, valide";
        }
        if(empty($event["budget"])){
            return "Debe indicar el presupuesto para este proceso, por favor, valide";
        }
        if($event["budget"] > 100000000.00){
            return "El valor indicado excelente el límite del presupuesto, por favor, valide";
        }
        if(empty($event["assets"])){
            return "Debe indicar el bien o servicio, por favor, valide";
        }

    }

}

?>