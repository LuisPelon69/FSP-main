<?php
require_once 'bd/conex.php';

class CobroModel {
    private $conn;

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

    public function getTiposPapel() {
        $query = "SELECT NombreTipoP FROM tipopapel";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTiposImpresion() {
        $query = "SELECT NombreTipoI FROM tipoimpresion";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
