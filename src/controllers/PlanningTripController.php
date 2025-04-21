<?php

require_once('../models/ProgrammedTrip.php');

class PlanningTripController
{
    private $programmedTripModel;

    public function __construct()
    {
        $this->programmedTripModel = new ProgrammedTrip();
        session_start();
    }
    public function index()
    {
        if (!isset($_SESSION['UserID'])) {
            $_SESSION['modal'] = [
                'title' => '¡Ups! Acceso Necesario',
                'message' => 'Por favor, inicie sesión o regístrese para continuar a esta sección y disfrutar de nuestros servicios.'
            ];

            header("Location: ./");
            exit();
        }

        include('../views/viewFormPlanningTrip.php');
    }

    public function getProgrammedTripByDestination()
    {
        if (isset($_GET['dest'])) {
            $dataProgrammedTrip = $this->programmedTripModel->getProgrammedTripByDestination($_GET['dest']);
            echo $dataProgrammedTrip['Price'] ?? '--.--';
        } else {
            echo '';
        }
    }

    public function listProgrammedTripAvailable()
    {
        $arrayProgrammedTrip = $this->programmedTripModel->listProgrammedTripAvailable();
        echo json_encode($arrayProgrammedTrip);
    }

    public function getProgrammedTrip()
    {
        if (isset($_GET['trip'])) {
            $dataProgrammedTrip = $this->programmedTripModel->getProgrammedTrip($_GET['trip']);
            echo json_encode($dataProgrammedTrip);
        } else {
            echo '';
        }
    }
}