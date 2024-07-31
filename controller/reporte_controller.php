<?php
require_once '../bd/conex.php';
require_once '../model/ReporteModel.php';

header('Content-Type: application/json; charset=UTF-8');

try {
    $tipo = $_GET['tipo'] ?? '';

    $model = new ReporteModel();

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        error_log('Datos recibidos (GET): ' . print_r($_GET, true));
        switch ($tipo) {
            case 'cobros':
                $data = $model->obtenerCobros();
                break;
            case 'loteImpresion':
                $data = $model->obtenerLoteImpresion();
                break;
            case 'recargas':
                $data = $model->obtenerRecargas();
                break;
            case 'logins':
                $data = $model->obtenerLogins();
                break;
            default:
                echo json_encode(['error' => 'Tipo no especificado o incorrecto']);
                exit;
        }
        echo json_encode($data);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
