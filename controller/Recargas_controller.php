<?php
require_once '../bd/conex.php';
require_once '../model/Recargas_Model.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

$recargasModel = new RecargasModel();

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $recarga = $recargasModel->obtenerRecargaPorId($id);
            if ($recarga) {
                echo json_encode($recarga);
            } else {
                echo json_encode(['error' => 'Recarga no encontrada']);
            }
        } else {
            $recargas = $recargasModel->obtenerRecargas();
            echo json_encode($recargas);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        $recargasModel->setIdCliente($data['idCliente']);
        $recargasModel->setIdEmpleado($data['idEmpleado']);
        $recargasModel->setFechaHoraR($data['FechaHoraR']);
        $recargasModel->setValorR($data['ValorR']);

        if ($recargasModel->save()) {
            echo json_encode(['message' => 'Recarga creada exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al crear la recarga']);
        }
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);

        $recargasModel->setFoRecarga($data['FoRecarga']);
        $recargasModel->setIdCliente($data['idCliente']);
        $recargasModel->setIdEmpleado($data['idEmpleado']);
        $recargasModel->setFechaHoraR($data['FechaHoraR']);
        $recargasModel->setValorR($data['ValorR']);

        if ($recargasModel->update()) {
            echo json_encode(['message' => 'Recarga actualizada exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al actualizar la recarga']);
        }
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];

        if ($recargasModel->delete($id)) {
            echo json_encode(['message' => 'Recarga eliminada exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al eliminar la recarga']);
        }
        break;
    default:
        echo json_encode(['error' => 'Método no soportado']);
        break;
}
?>
