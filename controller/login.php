<?php
require_once('../bd/conex.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nombre']) && isset($_POST['password'])) {
        $nombre = $_POST['nombre'];
        $password = $_POST['password'];

        // Conexión a la base de datos y consulta
        $db = Database::connect();
        $query = "SELECT * FROM empleado WHERE NombreEmp = :nombre AND PasswordE = :password";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        
        $count = $stmt->rowCount();
        if ($count > 0) {
            // Iniciar sesión exitoso
            session_start();
            $_SESSION['nombre'] = $nombre;  


            header("Location: ../index.html");
            exit();
        } else {
            echo "Nombre de usuario o contraseña incorrectos";
        }
    } else {
        echo "Faltan datos de inicio de sesión";
    }
}
?>
