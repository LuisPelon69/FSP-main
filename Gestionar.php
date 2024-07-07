<!--Ya en este archivo solo hice mención al controller de gestionar para que se una todo-->
<?php
require_once 'MVC_CONTROLADOR/MenuGestionarController.php';

$controller = new MenuGestionarController();
$controller->index();
?>
