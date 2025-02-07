
<?php
require_once '../bd/conex.php';
require_once '../model/EmpleadoModel.php';

$method = $_SERVER['REQUEST_METHOD'];
try {
    error_log('Método de solicitud: ' . $method); // Registro del método de solicitud

    if ($method === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        error_log('Datos recibidos (POST): ' . print_r($data, true)); // Registro de los datos recibidos

        if (!isset($data['NombreEmp'], $data['Idstatus'], $data['PasswordE'], $data['CURPemp'], $data['RFC'], $data['CP'], $data['Calle'], $data['NoInterior'], $data['NoExt'], $data['Colonia'], $data['Cruzamiento'])) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos para crear el empleado']);
            exit;
        }

        $empleado = new EmpleadoModel();
        $empleado->setNombreEmp($data['NombreEmp']);
        $empleado->setIdstatus($data['Idstatus']);
        $empleado->setPasswordE($data['PasswordE']);
        $empleado->setCURPemp($data['CURPemp']);
        $empleado->setRFC($data['RFC']);
        $empleado->setCP($data['CP']);
        $empleado->setCalle($data['Calle']);
        $empleado->setNoInterior($data['NoInterior']);
        $empleado->setNoExt($data['NoExt']);
        $empleado->setColonia($data['Colonia']);
        $empleado->setCruzamiento($data['Cruzamiento']);

        $response = [];

        if ($empleado->save()) {
            $response['success'] = true;
            $response['message'] = 'Empleado creado exitosamente XD';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error al crear el empleado';
        }

        echo json_encode($response);
    } elseif ($method === 'GET') {
        $empleado = new EmpleadoModel();
        error_log('Datos recibidos (GET): ' . print_r($_GET, true)); // Registro de los datos recibidos por GET


        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $empleadoData = $empleado->obtenerEmpleadoPorId($id);
            echo json_encode($empleadoData);
        } elseif (isset($_GET['type']) && $_GET['type'] === 'tiposempleado') {
            $tiposEmpleado = $empleado->obtenerTiposEmpleado();
            echo json_encode($tiposEmpleado);
        } elseif (isset($_GET['Idstatus'])) {
            $id = $_GET['Idstatus'];
            $empleadoData = $empleado->obtenerEmpleadoPorId($id);
            echo json_encode($empleadoData);
        } else {
            $empleados = $empleado->obtenerEmpleados();

            foreach ($empleados as &$empleado) {
                $empleado['NombreStatus'] = obtenerNombreStatus($empleado['Idstatus']);
            }
            echo json_encode($empleados);
        }
    } elseif ($method === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);
        error_log('Datos recibidos (PUT): ' . print_r($data, true)); // Registro de los datos recibidos

        if (!isset($data['NombreEmp'], $data['CURPemp'], $data['RFC'], $data['CP'], $data['Calle'], $data['NoInterior'], $data['NoExt'], $data['Colonia'], $data['Cruzamiento'], $data['idEmple'])) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos para actualizar el empleado']);
            exit;
        }

        $empleado = new EmpleadoModel();
        $empleado->setIdEmp($data['idEmple']); // Asegúrate de incluir el ID del empleado
        $empleado->setNombreEmp($data['NombreEmp']);
        // $empleado->setPasswordE(password_hash($data['PasswordE'], PASSWORD_BCRYPT)); // Password no está en los datos enviados
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
        error_log('Datos recibidos (DELETE): ' . print_r($data, true)); // Registro de los datos recibidos

        if (!isset($data['ids'])) {
            echo json_encode(['success' => false, 'message' => 'IDs de los empleados no proporcionados']);
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
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    }
} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage()); // Registro de cualquier excepción
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

function obtenerTiposEmpleado()
{
    $conn = (new Database())->getConnection();
    $query = "SELECT Idstatus, NombreStatus FROM statuse";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $tiposEmpleado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($tiposEmpleado);
}

function obtenerNombreStatus($Idstatus)
{
    $conn = (new Database())->getConnection();
    $query = "SELECT NombreStatus FROM statuse WHERE Idstatus = :Idstatus"; // Asegúrate de que el nombre del campo sea correcto

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':Idstatus', $Idstatus, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['NombreStatus'] : null;
}
?>
