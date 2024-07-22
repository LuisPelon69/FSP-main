<?php
// realizar_cobro.php

// Conectar a la base de datos
$host = 'localhost';
$db = 'fspdatabase';
$user = 'usuario';
$pass = 'contraseña';

$conn = new mysqli($host, $user, $pass, $db);

// Comprobar conexión
if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

// Obtener los datos enviados
$idClien = $_POST['idClien'];
$cobro = $_POST['cobro'];

// Obtener el saldo actual del cliente
$sql = "SELECT Saldo FROM cliente WHERE idClien = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $idClien);
$stmt->execute();
$result = $stmt->get_result();

$response = array();

if ($result->num_rows > 0) {
    $cliente = $result->fetch_assoc();
    $saldoActual = $cliente['Saldo'];

    if ($cobro <= $saldoActual) {
        // Descontar el cobro del saldo
        $nuevoSaldo = $saldoActual - $cobro;
        $updateSql = "UPDATE cliente SET Saldo = ? WHERE idClien = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param('di', $nuevoSaldo, $idClien);
        $updateStmt->execute();

        $response['success'] = true;
        $response['saldo'] = $nuevoSaldo;
    } else {
        $response['success'] = false;
        $response['error'] = 'Saldo insuficiente';
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Cliente no encontrado';
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
