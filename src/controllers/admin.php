<?php
include("../models/Activity.php");
include("../models/CategoryDestination.php");
include("../models/Destination.php");
include("../models/Destination_Activity.php");
include("../models/PaymentMethod.php");
include("../models/Payment.php");
include("../models/Reservation.php");

$action = isset($GET['action']) ? $_GET['action']: null;
switch($action){

    //actividades
    case 'list-activity':
        $activityModel = new Activity();
        $activities = $activityModel->listActivity();
        echo $activity ? json_decode($activity): " no se encuentran las actividad";
        break;
    
    case 'get-activity':
        $idActiv = isset($_GET['ActivityID']) ? $_GET['ActivityID']: null;
        if($idActiv){
            $activityModel = new Activity();
            $activity = $activityModel->getActivity($idActiv);
            echo $activity ? json_decode($activity): "no se encuentra la actividad";
        }else {
            echo "requiere el id";
        }break;

    case 'create-activity':
        $name = isset($_POST['Name']) ? $_POST['Name']: null;
        $description = isset($_POST['Description']) ? $_POST['Description']: null;
        $price = isset($_POST['Price'])? $_POST['Price']: null;

    if ($mane && $description && $price){
        $activityModel = new Activity();
        $result = $activityModel->createActivity($name, $description, $price);

        echo $result ===1 ? "la actividad se creo correctamente": "error al crear la actividad";
    }else{
        echo "todos loa campos son oblicagorios";
    }break;

    case 'update-activity':
        $idActiv = isset($_POST['ActivityID']) ? $_POST['ActivityID'] : null;
        $name = isset($_POST['Name']) ? $_POST['Name'] : null;
        $description = isset($_POST['Description']) ? $_POST['description'] : null;
        $price = isset($_POST['price']) ? $_POST['price'] : null;

        if ($idActiv && $name && $description && $price){
            $activityModel = new Activity();
            $result = $activityModel->updateActivity($idActiv, $name, $description, $price);

            echo $result === 1 ? "actividad actualizada con exito" : "error al actualizar  la actividad";
        }break;

    case 'delete-activity':
        $idActiv =  isset($_GET['ActivityID'])? $_GET['ActivityID']: null;
        if($idActiv){
            $activityModel = new Activity();
            $result = $categoryModel->deleteActivity($idActiv);
    
            echo $result === 1 ? "actividad eliminada con exito": "error al eliminar la actividad";
        }else{
            echo "requiere el id";
        }break;
    
    // las categorias de destino

    case 'list-category':
        $categoryModel = new CategoryDestination();
        $categories = $categoryModel->listCategoryDestination();

        echo $categories ? json_encode($categories): "no se encuentran categorias";
        break;

    case 'get-category':
        $idCategory = isset($_GET['CategoryID']) ? $_GET['CategoryID']: null;
        if($idCategory){
            $categoryModel = new CategoryDestination();
            $categories = $categoryModel->getCategoryDestination($idCategory);

            echo $categories ? json_decode($categories): "no se encuentra la categoria";
        }else {
            echo "requiere el id";
        }break;

    case 'create-category':
        $name = isset($_POST['name']) ? $_POST['name']: null;
        $description = isset($_POST['description']) ? $_POST['description']: null;

        if ($name && $description){
            $categoryModel = new CategoryDestination();
            $result = $categoryModel->createCategoryDestination($name, $description);

            echo $result ===1 ? "categoria creada correctamente": "error al crear al categoria";
        }else{
            echo "todos los campos son requieridos";

        }break;

    case 'update-category':
        $idCategory = isset($_POST['CategoryID']) ? $_POST['CategoryID'] : null;
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        
        if ($idCategory && $name && $description) {
            $categoryModel = new CategoriesDestination();
            $result = $categoryModel->updateCategory($idCategory, $name, $description);

            echo $result === 1 ? "Categoría actualizada con éxito" : "Error al actualizar la categoría";
        } else {
            echo "Todos los campos son requeridos";
        }
        break;
        
    
    case 'delete-category':
    $idCategory =  isset($_GET['CategoryID'])? $_GET['CategoryID']: null;
    if($idCategory){
        $categoryModel = new CategoryDestination();
        $result = $categoryModel->deleteCategoryDestination($idCategory);

        echo $result === 1 ? "categoria eliminada con exito": "error al eliminar la categoria";
    }else{
        echo "requiere el id";
    }break;

    //destinos
    case 'list-destination':
        $descriptionModel = new Destination();
        $descriptions = $descriptionModel->listDestination();

        echo $descriptions ? json_decode($descriptions) :"No se encuentran los destinos";
        break;

    case 'get-destination':
        $idDest = isset($_GET['DestinationID']) ? $_GET['DestinationID']: null;
        if($idDest){
            $destinationModel = new Destination();
            $destinations = $destinationModel->getDestination($idDest);

            echo $descriptions ? json_decode($descriptions): "no se encuentra el destino";
        }else {
            echo "requiere el id";
        }break;

    case 'create-destination':
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $location = isset($_POST['location']) ? $_POST['location'] : null;
        $price = isset($_POST['price']) ? $_POST['price'] : null;
        $image = isset($_POST['image']) ? $_POST['image'] : null;
        $categoryID = isset($_POST['categoryID']) ? $_POST['categoryID'] : null;

        if ($name && $description && $location && $price && $image && $categoryID) {
            $destinationModel = new Destination();
            $result = $destinationModel->createDestination($name, $description, $location, $price, $image, $categoryID);
            echo $result === 1 ? "Destino creado correctamente" : "Error al crear el destino";
        } else {
            echo "Todos los campos son requeridos";
        }
        break;
        
    case 'update-destination':
        $idDest = isset($_POST['DestinationID']) ? $_POST['DestinationID'] : null;
        $name = isset($_POST['Name']) ? $_POST['Name'] : null;
        $description = isset($_POST['Description']) ? $_POST['Description'] : null;
        $location = isset($_POST['Location']) ? $_POST['Location'] : null;
        $price = isset($_POST['Price']) ? $_POST['Price'] : null;
        $image = isset($_POST['Image']) ? $_POST['Image'] : null;
        $categoryID = isset($_POST['CategoryID']) ? $_POST['CategoryID'] : null;

        if ($idDest && $name && $description && $location && $price && $image && $categoryID) {
            $destinationModel = new Destination();
            $result = $destinationModel->updateDestination($idDest, $name, $description, $location, $price, $image, $categoryID);
            echo $result === 1 ? "Destino actualizado con éxito" : "Error al actualizar el destino";
        } else {
            echo "Todos los campos son requeridos";
        }
        break;

    case 'delete-destination':
        $idDest = isset($_GET['DestinationID'])? $_GET['DestinationID']: null;
        if ($idDest){
            $destinationModel = new Destination();
            $result = $destinationModel->deleteDestination($idDest);

            echo $result === 1 ? "destino elimidado con exito": "error al eliminar el destino";
        }else{
            echo "se requiere el id";
        }
        break;
        
        // metodo de pago

    case 'list-payment-method':
        $paymentMethodModel = new PaymentMethod();
        $paymentMethods = $paymentMethodModel->listPaymentMethod();
        echo $paymentMethods ? json_encode($paymentMethods) : "No se encuentran métodos de pago";
        break;

    case 'get-payment-method':
        $idPymt = isset($_GET['PaymentMethodID']) ? $_GET['PaymentMethodID']: null;
        if($idPymt){
            $paymentMethodModel = new PaymentMethod();
            $paymentMethods = $paymentMethodModel->getPaymentMethod($idPymt);
            echo $paymentMethods ? json_decode($paymentMethods): "no se encuentra los metodos de pagos";
        }else {
            echo "requiere el id";
        }break;

    case 'create-payment-method':
        $name = isset($_POST['Name']) ? $_POST['Name'] : null;
        $description = isset($_POST['Description']) ? $_POST['Description'] : null;
        
        if ($name && $description) {
            $paymentMethodModel = new PaymentMethod();
            $result = $paymentMethodModel->createPaymentMethod($name, $description);
            echo $result === 1 ? "Método de pago creado correctamente" : "Error al crear el método de pago";
        } else {
            echo "Todos los campos son requeridos";
        }
        break;
        
        case 'update-payment-method':
            $idPaymentMethod = isset($_POST['PaymentMethodID']) ? $_POST['PaymentMethodID'] : null;
            $name = isset($_POST['Name']) ? $_POST['Name'] : null;
            $description = isset($_POST['Description']) ? $_POST['Description'] : null;
    
            if ($idPaymentMethod && $name && $description) {
                $paymentMethodModel = new PaymentMethod();
                $result = $paymentMethodModel->updatePaymentMethod($idPaymentMethod, $name, $description);
                echo $result === 1 ? "Método de pago actualizado con éxito" : "Error al actualizar el método de pago";
            } else {
                echo "Todos los campos son requeridos";
            }
            break;

    case 'delete-payment-method':
        $idPaymentMethod = isset($_POST['PaymentMethodID']) ? $_POST['PaymentMethodID']: null;
        if($idPaymentMethod){
            $paymentMethodModel = new PaymentMethod();
            $result = $paymentMethodModel->deletePaymentMethod($idPaymentMethod);

            echo $result ===1 ? "Metodo de pago eliminado con exito": "error al eliminar el metodo de pago";

        }else{
            echo "requiere el id";
        }break;

        //los pagos

    case 'list-payment':
        $paymentModel = new PaymentMethod();
        $payments = $paymentModel->listPayment();

        echo $payments ? json_encode($payments): "no se encuentra el pago";
        break;

    case 'get-payment':
        $idPymt = isset($_GET['PaymentID']) ? $_GET['PaymentID']: null;
        if($idPymt){
            $paymentModel = new PaymentMethod();
            $payments = $paymentModel->getPayment($idPymt);
            echo $payments ? json_decode($payments): "no se encuentra el pago";
        }else {
            echo "requiere el id";
        }break;

    case 'create-payment':
        $reservationID = isset($_POST['ReservationID']) ? $_POST['ReservationID'] : null;
        $paymentMethodID = isset($_POST['PaymentMethodID']) ? $_POST['PaymentMethodID'] : null;
        $totalAmount = isset($_POST['TotalAmount']) ? $_POST['TotalAmount'] : null;
        $paymentDate = isset($_POST['PaymentDate']) ? $_POST['PaymentDate'] : null;

        if ($reservationID && $paymentMethodID && $totalAmount && $paymentDate) {
            $paymentModel = new PaymentMethod();
            $result = $paymentModel->createPayment($reservationID, $paymentMethodID, $totalAmount, $paymentDate);
            echo $result === 1 ? "Pago creado correctamente" : "Error al crear el pago";
        } else {
            echo "Todos los campos son requeridos";
        }
        break;

    case 'update-payment':
        $idPymt = isset($_POST['PaymentID']) ? $_POST['PaymentID']: null;
        $reservationID = isset($_POST['ReservationID']) ? $_POST['ReservationID'] : null;
        $paymentMethodID = isset($_POST['PaymentMethodID']) ? $_POST['PaymentMethodID'] : null;
        $totalAmount = isset($_POST['TotalAmount']) ? $_POST['TotalAmount'] : null;
        $paymentDate = isset($_POST['PaymentDate']) ? $_POST['PaymentDate'] : null;

        if ($idPymt && $reservationID && $paymentMethodID && $totalAmount && $paymentDate) {
            $paymentModel = new PaymentMethod();
            $result = $paymentModel->updatePayment($idPymt, $reservationID, $paymentMethodID, $totalAmount, $paymentDate);
            echo $result === 1 ? "Pago actualizado correctamente" : "Error al actualizar el pago";
        } else {
            echo "Todos los campos son requeridos";
        }
        break;

    case 'delete-payment':
        $idPymt = isset($_GET['PaymentID']) ? $_GET['PaymentID']: null;
        if ($idPymt){
            $paymentModel = new PaymentMethod();
            $result = $paymentModel->deletePayment($idPymt);

            echo $result === 1 ? "pago eliminado con exito": "error al eliminar el pago";
        }else{
            echo "se requiere el id";
        }
        break;

    // reservas

    case 'list-reservation':
        $resvationModel = new Reservation();
        $reservations = $resvationModel->listReservation();

        echo $reservations ? json_encode($reservations): "no se encuentran reservas";
        break;

    case 'get-reservation':
        $idReserv = isset($_GET['id']) ? $_GET['id']: null;
        if ($idReserv){
            $resvationModel = new Reservation();
            $reservations = $resvationModel->getReservation($idReserv);

            echo $reservations ? json_encode($reservations): "no se escuentra la reserva";

        }else{
            echo "requiere el id";
        }break;

    case 'create-reservation':
        $programmedTripID = isset($_POST['ProgrammedTripID']) ? $_POST['ProgrammedTripID'] : null;
        $userID = isset($_POST['UserID']) ? $_POST['UserID'] : null;
        $phoneNumber = isset($_POST['PhoneNumber']) ? $_POST['PhoneNumber'] : null;
        $reservationDate = isset($_POST['ReservationDate']) ? $_POST['ReservationDate'] : null;
        $numberPeople = isset($_POST['NumberPeople']) ? $_POST['NumberPeople'] : null;
        $state = isset($_POST['State']) ? $_POST['State'] : null;

        if ($programmedTripID && $userID && $phoneNumber && $reservationDate && $numberPeople && $state) {
            $reresvationModel = new Reservation();
            $result = $reservationModel->createReservation($programmedTripID, $userID, $phoneNumber, $reservationDate, $numberPeople, $state);
            echo $result === 1 ? "reserva creado correctamente" : "Error al crear la reserva";
        } else {
            echo "Todos los campos son requeridos";
        }
        break;

    case 'update-reservation':
        $reservationID = isset($_POST['ReservationID']) ? $_POST['ReservationID'] : null;
        $programmedTripID = isset($_POST['ProgrammedTripID']) ? $_POST['ProgrammedTripID'] : null;
        $userID = isset($_POST['UserID']) ? $_POST['UserID'] : null;
        $phoneNumber = isset($_POST['PhoneNumber']) ? $_POST['PhoneNumber'] : null;
        $reservationDate = isset($_POST['ReservationDate']) ? $_POST['ReservationDate'] : null;
        $numberPeople = isset($_POST['NumberPeople']) ? $_POST['NumberPeople'] : null;
        $state = isset($_POST['State']) ? $_POST['State'] : null;

        if ($reservationID && $programmedTripID && $userID && $phoneNumber && $reservationDate && $numberPeople && $state) {
            $reresvationModel = new Reservation();
            $result = $reservationModel->updateReservation($reservationID, $programmedTripID, $userID, $phoneNumber, $reservationDate, $numberPeople, $state);
            echo $result === 1 ? "la reserva se actualizo correctamente" : "Error al actualizar la reserva";
        } else {
            echo "Todos los campos son requeridos";
        }
        break;

    case 'delete-reservation':
        $reservationID = isset($_POST['ReservationID']) ? $_POST['ReservationID'] : null;
        if ($reservationID){
            $reservationModel = new Reservation();
            $result = $reservationModel->deleteReservation($reservationID);

            echo $result === 1 ? "reserva eliminado con exito": "error al eliminar la reserva";
        }else{
            echo "se requiere el id";
        }
        break;
        
        // destino vs actividad
     
    case 'list-destination-activity':
        $destination_ActivityModel = new Destination_Activity();
        $destination_Activities = $destination_ActivityModel->listDestination_Activity();

        echo $destination_Activities? json_encode($destination_Activities): "no se encuentra la actividad";
        break;

    case 'get-destination-activity':
        $destinationID = isset($_GET['DestinationID']) ? $_GET['DestinationID']: null;
        if ($idReserv){
            $destination_ActivityModel = new Destination_Activity();
            $destination_Activities = $destination_ActivityModel->getDestination_Activity($destinationID);
    
            echo $reservations ? json_encode($reservations): "no se escuentra la reserva ni destinos";

        }else{
            echo "requiere el destino";
        }
        break;

    case 'update-destination-activity':
        $activityID= isset($_POST['ActivityID']) ? $_POST['ActivityID'] : null;
        
        if ($activityID) {
            $destination_ActivityModel = new Destination_Activity();
            $destination_Activities = $destination_ActivityModel->updateDestination_Activity($activityID);
            echo $result === 1 ? "actividad-destino actualizado correctamente" : "Error al actualizar actividad-destino";
        } else {
            echo "requiere la actividad";
        }
        break;

    case 'create-destination-activity':
        $activityID= isset($_POST['ActivityID']) ? $_POST['ActivityID'] : null;
        $destinationID = isset($_POST['DestinationID']) ? $_POST['DestinationID'] : null;
       
        if ($activityID && $destinationID) {
            $destination_ActivityModel = new Destination_Activity();
            $destination_Activities = $destination_ActivityModel->createDestination_Activity($activityID, $destinationID);
            echo $result === 1 ? "actividad-destino  creado correctamente" : "Error al crear actividad-destino";
        } else {
            echo "Todos los campos son requeridos";
        }
        break;

    case 'delete-destination-activity':
        $destinationID  = isset($_POST['DestinationID']) ? $_POST['DestinationID '] : null;
        if ($destinationID){
            $destination_ActivityModel = new Destination_Activity();
            $destination_Activities = $destination_ActivityModel->deleteDestination_Activity($activityID);
            echo $result === 1 ? "actividad-destino  eliminado correctamente" : "Error al crear actividad-destino";
        } else {
            echo "Todos los campos son requeridos";
        }
        break;


        // viajes programadoss
    case 'list-programmed-trip':
        $programmedTripModel = new ProgrammedTrip();
        $programmedTrips = $programmedTripModel->listProgrammedTrip();

        echo $programmedTrips ? json_encode($programmedTrips): "no se encuentra la programacion de la actividad";
        break;

    case 'get-programmed-trip':
        $programmedTripID = isset($_GET['ProgrammedTripID']) ? $_GET['ProgrammedTripID']: null;
        if ($programmedTripID){
            $programmedTripModel = new ProgrammedTrip();
            $programmedTrips = $programmedTripModel->getProgrammedTrip($programmedTripID);
    
            echo $programmedTrips ? json_encode($programmedTrips): "no se encuentra la programacion de la actividad";

        }else{
            echo "requiere el programacion de la actividad";

        }
        break;

    case 'create-programmed-trip':
        $name = isset($_POST['Name']) ? $_POST['Name'] : null;
        $description = isset($_POST['Description']) ? $_POST['Description'] : null;
        $stardate = isset($_POST['StartDate']) ? $_POST['StartDate'] : null;
        $endDate = isset($_POST['EndDate']) ? $_POST['EndDate'] : null;
        $endDate = isset($_POST['EndDate']) ? $_POST['EndDate'] : null;
        $maxCapacity = isset($_POST['MaxCapacity']) ? $_POST['MaxCapacity'] : null;
        $price = isset($_POST['Price']) ? $_POST['Price'] : null;
        $description = isset($_POST['DestinationID']) ? $_POST['DestinationID'] : null;
        
        if ($name && $description && $stardate && $endDate && $maxCapacity && $price && $destinationID) {
            $programmedTripModel = new ProgrammedTrip();
            $programmedTrips = $programmedTripModel->ProgrammedTrip($programmedTripID, $name, $description, $stardate, $endDate, $maxCapacity, $price, $destinationID);
    
                echo $programmedTrips === 1 ? "programacion de actividades se a actualizado correctamente" : "Error al actualizar programacion de actividades";
            } else {
                echo "Todos los campos son requeridos";
            }
            break;

    case 'update-programmed-trip':
        $programmedTripID= isset($_POST['ProgrammedTripID']) ? $_POST['ProgrammedTripID'] : null;
        $name = isset($_POST['Name']) ? $_POST['Name'] : null;
        $description = isset($_POST['Description']) ? $_POST['Description'] : null;
        $stardate = isset($_POST['StartDate']) ? $_POST['StartDate'] : null;
        $endDate = isset($_POST['EndDate']) ? $_POST['EndDate'] : null;
        $maxCapacity = isset($_POST['MaxCapacity']) ? $_POST['MaxCapacity'] : null;
        $price = isset($_POST['Price']) ? $_POST['Price'] : null;
        $destinationID = isset($_POST['DestinationID']) ? $_POST['DestinationID'] : null;
        
        if ($programmedTripID && $name && $description && $stardate &&  $endDate && $maxCapacity && $price && $destinationID) {
            $programmedTripModel = new ProgrammedTrip();
            $programmedTrips = $programmedTripModel->updateProgrammedTrip($programmedTripID, $name, $description, $stardate, $endDate,  $maxCapacity, $price, $destinationID);
    
                echo $programmedTrips === 1 ? "programacion de actividades se a  creado correctamente" : "Error al crear programacion de actividades";
            } else {
                echo "Todos los campos son requeridos";
            }
            break;

    case 'delete-programmed-trip':
        $programmedTripID= isset($_POST['ProgrammedTripID']) ? $_POST['ProgrammedTripID'] : null;
        
        if ($programmedTripID) {
            $programmedTripModel = new ProgrammedTrip();
            $programmedTrips = $programmedTripModel->deleteProgrammedTrip($programmedTripID);
    
                echo $programmedTrips === 1 ? "programacion de actividades se eliminado correctamente" : "Error al eliminar programacion de actividades";
            } else {
                echo "require el id";
            }
            break;
            
    default:
        echo "la accion es invalida";
    break;
}