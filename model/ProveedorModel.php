<?php
require_once '../bd/conex.php';

class ProveedorModel {
    private $conn;
    private $table_name = "proveedores";
    
    public $idProveedor;
    public $NombreProveedor;
    public $Telefono;
    public $Correo;
    public $CodigoPostal;
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
    public function setidProveedor($idProveedor) { $this->idProveedor = $idProveedor; }
    public function setNombreProveedor($NombreProveedor) { $this->NombreProveedor = $NombreProveedor; }
    public function setTelefono($Telefono) { $this->Telefono = $Telefono; }
    public function setCorreo($Correo) { $this->Correo = $Correo; }
    public function setCodigoPostal($CodigoPostal) { $this->CodigoPostal = $CodigoPostal; }
    public function setCalle($Calle) { $this->Calle = $Calle; }
    public function setNoInterior($NoInterior) { $this->NoInterior = $NoInterior; }
    public function setNoExt($NoExt) { $this->NoExt = $NoExt; }
    public function setColonia($Colonia) { $this->Colonia = $Colonia; }
    public function setCruzamiento($Cruzamiento) { $this->Cruzamiento = $Cruzamiento; }
    

    // Método para guardar un nuevo Proveedor
    public function save() {
        $query = "INSERT INTO " . $this->table_name . " (NombreProveedor, Telefono, Correo, CodigoPostal, Calle, NoInterior, NoExt, Colonia, Cruzamiento) VALUES (:NombreProveedor, :Telefono, :Correo, :CodigoPostal, :Calle, :NoInterior, :NoExt, :Colonia, :Cruzamiento)";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de datos
        $this->NombreProveedor = htmlspecialchars(strip_tags($this->NombreProveedor));
        $this->Telefono = htmlspecialchars(strip_tags($this->Telefono));
        $this->Correo = htmlspecialchars(strip_tags($this->Correo));
        $this->CodigoPostal = htmlspecialchars(strip_tags($this->CodigoPostal));
        $this->Calle = htmlspecialchars(strip_tags($this->Calle));
        $this->NoInterior = htmlspecialchars(strip_tags($this->NoInterior));
        $this->NoExt = htmlspecialchars(strip_tags($this->NoExt));
        $this->Colonia = htmlspecialchars(strip_tags($this->Colonia));
        $this->Cruzamiento = htmlspecialchars(strip_tags($this->Cruzamiento));

        // Vinculación de parámetros
        $stmt->bindParam(':NombreProveedor', $this->NombreProveedor);
        $stmt->bindParam(':Telefono', $this->Telefono);
        $stmt->bindParam(':Correo', $this->Correo);
        $stmt->bindParam(':CodigoPostal', $this->CodigoPostal);
        $stmt->bindParam(':Calle', $this->Calle);
        $stmt->bindParam(':NoInterior', $this->NoInterior);
        $stmt->bindParam(':NoExt', $this->NoExt);
        $stmt->bindParam(':Colonia', $this->Colonia);
        $stmt->bindParam(':Cruzamiento', $this->Cruzamiento);

        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            error_log("Error al guardar el Proveedor: " . $errorInfo[2]);
            return false;
        }
    }

    // Método para actualizar un Proveedor existente
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET NombreProveedor = :NombreProveedor, 
                      Telefono = :Telefono, 
                      Correo = :Correo, 
                      CodigoPostal = :CodigoPostal, 
                      Calle = :Calle, 
                      NoInterior = :NoInterior, 
                      NoExt = :NoExt, 
                      Colonia = :Colonia, 
                      Cruzamiento = :Cruzamiento 
                  WHERE idProveedor = :idProveedor";
    
        $stmt = $this->conn->prepare($query);
    
        // Limpieza de datos
        $this->NombreProveedor = htmlspecialchars(strip_tags($this->NombreProveedor));
        $this->Telefono = htmlspecialchars(strip_tags($this->Telefono));
        $this->Correo = htmlspecialchars(strip_tags($this->Correo));
        $this->CodigoPostal = htmlspecialchars(strip_tags($this->CodigoPostal));
        $this->Calle = htmlspecialchars(strip_tags($this->Calle));
        $this->NoInterior = htmlspecialchars(strip_tags($this->NoInterior));
        $this->NoExt = htmlspecialchars(strip_tags($this->NoExt));
        $this->Colonia = htmlspecialchars(strip_tags($this->Colonia));
        $this->Cruzamiento = htmlspecialchars(strip_tags($this->Cruzamiento));
    
        // Vinculación de parámetros
        $stmt->bindParam(':idProveedor', $this->idProveedor);
        $stmt->bindParam(':NombreProveedor', $this->NombreProveedor);
        $stmt->bindParam(':Telefono', $this->Telefono);
        $stmt->bindParam(':Correo', $this->Correo);
        $stmt->bindParam(':CodigoPostal', $this->CodigoPostal);
        $stmt->bindParam(':Calle', $this->Calle);
        $stmt->bindParam(':NoInterior', $this->NoInterior);
        $stmt->bindParam(':NoExt', $this->NoExt);
        $stmt->bindParam(':Colonia', $this->Colonia);
        $stmt->bindParam(':Cruzamiento', $this->Cruzamiento);
    
        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            error_log("Error al actualizar el Proveedor: " . $errorInfo[2]);
            return false;
        }
    }
    

    // Método para eliminar un Proveedor
    public function delete($idProveedor) {
        $query = "DELETE FROM " . $this->table_name . " WHERE idProveedor = :idProveedor";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':idProveedor', $idProveedor);

        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            error_log("Error al eliminar el Proveedor: " . $errorInfo[2]);
            return false;
        }
    }

    // Método para obtener un Proveedor por su ID
    public function obtenerProveedorPorId($idProveedor) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE idProveedor = :idProveedor";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idProveedor', $idProveedor);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Método para obtener todos los Proveedores
    public function obtenerProveedores() {
        $query = "SELECT p.*, 
                    (SELECT COUNT(*) FROM recarga WHERE recarga.idProveedor = p.idProveedor) AS Recargas,
                    (SELECT COUNT(*) FROM cobro WHERE cobro.idProveedor = p.idProveedor) AS Cobros
                FROM " . $this->table_name . " p";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>


