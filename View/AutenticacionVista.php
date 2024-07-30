<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../img/icono.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="stylesheet" href="../css/Style_login.css"> <!-- Ruta al archivo CSS -->

    <title>FSP - Login</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Crear cuenta</h1>
                <br>
                <input type="text" placeholder="Nombres" name="first_name">
                <input type="text" placeholder="Apellido Materno" name="last_name_maternal">
                <input type="text" placeholder="Apellido Paterno" name="last_name_paternal">
                <input type="text" placeholder="Email" name="email">
                <input type="text" placeholder="Telefono" name="phone">
                <input type="password" placeholder="Password" name="password">
                <button type="submit">Ingresar</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="../controller/AutenticacionController.php" method="post"> 
                <h1>Iniciar sesión</h1>
                <br>
                <input type="text" placeholder="Nombre" name="nombre">
                <input type="password" placeholder="Password" name="password">
                <a href="#">Olvidaste tu contraseña?</a>
                <button type="submit">Ingresar</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bienvenido!</h1>
                    <p>Ingresa tus datos para crear tu nueva cuenta con FSP</p>
                    <img src="../img/Logo3.png" alt="Logo" class="logo" height="110" width="300"> 
                    <button class="hidden" id="login">¿Ya tienes cuenta?</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Bienvenido a FSP</h1>
                    <p>Ingresa tus datos para acceder de nuevo</p>
                    <img src="../img/Logo3.png" alt="Logo" class="logo" height="110" width="300"> 
                    <button class="hidden" id="register">Únete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Error -->
    <div class="modal fade" id="mensajeModal" tabindex="-1" role="dialog" aria-labelledby="mensajeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mensajeModalLabel">Error de Autenticación</h5>
                </div>
                <div class="modal-body" id="modal-message">
                    <!-- Aquí se mostrará el mensaje del servidor -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlaces a Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/Script_login.js"></script> <!-- Ruta al archivo JS -->
</body>
</html>
