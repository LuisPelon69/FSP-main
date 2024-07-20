<?php
require_once '../bd/conex.php';

class EmpleadoModel {
    private $conn;
    private $table_name = "empleado";
    
    public $idEmple;
    public $NombreEmp;
    public $Idstatus; // Cambiado de 'Idstatus' a 'Idstatus'
    public $PasswordE;
    public $CURPemp;
    public $RFC;
    public $CP;
    public $Calle;
    public $NoInterior;
    public $NoExt;
    public $Colonia;
    public $Cruzamiento;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Métodos setters
    public function setIdEmp($idEmple) { $this->idEmple = $idEmple; }
    public function setNombreEmp($NombreEmp) { $this->NombreEmp = $NombreEmp; }
    public function setIdstatus($Idstatus) { $this->Idstatus = $Idstatus; }
    public function setPasswordE($PasswordE) { $this->PasswordE = $PasswordE; }
    public function setCURPemp($CURPemp) { $this->CURPemp = $CURPemp; }
    public function setRFC($RFC) { $this->RFC = $RFC; }
    public function setCP($CP) { $this->CP = $CP; }
    public function setCalle($Calle) { $this->Calle = $Calle; }
    public function setNoInterior($NoInterior) { $this->NoInterior = $NoInterior; }
    public function setNoExt($NoExt) { $this->NoExt = $NoExt; }
    public function setColonia($Colonia) { $this->Colonia = $Colonia; }
    public function setCruzamiento($Cruzamiento) { $this->Cruzamiento = $Cruzamiento; }

    // Método para guardar un nuevo empleado
    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (NombreEmp, Idstatus, PasswordE, CURPemp, RFC, CP, Calle, NoInterior, NoExt, Colonia, Cruzamiento) VALUES (:NombreEmp, :Idstatus, :PasswordE, :CURPemp, :RFC, :CP, :Calle, :NoInterior, :NoExt, :Colonia, :Cruzamiento)";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreEmp = htmlspecialchars(strip_tags($this->NombreEmp));
        $this->Idstatus = htmlspecialchars(strip_tags($this->Idstatus));
        $this->PasswordE = htmlspecialchars(strip_tags($this->PasswordE));
        $this->CURPemp = htmlspecialchars(strip_tags($this->CURPemp));
        $this->RFC = htmlspecialchars(strip_tags($this->RFC));
        $this->CP = htmlspecialchars(strip_tags($this->CP));
        $this->Calle = htmlspecialchars(strip_tags($this->Calle));
        $this->NoInterior = htmlspecialchars(strip_tags($this->NoInterior));
        $this->NoExt = htmlspecialchars(strip_tags($this->NoExt));
        $this->Colonia = htmlspecialchars(strip_tags($this->Colonia));
        $this->Cruzamiento = htmlspecialchars(strip_tags($this->Cruzamiento));

        // Vinculación de parámetros
        $stmt->bindParam(':NombreEmp', $this->NombreEmp);
        $stmt->bindParam(':Idstatus', $this->Idstatus); // Cambiado de 'Idstatus' a 'Idstatus'
        $stmt->bindParam(':PasswordE', $this->PasswordE);
        $stmt->bindParam(':CURPemp', $this->CURPemp);
        $stmt->bindParam(':RFC', $this->RFC);
        $stmt->bindParam(':CP', $this->CP);
        $stmt->bindParam(':Calle', $this->Calle);
        $stmt->bindParam(':NoInterior', $this->NoInterior);
        $stmt->bindParam(':NoExt', $this->NoExt);
        $stmt->bindParam(':Colonia', $this->Colonia);
        $stmt->bindParam(':Cruzamiento', $this->Cruzamiento);

        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    // Método para actualizar un empleado existente
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET NombreEmp = :NombreEmp, Idstatus = :Idstatus, PasswordE = :PasswordE, CURPemp = :CURPemp, RFC = :RFC, CP = :CP, Calle = :Calle, NoInterior = :NoInterior, NoExt = :NoExt, Colonia = :Colonia, Cruzamiento = :Cruzamiento WHERE idEmple = :idEmple";

        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreEmp = htmlspecialchars(strip_tags($this->NombreEmp));
        $this->Idstatus = htmlspecialchars(strip_tags($this->Idstatus));
        $this->PasswordE = htmlspecialchars(strip_tags($this->PasswordE));
        $this->CURPemp = htmlspecialchars(strip_tags($this->CURPemp));
        $this->RFC = htmlspecialchars(strip_tags($this->RFC));
        $this->CP = htmlspecialchars(strip_tags($this->CP));
        $this->Calle = htmlspecialchars(strip_tags($this->Calle));
        $this->NoInterior = htmlspecialchars(strip_tags($this->NoInterior));
        $this->NoExt = htmlspecialchars(strip_tags($this->NoExt));
        $this->Colonia = htmlspecialchars(strip_tags($this->Colonia));
        $this->Cruzamiento = htmlspecialchars(strip_tags($this->Cruzamiento));

        // Vinculación de parámetros
        $stmt->bindParam(':idEmple', $this->idEmple);
        $stmt->bindParam(':NombreEmp', $this->NombreEmp);
        $stmt->bindParam(':Idstatus', $this->Idstatus); // Cambiado de 'Idstatus' a 'Idstatus'
        $stmt->bindParam(':PasswordE', $this->PasswordE);
        $stmt->bindParam(':CURPemp', $this->CURPemp);
        $stmt->bindParam(':RFC', $this->RFC);
        $stmt->bindParam(':CP', $this->CP);
        $stmt->bindParam(':Calle', $this->Calle);
        $stmt->bindParam(':NoInterior', $this->NoInterior);
        $stmt->bindParam(':NoExt', $this->NoExt);
        $stmt->bindParam(':Colonia', $this->Colonia);
        $stmt->bindParam(':Cruzamiento', $this->Cruzamiento);

        return $stmt->execute();
    }

    // Método para eliminar un empleado
    public function delete($idEmple) {
        $query = "DELETE FROM " . $this->table_name . " WHERE idEmple = :idEmple";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':idEmple', $idEmple);

        return $stmt->execute();
    }

    // Método para obtener un empleado por su ID
    public function obtenerEmpleadoPorId($idEmple) {
        $query = "SELECT e.*, s.NombreStatus FROM " . $this->table_name . " e LEFT JOIN statuse s ON e.Idstatus = s.Idstatus WHERE e.idEmple = :idEmple";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':idEmple', $idEmple);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para obtener todos los empleados
    public function obtenerEmpleados() {
        $query = "SELECT e.*, 
                    (SELECT COUNT(*) FROM recarga WHERE recarga.idEmpleado = e.idEmple) AS Recargas,
                    (SELECT COUNT(*) FROM cobro WHERE cobro.idEmpleado = e.idEmple) AS Cobros
                FROM empleado e";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para obtener los tipos de empleado
    public function obtenerTiposEmpleado() {
        $query = "SELECT Idstatus, NombreStatus FROM statuse";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
