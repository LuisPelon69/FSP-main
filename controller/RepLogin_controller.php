<?php
require_once '../bd/conex.php';
require_once '../model/RepLogin_Model.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

$repLoginModel = new RepLoginModel();

switch ($method) {
    case 'GET':
        if (isset($_GET['NombreEmp']) && isset($_GET['FechaHoraLog'])) {
            $NombreEmp = $_GET['NombreEmp']; // Aseguramos de que se maneje correctamente el NombreEmp
            $FechaHoraLog = $_GET['FechaHoraLog'];
            $login = $repLoginModel->obtenerLoginPorId($NombreEmp, $FechaHoraLog);
            if ($login) {
                echo json_encode($login);
            } else {
                echo json_encode(['error' => 'Login no encontrado']);
            }
        } else {
            $logins = $repLoginModel->obtenerLogins();
            echo json_encode($logins);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        $repLoginModel->setNombreEmp($data['NombreEmp']);
        $repLoginModel->setFechaHoraLog($data['FechaHoraLog']);

        if ($repLoginModel->save()) {
            echo json_encode(['message' => 'Login creado exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al crear el login']);
        }
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);

        $repLoginModel->setNombreEmp($data['NombreEmp']);
        $repLoginModel->setFechaHoraLog($data['FechaHoraLog']);

        if ($repLoginModel->update()) {
            echo json_encode(['message' => 'Login actualizado exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al actualizar el login']);
        }
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $NombreEmp = $data['NombreEmp'];
        $FechaHoraLog = $data['FechaHoraLog'];

        if ($repLoginModel->delete($NombreEmp, $FechaHoraLog)) {
            echo json_encode(['message' => 'Login eliminado exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al eliminar el login']);
        }
        break;
    default:
        echo json_encode(['error' => 'Método no soportado']);
        break;
}
?>
