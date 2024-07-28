<?php
require_once '../bd/conex.php';
require_once '../model/Cobro_Model2.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

$cobroModel = new CobroModel();

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $cobro = $cobroModel->obtenerCobroPorId($id);
            if ($cobro) {
                echo json_encode($cobro);
            } else {
                echo json_encode(['error' => 'Cobro no encontrado']);
            }
        } else {
            $cobros = $cobroModel->obtenerCobros();
            echo json_encode($cobros);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        $cobroModel->setIdCliente($data['idCliente']);
        $cobroModel->setIdEmpleado($data['idEmpleado']);
        $cobroModel->setFechaHoraC($data['FechaHoraC']);
        $cobroModel->setTotalCobro($data['TotalCobro']);

        if ($cobroModel->save()) {
            echo json_encode(['message' => 'Cobro creado exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al crear el cobro']);
        }
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);

        $cobroModel->setIdCobro($data['idCobro']);
        $cobroModel->setIdCliente($data['idCliente']);
        $cobroModel->setIdEmpleado($data['idEmpleado']);
        $cobroModel->setFechaHoraC($data['FechaHoraC']);
        $cobroModel->setTotalCobro($data['TotalCobro']);

        if ($cobroModel->update()) {
            echo json_encode(['message' => 'Cobro actualizado exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al actualizar el cobro']);
        }
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];

        if ($cobroModel->delete($id)) {
            echo json_encode(['message' => 'Cobro eliminado exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al eliminar el cobro']);
        }
        break;
    default:
        echo json_encode(['error' => 'Método no soportado']);
        break;
}
?>
