<?php
require_once 'MVC_CONTROLADOR/DashboardController.php';
?>
<?php
// index.php

// Obtén el controlador y la acción de la URL, o usa valores predeterminados
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Dashboard';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Construye el nombre del archivo del controlador
$controllerFile = 'MVC_CONTROLADORES/' . $controller . 'Controller.php';

// Verifica si el archivo del controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // Construye el nombre de la clase del controlador
    $controllerClass = $controller . 'Controller';
    
    // Verifica si la clase del controlador existe
    if (class_exists($controllerClass)) {
        $controllerObject = new $controllerClass();
        
        // Verifica si el método de acción existe en el controlador
        if (method_exists($controllerObject, $action)) {
            $controllerObject->$action();
        } else {
            // Maneja el caso en que la acción no existe
            echo "La acción '$action' no existe en el controlador '$controllerClass'.";
        }
    } else {
        // Maneja el caso en que la clase del controlador no existe
        echo "El controlador '$controllerClass' no existe.";
    }
} else {
    // Maneja el caso en que el archivo del controlador no existe
    echo "El archivo del controlador '$controllerFile' no existe.";
}
?>
