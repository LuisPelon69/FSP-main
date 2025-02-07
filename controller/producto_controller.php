<?php
require_once '../bd/conex.php';
require_once '../model/TamañoPapelModel.php';
require_once '../model/TipoPapelModel.php';
require_once '../model/TipoImpresionModel.php';

$method = $_SERVER['REQUEST_METHOD']; // Obtener el método HTTP de la solicitud

header('Content-Type: application/json; charset=UTF-8'); // Establecer el tipo de contenido de la respuesta como JSON

try {
    $tipo = $_GET['tipo'] ?? ''; // Obtener el tipo de entidad a manipular (tamañoPapel, tipoPapel, tipoImpresion)

    // Seleccionar el modelo correspondiente según el tipo de entidad
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

    // Manejar las solicitudes GET
    if ($method === 'GET') {
        error_log('Datos recibidos (GET): ' . print_r($_GET, true));

        if (isset($_GET['id'])) {
            // Obtener un registro específico por ID
            $id = $_GET['id'];
            $data = $model->obtenerPorId($id);
            echo json_encode($data);
        } else {
            // Obtener todos los registros
            $data = $model->obtenerTodos();
            echo json_encode($data);
        }
    }
    // Manejar las solicitudes POST
    elseif ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true); // Decodificar el JSON recibido en el cuerpo de la solicitud

        // Validar y asignar datos para cada tipo de entidad
        if ($tipo === 'tamañoPapel') {
            if (!isset($data['NombreTam']) || !isset($data['PreciopUTaP'])) {
                echo json_encode(['error' => 'Datos incompletos para crear el registro']);
                exit;
            }
            $model->setNombreTam($data['NombreTam']);
            $model->setPreciopUTaP($data['PreciopUTaP']);
        } elseif ($tipo === 'tipoPapel') {
            if (!isset($data['NombreTipoP']) || !isset($data['PreciopUTiP'])) {
                echo json_encode(['error' => 'Datos incompletos para crear el registro']);
                exit;
            }
            $model->setNombreTipoP($data['NombreTipoP']);
            $model->setPreciopUTiP($data['PreciopUTiP']);
        } elseif ($tipo === 'tipoImpresion') {
            if (!isset($data['NombreTipoI']) || !isset($data['PreciopUTiI'])) {
                echo json_encode(['error' => 'Datos incompletos para crear el registro']);
                exit;
            }
            $model->setNombreTipoI($data['NombreTipoI']);
            $model->setPreciopUTiI($data['PreciopUTiI']);
        }

        // Guardar el nuevo registro en la base de datos
        if ($model->save()) {
            echo json_encode(['success' => 'Registro creado exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al crear el registro']);
        }
    }
    // Manejar las solicitudes PUT
    elseif ($method === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true); // Decodificar el JSON recibido en el cuerpo de la solicitud

        // Validar y asignar datos para cada tipo de entidad
        if (!isset($data['id']) || !isset($data['Nombre']) || !isset($data['PrecioUnitario'])) {
            echo json_encode(['error' => 'Datos incompletos para actualizar el registro']);
            exit;
        }

        if ($tipo === 'tamañoPapel') {
            $model->setideTamaño($data['id']);
            $model->setNombreTam($data['Nombre']);
            $model->setPreciopUTaP($data['PrecioUnitario']);
        } elseif ($tipo === 'tipoPapel') {
            $model->setideTipoP($data['id']);
            $model->setNombreTipoP($data['Nombre']);
            $model->setPreciopUTiP($data['PrecioUnitario']);
        } elseif ($tipo === 'tipoImpresion') {
            $model->setideTipoI($data['id']);
            $model->setNombreTipoI($data['Nombre']);
            $model->setPreciopUTiI($data['PrecioUnitario']);
        }

        // Actualizar el registro en la base de datos
        if ($model->update()) {
            echo json_encode(['success' => 'Registro actualizado exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al actualizar el registro']);
        }
    }
    // Manejar las solicitudes DELETE
    elseif ($method === 'DELETE') {
        $data = json_decode(file_get_contents('php://input'), true); // Decodificar el JSON recibido en el cuerpo de la solicitud

        if (!isset($data['ids'])) {
            echo json_encode(['error' => 'IDs no proporcionados']);
            exit;
        }

        $success = true;

        // Eliminar cada registro especificado por ID
        foreach ($data['ids'] as $id) {
            if (!$model->delete($id)) {
                $success = false;
                break;
            }
        }

        if ($success) {
            echo json_encode(['success' => 'Registros eliminados exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al eliminar los registros. Por favor, intenta nuevamente.']);
        }
    }
    // Manejar otros métodos HTTP no permitidos
    else {
        echo json_encode(['error' => 'Método no permitido']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => 'Error del servidor: ' . $e->getMessage()]);
}
?>
