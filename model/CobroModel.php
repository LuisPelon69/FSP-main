<?php
require_once 'bd/conex.php';

class CobroModel {
    public $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getTamañosPapel() {
        $query = "SELECT NombreTam FROM tamañopapel";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setTotalCobro($TotalCobro) {
        $this->TotalCobro = $TotalCobro;
    }

    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (idCobro, idCliente, idEmpleado, TotalCobro) 
                  VALUES (:idCobro, :idCliente, :idEmpleado, :TotalCobro)";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->idCobro = htmlspecialchars(strip_tags($this->idCobro));
        $this->idCliente = htmlspecialchars(strip_tags($this->idCliente));
        $this->idEmpleado = htmlspecialchars(strip_tags($this->idEmpleado));
        $this->TotalCobro = htmlspecialchars(strip_tags($this->TotalCobro));

        // Vinculación de parámetros
        $stmt->bindParam(':idCobro', $this->idCobro);
        $stmt->bindParam(':idCliente', $this->idCliente);
        $stmt->bindParam(':idEmpleado', $this->idEmpleado);
        $stmt->bindParam(':TotalCobro', $this->TotalCobro);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function getMaxIdCobro() {
        $query = "SELECT MAX(idCobro) as maxIdCobro FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['maxIdCobro'];
    }
    


}