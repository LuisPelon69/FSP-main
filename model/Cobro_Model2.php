<?php
require_once '../bd/conex.php';

class CobroModel {
    private $conn;
    private $table_name = "cobro";

    public $idCobro;
    public $idCliente;
    public $idEmpleado;
    public $FechaHoraC;
    public $TotalCobro;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setIdCobro($idCobro) {
        $this->idCobro = $idCobro;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    public function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
    }

    public function setFechaHoraC($FechaHoraC) {
        $this->FechaHoraC = $FechaHoraC;
    }

    public function setTotalCobro($TotalCobro) {
        $this->TotalCobro = $TotalCobro;
    }

    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (idCliente, idEmpleado, FechaHoraC, TotalCobro) 
                  VALUES (:idCliente, :idEmpleado, :FechaHoraC, :TotalCobro)";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->idCliente = htmlspecialchars(strip_tags($this->idCliente));
        $this->idEmpleado = htmlspecialchars(strip_tags($this->idEmpleado));
        $this->FechaHoraC = htmlspecialchars(strip_tags($this->FechaHoraC));
        $this->TotalCobro = htmlspecialchars(strip_tags($this->TotalCobro));

        // Vinculación de parámetros
        $stmt->bindParam(':idCliente', $this->idCliente);
        $stmt->bindParam(':idEmpleado', $this->idEmpleado);
        $stmt->bindParam(':FechaHoraC', $this->FechaHoraC);
        $stmt->bindParam(':TotalCobro', $this->TotalCobro);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function obtenerCobros() {
        $query = "SELECT idCobro, idCliente, idEmpleado, FechaHoraC, TotalCobro FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $cobros = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cobros[] = $row;
        }

        return $cobros;
    }

    public function obtenerCobroPorId($id) {
        $query = "SELECT idCobro, idCliente, idEmpleado, FechaHoraC, TotalCobro FROM " . $this->table_name . " WHERE idCobro = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET idCliente = :idCliente, 
                      idEmpleado = :idEmpleado, 
                      FechaHoraC = :FechaHoraC, 
                      TotalCobro = :TotalCobro 
                  WHERE idCobro = :idCobro";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->idCliente = htmlspecialchars(strip_tags($this->idCliente));
        $this->idEmpleado = htmlspecialchars(strip_tags($this->idEmpleado));
        $this->FechaHoraC = htmlspecialchars(strip_tags($this->FechaHoraC));
        $this->TotalCobro = htmlspecialchars(strip_tags($this->TotalCobro));
        $this->idCobro = htmlspecialchars(strip_tags($this->idCobro));

        // Vinculación de parámetros
        $stmt->bindParam(':idCliente', $this->idCliente);
        $stmt->bindParam(':idEmpleado', $this->idEmpleado);
        $stmt->bindParam(':FechaHoraC', $this->FechaHoraC);
        $stmt->bindParam(':TotalCobro', $this->TotalCobro);
        $stmt->bindParam(':idCobro', $this->idCobro);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE idCobro = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$id])) {
            return true;
        }

        return false;
    }
}
?>
