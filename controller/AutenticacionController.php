<?php
require_once 'model/AutenticacionModel.php';
require_once('bd/conex.php');

class AutenticacionController {
    private $model;

    public function __construct() {
        $this->model = new AutenticacionModel();
        $this->handleLogin();
    }

    private function handleLogin() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['nombre']) && isset($_POST['password'])) {
                $nombre = $_POST['nombre'];
                $password = $_POST['password'];

                // Conexión a la base de datos y consulta
                $db = Database::getConnection();
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
                    header("Location: index.html");
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
?>

        <!-- Wrapper para contenido y sidebar -->
        <div id="wrapper" class="d-flex">

            <!-- Contenido principal -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">

                    <!-- Contenido -->
                    <?php include 'View/AutenticacionVista.php'; ?>
                    
                </div>
                <!-- End of Content -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Wrapper -->

<?php
        include 'View/Scripts.php';
    }
}

$controller = new AutenticacionController();
$controller->index();
?>
