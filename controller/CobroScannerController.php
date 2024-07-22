<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bd' . DIRECTORY_SEPARATOR . 'conex.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'ClienteModel.php';

class CobroScannerController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function obtenerDatosCliente() {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $clienteId = $_POST['clienteId'];

                // Obtener los datos del cliente
                $query = "SELECT NombreClien, Saldo FROM cliente WHERE idClien = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(1, $clienteId);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $response = array('status' => '', 'nombre' => '', 'saldo' => '');

                if ($row) {
                    $response['status'] = 'success';
                    $response['nombre'] = $row['NombreClien'];
                    $response['saldo'] = $row['Saldo'];
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Cliente no encontrado.';
                }

                echo json_encode($response);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
}

// Instancia del controlador
$controller = new CobroScannerController();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'obtenerDatosCliente') {
    $controller->obtenerDatosCliente();
}
?>
