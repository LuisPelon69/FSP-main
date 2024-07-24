<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bd' . DIRECTORY_SEPARATOR . 'conex.php';

class CobrosQRController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function obtenerDatosCliente() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $clienteId = $_POST['clienteId'];

            // Obtener los datos del cliente
            $query = "SELECT NombreClien, Saldo FROM cliente WHERE idClien = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $clienteId);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo json_encode(['status' => 'success', 'nombre' => $row['NombreClien'], 'saldo' => $row['Saldo']]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Cliente no encontrado.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
        }
    }
}

// Crear una instancia del controlador y llamar a la función correspondiente
$controller = new CobrosQRController();
$controller->obtenerDatosCliente();
?>
