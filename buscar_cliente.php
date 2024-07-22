<?php
// buscar_cliente.php

// Conectar a la base de datos
$host = 'localhost';
$db = 'fspdatabase'; // Asegúrate de usar el nombre correcto de tu base de datos
$user = 'root'; // Tu usuario de la base de datos
$pass = ''; // Tu contraseña de la base de datos

$conn = new mysqli($host, $user, $pass, $db);

// Comprobar conexión
if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

// Obtener el ID del cliente
$idClien = $_GET['idClien'];

// Consultar el cliente
$sql = "SELECT Saldo FROM cliente WHERE idClien = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $idClien);
$stmt->execute();
$result = $stmt->get_result();

$response = array();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['found'] = true;
    $response['saldo'] = $row['Saldo'];
} else {
    $response['found'] = false;
    $response['saldo'] = null;
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
