<?php
require_once("../db/ConexionSQL.php");

class Destination_Activity{

    private $connection;

    // Constructor: establece la conexión solo una vez
    public function __construct() {
        $objConexionSQL = new ConexionSQL();
        $this->connection = $objConexionSQL->ExecuteConnection();
        if ($this->connection->connect_error) {
            die("Conexión fallida: " . $this->connection->connect_error);
        }
    }

    // Método para listar las relaciones entre destinos y actividades
    public function listDestination_Activity() {
        $sql = "SELECT * FROM Destination_Activities";
        $result = $this->connection->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                $arrayDestination_Activity = [];
                while ($row = $result->fetch_assoc()) {
                    $arrayDestination_Activity[] = $row;
                }
                return $arrayDestination_Activity;
            } else {
                return null; 
            }
        }
        return null;
    }

    // Método para obtener una relación de activ vs destin
    public function getDestination_Activity($idDest) {
        $sql = "SELECT DestinationID, ActivitieID FROM Destination_Activities WHERE DestinationID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idDest); 
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null; 
            }
        }
        return null; 
    }

    // actualizar 
    public function updateDestination_Activity($idDest, $idActiv) {
        $sql = "UPDATE Destination_Activities SET DestinationID = ?, ActivitieID = ? WHERE DestinationID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("iii", $idDest, $idActiv, $idDest); 
            $result = $stmt->execute();

            return $result ? 1 : 0; 
        }
        return 0;
    }

    //  eliminar 
    public function deleteDestination_Activity($idDest) {
        $sql = "DELETE FROM Destination_Activities WHERE DestinationID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idDest); 
            $result = $stmt->execute();

            return $result ? 1 : 0;
        }
        return 0; 
    }

    // crear 
    public function createDestination_Activity($idDest, $idActiv) {
        $sql = "INSERT INTO Destination_Activities (DestinationID, ActivitieID) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ii", $idDest, $idActiv); 
            $result = $stmt->execute();

            return $result ? 1 : 0; 
        }
        return 0; 
    }
}

