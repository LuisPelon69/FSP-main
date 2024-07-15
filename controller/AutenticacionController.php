<?php
require_once 'model\AutenticacionModel.php';
require_once 'bd\conex.php';

class AutenticacionController {
    private $model;

    public function __construct() {
        $this->model = new AutenticacionModel();
        session_start();
        $this->handleLogin();
    }

    private function handleLogin() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['nombre']) && isset($_POST['password'])) {
                $nombre = trim($_POST['nombre']);
                $password = trim($_POST['password']);

                // Conexión a la base de datos y consulta
                $database = new Database();
                $db = $database->getConnection();
                $query = "SELECT * FROM empleado WHERE NombreEmp = :nombre AND PasswordE = :password";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':password', $password);
                $stmt->execute();

                $count = $stmt->rowCount();
                if ($count > 0) {
                    // Iniciar sesión exitoso
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
    }

    public function index() {
        $monthlyEarnings = $this->model->getMonthlyEarnings();
        $annualEarnings = $this->model->getAnnualEarnings();
        $goalsCompletion = $this->model->getGoalsCompletion();
        $receivedEmails = $this->model->getReceivedEmails();
        include 'View/AutenticacionVista.php';
        include 'View/Scripts.php';
    }
}

$controller = new AutenticacionController();
$controller->index();
?>
