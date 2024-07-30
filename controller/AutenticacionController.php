<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR . 'AutenticacionModel.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bd' . DIRECTORY_SEPARATOR . 'conex.php';

$controller = new AutenticacionController();
$controller->index();
class AutenticacionController 
{
    private $model;
    private $errorMessage;
    public function index() {
        $monthlyEarnings = $this->model->getMonthlyEarnings();
        $annualEarnings = $this->model->getAnnualEarnings();
        $goalsCompletion = $this->model->getGoalsCompletion();
        $receivedEmails = $this->model->getReceivedEmails();
        include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'AutenticacionVista.php';
    }
    public function __construct() {
        $this->model = new AutenticacionModel();
        $this->errorMessage = 'Nombre de usuario o contraseña incorrectos.';
        $this->handleLogin();
    }

    private function handleLogin() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['nombre']) && isset($_POST['password'])) {
                $nombre = $_POST['nombre'];
                $password = $_POST['password'];

                // Conexión a la base de datos y consulta
                $database = new Database();
                $db = $database->getConnection();
                $query = "SELECT * FROM empleado WHERE idEmple = :nombre AND PasswordE = :password";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':nombre', $nombre);
                $stmt->bindParam(':password', $password);
                $stmt->execute();
                
                $count = $stmt->rowCount();
                if ($count > 0) {
                    // Obtener el idEmple para verificar el prefijo
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $idEmple = $row['idEmple'];

                    // Iniciar sesión exitoso
                    session_start();
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['idEmple'] = $idEmple; // Almacenar idEmple en la sesión

                    // Redirigir según el prefijo del idEmple
                    if (strpos($idEmple, '10') === 0) {
                        header("Location: ../Admin.php");
                    } elseif (strpos($idEmple, '20') === 0) {
                        header("Location: ../NuevoCobro_Empleado.php");
                    } else {
                        // Redirigir a una página por defecto o mostrar un error
                        header("Location: ../index.php");
                    }
                    exit();
                } else {
                    $this->displayError($this->errorMessage);
                }
            } else {
                $this->displayError($this->errorMessage);
            }
        }
    }

    private function displayError($message) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var modalMessageElement = document.getElementById('modal-message');
                modalMessageElement.textContent = '$message';
                var mensajeModal = new bootstrap.Modal(document.getElementById('mensajeModal'), {
                    keyboard: false
                });
                mensajeModal.show();
            });
        </script>";
    }
}

?>
