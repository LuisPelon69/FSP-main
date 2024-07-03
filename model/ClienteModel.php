<?php
require_once '../bd/conex.php';

class ClienteModel {
    private $conn;
    private $table_name = "cliente";

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
        $query = "INSERT INTO " . $this->table_name . " (NombreClien, ApellidoP, ApellidoM, Telefono, Correo, passwClien, Saldo) VALUES (:NombreClien, :ApellidoP, :ApellidoM, :Telefono, :Correo, :passwClien, :Saldo)";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreClien = htmlspecialchars(strip_tags($this->NombreClien));
        $this->ApellidoP = htmlspecialchars(strip_tags($this->ApellidoP));
        $this->ApellidoM = htmlspecialchars(strip_tags($this->ApellidoM));
        $this->Telefono = htmlspecialchars(strip_tags($this->Telefono));
        $this->Correo = htmlspecialchars(strip_tags($this->Correo));
        $this->passwClien = htmlspecialchars(strip_tags($this->passwClien));
        $this->Saldo = 0;

        // Vinculación de parámetros
        $stmt->bindParam(':NombreClien', $this->NombreClien);
        $stmt->bindParam(':ApellidoP', $this->ApellidoP);
        $stmt->bindParam(':ApellidoM', $this->ApellidoM);
        $stmt->bindParam(':Telefono', $this->Telefono);
        $stmt->bindParam(':Correo', $this->Correo);
        $stmt->bindParam(':passwClien', $this->passwClien);
        $stmt->bindParam(':Saldo', $this->Saldo);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
