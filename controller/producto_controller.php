<?php
require_once '../bd/conex.php';
require_once '../model/TamañoPapelModel.php';
require_once '../model/TipoPapelModel.php';
require_once '../model/TipoImpresionModel.php';

$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json; charset=UTF-8');

try {
    $tipo = $_GET['tipo'] ?? '';

    switch ($tipo) {
        case 'tamañoPapel':
            $model = new TamañoPapelModel();
            break;
        case 'tipoPapel':
            $model = new TipoPapelModel();
            break;
        case 'tipoImpresion':
            $model = new TipoImpresionModel();
            break;
        default:
            echo json_encode(['error' => 'Tipo no especificado o incorrecto']);
            exit;
    }

    if ($method === 'GET') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $data = $model->obtenerPorId($id);
            echo json_encode($data);
        } else {
            $data = $model->obtenerTodos();
            echo json_encode($data);
        }
    } elseif ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        // Verificación y asignación de valores en POST
        if (!isset($data['Nombre'], $data['PrecioUnitario'], $data['FechaUltimaModificacion'])) {
            echo json_encode(['error' => 'Datos incompletos para crear el registro']);
            exit;
        }

        if ($tipo === 'tamañoPapel') {
            $model->setNombreTam($data['Nombre']);
            $model->setPreciopUTaP($data['PrecioUnitario']);
            //$model->setFechaUlModi($data['FechaUltimaModificacion']);
        } elseif ($tipo === 'tipoPapel') {
            $model->setNombreTipoP($data['Nombre']);
            $model->setPreciopUTiP($data['PrecioUnitario']);
            //$model->setFechaUlModi($data['FechaUltimaModificacion']);
        } elseif ($tipo === 'tipoImpresion') {
            $model->setNombreTipoI($data['Nombre']);
            $model->setPreciopUTiI($data['PrecioUnitario']);
            //$model->setFechaUlModi($data['FechaUltimaModificacion']);
        }

        $response = [];

        if ($model->save()) {
            $response['success'] = true;
            $response['message'] = 'Registro creado exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al crear el registro. Por favor, verifica los datos e intenta nuevamente.';
        }

        echo json_encode($response);

    } elseif ($method === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);

        // Verificación y asignación de valores en PUT
        if (!isset($data['id'], $data['Nombre'], $data['PrecioUnitario'], $data['FechaUltimaModificacion'])) {
            echo json_encode(['error' => 'Datos incompletos para actualizar el registro']);
            exit;
        }

        if ($tipo === 'tamañoPapel') {
            $model->setideTamaño($data['id']);
            $model->setNombreTam($data['Nombre']);
            $model->setPreciopUTaP($data['PrecioUnitario']);
            //$model->setFechaUlModi($data['FechaUltimaModificacion']);
        } elseif ($tipo === 'tipoPapel') {
            $model->setideTipoP($data['id']);
            $model->setNombreTipoP($data['Nombre']);
            $model->setPreciopUTiP($data['PrecioUnitario']);
            //$model->setFechaUlModi($data['FechaUltimaModificacion']);

        } elseif ($tipo === 'tipoImpresion') {
            $model->setideTipoI($data['id']);
            $model->setNombreTipoI($data['Nombre']);
            $model->setPreciopUTiI($data['PrecioUnitario']);
            //$model->setFechaUlModi($data['FechaUltimaModificacion']);
        }

        $response = [];

        if ($model->update()) {
            $response['success'] = true;
            $response['message'] = 'Registro actualizado exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al actualizar el registro. Por favor, verifica los datos e intenta nuevamente.';
        }

        echo json_encode($response);

    } elseif ($method === 'DELETE') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['ids'])) {
            echo json_encode(['error' => 'IDs no proporcionados']);
            exit;
        }

        $response = [];
        $success = true;

        foreach ($data['ids'] as $id) {
            if (!$model->delete($id)) {
                $success = false;
                break;
            }
        }

        if ($success) {
            $response['success'] = true;
            $response['message'] = 'Registros eliminados exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al eliminar los registros. Por favor, intenta nuevamente.';
        }

        echo json_encode($response);

    } else {
        echo json_encode(['error' => 'Método no permitido']);
    }

} catch (Exception $e) {
    echo json_encode(['error' => 'Error del servidor: ' . $e->getMessage()]);
}
?>
