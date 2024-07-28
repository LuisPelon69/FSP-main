<?php
require_once '../bd/conex.php';
require_once '../model/Loteimpresion_Model.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

$loteImpresionModel = new LoteimpresionModel();

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $loteImpresion = $loteImpresionModel->obtenerLoteImpresionPorId($id);
            if ($loteImpresion) {
                echo json_encode($loteImpresion);
            } else {
                echo json_encode(['error' => 'Lote de impresión no encontrado']);
            }
        } else {
            $loteImpresiones = $loteImpresionModel->obtenerLoteImpresiones();
            echo json_encode($loteImpresiones);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        $loteImpresionModel->setIdCobro($data['idCobro']);
        $loteImpresionModel->setIdTamaño($data['idTamaño']);
        $loteImpresionModel->setIdTipoP($data['idTipoP']);
        $loteImpresionModel->setIdTipoI($data['idTipoI']);
        $loteImpresionModel->setCantHojas($data['CantHojas']);
        $loteImpresionModel->setDuplexBool($data['DuplexBool']);
        $loteImpresionModel->setCostoLote($data['CostoLote']);

        if ($loteImpresionModel->save()) {
            echo json_encode(['message' => 'Lote de impresión creado exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al crear el lote de impresión']);
        }
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);

        $loteImpresionModel->setIdLoteIm($data['idLoteIm']);
        $loteImpresionModel->setIdCobro($data['idCobro']);
        $loteImpresionModel->setIdTamaño($data['idTamaño']);
        $loteImpresionModel->setIdTipoP($data['idTipoP']);
        $loteImpresionModel->setIdTipoI($data['idTipoI']);
        $loteImpresionModel->setCantHojas($data['CantHojas']);
        $loteImpresionModel->setDuplexBool($data['DuplexBool']);
        $loteImpresionModel->setCostoLote($data['CostoLote']);

        if ($loteImpresionModel->update()) {
            echo json_encode(['message' => 'Lote de impresión actualizado exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al actualizar el lote de impresión']);
        }
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];

        if ($loteImpresionModel->delete($id)) {
            echo json_encode(['message' => 'Lote de impresión eliminado exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al eliminar el lote de impresión']);
        }
        break;
    default:
        echo json_encode(['error' => 'Método no soportado']);
        break;
}
?>
