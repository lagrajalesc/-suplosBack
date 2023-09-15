<?php
require_once("clases/user.php");
# Se crea un nuevo objeto de la clase user 
$user = new user;
# Se crea variable response la cual servirá de respuesta para el servicio
$response = [
    "error" => false,
    "statusCode" => "",
    "message" => "",
    "data" => []
];
#se valida que la solicitud sea por método post
 if($_SERVER['REQUEST_METHOD'] == "POST"){
    #se capturan los datos que vienen de la solicitud
    $postBody = file_get_contents("php://input");  
    # se llama al método createUser con los datos capturados de la solicitud
    $user = $user->createUser($postBody);
    #se valida el contenido de la variable $user y de acuerdo a este se asignan valores a la respuesta
    if(!empty($user)){
        http_response_code(200);
        $response["error"] = true;
        $response["statusCode"] = "400";
        $response["message"] = $user;
    }else{
        http_response_code(200);
        $response["error"] = false;
        $response["statusCode"] = "201";
        $response["message"] = "El usuario se ha creado correctamente";
    }
 
    
     
 }
 #respuesta del servicio
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
echo json_encode($response);




?>
