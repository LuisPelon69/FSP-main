<?php
require_once '../bd/conex.php';

class TamañoPapelModel {
    private $conn;
    private $table_name = "tamañopapel";
    public $id;
    public $nombre;
    public $precioUnitario;
    public $fechaUltimaModificacion;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPrecioUnitario($precioUnitario) {
        $this->precioUnitario = $precioUnitario;
    }

    public function setFechaUltimaModificacion($fechaUltimaModificacion) {
        $this->fechaUltimaModificacion = $fechaUltimaModificacion;
    }

    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (NombreTam, PreciopUTaP, FechaUlModi) VALUES (:nombre, :precioUnitario, :fechaUltimaModificacion)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':precioUnitario', $this->precioUnitario);
        $stmt->bindParam(':fechaUltimaModificacion', $this->fechaUltimaModificacion);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function obtenerTodos() {
        $query = "SELECT ideTamaño AS id, NombreTam AS nombre, PreciopUTaP AS precioUnitario, FechaUlModi AS fechaUltimaModificacion FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    public function obtenerPorId($id) {
        $query = "SELECT ideTamaño AS id, NombreTam AS nombre, PreciopUTaP AS precioUnitario, FechaUlModi AS fechaUltimaModificacion FROM " . $this->table_name . " WHERE ideTamaño = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET NombreTam = :nombre, PreciopUTaP = :precioUnitario, FechaUlModi = :fechaUltimaModificacion WHERE ideTamaño = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':precioUnitario', $this->precioUnitario);
        $stmt->bindParam(':fechaUltimaModificacion', $this->fechaUltimaModificacion);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE ideTamaño = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$id])) {
            return true;
        }

        return false;
    }
}
?>
