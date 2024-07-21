<?php
require_once '../bd/conex.php';

class TamañoPapelModel {
    private $conn;
    private $table_name = "tamañopapel";
    
    public $ideTamaño;
    public $NombreTam;
    public $PreciopUTaP;
    public $FechaUlModi;
    public $Proveedor;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Métodos setters
    public function setIdeTamaño($ideTamaño) { $this->ideTamaño = $ideTamaño; }
    public function setNombreTam($NombreTam) { $this->NombreTam = $NombreTam; }
    public function setPreciopUTaP($PreciopUTaP) { $this->PreciopUTaP = $PreciopUTaP; }
    public function setFechaUlModi($FechaUlModi) { $this->FechaUlModi = $FechaUlModi; }
    public function setProveedor($Proveedor) { $this->Proveedor = $Proveedor; }

    // Método para guardar un nuevo tamaño de papel
    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (NombreTam, PreciopUTaP, FechaUlModi, Proveedor) 
                  VALUES (:NombreTam, :PreciopUTaP, :FechaUlModi, :Proveedor)";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreTam = htmlspecialchars(strip_tags($this->NombreTam));
        $this->PreciopUTaP = htmlspecialchars(strip_tags($this->PreciopUTaP));
        $this->FechaUlModi = htmlspecialchars(strip_tags($this->FechaUlModi));
        $this->Proveedor = htmlspecialchars(strip_tags($this->Proveedor));

        // Vinculación de parámetros
        $stmt->bindParam(':NombreTam', $this->NombreTam);
        $stmt->bindParam(':PreciopUTaP', $this->PreciopUTaP);
        $stmt->bindParam(':FechaUlModi', $this->FechaUlModi);
        $stmt->bindParam(':Proveedor', $this->Proveedor);

        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            error_log("Error al guardar el tamaño de papel: " . $errorInfo[2]);
            return false;
        }
    }

    // Método para actualizar un tamaño de papel existente
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET NombreTam = :NombreTam, 
                      PreciopUTaP = :PreciopUTaP, 
                      FechaUlModi = :FechaUlModi, 
                      Proveedor = :Proveedor 
                  WHERE ideTamaño = :ideTamaño";
    
        $stmt = $this->conn->prepare($query);
    
        // Limpieza de datos
        $this->NombreTam = htmlspecialchars(strip_tags($this->NombreTam));
        $this->PreciopUTaP = htmlspecialchars(strip_tags($this->PreciopUTaP));
        $this->FechaUlModi = htmlspecialchars(strip_tags($this->FechaUlModi));
        $this->Proveedor = htmlspecialchars(strip_tags($this->Proveedor));
    
        // Vinculación de parámetros
        $stmt->bindParam(':ideTamaño', $this->ideTamaño);
        $stmt->bindParam(':NombreTam', $this->NombreTam);
        $stmt->bindParam(':PreciopUTaP', $this->PreciopUTaP);
        $stmt->bindParam(':FechaUlModi', $this->FechaUlModi);
        $stmt->bindParam(':Proveedor', $this->Proveedor);
    
        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            error_log("Error al actualizar el tamaño de papel: " . $errorInfo[2]);
            return false;
        }
    }

    // Método para eliminar un tamaño de papel
    public function delete($ideTamaño) {
        $query = "DELETE FROM " . $this->table_name . " WHERE ideTamaño = :ideTamaño";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':ideTamaño', $ideTamaño);

        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            error_log("Error al eliminar el tamaño de papel: " . $errorInfo[2]);
            return false;
        }
    }

    // Método para obtener un tamaño de papel por su ID
    public function obtenerTamañoPapelPorId($ideTamaño) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE ideTamaño = :ideTamaño";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':ideTamaño', $ideTamaño);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para obtener todos los tamaños de papel
    public function obtenerTamañosPapel() {
        $query = "SELECT ideTamaño, NombreTam FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
