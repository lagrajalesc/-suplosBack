<?php
require_once "clases/assets.php";
# se crea objeto de tipo assets
$assets = new assets;
# Se crea variable response la cual servirá de respuesta para el servicio
$response = [
    "error" => false,
    "statusCode" => "",
    "message" => "",
    "data" => []
];
#se valida que la solicitud sea por método get
if($_SERVER['REQUEST_METHOD'] == "GET"){
    $data = $assets->getAssets();
        # se llama a la función updateStatus y se asigna a una variable
    # para posteriormente validar el contenido de la misma y asignar los valores correspondiente
    #a la respuesta del servicio
    if(empty($data)){
        http_response_code(200);
        $response["error"] = false;
        $response["statusCode"] = "204";
        $response["message"] = "No se encontraron regisros, por favor, valide";
    } else{
        http_response_code(200);
        $response["error"] = false;
        $response["statusCode"] = "200";
        $response["message"] = "Estos son los registros encontrados";
        $response["data"] = ["assets" => $data];
    }
}

 #respuesta del servicio
 header('Content-Type: application/json');
 header("Access-Control-Allow-Origin: *");
 echo json_encode($response);
?>