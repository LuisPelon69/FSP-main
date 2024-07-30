<?php
require_once '../bd/conex.php';

class RepLoginModel {
    private $conn;
    private $table_name = "empleado"; // Cambiado para asegurarnos de que estamos trabajando con la tabla correcta

    public $NombreEmp;
    public $FechaHoraLog;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setNombreEmp($NombreEmp) {
        $this->NombreEmp = $NombreEmp;
    }

    public function setFechaHoraLog($FechaHoraLog) {
        $this->FechaHoraLog = $FechaHoraLog;
    }

    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (NombreEmp, FechaHoraLog) 
                  VALUES (:NombreEmp, :FechaHoraLog)";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreEmp = htmlspecialchars(strip_tags($this->NombreEmp));
        $this->FechaHoraLog = htmlspecialchars(strip_tags($this->FechaHoraLog));

        // Vinculación de parámetros
        $stmt->bindParam(':NombreEmp', $this->NombreEmp);
        $stmt->bindParam(':FechaHoraLog', $this->FechaHoraLog);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function obtenerLogins() {
        $query = "SELECT NombreEmp, FechaHoraLog FROM " . $this->table_name; // Seleccionamos solo las columnas necesarias
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $logins = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $logins[] = $row;
        }

        return $logins;
    }

    public function obtenerLoginPorId($NombreEmp, $FechaHoraLog) {
        $query = "SELECT NombreEmp, FechaHoraLog FROM " . $this->table_name . " WHERE NombreEmp = ? AND FechaHoraLog = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$NombreEmp, $FechaHoraLog]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET FechaHoraLog = :FechaHoraLog 
                  WHERE NombreEmp = :NombreEmp";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreEmp = htmlspecialchars(strip_tags($this->NombreEmp));
        $this->FechaHoraLog = htmlspecialchars(strip_tags($this->FechaHoraLog));

        // Vinculación de parámetros
        $stmt->bindParam(':NombreEmp', $this->NombreEmp);
        $stmt->bindParam(':FechaHoraLog', $this->FechaHoraLog);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete($NombreEmp, $FechaHoraLog) {
        $query = "DELETE FROM " . $this->table_name . " WHERE NombreEmp = ? AND FechaHoraLog = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$NombreEmp, $FechaHoraLog])) {
            return true;
        }

        return false;
    }
}
?>
