<?php
require_once '../bd/conex.php';

class TarjetaEmpleadoModel {
    private $conn;
    private $table_name = "cliente";
    public $idClien;
    public $NombreClien;
    public $ApellidoP;
    public $ApellidoM;
    public $Telefono;
    public $Correo;
    public $passwClien;
    public $Saldo;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setIdClien($idClien) {
        $this->idClien = $idClien;
    }

    public function setNombreClien($NombreClien) {
        $this->NombreClien = $NombreClien;
    }

    public function setApellidoP($ApellidoP) {
        $this->ApellidoP = $ApellidoP;
    }

    public function setApellidoM($ApellidoM) {
        $this->ApellidoM = $ApellidoM;
    }

    public function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }

    public function setCorreo($Correo) {
        $this->Correo = $Correo;
    }

    public function setPasswClien($passwClien) {
        $this->passwClien = $passwClien;
    }

    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (NombreClien, ApellidoP, ApellidoM, Telefono, Correo, passwClien, Saldo, idStatus) VALUES (:NombreClien, :ApellidoP, :ApellidoM, :Telefono, :Correo, :passwClien, :Saldo, :idStatus)";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreClien = htmlspecialchars(strip_tags($this->NombreClien));
        $this->ApellidoP = htmlspecialchars(strip_tags($this->ApellidoP));
        $this->ApellidoM = htmlspecialchars(strip_tags($this->ApellidoM));
        $this->Telefono = htmlspecialchars(strip_tags($this->Telefono));
        $this->Correo = htmlspecialchars(strip_tags($this->Correo));
        $this->passwClien = htmlspecialchars(strip_tags($this->passwClien));
        $this->Saldo = 0; // Valor por defecto
        $idStatus = 1; // Valor por defecto

        // Vinculación de parámetros
        $stmt->bindParam(':NombreClien', $this->NombreClien);
        $stmt->bindParam(':ApellidoP', $this->ApellidoP);
        $stmt->bindParam(':ApellidoM', $this->ApellidoM);
        $stmt->bindParam(':Telefono', $this->Telefono);
        $stmt->bindParam(':Correo', $this->Correo);
        $stmt->bindParam(':passwClien', $this->passwClien);
        $stmt->bindParam(':Saldo', $this->Saldo);
        $stmt->bindParam(':idStatus', $idStatus);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function obtenerClientes() {
        $query = "SELECT idClien, NombreClien, ApellidoP, ApellidoM, Saldo, Telefono, Correo, idStatus FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $clientes = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clientes[] = $row;
        }

        return $clientes;
    }

    public function obtenerClientePorId($id) {
        $query = "SELECT idClien, NombreClien, ApellidoP, ApellidoM, Saldo, Telefono, Correo, idStatus FROM " . $this->table_name . " WHERE idClien = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET NombreClien = :NombreClien, ApellidoP = :ApellidoP, ApellidoM = :ApellidoM, Telefono = :Telefono, Correo = :Correo, idStatus = :idStatus WHERE idClien = :idClien";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreClien = htmlspecialchars(strip_tags($this->NombreClien));
        $this->ApellidoP = htmlspecialchars(strip_tags($this->ApellidoP));
        $this->ApellidoM = htmlspecialchars(strip_tags($this->ApellidoM));
        $this->Telefono = htmlspecialchars(strip_tags($this->Telefono));
        $this->Correo = htmlspecialchars(strip_tags($this->Correo));
        $this->idClien = htmlspecialchars(strip_tags($this->idClien));
        $idStatus = 1; // Mantener idStatus en 1

        // Vinculación de parámetros
        $stmt->bindParam(':NombreClien', $this->NombreClien);
        $stmt->bindParam(':ApellidoP', $this->ApellidoP);
        $stmt->bindParam(':ApellidoM', $this->ApellidoM);
        $stmt->bindParam(':Telefono', $this->Telefono);
        $stmt->bindParam(':Correo', $this->Correo);
        $stmt->bindParam(':idClien', $this->idClien);
        $stmt->bindParam(':idStatus', $idStatus);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE idClien = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$id])) {
            return true;
        }

        return false;
    }
}
?>