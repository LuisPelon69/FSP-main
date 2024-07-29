// Guardar como Graficas_Controller.php en /controller
<?php
require_once '../model/Graficas_Model.php';

class Graficas_Controller {
    private $model;

    public function __construct() {
        $this->model = new Graficas_Model();
    }

    public function index() {
        header('Content-Type: application/json');
        $data = $this->model->getCobrosMensuales();
        $labels = array_column($data, 'mes');
        $values = array_column($data, 'total');
        echo json_encode(['labels' => $labels, 'values' => $values]);
    }
}

// Nota: No se instancia ni se llama al controlador aquí.

?>
