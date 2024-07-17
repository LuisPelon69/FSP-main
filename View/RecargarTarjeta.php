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
    <link href="css/recarga.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>

<div class="container">
    <h1>Recargar tarjeta</h1>
    <form id="recargaForm" action="controller/RecargarTarjetaController.php" method="post">
        <div class="qr-code">
            <img src="img/Logo2.3.png" alt="QR Code" style="width: 100%; height: 100%;">
            <button type="button" class="scan-btn" id="scan-btn">Scan QR Code</button>
        </div>
        <div class="input-field">
            <label for="cliente">Cliente:</label>
            <input type="text" id="cliente" name="cliente">
        </div>
        <div class="input-field">
            <label for="saldo">Saldo:</label>
            <input type="text" id="saldo" name="saldo" readonly>
        </div>
        <div class="input-field">
            <label for="cantidad">Ingrese cantidad a recargar:</label>
            <input type="text" id="cantidad" name="cantidad" required>
        </div>
        <button type="submit">Recargar</button>
    </form>
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

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script src="js/recargas.js"></script>

<!-- Script para escanear el código QR y rellenar los campos -->
<script>
    document.getElementById('scan-btn').addEventListener('click', function() {
        // Simulación de escaneo de QR
        let cliente = 'Juan Perez';  // Nombre del cliente obtenido del QR

        // Realiza una solicitud AJAX para obtener el saldo del cliente
        $.post('controller/RecargarTarjetaController.php', { cliente: cliente }, function(data) {
            document.getElementById('cliente').value = data.nombre;
            document.getElementById('saldo').value = data.saldo;
        }, 'json').fail(function() {
            alert('Error al obtener el saldo del cliente.');
        });
    });

    // Evitar envío automático del formulario y manejar la respuesta en un modal
    $(document).ready(function() {
        $('#recargaForm').submit(function(event) {
            event.preventDefault();
            $.post($(this).attr('action'), $(this).serialize(), function(response) {
                $('#modal-message').text(response.message);
                $('#mensajeModal').modal('show');
                if (response.status === 'success') {
                    // Limpiar campos del formulario después de recarga exitosa
                    $('#cliente').val('');
                    $('#saldo').val('');
                    $('#cantidad').val('');
                }
            }, 'json').fail(function() {
                alert('Error al procesar la recarga.');
            });
        });
    });
</script>

