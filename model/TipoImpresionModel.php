<?php
require_once '../bd/conex.php';

class TipoImpresionModel
{
    private $conn;
    private $table_name = "tipoimpresion";

    public $ideTipoI;
    public $NombreTipoI;
    public $PreciopUTiI;
    public $FechaUlModi;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function setideTipoI($ideTipoI)
    {
        $this->ideTipoI = $ideTipoI;
    }

    public function setNombreTipoI($NombreTipoI)
    {
        $this->NombreTipoI = $NombreTipoI;
    }

    public function setPreciopUTiI($PreciopUTiI)
    {
        $this->PreciopUTiI = $PreciopUTiI;
    }

    public function setFechaUlModi($FechaUlModi)
    {
        $this->FechaUlModi = $FechaUlModi;
    }

    public function save()
    {
        $query = "INSERT INTO " . $this->table_name . " (NombreTipoI, PreciopUTiI) VALUES (:NombreTipoI, :PreciopUTiI)";
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreTipoI = htmlspecialchars(strip_tags($this->NombreTipoI));
        $this->PreciopUTiI = htmlspecialchars(strip_tags($this->PreciopUTiI));

        // Vinculación de parámetros
        $stmt->bindParam(':NombreTipoI', $this->NombreTipoI);
        $stmt->bindParam(':PreciopUTiI', $this->PreciopUTiI);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function obtenerTodos()
    {
        $query = "SELECT ideTipoI, NombreTipoI, PreciopUTiI, FechaUlModi FROM " . $this->table_name;
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
        $query = "SELECT ideTipoI, NombreTipoI, PreciopUTiI, FechaUlModi FROM " . $this->table_name . " WHERE ideTipoI = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET NombreTipoI = :NombreTipoI, PreciopUTiI = :PreciopUTiI, FechaUlModi = :FechaUlModi WHERE ideTipoI = :id";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreTipoI = htmlspecialchars(strip_tags($this->NombreTipoI));
        $this->PreciopUTiI = htmlspecialchars(strip_tags($this->PreciopUTiI));
        $this->ideTipoI = htmlspecialchars(strip_tags($this->ideTipoI));
        $this->FechaUlModi = date('Y-m-d H:i:s'); // Establecer la fecha actual

        // Vinculación de parámetros
        $stmt->bindParam(':NombreTipoI', $this->NombreTipoI);
        $stmt->bindParam(':PreciopUTiI', $this->PreciopUTiI);
        $stmt->bindParam(':id', $this->ideTipoI);
        $stmt->bindParam(':FechaUlModi', $this->FechaUlModi);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE ideTipoI = ?";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$id])) {
            return true;
        }

        return false;
    }
}
?>
