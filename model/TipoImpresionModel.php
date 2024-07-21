<?php
require_once '../bd/conex.php';

class TipoImpresionModel {
    private $conn;
    private $table_name = "tipoimpresion";
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
        $query = "INSERT INTO " . $this->table_name . " (NombreTipoI, PreciopUTiI, FechaUlModi) VALUES (:nombre, :precioUnitario, :fechaUltimaModificacion)";
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
        $query = "SELECT ideTipoI AS id, NombreTipoI AS nombre, PreciopUTiI AS precioUnitario, FechaUlModi AS fechaUltimaModificacion FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    public function obtenerPorId($id) {
        $query = "SELECT ideTipoI AS id, NombreTipoI AS nombre, PreciopUTiI AS precioUnitario, FechaUlModi AS fechaUltimaModificacion FROM " . $this->table_name . " WHERE ideTipoI = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET NombreTipoI = :nombre, PreciopUTiI = :precioUnitario, FechaUlModi = :fechaUltimaModificacion WHERE ideTipoI = :id";
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
        $query = "DELETE FROM " . $this->table_name . " WHERE ideTipoI = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$id])) {
            return true;
        }

        return false;
    }
}
?>
