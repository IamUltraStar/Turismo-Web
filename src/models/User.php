<?php
require_once("../db/ConexionSQL.php");

class User{
    function executeLogin($username, $password){
        $valueLogin = false;
        try{
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            $query = "SELECT UserID, Username, Password FROM Users WHERE Username = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if($row = $result->fetch_assoc()){
                if (password_verify($password, $row['Password'])) {
                    $valueLogin = $row['UserID'];
                }
            }
            $stmt->close();
            $connection->close();
        }catch(Exception $e){
            echo $e->getMessage();
        }
        
        return $valueLogin;
    }
    
    function executeRegister($name, $email, $username, $password){
        try{
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO Users (Username, Password, FullName, Email) VALUES (?, ?, ?, ?)";
            $stmt = $connection->prepare($query);
            $stmt->bind_param('ssss', $username, $hashed_password, $name, $email);
            $stmt->execute();
            $UserID = $connection->insert_id;

            $stmt->close();
            $connection->close();
        }catch(Exception $e){
            echo $e->getMessage();
        }

        return $UserID;
    }

    function getDataUserByID($UserID){
        try {
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            $query = 'SELECT FullName, Email, Rol FROM Users WHERE UserID = ?';
            $stmt = $connection->prepare($query);
            $stmt->bind_param('i', $UserID);
            $stmt->execute();
            $result = $stmt->get_result();

            $stmt->close();
            $connection->close();

            if($row = $result->fetch_assoc()){
                return $row;
            }else{
                return false;
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    function checkErrorsLogin($username, $password){
        if($username == '' || $password == '') {
            return false;
        }
        return true;
    }

    function checkErrorsRegister($name, $email, $username, $password, $password1) {
        $domains_allowed = ['@gmail.com', "@hotmail.com", "@outlook.com"];
    
        if ($name == "" || $username == "" || $email == "" || $password == "" || $password1 == "") {
            return '3';
        }
    
        if ($password != $password1) {
            return '4';
        }

        $domain = substr($email, strpos($email, '@'));
        if (!in_array($domain, $domains_allowed)) {
            return '5';
        }
    
        try {
            $objConexionSQL = new ConexionSQL();
            $connection = $objConexionSQL->ExecuteConnection();

            $query = "SELECT Email FROM Users WHERE Email = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
        
            $stmt->close();
            
            if ($result->num_rows > 0) {
                $connection->close();
                return '6';
            }

            $query = "SELECT Username FROM Users WHERE Username = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
        
            $stmt->close();
            $connection->close();

            if ($result->num_rows > 0) {
                return '7';
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    
        return '0';
    }
}