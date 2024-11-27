<?php
require_once("../db/ConexionSQL.php");

class Payment {

    private $connection;

    // Constructor: 
    public function __construct() {
        $objConexionSQL = new ConexionSQL();
        $this->connection = $objConexionSQL->ExecuteConnection();

        // Verificar conexión 
        if ($this->connection->connect_error) {
            die("Conexión fallida: " . $this->connection->connect_error);
        }
    }

    // listar todos los pagos
    public function listPayment() {
        $sql = "SELECT * FROM Payments";
        $result = $this->connection->query($sql);

        if ($result && $result->num_rows > 0) {
            $arrayPayment = [];
            while ($row = $result->fetch_assoc()) {
                $arrayPayment[] = $row;
            }
            return $arrayPayment;
        }
        return null;
    }

    // obtener pago
    public function getPayment($idPymt) {
        $sql = "SELECT ReservationID, PaymentMethodID, TotalAmount, PaymentDate FROM Payments WHERE PaymentID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idPymt); 
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        }
        return null; 
    }

    // actualizar  pago
    public function updatePayment($idPymt, $idReservation, $idPaymentMethod, $totalAmount, $paymentDate) {
        $sql = "UPDATE Payments SET ReservationID = ?, PaymentMethodID = ?, TotalAmount = ?, PaymentDate = ? WHERE PaymentID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("iidsi", $idReservation, $idPaymentMethod, $totalAmount, $paymentDate, $idPymt); // "iidsi" para los tipos de parámetros
            $result = $stmt->execute();

            return $result ? 1 : 0;
        }
        return 0;
    }

    // eliminar un pag
    public function deletePayment($idPymt) {
        $sql = "DELETE FROM Payments WHERE PaymentID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idPymt);
            $result = $stmt->execute();

            return $result ? 1 : 0; 
        }
        return 0; 
    }

    // crear  nuevo pago
    public function createPayment($idReservation, $idPaymentMethod, $totalAmount, $paymentDate) {
        $sql = "INSERT INTO Payments (ReservationID, PaymentMethodID, TotalAmount, PaymentDate) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("iids", $idReservation, $idPaymentMethod, $totalAmount, $paymentDate); // "iids" para los tipos de parámetros
            $result = $stmt->execute();

            return $result ? 1 : 0; 
        }
        return 0;
    }
    
}
