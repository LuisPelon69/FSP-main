<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        .plan {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 10px;
            padding: 20px;
            width: 300px;
        }
        .plan h2 {
            color: #0078d4;
        }
        .plan p {
            font-size: 1.1em;
            margin: 10px 0;
        }
        .plan ul {
            list-style: none;
            padding: 0;
        }
        .plan ul li {
            margin: 10px 0;
        }
        .plan button {
            background-color: #0078d4;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 1em;
            margin-top: 20px;
            padding: 10px 20px;
            width: 100%;
        }
        .plan button:hover {
            background-color: #005a9e;
        }
        .price {
            font-size: 1.5em;
            font-weight: bold;
        }
        .subtext {
            color: #888;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="plan">
            <h2>FSP Usuarios</h2>
            <p class="price">MXN$1,299.00/año</p>
            <ul>
                <li>Acceso a internet en cualquiera de nuestras sucursales</li>
                <li>Módulos VIP</li>
                <li>Servicio al cliente</li>
                <li>Pagos desde tu dispositivo</li>
                <li>Novedades exclusivas</li>
                <li>Seguridad para los datos y los dispositivos</li>
                <li>Ofertas exclusivas de FSP y nuestros coolaboradores</li>
            </ul>
            <button>Comprar ahora</button>
            <p class="subtext" href="View/AutenticacionVista.php">O comprar a MXN$129.99/mes</p>
        </div>
        <div class="plan">
            <h2>FSP Empresas</h2>
            <p class="price">MXN$1,749.00/año</p>
            <ul>
                <li>Sistema desktop de FSP</li>
                <li>Base de datos para llevar un mejor control de su empresa</li>
                <li>Sistema para módulos VIP</li>
                <li>Cobros desde sus dispositivos</li>
                <li>Seguridad para los datos y los dispositivos</li>
                <li>Acceso a nuestros coolaboradores</li>
                <li>Información exclusiva para iniciar con su empresa en caso de ser nueva</li>
            </ul>
            <button href="View\AutenticacionVista.php">Comprar ahora</button>
            <p class="subtext">O comprar a MXN$169.99/mes</p>
        </div>
    </div>
</body>
</html>
