<?php

class Review
{
    private $connection;

    public function __construct()
    {
        $objConexionSQL = new ConexionSQL();
        $this->connection = $objConexionSQL->ExecuteConnection();

        // Verificar  conexión
        if ($this->connection->connect_error) {
            die("Conexión fallida: " . $this->connection->connect_error);
        }
    }

    public function createReview($userID, $destinationID, $comment, $rating)
    {
        try {
            $sql = "INSERT INTO Reviews (UserID, DestinationID, Comment, Rating) VALUES (?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("iisi", $userID, $destinationID, $comment, $rating);
            $stmt->execute();

            $stmt->close();
            $this->connection->close();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getReviewsByDestination($idDest)
    {
        try {
            $sql = "SELECT u.FullName, r.Comment, r.Rating, r.ReviewDate FROM Reviews AS r JOIN Users AS u ON r.UserID = u.UserID WHERE r.DestinationID = ? ORDER BY r.ReviewID DESC";
            $stmt = $this->connection->prepare(query: $sql);
            $stmt->bind_param("i", $idDest);
            $stmt->execute();
            $result = $stmt->get_result();

            $arrayReviews = [];
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $arrayReviews[] = $row;
                }
            }

            $stmt->close();
            $this->connection->close();
            return $arrayReviews;
        } catch (Exception $e) {
            return false;
        }
    }
}
