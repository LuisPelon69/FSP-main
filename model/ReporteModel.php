<?php
require_once '../bd/conex.php';

class ReporteModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function obtenerCobros()
    {
        $query = "SELECT 
                    cobro.idCobro,
                    CONCAT(cliente.NombreClien, ' ', cliente.ApellidoP, ' ', cliente.ApellidoM) AS NombreCliente,
                    empleado.NombreEmp AS NombreEmpleado,
                    cobro.FechaHoraC,
                    cobro.TotalCobro
                  FROM 
                    cobro
                  JOIN 
                    cliente ON cobro.idCliente = cliente.idClien
                  JOIN 
                    empleado ON cobro.idEmpleado = empleado.idEmple";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerLoteImpresion()
    {
        $query = "SELECT 
                    loimpresion.idLoteIm,
                    CONCAT(cliente.NombreClien, ' ', cliente.ApellidoP, ' ', cliente.ApellidoM) AS NombreCliente,
                    empleado.NombreEmp AS NombreEmpleado,
                    tamañopapel.NombreTam AS NombreTamano,
                    tipopapel.NombreTipoP AS NombreTipoPapel,
                    tipoimpresion.NombreTipoI AS NombreTipoImpresion,
                    loimpresion.idCobro,
                    loimpresion.CantHojas,
                    loimpresion.DuplexBool,
                    loimpresion.CostoLote
                  FROM 
                    loimpresion
                  JOIN 
                    cobro ON loimpresion.idCobro = cobro.idCobro
                  JOIN 
                    cliente ON cobro.idCliente = cliente.idClien
                  JOIN 
                    empleado ON cobro.idEmpleado = empleado.idEmple
                  JOIN 
                    tamañopapel ON loimpresion.idTamano = tamañopapel.ideTamaño
                  JOIN 
                    tipopapel ON loimpresion.idTipoP = tipopapel.ideTipoP
                  JOIN 
                    tipoimpresion ON loimpresion.idTipoI = tipoimpresion.ideTipoI";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerRecargas()
    {
        $query = "SELECT 
            recarga.FoRecarga,
            CONCAT(cliente.NombreClien, ' ', cliente.ApellidoP, ' ', cliente.ApellidoM) AS NombreCliente,
            empleado.NombreEmp AS NombreEmpleado,
            recarga.FechaHoraR,
            recarga.ValorR
          FROM 
            recarga
          JOIN 
            cliente ON recarga.idCliente = cliente.idClien
          JOIN 
            empleado ON recarga.idEmpleado = empleado.idEmple";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerLogins()
    {
        $query = "SELECT 
            empleado.NombreEmp AS NombreEmpleado,
            registrologin.FechaHoraLog
            FROM 
            registrologin
            JOIN 
            empleado ON registrologin.idEmpleado = empleado.idEmple";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
