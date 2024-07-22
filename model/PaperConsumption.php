<?php
include_once 'conex.php';

class PaperConsumption {
    private $conn;
    private $table_name = "paper_consumption";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtiene todos los datos de consumo de papel
    public function getAll() {
        $query = "SELECT value FROM " . $this->table_name . " ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Agrega un nuevo registro de consumo de papel
    public function create($value) {
        $query = "INSERT INTO " . $this->table_name . " (value) VALUES (:value)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':value', $value);
        return $stmt->execute();
    }
}
?>
