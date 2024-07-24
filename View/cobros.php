<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interfaz Administrativa</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/tarjeta.css">
    <link href="css/stylesCobro.css" rel="stylesheet">

    <style>
        /* Estilo para el botón de eliminar */
        .delete-row {
            display: none; /* Ocultar el ícono por defecto */
            background: none;
            border: none;
            color: red;
            font-size: 1.2rem;
            cursor: pointer;
        }

        /* Mostrar el ícono al pasar el puntero sobre la fila */
        .table tbody tr:hover .delete-row {
            display: block;
        }

        /* Estilo para el modal de notificación */
        .notification-modal {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050; /* Asegurarse de que esté por encima de otros elementos */
            display: none;
        }
    </style>
</head>

<body id="page-top">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"></h1>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="header">
                            <div class="logo">
                                <img src="img/Logo2.png" alt="Admin">
                            </div>
                            <div class="input-container">
                                <label>Nombre:</label>
                                <input type="text" value="Juan Pérez" disabled>
                            </div>
                            <div class="input-container">
                                <label>ID:</label>
                                <input type="text" value="12345" disabled>
                            </div>
                        </div>
                        <div class="header">
                            <!-- Fila para Cliente y Saldo en horizontal -->
                            <div class="input-row">
                                <div class="input-container">
                                    <label>Cliente:</label>
                                    <input type="text" id="cliente" placeholder="Ingrese ID del cliente">
                                </div>
                                <div class="input-container">
                                    <label>Saldo:</label>
                                    <input type="text" id="saldo" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <!-- Tabla con filas que tienen un ícono para eliminar -->
                            <div class="mt-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Lote</th>
                                            <th>Cantidad de Hojas</th>
                                            <th>Duplex</th>
                                            <th>Tamaño Papel</th>
                                            <th>Tipo de Papel</th>
                                            <th>Tipo de Impresión</th>
                                            <th>Total</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productos">
                                    </tbody>
                                </table>
                            </div>
                            <div class="right-pane">
                                <!-- Botón de Propiedades -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#propiedadesPapelModal">
                                    Agregar Productos
                                </button>
                                
                            </div>
                        </div>
                        <div class="footer">
                            <div class="reset-container">
                                <button id="reset-payment" class="btn btn-secondary">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                            <div class="amount-container">
                                <button id="paper-plane-button" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Enviar Comprobante
                                </button>
                                <label for="amount">$</label>
                                <input type="text" id="amount" readonly>
                            </div>
                            <button id="charge" class="btn btn-primary">Cobrar</button>
                            
                            <div class="cart-icon"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Modal Propiedades de Papel -->
<div class="modal fade" id="propiedadesPapelModal" tabindex="-1" aria-labelledby="propiedadesPapelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="propiedadesPapelModalLabel">Propiedades de papel</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="modal-form">
                    <!-- Formulario -->
                    <div class="container">
                        <div class="row mb-3">
                            <div class="col text-center">
                                <img src="img/Logo3.png" alt="Icono de Papel" class="img-fluid">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <label for="clb_TamañoPapel">Tamaño de papel</label>
                                <select class="form-control" id="clb_TamañoPapel">
                                    <option value="">Selecciona</option>
                                </select>
                            </div>
                            <div class="col-md-4 text-center">
                                <label for="clb_TipoPapel">Tipo de papel</label>
                                <select class="form-control" id="clb_TipoPapel">
                                    <option value="">Selecciona</option>
                                </select>
                            </div>
                            <div class="col-md-4 text-center">
                                <label for="clb_TipoImpresion">Tipo de impresión</label>
                                <select class="form-control" id="clb_TipoImpresion">
                                    <option value="">Selecciona</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 text-center">
                                <label for="duplex">Duplex:</label>
                                <select class="form-control" id="duplex">
                                    <option value="si">Sí</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 text-center">
                                <label for="hojas">Cantidad de hojas:</label>
                                <input type="number" class="form-control" id="hojas" min="1" max="999" step="1" pattern="\d{1,3}" title="Debe ser un número entre 1 y 999 con hasta 3 dígitos" required>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col text-center">
                            <button id="new-batch" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i>añadir
                            </button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer"></div>
        </div>
    </div>
</div>


    <!-- Modal de Notificación -->
    <div id="notification-modal" class="modal fade notification-modal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span id="notification-message"></span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="js/modalCobro.js"></script>
    <script src="js/calculo_cobro.js"></script>

    <script>
    $(document).ready(function() {
        // Cargar las opciones al abrir el modal
        $('#propiedadesPapelModal').on('show.bs.modal', function () {
            $.ajax({
                url: 'Cobros_sub.php?action=getPaperProperties',
                method: 'GET',
                dataType: 'json',
                success: function (response) {
                    var tamañosPapel = response.tamañosPapel;
                    var tiposPapel = response.tiposPapel;
                    var tiposImpresion = response.tiposImpresion;

                    var selectTamaño = $('#clb_TamañoPapel');
                    var selectTipoPapel = $('#clb_TipoPapel');
                    var selectTipoImpresion = $('#clb_TipoImpresion');

                    selectTamaño.empty().append('<option value="">Selecciona</option>');
                    selectTipoPapel.empty().append('<option value="">Selecciona</option>');
                    selectTipoImpresion.empty().append('<option value="">Selecciona</option>');

                    $.each(tamañosPapel, function(index, tamaño) {
                        selectTamaño.append('<option value="' + tamaño.NombreTam + '">' + tamaño.NombreTam + '</option>');
                    });

                    $.each(tiposPapel, function(index, tipo) {
                        selectTipoPapel.append('<option value="' + tipo.NombreTipoP + '">' + tipo.NombreTipoP + '</option>');
                    });

                    $.each(tiposImpresion, function(index, tipo) {
                        selectTipoImpresion.append('<option value="' + tipo.NombreTipoI + '">' + tipo.NombreTipoI + '</option>');
                    });

                    // Cargar opciones guardadas
                    var savedTamañoPapel = localStorage.getItem('tamañoPapel');
                    var savedTipoPapel = localStorage.getItem('tipoPapel');
                    var savedTipoImpresion = localStorage.getItem('tipoImpresion');

                    if (savedTamañoPapel) selectTamaño.val(savedTamañoPapel);
                    if (savedTipoPapel) selectTipoPapel.val(savedTipoPapel);
                    if (savedTipoImpresion) selectTipoImpresion.val(savedTipoImpresion);
                },
                error: function () {
                    alert('Error al cargar las propiedades del papel.');
                }
            });
        });

        // Guardar propiedades al hacer clic en "Guardar"
        $('#save-properties').click(function() {
            var tamañoPapel = $('#clb_TamañoPapel').val();
            var tipoPapel = $('#clb_TipoPapel').val();
            var tipoImpresion = $('#clb_TipoImpresion').val();

            // Guardar las propiedades seleccionadas en local storage
            localStorage.setItem('tamañoPapel', tamañoPapel);
            localStorage.setItem('tipoPapel', tipoPapel);
            localStorage.setItem('tipoImpresion', tipoImpresion);

            // Cerrar el modal
            $('#propiedadesPapelModal').modal('hide');
        });

        // Reiniciar valores al presionar el botón "new-batch"
        $('#new-batch').click(function(e) {
            e.preventDefault(); // Evitar el envío del formulario por defecto
            localStorage.removeItem('tamañoPapel');
            localStorage.removeItem('tipoPapel');
            localStorage.removeItem('tipoImpresion');

            // Aquí puedes añadir el código para crear el lote
            // Ejemplo:
            // var lote = {
            //     tamañoPapel: $('#clb_TamañoPapel').val(),
            //     tipoPapel: $('#clb_TipoPapel').val(),
            //     tipoImpresion: $('#clb_TipoImpresion').val(),
            //     duplex: $('#duplex').val(),
            //     hojas: $('#hojas').val()
            // };
            // console.log(lote);

            // Cerrar el modal después de añadir el lote
            $('#propiedadesPapelModal').modal('hide');
        });

        // Búsqueda de cliente
        $('#cliente').on('keypress', function (e) {
            if (e.which == 13) { // Enter key
                var idCliente = $(this).val();
                $.ajax({
                    url: 'buscar_cliente.php',
                    method: 'GET',
                    data: { idClien: idCliente },
                    dataType: 'json',
                    success: function (response) {
                        if (response.found) {
                            $('#saldo').val('$' + response.saldo);
                            mostrarMensaje('Cliente encontrado exitosamente.', 'success');
                        } else {
                            $('#saldo').val('');
                            mostrarMensaje('Cliente no encontrado.', 'error');
                        }
                    },
                    error: function () {
                        $('#saldo').val('');
                        mostrarMensaje('Error al buscar el cliente.', 'error');
                    }
                });
            }
        });

        function mostrarMensaje(mensaje, tipo) {
            var color = tipo === 'success' ? 'green' : 'red';
            $('#mensajeModal').remove();
            $('body').append('<div id="mensajeModal" style="position:fixed;top:20px;right:20px;background:'+color+';color:white;padding:10px;border-radius:5px;">' + mensaje + '</div>');
            setTimeout(function() {
                $('#mensajeModal').remove();
            }, 3000);
        }

        // Realizar cobro al presionar el botón "Cobrar"
        $('#charge').click(function() {
            var cliente = $('#cliente').val();
            var total = $('#amount').val();
            var detalles = [];

            $('.table tbody tr').each(function() {
                var lote = $(this).find('td').eq(0).text();
                var hojas = $(this).find('td').eq(1).text();
                var duplex = $(this).find('td').eq(2).text();
                var tamaño = $(this).find('td').eq(3).text();
                var tipoPapel = $(this).find('td').eq(4).text();
                var tipoImpresion = $(this).find('td').eq(5).text();
                var totalFila = $(this).find('td').eq(6).text();

                detalles.push({
                    lote: lote,
                    hojas: hojas,
                    duplex: duplex,
                    tamaño: tamaño,
                    tipoPapel: tipoPapel,
                    tipoImpresion: tipoImpresion,
                    total: totalFila
                });
            });

            $.ajax({
                url: 'realizar_cobro.php',
                method: 'POST',
                data: {
                    cliente: cliente,
                    total: total,
                    detalles: JSON.stringify(detalles)
                },
                success: function(response) {
                    mostrarMensaje('Cobro realizado exitosamente.', 'success');
                },
                error: function() {
                    mostrarMensaje('Error al realizar el cobro.', 'error');
                }
            });
        });
    });
</script>

<script>
        $(document).ready(function() {
            function updateTotal() {
                var cantidad_hojas = $("#hojas").val();
                var duplex = $("#duplex").val();
                var tamaño_papel = $("#clb_TamañoPapel").val();
                var tipo_papel = $("#clb_TipoPapel").val();
                var tipo_impresion = $("#clb_TipoImpresion").val();

                $.ajax({
                    url: 'index.php?action=calculateTotal',
                    type: 'GET',
                    data: {
                        cantidad_hojas: cantidad_hojas,
                        duplex: duplex,
                        tamaño_papel: tamaño_papel,
                        tipo_papel: tipo_papel,
                        tipo_impresion: tipo_impresion
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        var total = data.total;
                        $("#productos").append(`
                            <tr>
                                <td>Lote</td>
                                <td>${cantidad_hojas}</td>
                                <td>${duplex}</td>
                                <td>${tamaño_papel}</td>
                                <td>${tipo_papel}</td>
                                <td>${tipo_impresion}</td>
                                <td>${total}</td>
                                <td><button class="delete-row">Eliminar</button></td>
                            </tr>
                        `);
                    }
                });
            }

            $("#new-batch").click(function(e) {
                e.preventDefault();
                updateTotal();
            });

            $("#productos").on("click", ".delete-row", function() {
                $(this).closest("tr").remove();
            });
        });
    </script>

</body>
</html>
