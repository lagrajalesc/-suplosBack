<?php

class userValidator  {
 
# se crea función que valida que se ingresen las credenciales del usuario 
# que se va a loguear
    public function validateCredentials($data){
        $credentials = json_decode($data,true);
        if(empty($credentials['user']) || empty($credentials['password'])){
            return "Debe indicar el correo y la contraseña, por favor, valide";
        }
    }
# se crea función que valida que se hayan proporcionado todos los datos necesario 
# para que se cree un nuevo usuario 
    public function validateUser($data){
        $user = json_decode($data,true);
        if(empty($user['user'])){
            return "Debe indicar el correo, por favor, valide";
        }
        if(empty($user['password'])){
            return "Debe indicar la contraseña, por favor, valide";
        }
        if(strlen($user['password']) < 8){
            return "La contraseña debe contener al menos 8 caracteres, por favor, valide";
        }
        if(empty($user['firstName'])){
            return "Debe indicar el nombre del usuario, por favor, valide";
        }
        if(empty($user['lastName'])){
            return "Debe indicar el apellido del usuario, por favor, valide";
        }
    }
    
}

?>