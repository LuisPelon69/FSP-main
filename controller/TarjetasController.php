<?php
require_once 'model/ClientesModel.php';

class TarjetasController
{
    private $model;

    public function __construct()
    {
        $this->model = new ClientesModel();
    }

    public function index()
    {
        $monthlyEarnings = $this->model->getMonthlyEarnings();
        $annualEarnings = $this->model->getAnnualEarnings();
        $goalsCompletion = $this->model->getGoalsCompletion();
        $receivedEmails = $this->model->getReceivedEmails();

        include 'View/Header.php';
?>

        <!-- Wrapper para contenido y sidebar -->
        <div id="wrapper" class="d-flex">

            <!-- Sidebar -->
            <?php include 'View/Sidebar.php'; ?>

            <!-- Contenido principal -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">

                    <!-- Topbar -->
                    <?php include 'View/Topbar.php'; ?>

                    <!-- Contenido -->
                    <?php include 'View/ClientesVista.php'; ?>

                    <!-- Footer -->
                    <?php include 'View/Footer.php'; ?>

                </div>
                <!-- End of Content -->


            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Wrapper -->

<?php
        include 'View/Scripts.php';
    }
}

$controller = new TarjetasController();
$controller->index();
?>