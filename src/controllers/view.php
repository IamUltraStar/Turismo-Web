<?php
include("../models/User.php");
include("../models/Destination.php");

session_start();

if(isset($_GET["view"])) {
    switch($_GET["view"]) {
        case "view-login":
            if (isset($_SESSION['UserID'])) {
                header("Location: view.php");
                exit();
            }

            $titleTab = 'Login';
            $visibleFormLogin = '';
            $visibleFormRegister = 'hidden';

            include('../views/viewLogin.php');
            break;

        case "view-register":
            if (isset($_SESSION['UserID'])) {
                header("Location: view.php");
                exit();
            }

            $titleTab = 'Register';
            $visibleFormLogin = 'hidden';
            $visibleFormRegister = '';

            include('../views/viewLogin.php');
            break;

        case "view-destinations":
            if (isset($_GET['destination'])) {
                $objDestination = new Destination();
                $dataDestination = $objDestination->getDestination($_GET['destination']);
                
                if ($dataDestination == []) {
                    header("Location: view.php?view=view-destinations");
                    exit();
                }
                
                include('../views/viewDestinationPage.php');
            }else{
                include('../views/viewDestinationsPage.php');
            }
            break;

        case "form-planning-trip":
            if (!isset($_SESSION['UserID'])) {
                $titleModal = '¡Ups! Acceso Necesario';
                $msgModal = 'Por favor, inicie sesión o regístrese para continuar a esta sección y disfrutar de nuestros servicios.';
                
                include('../views/viewHomePage.php');
                include('../views/viewModal.php');
                exit();
            }

            include('../views/viewFormPlanningTrip.php');
            break;

        case "payment-page":
            if (!isset($_SESSION['UserID'])) {
                $titleModal = '¡Ups! Acceso Necesario';
                $msgModal = 'Por favor, inicie sesión o regístrese para continuar a esta sección y disfrutar de nuestros servicios.';

                include('../views/viewHomePage.php');
                include('../views/viewModal.php');
                exit();
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $ProgrammedTripID = $_POST['ProgrammedTripID'];
                $PhoneNumber = $_POST['PhoneNumber'];
                $NumberPeople = $_POST['NumberPeople'];

                if (empty($ProgrammedTripID) || empty($PhoneNumber) || empty($NumberPeople) || !is_numeric($PhoneNumber) || !is_numeric($NumberPeople)) {
                    $titleModal = '¡Ups! Algo Ocurrió';
                    $msgModal = 'Debes completar todos los campos.';
                    
                    include('../views/viewFormPlanningTrip.php');
                    include('../views/viewModal.php');
                    exit();
                }
                
                include('../views/viewPaymentPage.php');
            }else{
                header('Location: view.php');
            }
            break;

        case "payment-made";
            $titleModal = '¡Pago Exitoso!';
            $msgModal = 'Gracias por tu compra. Tu pago se ha procesado correctamente. Revisa tu correo para más detalles.';

            include('../views/viewHomePage.php');
            include('../views/viewModal.php');
            break;

        case "view-admin":
            if (!isset($_SESSION['UserID'])) {
                $titleModal = '¡Ups! Acceso Necesario';
                $msgModal = 'Por favor, inicie sesión o regístrese para continuar a esta sección y disfrutar de nuestros servicios.';
                
                include('../views/viewHomePage.php');
                include('../views/viewModal.php');
                exit();
            }

            $objUser = new User();
            $data = $objUser->getDataUserByID($_SESSION['UserID']);
                
            if($data["Rol"] != "administrador") {
                $titleModal = 'Acceso Restringido';
                $msgModal = 'Lo sentimos, esta sección está disponible solo para administradores. Si crees que esto es un error, por favor contacta con el soporte.';
                
                include('../views/viewHomePage.php');
                include('../views/viewModal.php');
                exit();
            }

            include('../views/viewAdmin.php');
            break;

        default:
            include('../views/viewHomePage.php');
            break;
    }
}else{
    include('../views/viewHomePage.php');
}