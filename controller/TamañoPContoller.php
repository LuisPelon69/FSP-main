<?php
require_once '../bd/conex.php';
require_once '../model/TamañoPapelModel.php';

$method = $_SERVER['REQUEST_METHOD'];

try {
    error_log('Método de solicitud: ' . $method); // Registro del método de solicitud

    if ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        error_log('Datos recibidos (POST): ' . print_r($data, true)); // Registro de los datos recibidos

        if (!isset($data['NombreTam'], $data['PreciopUTaP'], $data['FechaUlModi'], $data['Proveedor'])) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos para crear el tamaño de papel']);
            exit;
        }

        $tamañoPapel = new TamañoPapelModel();
        $tamañoPapel->setNombreTam($data['NombreTam']);
        $tamañoPapel->setPreciopUTaP($data['PreciopUTaP']);
        $tamañoPapel->setFechaUlModi($data['FechaUlModi']);
        $tamañoPapel->setProveedor($data['Proveedor']);

        $response = [];

        if ($tamañoPapel->save()) {
            $response['success'] = true;
            $response['message'] = 'Tamaño de papel creado exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al crear el tamaño de papel';
        }

        echo json_encode($response);

    } elseif ($method === 'GET') {
        $tamañoPapel = new TamañoPapelModel();
        error_log('Datos recibidos (GET): ' . print_r($_GET, true)); // Registro de los datos recibidos por GET
    
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $tamañoPapelData = $tamañoPapel->obtenerTamañoPapelPorId($id);
            echo json_encode($tamañoPapelData);
    
        } else {
            $tamañosPapel = $tamañoPapel->obtenerTamañosPapel();
            echo json_encode($tamañosPapel);
        }
    } elseif ($method === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);
        error_log('Datos recibidos (PUT): ' . print_r($data, true)); // Registro de los datos recibidos
    
        if (!isset($data['NombreTam'], $data['PreciopUTaP'], $data['FechaUlModi'], $data['Proveedor'], $data['ideTamaño'])) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos para actualizar el tamaño de papel']);
            exit;
        }
    
        $tamañoPapel = new TamañoPapelModel();
        $tamañoPapel->setIdeTamaño($data['ideTamaño']); // Asegúrate de incluir el ID del tamaño de papel
        $tamañoPapel->setNombreTam($data['NombreTam']);
        $tamañoPapel->setPreciopUTaP($data['PreciopUTaP']);
        $tamañoPapel->setFechaUlModi($data['FechaUlModi']);
        $tamañoPapel->setProveedor($data['Proveedor']);
    
        $response = [];
    
        if ($tamañoPapel->update()) {
            $response['success'] = true;
            $response['message'] = 'Tamaño de papel actualizado exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al actualizar el tamaño de papel';
        }
    
        echo json_encode($response);
    } elseif ($method === 'DELETE') {
        $data = json_decode(file_get_contents('php://input'), true);
        error_log('Datos recibidos (DELETE): ' . print_r($data, true)); // Registro de los datos recibidos

        if (!isset($data['ids'])) {
            echo json_encode(['success' => false, 'message' => 'IDs de los tamaños de papel no proporcionados']);
            exit;
        }

        $tamañoPapel = new TamañoPapelModel();
        $response = [];
        $success = true;

        foreach ($data['ids'] as $id) {
            if (!$tamañoPapel->delete($id)) {
                $success = false;
                break;
            }
        }

        if ($success) {
            $response['success'] = true;
            $response['message'] = 'Tamaños de papel eliminados exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al eliminar los tamaños de papel';
        }

        echo json_encode($response);

    } else {
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    }

} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage()); // Registro de cualquier excepción
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
