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

    // Crear una nueva reserva
    public function createReservation($programmedTripID, $idUser, $numberPhone, $numberpeople) {
        $sql = "INSERT INTO Reservations ( ProgrammedTripID, UserID, PhoneNumber, NumberPeople) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("iisi",$programmedTripID,  $idUser, $numberPhone, $numberpeople); // Definir los tipos de datos
            $result = $stmt->execute();

            return $result ? 1 : 0;
        }
        return 0; 
    }

    public function lastReservationInserted(){
        return $this->connection->insert_id;
    }
}
