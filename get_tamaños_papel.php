<?php
require_once '../bd/conex.php';
require_once '../model/TamañoPapelModel.php';

try {
    $tamañoPapel = new TamañoPapelModel();
    $tamañosPapel = $tamañoPapel->obtenerTamañosPapel();
    echo json_encode($tamañosPapel);
} catch (Exception $e) {
    error_log('Error al obtener tamaños de papel: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error al obtener tamaños de papel']);
}
?>