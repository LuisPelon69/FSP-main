<?php
require_once '../bd/conex.php';

class RecargasModel {
    private $conn;
    private $table_name = "recarga";

    public $FoRecarga;
    public $idCliente;
    public $idEmpleado;
    public $FechaHoraR;
    public $ValorR;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setFoRecarga($FoRecarga) {
        $this->FoRecarga = $FoRecarga;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    public function setIdEmpleado($idEmpleado) {
        $this->idEmpleado = $idEmpleado;
    }

    public function setFechaHoraR($FechaHoraR) {
        $this->FechaHoraR = $FechaHoraR;
    }

    public function setValorR($ValorR) {
        $this->ValorR = $ValorR;
    }

    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (idCliente, idEmpleado, FechaHoraR, ValorR) 
                  VALUES (:idCliente, :idEmpleado, :FechaHoraR, :ValorR)";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->idCliente = htmlspecialchars(strip_tags($this->idCliente));
        $this->idEmpleado = htmlspecialchars(strip_tags($this->idEmpleado));
        $this->FechaHoraR = htmlspecialchars(strip_tags($this->FechaHoraR));
        $this->ValorR = htmlspecialchars(strip_tags($this->ValorR));

        // Vinculación de parámetros
        $stmt->bindParam(':idCliente', $this->idCliente);
        $stmt->bindParam(':idEmpleado', $this->idEmpleado);
        $stmt->bindParam(':FechaHoraR', $this->FechaHoraR);
        $stmt->bindParam(':ValorR', $this->ValorR);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function obtenerRecargas() {
        $query = "SELECT FoRecarga, idCliente, idEmpleado, FechaHoraR, ValorR FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $recargas = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $recargas[] = $row;
        }

        return $recargas;
    }

    public function obtenerRecargaPorId($id) {
        $query = "SELECT FoRecarga, idCliente, idEmpleado, FechaHoraR, ValorR FROM " . $this->table_name . " WHERE FoRecarga = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET idCliente = :idCliente, 
                      idEmpleado = :idEmpleado, 
                      FechaHoraR = :FechaHoraR, 
                      ValorR = :ValorR 
                  WHERE FoRecarga = :FoRecarga";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->idCliente = htmlspecialchars(strip_tags($this->idCliente));
        $this->idEmpleado = htmlspecialchars(strip_tags($this->idEmpleado));
        $this->FechaHoraR = htmlspecialchars(strip_tags($this->FechaHoraR));
        $this->ValorR = htmlspecialchars(strip_tags($this->ValorR));
        $this->FoRecarga = htmlspecialchars(strip_tags($this->FoRecarga));

        // Vinculación de parámetros
        $stmt->bindParam(':idCliente', $this->idCliente);
        $stmt->bindParam(':idEmpleado', $this->idEmpleado);
        $stmt->bindParam(':FechaHoraR', $this->FechaHoraR);
        $stmt->bindParam(':ValorR', $this->ValorR);
        $stmt->bindParam(':FoRecarga', $this->FoRecarga);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE FoRecarga = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$id])) {
            return true;
        }

        return false;
    }
}
?>
