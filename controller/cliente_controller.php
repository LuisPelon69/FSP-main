<?php
// Incluir la conexión a la base de datos y el modelo ClienteModel
require_once '../bd/conex.php';
require_once '../model/ClienteModel.php';

// Comprobar el método de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $cliente = new ClienteModel();
    $cliente->setNombreClien($data['NombreClien']);
    $cliente->setApellidoP($data['ApellidoP']);
    $cliente->setApellidoM($data['ApellidoM']);
    $cliente->setTelefono($data['Telefono']);
    $cliente->setCorreo($data['Correo']);
    $cliente->setPasswClien(password_hash($data['passwClien'], PASSWORD_BCRYPT));

    $response = [];

    if ($cliente->save()) {
        $response['success'] = true;
        $response['message'] = 'Cliente creado exitosamente';
    } else {
        $response['success'] = false;
        $response['message'] = 'Error al crear el cliente';
    }

    echo json_encode($response);
} elseif ($method === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $cliente = new ClienteModel();
        $clienteData = $cliente->obtenerClientePorId($id);
        echo json_encode($clienteData);
    } else {
        $cliente = new ClienteModel();
        $clientes = $cliente->obtenerClientes();
        echo json_encode($clientes);
    }
} elseif ($method === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['idClien']) && isset($data['NombreClien']) && isset($data['ApellidoP']) && isset($data['ApellidoM']) && isset($data['Telefono']) && isset($data['Correo'])) {
        $cliente = new ClienteModel();
        $cliente->setIdClien($data['idClien']);
        $cliente->setNombreClien($data['NombreClien']);
        $cliente->setApellidoP($data['ApellidoP']);
        $cliente->setApellidoM($data['ApellidoM']);
        $cliente->setTelefono($data['Telefono']);
        $cliente->setCorreo($data['Correo']);

        if ($cliente->update()) {
            echo json_encode(['message' => 'Cliente actualizado exitosamente']);
        } else {
            echo json_encode(['error' => 'Error al actualizar el cliente']);
        }
    } else {
        echo json_encode(['error' => 'Datos incompletos para actualizar el cliente']);
    }
} elseif ($method === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['ids'])) {
        $ids = $data['ids'];
        $cliente = new ClienteModel();

        $errors = [];
        foreach ($ids as $id) {
            if (!$cliente->delete($id)) {
                $errors[] = "Error al eliminar el cliente con ID $id";
            }
        }

        if (empty($errors)) {
            echo json_encode(['message' => 'Clientes eliminados exitosamente']);
        } else {
            echo json_encode(['error' => $errors]);
        }
    } else {
        echo json_encode(['error' => 'IDs de clientes no proporcionados']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Método no permitido']);
}
?>
