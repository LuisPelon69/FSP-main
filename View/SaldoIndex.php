<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Saldo</title>
    <link rel="stylesheet" href="../css/SaldoIndex.css">
</head>
<body>
    <div class="container">
        <h2>Ver Saldo</h2>
        <div class="content">
            <div class="left">
                <div id="reader" class="reader"></div>
                <button class="scan-btn" id="scan-btn">Scan QR Code</button>
            </div>
            <div class="right">
                <div class="header">
                    <center><button class="reset-btn" id="reset-payment">Reiniciar</button></center>
                </div>
                <form>
                    <div class="form-group">
                        <label for="client-id">ID cliente:</label>
                        <input type="text" id="client-id" name="client-id" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" id="name" name="name" readonly>
                    </div>
                    <div class="form-group">
                        <label for="balance">Saldo:</label>
                        <input type="text" id="balance" name="balance" readonly>
                    </div>
                    <div class="logo-container">
                        <img src="../img/Logo3.png" alt="Logo" class="logo">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../js/lib/html5-qrcode.min.js"></script>

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
                            $.post('../controller/SaldoIndexController.php', { action: 'obtenerDatosCliente', clienteId: clienteId }, function(response) {
                                response = JSON.parse(response);
                                if (response.status === 'success') {
                                    $('#client-id').val(clienteId);
                                    $('#name').val(response.nombre);
                                    $('#balance').val(response.saldo);
                                } else {
                                    alert(response.message);
                                }
                            }).fail(function() {
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

        document.getElementById('reset-payment').addEventListener('click', function() {
            location.reload(); // Recargar la página
        });
    </script>
</body>
</html>
