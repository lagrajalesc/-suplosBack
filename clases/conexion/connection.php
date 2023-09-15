<?php 

class connection  {
    # se crean las variables necesarias para generar la conexión a la batos 
    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $conn; 

    # método constructor de la clase connection 
    # el cual asigna valores a las variables anteriores
    function  __construct(){
        $data = $this->connectionData();
        foreach($data as $key => $value){
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['database'];
            $this->port = $value['port'];
        }

        # se valida la conexión con las anteriores variables
        $this->conn = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
        if($this->conn->connect_errno){
            echo "falló la conexión";
            die();
        }
    }

    # se crea función que retorna los datos básicos de la conexión
    private function connectionData(){
        $path = dirname(__FILE__);
        $data = file_get_contents($path . "/" . "config");
        return  json_decode($data, true);
    }

    # se crea función que convierte los caracteres de un string a formato utf-8
    private function convertToUTF8($array){
        array_walk_recursive($array, function(&$item, $key){
            if(!mb_detect_encoding($item,'utf-8',true)){
                $item = utf8_encode($item);
            }
        });
        return $array;
    }

    # se crea función que recibe una query que permite obtener los registros de una tabla
    public function getData($query){
        $result = $this->conn->query($query);
        $resultArray = array();
        foreach($result as $key){
            $resultArray[] = $key;
        }
        return $this->convertToUTF8($resultArray);
    }
     # se crea función que recibe una query que permite agregar un nuevo registro a una tabla
    public function createRecord($query){
        $result = $this->conn->query($query);
        return $this->conn->affected_rows;
    }
    # se crea función que recibe una query que permite actualizar los registros de una tabla
    public function updateRecord($query){
        $result = $this->conn->query($query);
        return $this->conn->affected_rows;
    }


}

?>