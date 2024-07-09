<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/Style_login.css">
    <title>Login</title>
</head>

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
            <form action="../controller/login.php" method="post">
                <h1>Iniciar sesión</h1>
                <br>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="../js/Script_login.js"></script>