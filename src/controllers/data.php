<?php
include ("../models/ProgrammedTrip.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case "get-date-programmed-trip":
                $tripId = $_POST['tripId'];

                $objProgrammedTrip = new ProgrammedTrip();
                $data = $objProgrammedTrip->getProgrammedTrip($tripId);

                echo json_encode($data);

                break;
        }
    }
}