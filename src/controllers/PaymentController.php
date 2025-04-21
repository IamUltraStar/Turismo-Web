<?php

require_once("../models/Reservation.php");
require_once("../models/Payment.php");

class PaymentController
{
    private $reservationModel;
    private $paymentModel;

    public function __construct()
    {

        $this->reservationModel = new Reservation();
        $this->paymentModel = new Payment();
        session_start();
    }
    public function index()
    {
        if (!isset($_SESSION['UserID'])) {
            $_SESSION['modal'] = [
                'title' => '¡Ups! Acceso Necesario',
                'message' => 'Por favor, inicie sesión o regístrese para continuar a esta sección y disfrutar de nuestros servicios.'
            ];
            header('Location: ./');
            exit();
        }

        $ProgrammedTripID = $_POST['ProgrammedTripID'];
        $PhoneNumber = $_POST['PhoneNumber'];
        $NumberPeople = $_POST['NumberPeople'];

        if (empty($ProgrammedTripID) || empty($PhoneNumber) || empty($NumberPeople) || !is_numeric($PhoneNumber) || !is_numeric($NumberPeople)) {
            $_SESSION['modal'] = [
                'title' => '¡Ups! Algo Ocurrió',
                'message' => 'Debes completar todos los campos.'
            ];
            header('Location: ./formPlanningTrip');
            exit();
        }

        include('../views/viewPaymentPage.php');
    }

    public function executePayment()
    {
        $ProgrammedTripID = $_POST['ProgrammedTripID'];
        $PhoneNumber = $_POST['PhoneNumber'];
        $NumberPeople = $_POST['NumberPeople'];
        $TotalAmount = $_POST['TotalAmount'];

        $this->reservationModel->createReservation($ProgrammedTripID, $_SESSION['UserID'], $PhoneNumber, $NumberPeople);
        $ReservationID = $this->reservationModel->lastReservationInserted();

        $this->paymentModel->createPayment($ReservationID, 1, $TotalAmount);

        $this->paymentMade();
    }

    public function paymentMade()
    {
        $_SESSION['modal'] = [
            'title' => '¡Pago Exitoso!',
            'message' => 'Gracias por tu compra. Tu pago se ha procesado correctamente. Revisa tu correo para más detalles.'
        ];
        header('Location: ./');
    }
}

