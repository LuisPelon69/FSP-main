<?php
require_once '../bd/conex.php';
require_once '../model/CobroModel.php';
require_once '../model/LoImpresionModel.php';
require_once '../model/TamañoPapelModel.php';
require_once '../model/TipoImpresionModel.php';
require_once '../model/TipoPapelModel.php';
require_once '../model/ClienteModel.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

$cobroModel = new CobroModel();
$loImpresionModel = new LoImpresionModel();
$clienteModel = new ClienteModel();

switch ($method) {
    case 'GET':
        if (isset($_GET['type'])) {
            if ($_GET['type'] === 'tamañoPapel') {
                $model = new TamañoPapelModel();
                $result = $model->obtenerTodos();
                echo json_encode($result);
            } elseif ($_GET['type'] === 'tipoImpresion') {
                $model = new TipoImpresionModel();
                $result = $model->obtenerTodos();
                echo json_encode($result);
            } elseif ($_GET['type'] === 'tipoPapel') {
                $model = new TipoPapelModel();
                $result = $model->obtenerTodos();
                echo json_encode($result);
            } elseif ($_GET['type'] === 'maxIdCobro') {
                $maxIdCobro = $cobroModel->getMaxIdCobro();
                echo json_encode(['maxIdCobro' => $maxIdCobro]);
            } elseif ($_GET['type'] === 'obtenerSaldo' && isset($_GET['idCliente'])) {
                $idCliente = $_GET['idCliente'];
                $saldo = $clienteModel->obtenerSaldo($idCliente);
                echo json_encode(['saldo' => $saldo]);
            }
        }
        break;

    case 'POST':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['type'] === 'registrarCobro') {
            try {
                $data = json_decode(file_get_contents('php://input'), true);
                error_log("Datos recibidos para registrarCobro: " . print_r($data, true));
        
                // Descomponemos los datos recibidos
                $idCobro = $data['idCobro'];
                $idCliente = $data['idCliente'];
                $idEmpleado = $data['idEmpleado'];
                $TotalCobro = $data['TotalCobro'];
                $nuevoSaldo = $data['nuevoSaldo'];
        
                // Actualizamos el saldo del cliente
                $clienteModel = new ClienteModel();
                $clienteModel->actualizarSaldo($idCliente, $nuevoSaldo);
        
                // Guardamos el cobro
                $cobroModel = new CobroModel();
                $cobroModel->idCobro = $idCobro;
                $cobroModel->idCliente = $idCliente;
                $cobroModel->idEmpleado = $idEmpleado;
                $cobroModel->TotalCobro = $TotalCobro;
        
                if ($cobroModel->save()) {
                    $idCobro = $cobroModel->conn->lastInsertId();  // Obtener el ID generado
                    echo json_encode(['success' => true, 'idCobro' => $idCobro]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al guardar el cobro.']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
            }
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['type'] === 'registrarLotes') {
            try {
                $data = json_decode(file_get_contents('php://input'), true);
                error_log("Datos recibidos para registrarLotes: " . print_r($data, true));
        
                // Descomponemos los datos recibidos
                $idCobro = $data['idCobro'];
                $lotes = $data['lotes'];
        
                // Guardamos los lotes de impresión
                $loImpresionModel = new LoImpresionModel();

        
                foreach ($lotes as $lote) {
                    error_log("Guardando lote: " . print_r($lote, true));
                    $loImpresionModel->idLoteIm = $lote['idLoteIm'];
                    $loImpresionModel->idCobro = $idCobro;
                    $loImpresionModel->idTamano = $lote['idTamano']; // Asegúrate de que aquí sea 'idTamano' y no 'idTama\xc3\xb1o'
                    $loImpresionModel->idTipoP = $lote['idTipoP'];
                    $loImpresionModel->idTipoI = $lote['idTipoI'];
                    $loImpresionModel->CantHojas = $lote['CantHojas'];
                    $loImpresionModel->DuplexBool = $lote['DuplexBool'];
                    $loImpresionModel->CostoLote = $lote['CostoLote'];
                
                    $result = $loImpresionModel->save();
                    error_log("Resultado de guardar lote: " . $result);
                    $saveResult = json_decode($result, true);
                    if (!$saveResult['success']) {
                        echo json_encode(['success' => false, 'message' => 'Error al guardar el lote de impresión.']);
                        return;
                    }
                }
                
        
                echo json_encode(['success' => true]);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
            }
        }
        break;
}
