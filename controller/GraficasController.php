<?php
require_once 'model/GraficasModel.php';

class GraficasController {
    private $model;

    public function __construct() {
        $this->model = new GraficasModel();
    }

    public function index() {
        $reportsData = $this->model->getReportsData();
        
        include 'View/Header.php';
?>

        <!-- Wrapper for content and sidebar -->
        <div id="wrapper" class="d-flex">

            <!-- Sidebar -->
            <?php include 'View/Sidebar.php'; ?>

            <!-- Main content -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">

                    <!-- Topbar -->
                    <?php include 'View/Topbar.php'; ?>

                    <!-- Content -->
                    <?php include 'View/charts.php'; ?>
                    
                </div>
                <!-- End of Content -->

                <!-- Footer -->
                <?php include 'View/Footer.php'; ?>
            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Wrapper -->

<?php
        include 'View/Scripts.php';
    }
}

$controller = new GraficasController();
$controller->index();
?>
