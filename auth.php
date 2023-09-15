<?php
require_once("clases/auth.php");
# se crea objeto de tipo auth
$auth = new auth;
# Se crea variable response la cual servirá de respuesta para el servicio
$response = [
    "error" => false,
    "statusCode" => "",
    "message" => "",
    "data" => []
];
#se valida que la solicitud sea por método post
if($_SERVER['REQUEST_METHOD'] == "POST"){
    #se capturan los datos provenientes de la solicitud
    $postBody = file_get_contents("php://input"); 
    # se llama a la función login y se asigna a una variable
    # para posteriormente validar el contenido de la misma y asignar los valores correspondiente
    #a la respuesta del servicio
    $login = $auth->login($postBody);
    if(empty($login)){      
        http_response_code(200);
        $response["error"] = true;
        $response["statusCode"] = "204";
        $response["message"] = "Usuario o contraseña invalidos, por favor, valide";
    }else{
        http_response_code(200);
        $response["error"] = false;
        $response["statusCode"] = "200";
        $response["message"] = "Login exitoso";
        $response["data"] = ["token" => $login ];
    }
}
#respuesta del servicio
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
echo json_encode($response);



?>
