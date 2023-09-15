<?php
require_once "conexion/connection.php";
require_once("clases/validaciones/userValidator.php");

class auth extends connection{
# se crea función que permite autenticarse dentro del sistema
    public function login($data){
       try{
        #se crea variable de tipo userValidator para validar 
        # que se hayan enviado las credenciales
        $validator = new userValidator;
        if(empty($validator->validateCredentials($data))){
            # decodifica los datos provenientes de la solicitud 
            $data = json_decode($data,true);
            # se asgina el usuario indicado a una variable para este servir como parámetro en futuras consultas
            $user = $data["user"];
            # se crea query que busca usuarios con el corro que se indica y luego se validad el contenido de 
            # dicha variable
            $query = "SELECT * FROM users WHERE user_name = '$user'";
            $infoUser = parent::getData($query);
            if(!empty($infoUser)){
                # se encripta la contraseña ingresada con la contraseña de la base de datos para este usuario
                if(md5($data["password"]) == $infoUser[0]["password_user"] ){
                    # se configura zona horaria de colombia
                    date_default_timezone_set('America/Bogota');
                    # se asigna el id obtenido de la consulta a una variable
                    $user_id = $infoUser[0]["id"];
                    $val = true;
                    # se crea token
                    $token = bin2hex(openssl_random_pseudo_bytes(16,$val));
                    # se toma la fecha y hora del servidor
                    $date = date("Y-m-d H:i:s");
                    # se crea consulta que permite agregar un nuevo registro a la tabla user_token
                    $query = "INSERT INTO user_token (user_id, token, date_create) VALUES ('$user_id', '$token', '$date')";
                    if(parent::createRecord($query) ){
                        # en caso de que todo haya ido bien, se retorna el token
                        return $token;
                    } 
                }                     
            } 
        }         
       }catch(Exception $e){
        return "Se presentó un error al ejecutar este servicio: " . $e->getMessage();
    }
    }

}
?>

