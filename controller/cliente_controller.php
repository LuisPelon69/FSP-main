<?php
// Incluir la conexión a la base de datos y el modelo ClienteModel
require_once '../bd/conex.php';
require_once '../model/ClienteModel.php';

// Comprobar el método de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

// Configurar cabecera para que las respuestas sean en formato JSON
header('Content-Type: application/json; charset=UTF-8');

try {
    if ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['NombreClien'], $data['ApellidoP'], $data['ApellidoM'], $data['Telefono'], $data['Correo'], $data['passwClien'])) {
            echo json_encode(['error' => 'Datos incompletos para crear el cliente']);
            exit;
        }

        $cliente = new ClienteModel();
        $cliente->setNombreClien($data['NombreClien']);
        $cliente->setApellidoP($data['ApellidoP']);
        $cliente->setApellidoM($data['ApellidoM']);
        $cliente->setTelefono($data['Telefono']);
        $cliente->setCorreo($data['Correo']);
        $cliente->setPasswClien(password_hash($data['passwClien'], PASSWORD_BCRYPT));

        $response = [];

        if ($cliente->save()) {
            // Generar el código QR
            $qrData = [
                'NombreClien' => $data['NombreClien'],
                'ApellidoP' => $data['ApellidoP'],
                'ApellidoM' => $data['ApellidoM']
            ];
            

            $response['success'] = true;
            $response['message'] = 'Cliente creado exitosamente';

        } else {
            $response['success'] = false;
            $response['message'] = 'Error al crear el cliente. Por favor, verifica los datos e intenta nuevamente.';
        }

        echo json_encode($response);

    } elseif ($method === 'GET') {
        $cliente = new ClienteModel();
        error_log('Datos recibidos (GET): ' . print_r($_GET, true)); // Registro de los datos recibidos por GET
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $clienteData = $cliente->obtenerClientePorId($id);
            echo json_encode($clienteData);
        } else {
            $clientes = $cliente->obtenerClientes();
            echo json_encode($clientes);
        }

    } elseif ($method === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['idClien'], $data['NombreClien'], $data['ApellidoP'], $data['ApellidoM'], $data['Telefono'], $data['Correo'])) {
            echo json_encode(['error' => 'Datos incompletos para actualizar el cliente']);
            exit;
        }

        $cliente = new ClienteModel();
        $cliente->setIdClien($data['idClien']);
        $cliente->setNombreClien($data['NombreClien']);
        $cliente->setApellidoP($data['ApellidoP']);
        $cliente->setApellidoM($data['ApellidoM']);
        $cliente->setTelefono($data['Telefono']);
        $cliente->setCorreo($data['Correo']);

        $response = [];

        if ($cliente->update()) {
            $response['success'] = true;
            $response['message'] = 'Cliente actualizado exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al actualizar el cliente. Por favor, verifica los datos e intenta nuevamente.';
        }

        echo json_encode($response);

    } elseif ($method === 'DELETE') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['ids'])) {
            echo json_encode(['error' => 'IDs de los clientes no proporcionados']);
            exit;
        }

        $cliente = new ClienteModel();
        $response = [];
        $success = true;

        foreach ($data['ids'] as $id) {
            if (!$cliente->delete($id)) {
                $success = false;
                break;
            }
        }

        if ($success) {
            $response['success'] = true;
            $response['message'] = 'Clientes eliminados exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al eliminar los clientes. Por favor, intenta nuevamente.';
        }

        echo json_encode($response);

    } else {
        echo json_encode(['error' => 'Método no permitido']);
    }

} catch (Exception $e) {
    echo json_encode(['error' => 'Error del servidor: ' . $e->getMessage()]);
}
?>
