<?php
require_once '../bd/conex.php';

class TamañoPModel {
    private $conn;
    private $table_name = "tamañopapel";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function obtenerTamañosPapel() {
        $query = "SELECT * FROM " . $this->table_name; // Corregir consulta SQL
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $tamañosPapel = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tamañosPapel[] = $row;
        }

        return $tamañosPapel;
    }
}
?>