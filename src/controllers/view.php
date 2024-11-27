<?php
include("../models/User.php");
include("../models/Destination.php");
include("../models/ProgrammedTrip.php");

session_start();

if(isset($_GET["view"])) {
    switch($_GET["view"]) {
        case "verify-exist-session":
            $initials = '';
            if (isset($_SESSION['UserID'])) {
                $opcLogin = 'hidden';
                $opcUser = '';
                
                $objUser = new User();
                $data = $objUser->getDataUserByID($_SESSION['UserID']);
                $datasplit = explode(" ",$data['FullName']);
                
                for ($i = 0; $i < 2; $i++) {
                    $initials .= $datasplit[$i][0];
                }

                unset($objUser);
            }else{
                $opcLogin = '';
                $opcUser = 'hidden';
            }

            $objDestination = new Destination();
            $arrayDestination = $objDestination->listPopularDestination();

            include('../views/viewHomePage.php');
            break;
            
        case "view-login":
            if (isset($_SESSION['UserID'])) {
                header("Location: view.php?view=verify-exist-session");
                exit();
            }

            $titleTab = 'Login';
            $visibleFormLogin = '';
            $visibleFormRegister = 'hidden';

            include('../views/viewLogin.php');

            if (isset($_GET['msg'])) {
                $titleModal = '¡Ups! Algo Ocurrió';
                switch ($_GET['msg']) {
                    case 1:
                        $msgModal = "Debe completar ambos campos.";
                        break;
                    case 2:
                        $msgModal = "Usuario o contraseña incorrectos.";
                        break;
                    default:
                        $msgModal = "Error desconocido. Inténtalo de nuevo.";
                }
                include('../views/viewModal.php');
            }

            break;

        case "view-register":
            if (isset($_SESSION['UserID'])) {
                header("Location: view.php?view=verify-exist-session");
                exit();
            }

            $titleTab = 'Register';
            $visibleFormLogin = 'hidden';
            $visibleFormRegister = '';

            include('../views/viewLogin.php');

            if (isset($_GET['msg'])) {
                $titleModal = '¡Ups! Algo Ocurrió';
                switch ($_GET['msg']) {
                    case 3:
                        $msgModal = "Debes completar todos los campos.";
                        break;
                    case 4:
                        $msgModal = "Las contraseñas no coinciden.";
                        break;
                    case 5:
                        $msgModal = "Dominio de correo no permitido.";
                        break;
                    case 6:
                        $msgModal = "Este correo ya está registrado.";
                        break;
                    case 7:
                        $msgModal = "Este usuario ya está registrado.";
                        break;
                    default:
                        $msgModal = "Error desconocido. Inténtalo de nuevo.";
                }
                include('../views/viewModal.php');
            }
            break;

        case "view-destinations":
            $initials = '';
            if (isset($_SESSION['UserID'])) {
                $opcLogin = 'hidden';
                $opcUser = '';
                
                $objUser = new User();
                $data = $objUser->getDataUserByID($_SESSION['UserID']);
                $datasplit = explode(" ",$data['FullName']);
                
                for ($i = 0; $i < 2; $i++) {
                    $initials .= $datasplit[$i][0];
                }
                
                unset($objUser);
            }else{
                $opcLogin = '';
                $opcUser = 'hidden';
            }

            $objDestination = new Destination();
            if (isset($_GET['destination'])) {
                $dataDestination = $objDestination->getDestination($_GET['destination']);
                $arrayActivity = $objDestination->listActivityByDestination($_GET['destination']);

                if ($dataDestination == [] && $arrayActivity == []) {
                    header("Location: view.php?view=view-destinations");
                    exit();
                }

                $objProgrammedTrip = new ProgrammedTrip();
                $dataProgrammedTrip = $objProgrammedTrip->getProgrammedTripByDestination($_GET['destination']);
                $price_dataProgrammedTrip = '--.--';

                if ($dataProgrammedTrip != null) {
                    $price_dataProgrammedTrip = $dataProgrammedTrip['Price'];
                }

                include('../views/viewDestinationPage.php');
            }else{
                $arrayDestination = $objDestination->listDestination();
                include('../views/viewDestinationsPage.php');
            }
            break;

        case "form-planning-trip":
            $initials = '';
            if (isset($_SESSION['UserID'])) {
                $opcLogin = 'hidden';
                $opcUser = '';
                
                $objUser = new User();
                $data = $objUser->getDataUserByID($_SESSION['UserID']);
                $datasplit = explode(" ",$data['FullName']);
                
                for ($i = 0; $i < 2; $i++) {
                    $initials .= $datasplit[$i][0];
                }
                
                unset($objUser);

                $objProgrammedTrip = new ProgrammedTrip();
                $arrayProgrammedTrip = $objProgrammedTrip->listProgrammedTripAvailable();

                include('../views/viewFormPlanningTrip.php');
            }else{
                $opcLogin = '';
                $opcUser = 'hidden';
                $titleModal = '¡Ups! Acceso Necesario';
                $msgModal = 'Por favor, inicie sesión o regístrese para continuar a esta sección y disfrutar de nuestros servicios.';

                $objDestination = new Destination();
                $arrayDestination = $objDestination->listPopularDestination();

                include('../views/viewHomePage.php');
                include('../views/viewModal.php');
            }
            break;

        case "payment-page":
            $initials = '';

            if (!isset($_SESSION['UserID'])) {
                $opcLogin = '';
                $opcUser = 'hidden';
                $titleModal = '¡Ups! Acceso Necesario';
                $msgModal = 'Por favor, inicie sesión o regístrese para continuar a esta sección y disfrutar de nuestros servicios.';

                $objDestination = new Destination();
                $arrayDestination = $objDestination->listPopularDestination();

                include('../views/viewHomePage.php');
                include('../views/viewModal.php');
                exit();
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $ProgrammedTripID = $_POST['ProgrammedTripID'];
                $NumberPhone = $_POST['PhoneNumber'];
                $NumberPeople = $_POST['NumberPeople'];

                $objProgrammedTrip = new ProgrammedTrip();

                if (empty($ProgrammedTripID) || empty($NumberPhone || empty($NumberPeople))) {
                    $opcLogin = 'hidden';
                    $opcUser = '';
                    
                    $objUser = new User();
                    $data = $objUser->getDataUserByID($_SESSION['UserID']);
                    $datasplit = explode(" ",$data['FullName']);
                    
                    for ($i = 0; $i < 2; $i++) {
                        $initials .= $datasplit[$i][0];
                    }
                    
                    unset($objUser);

                    $arrayProgrammedTrip = $objProgrammedTrip->listProgrammedTripAvailable();

                    $titleModal = '¡Ups! Algo Ocurrió';
                    $msgModal = 'Debes completar todos los campos.';

                    include('../views/viewFormPlanningTrip.php');
                    include('../views/viewModal.php');
                    exit();
                }

                $arrayProgrammedTrip = $objProgrammedTrip->getProgrammedTrip($ProgrammedTripID);

                include('../views/viewPaymentPage.php');
            }else{
                header('Location: view.php?view=verify-exist-session');
            }
            break;

        case "payment-made";
            $initials = '';
            if (isset($_SESSION['UserID'])) {
                $opcLogin = 'hidden';
                $opcUser = '';
                
                $objUser = new User();
                $data = $objUser->getDataUserByID($_SESSION['UserID']);
                $datasplit = explode(" ",$data['FullName']);
                
                for ($i = 0; $i < 2; $i++) {
                    $initials .= $datasplit[$i][0];
                }

                unset($objUser);
            }else{
                $opcLogin = '';
                $opcUser = 'hidden';
            }

            $objDestination = new Destination();
            $arrayDestination = $objDestination->listPopularDestination();

            $titleModal = '¡Pago Exitoso!';
            $msgModal = 'Gracias por tu compra. Tu pago se ha procesado correctamente. Revisa tu correo para más detalles.';

            $objDestination = new Destination();
            $arrayDestination = $objDestination->listPopularDestination();

            include('../views/viewHomePage.php');
            include('../views/viewModal.php');
            break;

        case "view-admin":
            include('../views/viewAdmin.php');
            break;

        default:
            header("Location: view.php?view=verify-exist-session");
            break;
    }
}else{
    header("Location: view.php?view=verify-exist-session");
}