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
        $monthlyEarnings = $this->model->getMonthlyEarnings();
        $annualEarnings = $this->model->getAnnualEarnings();
        $goalsCompletion = $this->model->getGoalsCompletion();
        $receivedEmails = $this->model->getReceivedEmails();
        
        include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'Header.php';
?>

        <!-- Wrapper para contenido y sidebar -->
        <div id="wrapper" class="d-flex">

            <!-- Sidebar -->
            <?php include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'Sidebar.php'; ?>

            <!-- Contenido principal -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">

                    <!-- Topbar -->
                    <?php include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'Topbar.php'; ?>

                    <!-- Contenido -->
                    <?php include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'RecargarTarjeta.php'; ?>
                    
                </div>
                <!-- End of Content -->

                <!-- Footer -->
                <?php include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'Footer.php'; ?>
            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Wrapper -->

<?php
        include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'Scripts.php';
    }

    public function recargarSaldo() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $cliente = $_POST['cliente'];
            $cantidad = $_POST['cantidad'];

            // Obtener el saldo actual del cliente
            $query = "SELECT Saldo FROM cliente WHERE NombreClien = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $cliente);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $response = array('status' => '', 'message' => '');

            if ($row) {
                $saldo_actual = $row['Saldo'];
                $nuevo_saldo = $saldo_actual + $cantidad;

                // Actualizar el saldo del cliente
                $query = "UPDATE cliente SET Saldo = ? WHERE NombreClien = ?";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(1, $nuevo_saldo);
                $stmt->bindParam(2, $cliente);

                if ($stmt->execute()) {
                    $response['status'] = 'success';
                    $response['message'] = 'Recarga realizada con éxito.';
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
    }
}

$controller = new RecargarTarjetaController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->recargarSaldo();
} else {
    $controller->index();
}
?>
