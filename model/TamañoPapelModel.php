<?php
require_once '../bd/conex.php';

class TamañoPapelModel
{
    private $conn;
    private $table_name = "tamañopapel";

    public $ideTamaño;

    public $Nombre;
    public $Precio;
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
        $this->NombreTam = htmlspecialchars(strip_tags($this->Nombre));
        $this->PreciopUTaP = htmlspecialchars(strip_tags($this->Precio));

        // Vinculación de parámetros
        $stmt->bindParam(':NombreTam', $this->Nombre);
        $stmt->bindParam(':PreciopUTaP', $this->Precio);


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
        $query = "SELECT ideTamaño, NombreTam, PreciopUTaP FROM " . $this->table_name . " WHERE ideTamaño = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica los datos obtenidos
        error_log(print_r('Datitos obteniditos:', $data, true));

        return $data;
    }


    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET NombreTam = :NombreTam, PreciopUTaP = :PreciopUTaP, FechaUlModi= :FechaUlModi WHERE ideTamaño = :id";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreTam = htmlspecialchars(strip_tags($this->Nombre));
        $this->PreciopUTaP = htmlspecialchars(strip_tags($this->Precio));
        $this->ideTamaño = htmlspecialchars(strip_tags($this->ideTamaño));
        $FechaUlModi = '';

        // Vinculación de parámetros
        $stmt->bindParam(':NombreTam', $this->Nombre);
        $stmt->bindParam(':PreciopUTaP', $this->Precio);
        $stmt->bindParam(':id', $this->ideTamaño);
        $stmt->bindParam(':FechaUlModi', $FechaUlModi);

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
