<?php
// Incluir la conexión a la base de datos y el modelo ClienteModel
require_once '../bd/conex.php';
require_once '../model/ClienteModel.php';
require_once 'GenerarQRController.php'; // Incluir el nuevo controlador

// Comprobar el método de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

try {
    if ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);//uhnybyb

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
            $qrFilePath = GenerarQRController::generarQR($qrData);

            $response['success'] = true;
            $response['message'] = 'Cliente creado exitosamente';
            $response['qrCodePath'] = $qrFilePath; // Devolver la ruta del código QR
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al crear el cliente';
        }

        echo json_encode($response);

    } elseif ($method === 'GET') {
        $cliente = new ClienteModel();

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
            $response['message'] = 'Error al actualizar el cliente';
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
            $response['message'] = 'Error al eliminar los clientes';
        }

        echo json_encode($response);

    } else {
        echo json_encode(['error' => 'Método no permitido']);
    }

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
