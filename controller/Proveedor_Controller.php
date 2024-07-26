<?php
require_once '../bd/conex.php';
require_once '../model/ProveedorModel.php';

$method = $_SERVER['REQUEST_METHOD'];

try {
    error_log('Método de solicitud: ' . $method); // Registro del método de solicitud

    if ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        error_log('Datos recibidos (POST): ' . print_r($data, true)); // Registro de los datos recibidos

        if (!isset($data['NombreProveedor'], $data['IdTipo'], $data['Telefono'], $data['Correo'], $data['Calle'], $data['NoInterior'], $data['NoExt'], $data['Colonia'], $data['Cruzamiento'], $data['CodigoPostal'])) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos para crear el Proveedor']);
            exit;
        }

        $Proveedor = new ProveedorModel();
        $Proveedor->setNombreProveedor($data['NombreProveedor']);
        $Proveedor->setIdTipo($data['IdTipo']);
        $Proveedor->setTelefono($data['Telefono']);
        $Proveedor->setCorreo($data['Correo']);
        $Proveedor->setCalle($data['Calle']);
        $Proveedor->setNoInterior($data['NoInterior']);
        $Proveedor->setNoExt($data['NoExt']);
        $Proveedor->setColonia($data['Colonia']);
        $Proveedor->setCruzamiento($data['Cruzamiento']);
        $Proveedor->setCodigoPostal($data['CodigoPostal']);

        if ($Proveedor->save()) {
            echo json_encode(['success' => true, 'message' => 'Proveedor creado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al crear el Proveedor']);
        }

    } elseif ($method === 'GET') {
        $Proveedor = new ProveedorModel();
        error_log('Datos recibidos (GET): ' . print_r($_GET, true)); // Registro de los datos recibidos por GET

        if (isset($_GET['idProveedor'])) {
            $id = $_GET['idProveedor'];
            $ProveedorData = $Proveedor->obtenerProveedorPorId($id);
            echo json_encode($ProveedorData);

        } elseif (isset($_GET['tipos'])) {
            $tiposProveedor = $Proveedor->obtenerTiposProveedor();
            echo json_encode($tiposProveedor);

        } else {
            $Proveedores = $Proveedor->obtenerProveedores();
            echo json_encode($Proveedores);
        }

    } elseif ($method === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);
        error_log('Datos recibidos (PUT): ' . print_r($data, true)); // Registro de los datos recibidos

        if (!isset($data['idProveedor'], $data['NombreProveedor'], $data['IdTipo'], $data['Telefono'], $data['Correo'], $data['Calle'], $data['NoInterior'], $data['NoExt'], $data['Colonia'], $data['Cruzamiento'], $data['CodigoPostal'])) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos para actualizar el Proveedor']);
            exit;
        }

        $Proveedor = new ProveedorModel();
        $Proveedor->setidProveedor($data['idProveedor']);
        $Proveedor->setNombreProveedor($data['NombreProveedor']);
        $Proveedor->setIdTipo($data['IdTipo']);
        $Proveedor->setTelefono($data['Telefono']);
        $Proveedor->setCorreo($data['Correo']);
        $Proveedor->setCalle($data['Calle']);
        $Proveedor->setNoInterior($data['NoInterior']);
        $Proveedor->setNoExt($data['NoExt']);
        $Proveedor->setColonia($data['Colonia']);
        $Proveedor->setCruzamiento($data['Cruzamiento']);
        $Proveedor->setCodigoPostal($data['CodigoPostal']);

        if ($Proveedor->update()) {
            echo json_encode(['success' => true, 'message' => 'Proveedor actualizado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el Proveedor']);
        }

    } elseif ($method === 'DELETE') {
        $data = json_decode(file_get_contents('php://input'), true);
        error_log('Datos recibidos (DELETE): ' . print_r($data, true)); // Registro de los datos recibidos

        if (!isset($data['ids'])) {
            echo json_encode(['success' => false, 'message' => 'IDs de los proveedores no proporcionados']);
            exit;
        }

        $Proveedor = new ProveedorModel();
        $response = [];
        $success = true;

        foreach ($data['ids'] as $id) {
            if (!$Proveedor->delete($id)) {
                $success = false;
                break;
            }
        }

        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Proveedores eliminados exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar los proveedores']);
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    }

} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage()); // Registro de cualquier excepción
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
