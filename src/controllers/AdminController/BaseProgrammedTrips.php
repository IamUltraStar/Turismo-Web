<?php

require_once(ROOT_PATH . '/models/ProgrammedTrip.php');
require_once(ROOT_PATH . '/models/Destination.php');

class BaseProgrammedTrips
{
    private $programmedTripModel;
    private $destinationModel;

    public function __construct()
    {
        $this->programmedTripModel = new ProgrammedTrip();
        $this->destinationModel = new Destination();
    }

    public function index()
    {
        if (isset($_GET['trip'])) {
            $title_action_programmedTrip = "Editar viaje programado:";

            $editprogrammedTrip = $this->programmedTripModel->getProgrammedTrip($_GET['trip']);

            if (!isset($editprogrammedTrip)) {
                return view("admin/programmed-trips");
            }
        }

        $arrayProgrammedTrip = $this->programmedTripModel->listProgrammedTrip();
        $arrayDestinations = $this->destinationModel->listDestination();

        include(ROOT_PATH . '/views/admin/programmed_trips.php');
    }

    public function create()
    {
        $name = isset($_POST['trip_name']) ? $_POST['trip_name'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : null;
        $endDate = isset($_POST['end_date']) ? $_POST['end_date'] : null;
        $maxCapacity = isset($_POST['max_capacity']) ? $_POST['max_capacity'] : null;
        $price = isset($_POST['price']) ? $_POST['price'] : null;
        $destinationID = isset($_POST['destination_id']) ? $_POST['destination_id'] : null;

        if ($name && $description && $startDate && $endDate && $maxCapacity && $price && $destinationID) {
            $result = $this->programmedTripModel->createProgrammedTrip($name, $description, $startDate, $endDate, $maxCapacity, $price, $destinationID);

            if ($result) {
                echo "La actividad se creó correctamente";
            } else {
                echo "Error al crear la programacion de viajes";
            }
        } else {
            echo "Todos los campos son obligatorios";
        }

        return view("admin/programmed-trips");
    }

    public function update()
    {
        $programmedTripID = isset($_POST['trip']) ? $_POST['trip'] : null;
        $name = isset($_POST['trip_name']) ? $_POST['trip_name'] : null;
        $description = isset($_POST['description']) ? $_POST['description'] : null;
        $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : null;
        $endDate = isset($_POST['end_date']) ? $_POST['end_date'] : null;
        $maxCapacity = isset($_POST['max_capacity']) ? $_POST['max_capacity'] : null;
        $price = isset($_POST['price']) ? $_POST['price'] : null;
        $destinationID = isset($_POST['destination_id']) ? $_POST['destination_id'] : null;

        if ($programmedTripID && $name && $description && $startDate && $endDate && $maxCapacity && $price && $destinationID) {
            $result = $this->programmedTripModel->updateProgrammedTrip($programmedTripID, $name, $description, $startDate, $endDate, $maxCapacity, $price, $destinationID);
            $message = $result ? "programacion de viaje actualizado con éxito" : "Error al actualizar programacion de viaje";
            echo $message;
        }

        return view("admin/programmed-trips");
    }

    public function delete()
    {
        $programmedTripID = isset($_POST['trip']) ? $_POST['trip'] : null;

        if ($programmedTripID) {
            $result = $this->programmedTripModel->deleteProgrammedTrip($programmedTripID);

            if ($result) {
                echo "programacion de viajes eliminada con éxito";
            } else {
                echo "Error al eliminar la programacion de viajes";
            }
        } else {
            echo "ID de la progracion de actividades es requerido";
        }

        return view("admin/programmed-trips");
    }
}