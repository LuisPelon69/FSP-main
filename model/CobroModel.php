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
    // -------------------------------------------------------
    // Método para obtener los precios de los productos
    public function getPrecios() {
        $precios = [];

        // Obtener precios de tamaños de papel
        $query = "SELECT NombreTam, PreciopUTaP FROM tamañopapel";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $precios['tamañosPapel'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Obtener precios de tipos de papel
        $query = "SELECT NombreTipoP, PreciopUTiP FROM tipopapel";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $precios['tiposPapel'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Obtener precios de tipos de impresión
        $query = "SELECT NombreTipoI, PreciopUTiI FROM tipoimpresion";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $precios['tiposImpresion'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $precios;
    }
}