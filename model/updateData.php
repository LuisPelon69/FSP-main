<?php
include_once 'PaperConsumption.php';
include_once 'InkConsumption.php';

$response = array('status' => 'error', 'message' => 'Operación no realizada.');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataType = isset($_POST['dataType']) ? $_POST['dataType'] : '';
    $dataValue = isset($_POST['dataValue']) ? (int)$_POST['dataValue'] : 0;

    if ($dataType && $dataValue > 0) {
        try {
            if ($dataType === 'paper') {
                $paper = new PaperConsumption();
                $result = $paper->create($dataValue);
            } else {
                $ink = new InkConsumption();
                $result = $ink->create($dataValue);
            }

            if ($result) {
                $response = array('status' => 'success', 'message' => 'Datos actualizados correctamente.');
            } else {
                $response = array('status' => 'error', 'message' => 'Error al actualizar los datos.');
            }
        } catch (Exception $e) {
            $response = array('status' => 'error', 'message' => 'Excepción: ' . $e->getMessage());
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Datos inválidos.');
    }

    echo json_encode($response);
}

// Para obtener datos
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $dataType = isset($_GET['dataType']) ? $_GET['dataType'] : '';

    if ($dataType === 'paper') {
        $paper = new PaperConsumption();
        $stmt = $paper->getAll();
    } else {
        $ink = new InkConsumption();
        $stmt = $ink->getAll();
    }

    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row['value'];
    }

    echo json_encode($data);
}
?>
