<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Recargar Tarjeta</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/recargaQR.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>

<div class="container">
    <div class="qr-code">
        <div id="reader" style="width: 100%; height: 100%;"></div>
        <button type="button" class="scan-btn" id="scan-btn">Scan QR Code</button>
    </div>
    <div class="form-container">
        <center><h1>Recargar tarjeta</h1></center>
        <div class="reset-container">
        <button id="reset-payment" class="btn btn-secondary">
            <i class="fas fa-sync-alt"></i> Reiniciar
        </button>
    </div>
        <form id="recargaForm" action="controller/RecargarTarjetaController.php" method="post">
            <div class="input-field">
                <label for="cliente">ID cliente:</label>
                <input type="text" id="cliente" name="cliente" >
            </div>
            <div class="input-field">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" readonly>
            </div>
            <div class="input-field">
                <label for="saldo">Saldo:</label>
                <input type="text" id="saldo" name="saldo" readonly>
            </div>
            <div class="input-field">
                <label for="cantidad">Ingrese cantidad a recargar:</label>
                <input type="text" id="cantidad" name="cantidad" >
            </div>
            <button type="submit">Recargar</button>
        </form>
    </div>
</div>

<!-- Modal para mostrar el resultado de la recarga -->
<div class="modal fade" id="mensajeModal" tabindex="-1" role="dialog" aria-labelledby="mensajeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mensajeModalLabel">Mensaje de Recarga</h5>
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

<!-- Cargar scripts necesarios -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="js/lib/html5-qrcode.min.js"></script>

<!-- Código para manejar el escaneo del código QR -->
<script>
document.getElementById('scan-btn').addEventListener('click', function() {
    const html5QrCode = new Html5Qrcode("reader");

    html5QrCode.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: 250
        },
        qrCodeMessage => {
            console.log("QR Code detected: ", qrCodeMessage);
            html5QrCode.stop().then(ignore => {
                let clienteId = qrCodeMessage;
                if (clienteId) {
                    $.post('controller/RecargarTarjetaController.php', { action: 'obtenerDatosCliente', clienteId: clienteId }, function(response) {
                        if (response.status === 'success') {
                            $('#cliente').val(clienteId);
                            $('#nombre').val(response.nombre); // Mostrar nombre del cliente
                            $('#saldo').val(response.saldo);
                        } else {
                            alert(response.message);
                        }
                    }, 'json').fail(function() {
                        alert('Error al obtener los datos del cliente.');
                    });
                }
            }).catch(err => {
                console.log(err);
            });
        },
        errorMessage => {
            console.log("QR Code no match: ", errorMessage);
        }
    ).catch(err => {
        console.log("Unable to start scanning.", err);
    });
});

// Función para reiniciar el formulario y recargar la página
document.getElementById('reset-payment').addEventListener('click', function() {
    location.reload(); // Recargar la página
});

$(document).ready(function() {
    $('#recargaForm').submit(function(event) {
        event.preventDefault();
        let cantidad = $('#cantidad').val();
        
        // Validar que la cantidad ingresada es numérica y está en el rango permitido
        if (isNaN(cantidad) || cantidad.trim() === '' || cantidad <= 0 || cantidad > 500000) {
            $('#modal-message').text('Por favor, ingrese una cantidad válida.');
            $('#mensajeModal').modal('show');
            return;
        }
        
        $.post($(this).attr('action'), $(this).serialize(), function(response) {
            $('#modal-message').text(response.message);
            $('#mensajeModal').modal('show');
            if (response.status === 'success') {
                // Actualizar el saldo en la textbox
                $('#saldo').val(response.saldo);
                // Mostrar el nombre del cliente en el textbox
                $('#nombre').val(response.nombre);
            }
        }, 'json').fail(function() {
            alert('Error al procesar la recarga.');
        });
    });
});
</script>
</body>
</html>
