<?php
require_once 'model/CobroModel.php';

class CobroController {
    private $model;

    public function __construct() {
        $this->model = new CobroModel();
    }

    public function index() {
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
                    <?php include 'View/cobros.php'; ?>
                    
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

    public function getPaperProperties() {
        $tamañosPapel = $this->model->getTamañosPapel();
        $tiposPapel = $this->model->getTiposPapel();
        $tiposImpresion = $this->model->getTiposImpresion();

        header('Content-Type: application/json');
        echo json_encode([
            'tamañosPapel' => $tamañosPapel,
            'tiposPapel' => $tiposPapel,
            'tiposImpresion' => $tiposImpresion
        ]);
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'getPaperProperties') {
    $controller = new CobroController();
    $controller->getPaperProperties();
} else {
    $controller = new CobroController();
    $controller->index();
}
?>
