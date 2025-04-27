<?php

// require_once ROOT_PATH . "/controllers/BaseDestinations.php";
require_once ROOT_PATH . "/models/Destination.php";

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

        $dataDestinations = $this->destinationModel->listLocation();

        include('../views/viewDestinationsPage.php');
    }

    public function getDestination($value)
    {
        $dataDestination = $this->destinationModel->getDestination($value);

        if ($dataDestination == []) {
            return view("destinations");
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

    public function listDestinationSearched()
    {
        if (isset($_GET['query']) && isset($_GET['location'])) {
            $dataDestinations = $this->destinationModel->listDestinationSearched($_GET['query'], $_GET['location']);
            echo json_encode($dataDestinations);
        } else {
            echo json_encode([]);
        }
    }

}