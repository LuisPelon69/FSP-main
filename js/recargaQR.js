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
                    $.post('controller/RecargarTarjetaController.php', { action: 'obtenerSaldo', clienteId: clienteId }, function(response) {
                        if (response.status === 'success') {
                            $('#cliente').val(clienteId);
                            $('#saldo').val(response.saldo);
                            document.getElementById('qrCodeContainer').classList.add('active'); // Ocultar imagen de fondo
                        } else {
                            alert(response.message);
                        }
                    }, 'json').fail(function() {
                        alert('Error al obtener el saldo del cliente.');
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

$(document).ready(function() {
    $('#recargaForm').submit(function(event) {
        event.preventDefault();
        let cantidad = $('#cantidad').val();
        
        // Validar que la cantidad ingresada es numérica
        if (isNaN(cantidad) || cantidad.trim() === '') {
            $('#modal-message').text('Por favor, ingrese una cantidad válida.');
            $('#mensajeModal').modal('show');
            return;
        }
        
        $.post($(this).attr('action'), $(this).serialize(), function(response) {
            $('#modal-message').text(response.message);
            $('#mensajeModal').modal('show');
            if (response.status === 'success') {
                // Actualizar el saldo en la textbox
                $.post('controller/RecargarTarjetaController.php', { action: 'obtenerSaldo', clienteId: $('#cliente').val() }, function(response) {
                    if (response.status === 'success') {
                        $('#saldo').val(response.saldo);
                    } else {
                        alert(response.message);
                    }
                }, 'json').fail(function() {
                    alert('Error al obtener el saldo actualizado.');
                });
            }
        }, 'json').fail(function() {
            alert('Error al procesar la recarga.');
        });
    });
});