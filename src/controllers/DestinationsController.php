<?php

include("../models/Destination.php");

class DestinationsController
{

    private $destinationModel;

    public function __construct()
    {
        $this->destinationModel = new Destination();
    }

    public function index()
    {
        if (isset($_GET['dest'])) {
            $this->getDestination($_GET['dest']);
            exit();
        }

        include('../views/viewDestinationsPage.php');
    }

    public function getDestination($value)
    {
        $dataDestination = $this->destinationModel->getDestination($value);

        if ($dataDestination == []) {
            header("Location: ./destinations");
            exit();
        }

        include('../views/viewDestinationPage.php');
    }

    public function listDestinations()
    {
        $dataDestinations = $this->destinationModel->listDestination();
        echo json_encode($dataDestinations);
    }

    public function listPopularDestinations()
    {
        $dataDestinations = $this->destinationModel->listPopularDestination();
        echo json_encode($dataDestinations);
    }

    public function listActivityByDestination()
    {
        if (isset($_GET['dest'])) {
            $dataActivities = $this->destinationModel->listActivityByDestination($_GET['dest']);
            echo json_encode($dataActivities);
        } else {
            echo json_encode([]);
        }
    }


}