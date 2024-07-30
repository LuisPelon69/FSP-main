<?php
require_once 'config.php'; // Incluir la configuración global antes de cualquier salida
?><?php
require_once 'controller/AgregarProductoController.php';
?>
<?php
// index.php

// Obtén el controlador y la acción de la URL, o usa valores predeterminados
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'AgregarProducto';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
?>
