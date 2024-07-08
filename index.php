<?php
require_once 'MVC_CONTROLADOR/DashboardController.php';
?>
<?php
// index.php

// Obtén el controlador y la acción de la URL, o usa valores predeterminados
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Dashboard';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
?>
