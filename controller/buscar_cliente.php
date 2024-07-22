<?php
// buscar_cliente.php

// Conectar a la base de datos
$host = 'localhost';
$db = 'nombre_basedatos';
$user = 'usuario';
$pass = 'contraseña';

$conn = new mysqli($host, $user, $pass, $db);

// Comprobar conexión
if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

// Obtener el ID del cliente
$idClien = $_GET['idClien'];

// Consultar el cliente
$sql = "SELECT * FROM cliente WHERE idClien = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $idClien);
$stmt->execute();
$result = $stmt->get_result();

$response = array();
$response['found'] = $result->num_rows > 0;

echo json_encode($response);

$stmt->close();
$conn->close();
?>
