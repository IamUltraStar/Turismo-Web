<?php
include("../models/User.php");
include("../models/Reservation.php");
include("../models/Payment.php");

session_start();

if(isset($_GET["action"])) {
    switch($_GET["action"]) {
        case "execute-login":
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $objUser = new User();
            if(!($objUser->checkErrorsLogin($username, $password))){
                echo "1";
                exit();
            }
            
            $UserID = $objUser->executeLogin($username, $password);
            
            if($UserID !== false) {
                $_SESSION['UserID'] = $UserID;
                $data = $objUser->getDataUserByID($UserID);
                
                if($data["Rol"] == "administrador") {
                    echo "-1";
                }else{
                    echo "0";
                }
            }else{
                echo "2";
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
            }

            echo $type_error;
            break;

        case "execute-pay":
            $ProgrammedTripID = $_POST['ProgrammedTripID'];
            $PhoneNumber = $_POST['PhoneNumber'];
            $NumberPeople = $_POST['NumberPeople'];
            $TotalAmount = $_POST['TotalAmount'];

            $objReservation = new Reservation();
            $objReservation->createReservation($ProgrammedTripID, $_SESSION['UserID'], $PhoneNumber, $NumberPeople);
            $ReservationID = $objReservation->lastReservationInserted();

            $objPayment = new Payment();
            $objPayment->createPayment($ReservationID, 1, $TotalAmount);

            header("Location: view.php?view=payment-made");
            break;

        case "logout":
            session_destroy();
            header("Location: view.php");
            break;
        
        default:
            header("Location: view.php");
            break;
    }
}