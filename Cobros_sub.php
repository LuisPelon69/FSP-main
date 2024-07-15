<?php
require_once 'controller\CobroController.php';
?>
<?php
// index.php

// Obtén el controlador y la acción de la URL, o usa valores predeterminados
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Empleados';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
?>