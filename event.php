<?php

require_once("clases/event.php");
# se crea objeto de tipo event
$event = new event;
# Se crea variable response la cual servirá de respuesta para el servicio
$response = [
    "error" => false,
    "statusCode" => "",
    "message" => "",
    "data" => []
];
#se valida que la solicitud sea por método post
if($_SERVER['REQUEST_METHOD'] == "POST"){
    # se capturan los datos provenientes de la solicitud
    $postBody = file_get_contents("php://input");  
    # se llama a la función createEvent y se asigna a una variable
    # para posteriormente validar el contenido de la misma y asignar los valores correspondiente
    #a la respuesta del servicio
    $event = $event->createEvent($postBody);
    if(!empty($event)){
        http_response_code(200);
        $response["error"] = true;
        $response["statusCode"] = "400";
        $response["message"] = $event;
    }else{
        http_response_code(201);
        $response["error"] = false;
        $response["statusCode"] = "201";
        $response["message"] = "El evento se ha creado correctamente";
    }   
     
 }
 #respuesta del servicio
 header('Content-Type: application/json');
 header("Access-Control-Allow-Origin: *");
 echo json_encode($response);



?>