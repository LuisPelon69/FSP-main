<?php
require_once '../model/TamañoPModel.php';
require_once '../bd/conex.php';

class TamañoPController {
    private $model;

    public function __construct() {
        $this->model = new TamañoPModel();
    }

    public function mostrarTamañosPapel() {
        $tamañosPapel = $this->model->obtenerTamañosPapel();
        foreach ($tamañosPapel as $tamaño) {
            echo "ID: " . $tamaño['id'] . " - Tamaño: " . $tamaño['nombre'] . "<br>";
        }
    }
}

// Ejemplo de uso
$controller = new TamañoPController();
$controller->mostrarTamañosPapel();
?>