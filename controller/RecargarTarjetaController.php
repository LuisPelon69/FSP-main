<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bd' . DIRECTORY_SEPARATOR . 'conex.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'RecargarTarjetaModel.php';

class RecargarTarjetaController {
    private $model;
    private $db;

    public function __construct() {
        $this->model = new RecargarTarjetaModel();
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index() {
        // Lógica para cargar la vista principal
        $monthlyEarnings = $this->model->getMonthlyEarnings();
        $annualEarnings = $this->model->getAnnualEarnings();
        $goalsCompletion = $this->model->getGoalsCompletion();
        $receivedEmails = $this->model->getReceivedEmails();
        
        include dirname(__DIR__) . '/view/Header.php';
?>
        <!-- Wrapper para contenido y sidebar -->
        <div id="wrapper" class="d-flex">

            <!-- Sidebar -->
            <?php include dirname(__DIR__) . '/view/Sidebar.php'; ?>

            <!-- Contenido principal -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">

                    <!-- Topbar -->
                    <?php include dirname(__DIR__) . '/view/Topbar.php'; ?>

                    <!-- Contenido -->
                    <?php include dirname(__DIR__) . '/view/RecargarTarjeta.php'; ?>
                    
                </div>
                <!-- End of Content -->

                <!-- Footer -->
                <?php include dirname(__DIR__) . '/view/Footer.php'; ?>
            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Wrapper -->
<?php
        include dirname(__DIR__) . '/view/Scripts.php';
    }

    public function recargarSaldo() {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $cliente = $_POST['cliente'];
                $cantidad = $_POST['cantidad'];

                // Obtener el saldo actual del cliente
                $query = "SELECT NombreClien, Saldo FROM cliente WHERE idClien = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(1, $cliente);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $response = array('status' => '', 'message' => '');

                if ($row) {
                    $nombre = $row['NombreClien'];
                    $saldo_actual = $row['Saldo'];
                    $nuevo_saldo = $saldo_actual + $cantidad;

                    // Actualizar el saldo del cliente
                    $query = "UPDATE cliente SET Saldo = ? WHERE idClien = ?";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(1, $nuevo_saldo);
                    $stmt->bindParam(2, $cliente);

                    if ($stmt->execute()) {
                        $response['status'] = 'success';
                        $response['message'] = 'Recarga realizada con éxito.';
                        $response['nombre'] = $nombre; // Incluye el nombre del cliente
                        $response['saldo'] = $nuevo_saldo; // Incluye el saldo actualizado
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Error al actualizar el saldo.';
                    }
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

    public function obtenerSaldo() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $clienteId = $_POST['clienteId'];
            
            // Obtener el saldo actual del cliente
            $query = "SELECT Saldo FROM cliente WHERE idClien = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $clienteId);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo json_encode(['status' => 'success', 'saldo' => $row['Saldo']]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Cliente no encontrado.']);
            }
        }
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
        }
    }
}

$controller = new RecargarTarjetaController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && $_POST['action'] === 'obtenerSaldo') {
        $controller->obtenerSaldo();
    } elseif (isset($_POST['action']) && $_POST['action'] === 'obtenerDatosCliente') {
        $controller->obtenerDatosCliente();
    } else {
        $controller->recargarSaldo();
    }
} else {
    $controller->index();
}
?>
