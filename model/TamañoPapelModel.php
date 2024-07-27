<?php
require_once '../bd/conex.php';

class TamañoPapelModel
{
    private $conn;
    private $table_name = "tamañopapel";

    public $ideTamaño;
    public $NombreTam;
    public $PreciopUTaP;
    public $FechaUlModi;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setideTamaño($id)
    {
        $this->ideTamaño = $id;
    }

    public function setNombreTam($NombreTam)
    {
        $this->NombreTam = $NombreTam;
    }

    public function setPreciopUTaP($PreciopUTaP)
    {
        $this->PreciopUTaP = $PreciopUTaP;
    }

    public function setFechaUlModi($FechaUlModi)
    {
        $this->FechaUlModi = $FechaUlModi;
    }

    public function save()
    {
        $query = "INSERT INTO " . $this->table_name . " (NombreTam, PreciopUTaP) VALUES (:NombreTam, :PreciopUTaP)";
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreTam = htmlspecialchars(strip_tags($this->NombreTam));
        $this->PreciopUTaP = htmlspecialchars(strip_tags($this->PreciopUTaP));

        // Vinculación de parámetros
        $stmt->bindParam(':NombreTam', $this->NombreTam);
        $stmt->bindParam(':PreciopUTaP', $this->PreciopUTaP);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function obtenerTodos()
    {
        $query = "SELECT ideTamaño, NombreTam, PreciopUTaP, FechaUlModi FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    public function obtenerPorId($id)
    {
        $query = "SELECT ideTamaño, NombreTam, PreciopUTaP, FechaUlModi FROM " . $this->table_name . " WHERE ideTamaño = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET NombreTam = :NombreTam, PreciopUTaP = :PreciopUTaP, FechaUlModi = :FechaUlModi WHERE ideTamaño = :id";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreTam = htmlspecialchars(strip_tags($this->NombreTam));
        $this->PreciopUTaP = htmlspecialchars(strip_tags($this->PreciopUTaP));
        $this->ideTamaño = htmlspecialchars(strip_tags($this->ideTamaño));
        $this->FechaUlModi = date('Y-m-d H:i:s'); // Establecer la fecha actual

        // Vinculación de parámetros
        $stmt->bindParam(':NombreTam', $this->NombreTam);
        $stmt->bindParam(':PreciopUTaP', $this->PreciopUTaP);
        $stmt->bindParam(':id', $this->ideTamaño);
        $stmt->bindParam(':FechaUlModi', $this->FechaUlModi);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE ideTamaño = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$id])) {
            return true;
        }

        return false;
    }
}
?>
