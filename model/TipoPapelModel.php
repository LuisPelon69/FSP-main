<?php
require_once '../bd/conex.php';

class TipoPapelModel
{
    private $conn;
    private $table_name = "tipopapel";

    public $ideTipoP;

    public $NombreTipoP;
    public $PreciopUTiP;
    public $FechaUlModi;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setideTipoP($ideTipoP)
    {
        $this->ideTipoP = $ideTipoP;
    }

    public function setNombreTipoP($NombreTipoP)
    {
        $this->NombreTipoP = $NombreTipoP;
    }

    public function setPreciopUTiP($PreciopUTiP)
    {
        $this->PreciopUTiP = $PreciopUTiP;
    }

    public function setFechaUlModi($FechaUlModi)
    {
        $this->FechaUlModi = $FechaUlModi;
    }

    public function save()
    {
        $query = "INSERT INTO " . $this->table_name . " (NombreTipoP, PreciopUTiP, FechaUlModi) VALUES (:NombreTipoP, :PreciopUTiP,'')";
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreTipoP = htmlspecialchars(strip_tags($this->NombreTipoP));
        $this->PreciopUTiP = htmlspecialchars(strip_tags($this->PreciopUTiP));
        $this->FechaUlModi = '';

        // Vinculación de parámetros
        $stmt->bindParam(':NombreTipoP', $this->NombreTipoP);
        $stmt->bindParam(':PreciopUTiP', $this->PreciopUTiP);
        $stmt->bindParam(':FechaUlModi', $this->FechaUlModi);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function obtenerTodos()
    {
        $query = "SELECT ideTipoP, NombreTipoP, PreciopUTiP, FechaUlModi FROM " . $this->table_name;
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
        $query = "SELECT ideTipoP, NombreTipoP, PreciopUTiP, FechaUlModi FROM " . $this->table_name . " WHERE ideTipoP = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET NombreTipoP = :NombreTipoP, PreciopUTiP = :PreciopUTiP, FechaUlModi= :FechaUlModi WHERE ideTipoP = :id";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreTipoP = htmlspecialchars(strip_tags($this->NombreTipoP));
        $this->PreciopUTiP = htmlspecialchars(strip_tags($this->PreciopUTiP));
        $this->ideTipoP = htmlspecialchars(strip_tags($this->ideTipoP));
        $FechaUlModi = '';

        // Vinculación de parámetros
        $stmt->bindParam(':NombreTipoP', $this->NombreTipoP);
        $stmt->bindParam(':PreciopUTiP', $this->PreciopUTiP);
        $stmt->bindParam(':id', $this->ideTipoP);
        $stmt->bindParam(':FechaUlModi', $FechaUlModi);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE ideTipoP = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$id])) {
            return true;
        }

        return false;
    }
}
