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

    // crear  nuevo pago
    public function createPayment($idReservation, $idPaymentMethod, $totalAmount) {
        $sql = "INSERT INTO Payments (ReservationID, PaymentMethodID, TotalAmount) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("iid", $idReservation, $idPaymentMethod, $totalAmount); // "iids" para los tipos de parámetros
            $result = $stmt->execute();

            return $result ? 1 : 0; 
        }
        return 0;
    }
    
}
