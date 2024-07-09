<!--Aqui creo que solo cambie el link del php porque estabas llamando al dashboard, alch no me acuerdo si aqui lo cambie 
porque me estaba durmiendo pero en uno te confundite-->
<?php
require_once 'model/MenuGestionarModel.php';

class MenuGestionarController {
    private $model;

    public function __construct() {
        $this->model = new MenuGestionarModel();
    }

    public function index() {
        // Aquí puedes obtener datos del modelo si es necesario
        // $someData = $this->model->getSomeData();

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

                    <!-- Contenido de Menu-Gestionar -->
                    <?php include 'View/Menu-Gestionar.php'; ?>
                    
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

// Crear instancia del controlador y llamar al método index
$controller = new MenuGestionarController();
$controller->index();
?>
