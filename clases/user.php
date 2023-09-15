<?php
require_once "conexion/connection.php";
require_once "validaciones/userValidator.php";

class user extends connection{
    #se crea función que permite crear un nuevo usuaio
    public function createUser($user){
        try{
            # se crea objeto de tipo validator y se asigna a una variable con la cual valida que se 
            # hayan enviado los datos pertinentes en la solicitud
            $validator = new userValidator;
            $validateUser = $validator->validateUser($user);
            if(!empty($validateUser)){
                # en caso de que la validación sea erronea, retorno el error 
                return $validateUser;
            }
            # decodifico los datos provenientes de la solicitud
            $data = json_decode($user,true);
            # enctipto la contraseña
            $pass = md5($data["password"]);
            $firstName = $data["firstName"];
            $lastName = $data["lastName"];
            $user = $data["user"];
            # valido que no exista un usuario con el correo que indicaron
            $query = "SELECT * FROM  users WHERE user_name = '$user'";
            $data = parent::getData($query);
            if(!empty($data)){
                return "Ya existe un usuario con ese correo electrónico, intente con otro";       
            } 
            $query = "INSERT INTO users (firstName, LastName, user_name, password_user, status_id) VALUES ('$firstName', '$lastName', '$user', '$pass', 1)";
            if(!parent::createRecord($query) >= 1){
                return "Se presentó un error tratando de crear el nuevo usuario";
            } 
        }catch(Exception $e){
            return "Se presentó un error al ejecutar este servicio: " . $e->getMessage();
        }
    }
} 


?>