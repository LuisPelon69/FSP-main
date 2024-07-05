<?php
// Incluir la conexión a la base de datos y el modelo ClienteModel
require_once '../bd/conex.php';
require_once '../model/ClienteModel.php';

// Obtener los datos enviados desde el formulario
$data = json_decode(file_get_contents('php://input'), true);

// Crear una instancia del modelo ClienteModel y asignar los valores recibidos
$cliente = new ClienteModel();
$cliente->setNombreClien($data['NombreClien']);
$cliente->setApellidoP($data['ApellidoP']);
$cliente->setApellidoM($data['ApellidoM']);
$cliente->setTelefono($data['Telefono']);
$cliente->setCorreo($data['Correo']);
$cliente->setPasswClien(password_hash($data['passwClien'], PASSWORD_BCRYPT));

// Array para almacenar la respuesta
$response = [];

// Intentar guardar el cliente en la base de datos
if ($cliente->save()) {
    $response['success'] = true;
    $response['message'] = 'Cliente creado exitosamente';
} else {
    $response['success'] = false;
    $response['message'] = 'Error al crear el cliente';
}

// Enviar la respuesta en formato JSON
echo json_encode($response);
?>
