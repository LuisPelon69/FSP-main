<?php
require_once 'MVC_MODELO/MenuGestionarModel.php';

class MenuGestionarController {
    private $model;

    public function __construct() {
        $this->model = new MenuGestionarModel();
    }

    public function index() {
        // Aquí puedes obtener datos del modelo si es necesario
        // $someData = $this->model->getSomeData();

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

                    <!-- Contenido de Menu-Gestionar -->
                    <?php include 'MVC_VISTAS/Menu-Gestionar.php'; ?>
                    
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

// Crear instancia del controlador y llamar al método index
$controller = new MenuGestionarController();
$controller->index();
?>
