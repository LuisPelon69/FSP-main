<?php
require_once '../bd/conex.php';

class TipoPapelModel
{
    private $conn;
    private $table_name = "tipopapel";

    public $ideTipoP;
    public $Nombre;
    public $Precio;

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
        $this->Nombre = $NombreTipoP;
    }

    public function setPreciopUTiP($PreciopUTiP)
    {
        $this->Precio = $PreciopUTiP;
    }

    public function save()
    {
        $query = "INSERT INTO " . $this->table_name . " (NombreTipoP, PreciopUTiP) VALUES (:NombreTipoP, :PreciopUTiP)";
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->Nombre = htmlspecialchars(strip_tags($this->Nombre));
        $this->Precio = htmlspecialchars(strip_tags($this->Precio));

        // Vinculación de parámetros
        $stmt->bindParam(':NombreTipoP', $this->Nombre);
        $stmt->bindParam(':PreciopUTiP', $this->Precio);

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
        $query = "UPDATE " . $this->table_name . " SET NombreTipoP = :NombreTipoP, PreciopUTiP = :PreciopUTiP WHERE ideTipoP = :id";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->Nombre = htmlspecialchars(strip_tags($this->Nombre));
        $this->Precio = htmlspecialchars(strip_tags($this->Precio));
        $this->ideTipoP = htmlspecialchars(strip_tags($this->ideTipoP));

        // Vinculación de parámetros
        $stmt->bindParam(':NombreTipoP', $this->Nombre);
        $stmt->bindParam(':PreciopUTiP', $this->Precio);
        $stmt->bindParam(':id', $this->ideTipoP);

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
?>
