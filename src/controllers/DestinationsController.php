<?php

require_once ROOT_PATH . "/models/Destination.php";
require_once ROOT_PATH . "/models/Review.php";

class DestinationsController
{

    private $destinationModel;
    private $reviewModel;

    public function __construct()
    {
        session_start();
        $this->destinationModel = new Destination();
        $this->reviewModel = new Review();
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

        $dataReviews = $this->reviewModel->getReviewsByDestination($value);

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

    public function sendReview()
    {
        $idDest = $_POST['idDest'] ?? null;
        $rating = $_POST['rating'] ?? null;
        $comment = $_POST['comment'] ?? null;

        if (!isset($_SESSION['UserID'])) {
            $_SESSION['modal'] = [
                'title' => 'Error',
                'message' => 'Debes iniciar sesión para enviar una reseña.'
            ];

            return view("destinations?dest=" . $idDest);
        }

        if ($idDest && $rating && $comment) {
            $this->reviewModel->createReview($_SESSION['UserID'], $idDest, $comment, $rating);

            $_SESSION['modal'] = [
                'title' => 'Éxito',
                'message' => 'Tu reseña ha sido enviada con éxito.'
            ];

            return view("destinations?dest=" . $idDest);
        } else {
            $_SESSION['modal'] = [
                'title' => 'Error',
                'message' => 'No se pudo enviar la reseña. Por favor, intenta nuevamente.'
            ];
        }

        return view("destinations?dest=" . $idDest);
    }

}