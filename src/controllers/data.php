<?php
include ("../models/ProgrammedTrip.php");
include ("../models/User.php");
include ("../models/Destination.php");

session_start();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "verify-exist-session":
            if (isset($_SESSION['UserID'])) {
                $initials = '';
                $objUser = new User();
                $data = $objUser->getDataUserByID($_SESSION['UserID']);
                $datasplit = explode(" ",$data['FullName']);
                
                for ($i = 0; $i < 2; $i++) {
                    $initials .= $datasplit[$i][0];
                }

                echo $initials;
            }
            break;

        case "list-popular-destination":
            $objDestination = new Destination();
            $arrayDestination = $objDestination->listPopularDestination();
            
            echo json_encode($arrayDestination);
            break;

        case "list-destination":
            $objDestination = new Destination();
            $arrayDestination = $objDestination->listDestination();
            
            echo json_encode($arrayDestination);
            break;

        case "list-activity-by-destination":
            $destinationId = $_POST['destinationId'];
            $objDestination = new Destination();
            $arrayActivity = $objDestination->listActivityByDestination($destinationId);

            echo json_encode($arrayActivity);
            break;
        
        case "get-programmed-trip-by-destination":
            $destinationId = $_POST['destinationId'];
            $objProgrammedTrip = new ProgrammedTrip();
            $dataProgrammedTrip = $objProgrammedTrip->getProgrammedTripByDestination($destinationId);

            echo $dataProgrammedTrip['Price'] ?? '--.--';
            break;

        case "list-programmed-trip-available":
            $objProgrammedTrip = new ProgrammedTrip();
            $arrayProgrammedTrip = $objProgrammedTrip->listProgrammedTripAvailable();

            echo json_encode($arrayProgrammedTrip);
            break;

        case "get-programmed-trip":
            $ProgrammedTripID = $_POST['ProgrammedTripID'];
            $objProgrammedTrip = new ProgrammedTrip();
            $arrayProgrammedTrip = $objProgrammedTrip->getProgrammedTrip($ProgrammedTripID);

            echo json_encode($arrayProgrammedTrip);
            break;
    }
}