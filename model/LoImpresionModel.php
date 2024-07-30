<?php
require_once '../bd/conex.php';

class LoImpresionModel {
    private $conn;
    public $idLoteIm;
    public $idCobro;
    public $idTamano;
    public $idTipoP;
    public $idTipoI;
    public $CantHojas;
    public $DuplexBool;
    public $CostoLote;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function save() {
        $sql = 'INSERT INTO loimpresion (idLoteIm, idCobro, idTamano, idTipoP, idTipoI, CantHojas, DuplexBool, CostoLote)
                VALUES (:idLoteIm, :idCobro, :idTamano, :idTipoP, :idTipoI, :CantHojas, :DuplexBool, :CostoLote)';

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':idLoteIm', $this->idLoteIm, PDO::PARAM_INT);
        $stmt->bindValue(':idCobro', $this->idCobro, PDO::PARAM_INT);
        $stmt->bindValue(':idTamano', $this->idTamano, PDO::PARAM_INT);
        $stmt->bindValue(':idTipoP', $this->idTipoP, PDO::PARAM_INT);
        $stmt->bindValue(':idTipoI', $this->idTipoI, PDO::PARAM_INT);
        $stmt->bindValue(':CantHojas', $this->CantHojas, PDO::PARAM_INT);
        $stmt->bindValue(':DuplexBool', $this->DuplexBool, PDO::PARAM_INT);
        $stmt->bindValue(':CostoLote', $this->CostoLote, PDO::PARAM_STR);

        try {
            if ($stmt->execute()) {
                return json_encode(['success' => true]);
            } else {
                return json_encode(['success' => false, 'message' => 'Error al guardar el lote de impresión.']);
            }
        } catch (PDOException $e) {
            return json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
}

