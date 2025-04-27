<?php
require_once("../db/ConexionSQL.php");

class CategoryDestination
{

    private $connection;

    public function __construct()
    {
        $objConexionSQL = new ConexionSQL();
        $this->connection = $objConexionSQL->ExecuteConnection();
        if ($this->connection->connect_error) {
            die("Conexión fallida: " . $this->connection->connect_error);
        }
    }

    // Método para listar categorías de destino
    public function listCategoryDestination()
    {
        $sql = "SELECT * FROM CategoriesDestinations";
        $result = $this->connection->query($sql);
        $arrayCategoryDestination = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arrayCategoryDestination[] = $row;
            }
        }
        return $arrayCategoryDestination;

    }

    // Método para obtener una categoría
    public function getCategoryDestination($idCatD)
    {
        $sql = "SELECT * FROM CategoriesDestinations WHERE CategoryID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idCatD);
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

    // Método para actualizar una categoría de destino
    public function updateCategoryDestination($idCatD, $name, $description)
    {
        $sql = "UPDATE CategoriesDestinations SET Name = ?, Description = ? WHERE CategoryID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssi", $name, $description, $idCatD);
            $result = $stmt->execute();

            return $result ? 1 : 0;
        }
        return 0;
    }

    // Método para eliminar una categoría de destino
    public function deleteCategoryDestination($idCatD)
    {
        $sql = "DELETE FROM CategoriesDestinations WHERE CategoryID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idCatD);
            $result = $stmt->execute();

            return $result ? 1 : 0;
        }
        return 0;
    }

    // Método para crear una nueva categoría de destin
    public function createCategoryDestination($name, $description)
    {
        if (empty($name) || empty($description)) {
            return 0;
        }

        $sql = "INSERT INTO CategoriesDestinations (Name, Description) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $name, $description);
            $result = $stmt->execute();

            return $result ? 1 : 0;
        }
        return 0;
    }


}
