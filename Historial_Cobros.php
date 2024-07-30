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
require_once 'controller/HistorialCobrosController.php';
?>
<?php
// index.php

// Obtén el controlador y la acción de la URL, o usa valores predeterminados
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'HistorialCobros';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
