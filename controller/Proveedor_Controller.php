<?php
require_once '../bd/conex.php';
require_once '../model/ProveedorModel.php';

$method = $_SERVER['REQUEST_METHOD'];

try {
    error_log('Método de solicitud: ' . $method); // Registro del método de solicitud

    if ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        error_log('Datos recibidos (POST): ' . print_r($data, true)); // Registro de los datos recibidos

        if (!isset($data['NombreProveedor'], $data['Telefono'], $data['Correo'], $data['CodigoPostal'], $data['Calle'], $data['NoInterior'], $data['NoExt'], $data['Colonia'], $data['Cruzamiento'])) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos para crear el Proveedor']);
            exit;
        }

        $Proveedor = new ProveedorModel();
        $Proveedor->setNombreProveedor($data['NombreProveedor']);
        $Proveedor->setTelefono($data['Telefono']);
        $Proveedor->setCorreo($data['Correo']);
        $Proveedor->setCodigoPostal($data['CodigoPostal']);
        $Proveedor->setCalle($data['Calle']);
        $Proveedor->setNoInterior($data['NoInterior']);
        $Proveedor->setNoExt($data['NoExt']);
        $Proveedor->setColonia($data['Colonia']);
        $Proveedor->setCruzamiento($data['Cruzamiento']);

        $response = [];

        if ($Proveedor->save()) {
            $response['success'] = true;
            $response['message'] = 'Proveedor creado exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al crear el Proveedor';
        }

        echo json_encode($response);

    } elseif ($method === 'GET') {
        $Proveedor = new ProveedorModel();
        error_log('Datos recibidos (GET): ' . print_r($_GET, true)); // Registro de los datos recibidos por GET
    
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $ProveedorData = $Proveedor->obtenerProveedorPorId($id);
            echo json_encode($ProveedorData);
    
        } elseif (isset($_GET['idProveedor'])) {
            $id = $_GET['idProveedor'];
            $ProveedorData = $Proveedor->obtenerProveedorPorId($id);
            echo json_encode($ProveedorData);
            
        } else {
            $Proveedores = $Proveedor->obtenerProveedores();
            echo json_encode($Proveedores);
        }
    } elseif ($method === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);
        error_log('Datos recibidos (PUT): ' . print_r($data, true)); // Registro de los datos recibidos
    
        if (!isset($data['idProveedor'], $data['NombreProveedor'], $data['Telefono'], $data['Correo'], $data['CodigoPostal'], $data['Calle'], $data['NoInterior'], $data['NoExt'], $data['Colonia'], $data['Cruzamiento'])) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos para actualizar el Proveedor']);
            exit;
        }
    
        $Proveedor = new ProveedorModel();
        $Proveedor->setidProveedor($data['idProveedor']); // Asegúrate de incluir el ID del Proveedor
        $Proveedor->setNombreProveedor($data['NombreProveedor']);
        $Proveedor->setTelefono($data['Telefono']);
        $Proveedor->setCorreo($data['Correo']);
        $Proveedor->setCodigoPostal($data['CodigoPostal']);
        $Proveedor->setCalle($data['Calle']);
        $Proveedor->setNoInterior($data['NoInterior']);
        $Proveedor->setNoExt($data['NoExt']);
        $Proveedor->setColonia($data['Colonia']);
        $Proveedor->setCruzamiento($data['Cruzamiento']);
    
        $response = [];
    
        if ($Proveedor->update()) {
            $response['success'] = true;
            $response['message'] = 'Proveedor actualizado exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al actualizar el Proveedor';
        }
    
        echo json_encode($response);
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
            $response['success'] = true;
            $response['message'] = 'Proveedores eliminados exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al eliminar los proveedores';
        }

        echo json_encode($response);

    } else {
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    }

} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage()); // Registro de cualquier excepción
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

// -------------------------------------------------------------------
// NUEVO CÓDIGO PARA OBTENER Y MOSTRAR PROVEEDORES

function obtenerProveedores() {
    try {
        $conn = (new Database())->getConnection();
        $query = "SELECT idProveedor, NombreProveedor, Telefono, Correo, CodigoPostal, Calle, NoInterior, NoExt, Colonia, Cruzamiento FROM proveedores";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $proveedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($proveedores);
    } catch (Exception $e) {
        error_log('Error al obtener proveedores: ' . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'Error al obtener proveedores']);
    }
}
?>

