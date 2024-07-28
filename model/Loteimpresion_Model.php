<?php
require_once '../bd/conex.php';

class LoteimpresionModel {
    private $conn;
    private $table_name = "loimpresion";

    public $idLoteIm;
    public $idCobro;
    public $idTamaño;
    public $idTipoP;
    public $idTipoI;
    public $CantHojas;
    public $DuplexBool;
    public $CostoLote;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setIdLoteIm($idLoteIm) {
        $this->idLoteIm = $idLoteIm;
    }

    public function setIdCobro($idCobro) {
        $this->idCobro = $idCobro;
    }

    public function setIdTamaño($idTamaño) {
        $this->idTamaño = $idTamaño;
    }

    public function setIdTipoP($idTipoP) {
        $this->idTipoP = $idTipoP;
    }

    public function setIdTipoI($idTipoI) {
        $this->idTipoI = $idTipoI;
    }

    public function setCantHojas($CantHojas) {
        $this->CantHojas = $CantHojas;
    }

    public function setDuplexBool($DuplexBool) {
        $this->DuplexBool = $DuplexBool;
    }

    public function setCostoLote($CostoLote) {
        $this->CostoLote = $CostoLote;
    }

    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (idCobro, idTamaño, idTipoP, idTipoI, CantHojas, DuplexBool, CostoLote) 
                  VALUES (:idCobro, :idTamaño, :idTipoP, :idTipoI, :CantHojas, :DuplexBool, :CostoLote)";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->idCobro = htmlspecialchars(strip_tags($this->idCobro));
        $this->idTamaño = htmlspecialchars(strip_tags($this->idTamaño));
        $this->idTipoP = htmlspecialchars(strip_tags($this->idTipoP));
        $this->idTipoI = htmlspecialchars(strip_tags($this->idTipoI));
        $this->CantHojas = htmlspecialchars(strip_tags($this->CantHojas));
        $this->DuplexBool = htmlspecialchars(strip_tags($this->DuplexBool));
        $this->CostoLote = htmlspecialchars(strip_tags($this->CostoLote));

        // Vinculación de parámetros
        $stmt->bindParam(':idCobro', $this->idCobro);
        $stmt->bindParam(':idTamaño', $this->idTamaño);
        $stmt->bindParam(':idTipoP', $this->idTipoP);
        $stmt->bindParam(':idTipoI', $this->idTipoI);
        $stmt->bindParam(':CantHojas', $this->CantHojas);
        $stmt->bindParam(':DuplexBool', $this->DuplexBool);
        $stmt->bindParam(':CostoLote', $this->CostoLote);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function obtenerLoteImpresiones() {
        $query = "SELECT idLoteIm, idCobro, idTamaño, idTipoP, idTipoI, CantHojas, DuplexBool, CostoLote FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $loteImpresiones = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $loteImpresiones[] = $row;
        }

        return $loteImpresiones;
    }

    public function obtenerLoteImpresionPorId($id) {
        $query = "SELECT idLoteIm, idCobro, idTamaño, idTipoP, idTipoI, CantHojas, DuplexBool, CostoLote FROM " . $this->table_name . " WHERE idLoteIm = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET idCobro = :idCobro, 
                      idTamaño = :idTamaño, 
                      idTipoP = :idTipoP, 
                      idTipoI = :idTipoI, 
                      CantHojas = :CantHojas, 
                      DuplexBool = :DuplexBool, 
                      CostoLote = :CostoLote 
                  WHERE idLoteIm = :idLoteIm";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->idCobro = htmlspecialchars(strip_tags($this->idCobro));
        $this->idTamaño = htmlspecialchars(strip_tags($this->idTamaño));
        $this->idTipoP = htmlspecialchars(strip_tags($this->idTipoP));
        $this->idTipoI = htmlspecialchars(strip_tags($this->idTipoI));
        $this->CantHojas = htmlspecialchars(strip_tags($this->CantHojas));
        $this->DuplexBool = htmlspecialchars(strip_tags($this->DuplexBool));
        $this->CostoLote = htmlspecialchars(strip_tags($this->CostoLote));
        $this->idLoteIm = htmlspecialchars(strip_tags($this->idLoteIm));

        // Vinculación de parámetros
        $stmt->bindParam(':idCobro', $this->idCobro);
        $stmt->bindParam(':idTamaño', $this->idTamaño);
        $stmt->bindParam(':idTipoP', $this->idTipoP);
        $stmt->bindParam(':idTipoI', $this->idTipoI);
        $stmt->bindParam(':CantHojas', $this->CantHojas);
        $stmt->bindParam(':DuplexBool', $this->DuplexBool);
        $stmt->bindParam(':CostoLote', $this->CostoLote);
        $stmt->bindParam(':idLoteIm', $this->idLoteIm);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE idLoteIm = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$id])) {
            return true;
        }

        return false;
    }
}
?>
