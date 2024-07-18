<?php
// Incluir la conexión a la base de datos y el modelo EmpleadoModel
require_once '../bd/conex.php';
require_once '../model/EmpleadoModel.php';

// Comprobar el método de la solicitud
$method = $_SERVER['REQUEST_METHOD'];

try {
    if ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        // Verificar que todos los datos necesarios están presentes
        if (!isset($data['NombreEmp'], $data['Idstatus'], $data['PasswordE'], $data['CURPemp'], $data['RFC'], $data['CP'], $data['Calle'], $data['NoInterior'], $data['NoExt'], $data['Colonia'], $data['Cruzamiento'])) {
            echo json_encode(['error' => 'Datos incompletos para crear el empleado']);
            exit;
        }

        $empleado = new EmpleadoModel();
        $empleado->setNombreEmp($data['NombreEmp']);
        $empleado->setIdstatus($data['Idstatus']);
        $empleado->setPasswordE(password_hash($data['PasswordE'], PASSWORD_BCRYPT));
        $empleado->setCURPemp($data['CURPemp']);
        $empleado->setRFC($data['RFC']);
        $empleado->setCP($data['CP']);
        $empleado->setCalle($data['Calle']);
        $empleado->setNoInterior($data['NoInterior']);
        $empleado->setNoExt($data['NoExt']);
        $empleado->setColonia($data['Colonia']);
        $empleado->setCruzamiento($data['Cruzamiento']);

        // Generar el nuevo ID de empleado
        $empleado->setIdEmp($empleado->generarIdEmp($data['Idstatus']));

        $response = [];

        if ($empleado->save()) {
            $response['success'] = true;
            $response['message'] = 'Empleado creado exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al crear el empleado';
        }

        echo json_encode($response);

    } elseif ($method === 'GET') {
        if (isset($_GET['type']) && $_GET['type'] === 'statuse') {
            // Obtener los estados
            obtenerStatuses();
        } elseif (isset($_GET['idStatus'])) {
            $id = $_GET['idStatus'];
            $empleado = new EmpleadoModel();
            $empleadoData = $empleado->obtenerEmpleadoPorId($id);
            echo json_encode($empleadoData);
        } else {
            $empleado = new EmpleadoModel();
            $empleados = $empleado->obtenerEmpleados();
            echo json_encode($empleados);
        }

    } elseif ($method === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);

        // Verificar que todos los datos necesarios están presentes
        if (!isset($data['idEmp'], $data['NombreEmp'], $data['Idstatus'], $data['PasswordE'], $data['CURPemp'], $data['RFC'], $data['CP'], $data['Calle'], $data['NoInterior'], $data['NoExt'], $data['Colonia'], $data['Cruzamiento'])) {
            echo json_encode(['error' => 'Datos incompletos para actualizar el empleado']);
            exit;
        }

        $empleado = new EmpleadoModel();
        $empleado->setIdEmp($data['idEmp']);
        $empleado->setNombreEmp($data['NombreEmp']);
        $empleado->setIdstatus($data['Idstatus']);
        $empleado->setPasswordE(password_hash($data['PasswordE'], PASSWORD_BCRYPT));
        $empleado->setCURPemp($data['CURPemp']);
        $empleado->setRFC($data['RFC']);
        $empleado->setCP($data['CP']);
        $empleado->setCalle($data['Calle']);
        $empleado->setNoInterior($data['NoInterior']);
        $empleado->setNoExt($data['NoExt']);
        $empleado->setColonia($data['Colonia']);
        $empleado->setCruzamiento($data['Cruzamiento']);

        $response = [];

        if ($empleado->update()) {
            $response['success'] = true;
            $response['message'] = 'Empleado actualizado exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al actualizar el empleado';
        }

        echo json_encode($response);

    } elseif ($method === 'DELETE') {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['ids'])) {
            echo json_encode(['error' => 'IDs de los empleados no proporcionados']);
            exit;
        }

        $empleado = new EmpleadoModel();
        $response = [];
        $success = true;

        foreach ($data['ids'] as $id) {
            if (!$empleado->delete($id)) {
                $success = false;
                break;
            }
        }

        if ($success) {
            $response['success'] = true;
            $response['message'] = 'Empleados eliminados exitosamente';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al eliminar los empleados';
        }

        echo json_encode($response);

    } else {
        echo json_encode(['error' => 'Método no permitido']);
    }

} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

// Función para obtener los estados
function obtenerStatuses() {
    $conn = (new Database())->getConnection();
    $query = "SELECT * FROM statuse";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $statuses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($statuses);
}
?>
