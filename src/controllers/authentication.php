<?php
include("../models/User.php");

session_start();

if(isset($_GET["action"])) {
    switch($_GET["action"]) {
        case "execute-login":
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $objUser = new User();
            if(!($objUser->checkErrorsLogin($username, $password))){
                header('Location: view.php?view=view-login&msg=1');
                exit();
            }
            
            $result = $objUser->executeLogin($username, $password);
            if($result === true) {
                $UserID = $objUser->getIDByUsername($username);
                if($UserID != false) {
                    $_SESSION['UserID'] = $UserID;
                    $data = $objUser->getDataUserByID($UserID);
                    
                    if($data["Rol"] == "administrador") {
                        header('Location: view.php?view=view-admin');
                    }else{
                        header('Location: view.php?view=verify-exist-session');
                    }
                }else{
                    echo "ERROR";
                }
            }else{
                header('Location: view.php?view=view-login&msg=2');
            }
            break;

        case "execute-register":
            $name = $_POST["name"];
            $email = $_POST["email"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $password1 = $_POST["password1"];

            $objUser = new User();
            $type_error = $objUser->checkErrorsRegister( $name, $email, $username, $password, $password1);

            if ($type_error == '0') {
                $UserID = $objUser->executeRegister($name, $email, $username, $password);
                $_SESSION['UserID'] = $UserID;
                header('Location: view.php?view=verify-exist-session');
            }else{
                header("Location: view.php?view=view-register&msg=$type_error");
            }

            break;

        case "execute-pay":
            header("Location: view.php?view=payment-made");
            break;

        case "logout":
            session_destroy();
            header("Location: view.php?view=verify-exist-session");
            break;
        
        default:
            header("Location: view.php?view=verify-exist-session");
            break;
    }
    
}