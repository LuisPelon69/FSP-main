// Guardar como Graficas_Model.php en /model
<?php
require_once '../bd/conex.php';

class Graficas_Model {
    private $conn;
    private $table_name = "cobro";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getCobrosMensuales() {
        $query = "SELECT DATE_FORMAT(FechaHoraC, '%Y-%m') as mes, SUM(TotalCobro) as total 
                  FROM " . $this->table_name . " 
                  GROUP BY mes 
                  ORDER BY FechaHoraC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
