<?php
require_once 'MVC_MODELO/AgregarProductoModel.php';

class AgregarProductoController {
    private $model;

    public function __construct() {
        $this->model = new AgregarProductoModel();
    }

    public function index() {
        $monthlyEarnings = $this->model->getMonthlyEarnings();
        $annualEarnings = $this->model->getAnnualEarnings();
        $goalsCompletion = $this->model->getGoalsCompletion();
        $receivedEmails = $this->model->getReceivedEmails();
        
        include 'MVC_VISTAS/Header.php';
?>

        <!-- Wrapper para contenido y sidebar -->
        <div id="wrapper" class="d-flex">

            <!-- Sidebar -->
            <?php include 'MVC_VISTAS/Sidebar.php'; ?>

            <!-- Contenido principal -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">

                    <!-- Topbar -->
                    <?php include 'MVC_VISTAS/Topbar.php'; ?>

                    <!-- Contenido -->
                    <?php include 'MVC_VISTAS/AgregarProducto.php'; ?>
                    
                </div>
                <!-- End of Content -->

                <!-- Footer -->
                <?php include 'MVC_VISTAS/Footer.php'; ?>
            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Wrapper -->

<?php
        include 'MVC_VISTAS/Scripts.php';
    }
}

$controller = new AgregarProductoController();
$controller->index();
?>

