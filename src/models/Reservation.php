<?php
require_once("../db/ConexionSQL.php");

class Reservation {

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
    public function listReservation() {
        $sql = "SELECT * FROM Reservations";
        $result = $this->connection->query($sql);

        if ($result && $result->num_rows > 0) {
            $arrayReservation = [];
            while ($row = $result->fetch_assoc()) {
                $arrayReservation[] = $row;
            }
            return $arrayReservation;
        }
        return null;
    }

    // Obtener una reserva específica
    public function getReservation($idReserv) {
        $sql = "SELECT Name, Description FROM Reservations WHERE ReservationID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idReserv);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        }
        return null; 
    }

    // Actualizar reserva
    public function updateReservation($idReserv,$programmedTripID, $idUser, $numberPhone, $idDest, $dateReserv, $tripDate, $numberpeople, $state) {
        $sql = "UPDATE Reservations SET  ProgrammedTripID = ?, UserID = ?, PhoneNumber = ?, DestinationID = ?, ReservationDate = ?, TripDate = ?, NumberPeople = ?, State = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("iissssisi", $programmedTripID, $idUser, $numberPhone, $idDest, $dateReserv, $tripDate, $numberpeople, $state, $idReserv); // Definir los tipos de datos
            $result = $stmt->execute();

            return $result ? 1 : 0; 
        }
        return 0; 
    }

    // Eliminar una reserva
    public function deleteReservation($idReserv) {
        $sql = "DELETE FROM Reservations WHERE ReservationID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idReserv); 
            $result = $stmt->execute();

            return $result ? 1 : 0; 
        }
        return 0; 
    }

    // Crear una nueva reserva
    public function createReservation($programmedTripID, $idUser, $numberPhone, $idDest, $dateReserv, $tripDate, $numberpeople, $state) {
        $sql = "INSERT INTO Reservations ( ProgrammedTripID, UserID, PhoneNumber, DestinationID, ReservationDate, TripDate, NumberPeople, State) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("iissssii",$programmedTripID,  $idUser, $numberPhone, $idDest, $dateReserv, $tripDate, $numberpeople, $state); // Definir los tipos de datos
            $result = $stmt->execute();

            return $result ? 1 : 0;
        }
        return 0; 
    }
}

