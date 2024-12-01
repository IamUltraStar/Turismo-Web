<?php
require_once("../db/ConexionSQL.php");

class Destination {

    private $connection;

    public function __construct() {
        $objConexionSQL = new ConexionSQL();
        $this->connection = $objConexionSQL->ExecuteConnection();

        // Verificar  conexión
        if ($this->connection->connect_error) {
            die("Conexión fallida: " . $this->connection->connect_error);
        }
    }

    // listar todos los destinoss
    public function listDestination() {
        $sql = "SELECT * FROM Destinations ORDER BY Name";
        $result = $this->connection->query($sql);
        $arrayDestinations = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arrayDestinations[] = $row;
            }
        }
        return $arrayDestinations;
    }

    public function listPopularDestination() {
        $sql = "SELECT * FROM Destinations ORDER BY Name DESC LIMIT 6";
        $result = $this->connection->query($sql);
        $arrayDestination = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arrayDestination[] = $row;
            }
        }
        return $arrayDestination;
    }

    // obtener destino
    public function getDestination($idDest) {
        $sql = "SELECT d.DestinationID, d.Name as DestinationName, d.Description, d.Location, d.Price, d.Image, cd.CategoryID, cd.Name as CategoryName FROM Destinations as d JOIN CategoriesDestinations AS cd ON d.CategoryID = cd.CategoryID WHERE d.DestinationID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idDest); 
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        }
        return []; 
    }

    public function listActivityByDestination($idDest) {
        $sql = "SELECT a.Name, a.Description, a.Price FROM Destination_Activities AS da JOIN Activities AS a ON da.ActivityID = a.ActivityID WHERE da.DestinationID = ? ORDER BY a.Name";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $idDest);
        $stmt->execute();
        $result = $stmt->get_result();
        $arrayActivity = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arrayActivity[] = $row;
            }
        }
        return $arrayActivity;
    }

    //a ctualizar destino
    public function updateDestination($idDest, $name, $description, $location, $price, $image, $idcategory) {
        $sql = "UPDATE Destinations SET Name = ?, Description = ?, Location = ?, Price = ?, Image = ?, CategoryID = ? WHERE DestinationID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssdssi", $name, $description, $location, $price, $image, $idcategory, $idDest);
            $result = $stmt->execute();

            return $result ? 1 : 0; 
        }
        return 0;
    }

    //eliminar un destino
    public function deleteDestination($idDest) {
        $sql = "DELETE FROM Destinations WHERE DestinationID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idDest);
            $result = $stmt->execute();

            return $result ? 1 : 0;
        }
        return 0;
    }

    //crear un nuevo destino
    public function createDestination($name, $description, $location, $price, $image, $idcategory) {
        $sql = "INSERT INTO Destinations (Name, Description, Location, Price, Image, CategoryID) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssdsi", $name, $description, $location, $price, $image, $idcategory);
            $result = $stmt->execute();

            return $result ? 1 : 0;
        }
        return 0;
    }
}

