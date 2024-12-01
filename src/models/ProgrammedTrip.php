<?php
require_once("../db/ConexionSQL.php");

class ProgrammedTrip{

    private $connection;

    // Constructor
    public function __construct() {
        $objConexionSQL = new ConexionSQL();
        $this->connection = $objConexionSQL->ExecuteConnection();

        // Verificación de conexión
        if ($this->connection->connect_error) {
            die("Conexión fallida: " . $this->connection->connect_error);
        }
    }

    // Listar todas las reservas
    public function listProgrammedTrip() {
        $sql = "SELECT * FROM ProgrammedTrips";
        $result = $this->connection->query($sql);
        $arrayProgrammedTrips = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arrayProgrammedTrips[] = $row;
            }
            return $arrayProgrammedTrips;
        }
        return $arrayProgrammedTrips;
    }

    public function listProgrammedTripAvailable() {
        $sql = "SELECT * FROM ProgrammedTrips WHERE StartDate > CURDATE()";
        $result = $this->connection->query($sql);
        $arrayProgrammedTrip = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arrayProgrammedTrip[] = $row;
            }
            return $arrayProgrammedTrip;
        }
        return $arrayProgrammedTrip;
    }

    // Obtener una reserva específica
    public function getProgrammedTrip($idProgram) {
        $sql = "SELECT pt.ProgrammedTripID, pt.Name as ProgrammedTripName, pt.Description, pt.StartDate, pt.EndDate, pt.MaxCapacity, pt.Price, d.Name as DestinationName FROM ProgrammedTrips as pt JOIN Destinations as d ON pt.DestinationID = d.DestinationID WHERE pt.ProgrammedTripID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idProgram);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        }
        return [];
    }

    public function getProgrammedTripByDestination($idDest) {
        $sql = "SELECT pt.Name, pt.Description, pt.StartDate, pt.EndDate, pt.MaxCapacity, pt.Price FROM ProgrammedTrips AS pt JOIN Destinations AS d ON pt.DestinationID = d.DestinationID WHERE pt.DestinationID = ? AND pt.StartDate > CURDATE()";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idDest);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        }
        return null; 
    }

    // Actualizar reserva
    public function updateProgrammedTrip($idProgram, $name, $description, $stateDate, $endDate, $maxCapacity, $price, $destinationID) {
        $sql = "UPDATE ProgrammedTrips SET Name = ?, Description = ?, StartDate = ?, EndDate = ?, MaxCapacity = ?, Price = ?, DestinationID = ? WHERE ProgrammedTripID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("issssiis", $idProgram, $name, $description, $stateDate, $endDate, $maxCapacity, $price, $destinationID); 
            $result = $stmt->execute();

            return $result ? 1 : 0; 
        }
        return 0; 
    }

    // Eliminar una reserva
    public function deleteProgrammedTrip($idProgram) {
        $sql = "DELETE FROM ProgrammedTrips WHERE ProgrammedTripID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idProgram); 
            $result = $stmt->execute();

            return $result ? 1 : 0; 
        }
        return 0; 
    }

    // Crear una nueva reserva
    public function createProgrammedTrip($name, $description, $startDate, $endDate, $maxCapacity, $price, $destinationID) {
        $sql = "INSERT INTO ProgrammedTrips ( Name, Description, StartDate, EndDate, MaxCapacity, Price, DestinationID) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssiis", $name, $description, $startDate, $endDate, $maxCapacity, $price, $destinationID); // Definir los tipos de datos
            $result = $stmt->execute();

            return $result ? 1 : 0;
        }
        return 0; 
    }
}

