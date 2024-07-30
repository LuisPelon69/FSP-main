<?php
session_start();
if (!isset($_SESSION['idEmple'])) {
    header("Location: index.php"); // Redirige a la página de inicio de sesión si no hay sesión iniciada
    exit();
}
?>
<?php
require_once 'config.php'; // Incluir la configuración global antes de cualquier salida
?><?php
require_once 'controller/ReportesController.php';
?>

<?php
// index.php

// Get the controller and action from the URL, or use default values
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Reports';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Create the controller instance and call the action
$controllerName = $controller . 'Controller';
if (class_exists($controllerName)) {
    $controllerInstance = new $controllerName();
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        // Handle the error: action not found
        echo "Action not found!";
    }
} else {
    // Handle the error: controller not found
    echo "Controller not found!";
}
?>
