<?php
require_once("../db/ConexionSQL.php");

class Activity {
    
    private $connection;

    // Constructor: establece la conexión solo una vez.
    public function __construct() {
        $objConexionSQL = new ConexionSQL();
        $this->connection = $objConexionSQL->ExecuteConnection();
    }

    // listar actividades
    public function listActivity() {
        $sql = "SELECT * FROM Activities";
        $result = $this->connection->query($sql);
        $arrayActivities = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arrayActivities[] = $row;
            }
        }
        return $arrayActivities;

    }

    // Método para obtener una actividad
    public function getActivity($idActiv) {
        $sql = "SELECT Name, Description, Price FROM Activities WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $idActiv); 
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null; 
        }
    }

    // Método para actualizar
    public function updateActivity($idActiv, $name, $description, $price) {
        $sql = "UPDATE Activities SET Name = ?, Description = ?, Price = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssdi", $name, $description, $price, $idActiv); 
        $result = $stmt->execute();

        return $result ? 1 : 0;
    }

    // eliminar una actividad
    public function deleteActivity($idActiv) {
        $sql = "DELETE FROM Activities WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $idActiv); 
        $result = $stmt->execute();

        return $result ? 1 : 0;
    }

    // Método para crear una nueva actividda
    public function createActivity($name, $description, $price) {
        $sql = "INSERT INTO Activities (Name, Description, Price) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssd", $name, $description, $price);
        $result = $stmt->execute();

        return $result ? 1 : 0;
    }
}
