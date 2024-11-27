<?php

class ConexionSQL{
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'TurismoBD';

    function ExecuteConnection(){
        try{
            $connection = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        }catch(Exception $e){
            echo $e->getMessage();
        }
        return $connection;
    }

}