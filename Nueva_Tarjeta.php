<?php
require_once 'controller/NuevaTarjetaController.php';
?>
<?php
// index.php

// Obtén el controlador y la acción de la URL, o usa valores predeterminados
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'NuevaTarjeta';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
