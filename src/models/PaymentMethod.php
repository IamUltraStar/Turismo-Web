<?php
require_once("../db/ConexionSQL.php");

class PaymentMethod {

    private $connection;

    // Constructor:
    public function __construct() {
        $objConexionSQL = new ConexionSQL();
        $this->connection = $objConexionSQL->ExecuteConnection();

        // Verificar  conexión 
        if ($this->connection->connect_error) {
            die("Conexión fallida: " . $this->connection->connect_error);
        }
    }

    //listar todos los metodos de pago
    public function listPaymentMethod() {
        $sql = "SELECT * FROM PaymentMethods";
        $result = $this->connection->query($sql);
        $arrayPaymentMethods = [];

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $arrayPaymentMethods[] = $row;
            }
        }
        return $arrayPaymentMethods; 
    }

    // obtener un método de pago 
    public function getPaymentMethod($idPymtMtd) {
        $sql = "SELECT * FROM PaymentMethods WHERE PaymentMethodID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idPymtMtd); 
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        }
        return null;
    }

    // actualizar un método de pago
    public function updatePaymentMethod($idPymtMtd, $name, $description) {
        $sql = "UPDATE PaymentMethods SET Name = ?, Description = ? WHERE PaymentMethodID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssi", $name, $description, $idPymtMtd); // "ssi" para los tipos de parámetros
            $result = $stmt->execute();

            return $result ? 1 : 0; 
        }
        return 0; 
    }

    // eliminar un método de pag
    public function deletePaymentMethod($idPymtMtd) {
        $sql = "DELETE FROM PaymentMethods WHERE PaymentMethodID = ?";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $idPymtMtd); 
            $result = $stmt->execute();

            return $result ? 1 : 0; 
        }
        return 0; 
    }

    //crear un nuevo método de pago
    public function createPaymentMethod($name, $description) {
        $sql = "INSERT INTO PaymentMethods (Name, Description) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $name, $description); 
            $result = $stmt->execute();

            return $result ? 1 : 0;
        }
        return 0; 
    }
}
