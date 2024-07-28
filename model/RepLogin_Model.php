<?php
require_once '../bd/conex.php';

class RepLoginModel {
    private $conn;
    private $table_name = "registrologin";

    public $idEmpleado;
    public $FechaHoraLog;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
    }

    public function setFechaHoraLog($FechaHoraLog) {
        $this->FechaHoraLog = $FechaHoraLog;
    }

    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (idEmpleado, FechaHoraLog) 
                  VALUES (:idEmpleado, :FechaHoraLog)";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->idEmpleado = htmlspecialchars(strip_tags($this->idEmpleado));
        $this->FechaHoraLog = htmlspecialchars(strip_tags($this->FechaHoraLog));

        // Vinculación de parámetros
        $stmt->bindParam(':idEmpleado', $this->idEmpleado);
        $stmt->bindParam(':FechaHoraLog', $this->FechaHoraLog);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function obtenerLogins() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $logins = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $logins[] = $row;
        }

        return $logins;
    }

    public function obtenerLoginPorId($idEmpleado, $FechaHoraLog) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idEmpleado = ? AND FechaHoraLog = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$idEmpleado, $FechaHoraLog]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET FechaHoraLog = :FechaHoraLog 
                  WHERE idEmpleado = :idEmpleado AND FechaHoraLog = :FechaHoraLog";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->idEmpleado = htmlspecialchars(strip_tags($this->idEmpleado));
        $this->FechaHoraLog = htmlspecialchars(strip_tags($this->FechaHoraLog));

        // Vinculación de parámetros
        $stmt->bindParam(':idEmpleado', $this->idEmpleado);
        $stmt->bindParam(':FechaHoraLog', $this->FechaHoraLog);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete($idEmpleado, $FechaHoraLog) {
        $query = "DELETE FROM " . $this->table_name . " WHERE idEmpleado = ? AND FechaHoraLog = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$idEmpleado, $FechaHoraLog])) {
            return true;
        }

        return false;
    }
}
?>
