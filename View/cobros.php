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
    <link href="css/botonscan.css" rel="stylesheet">

    <style>
        /* Estilo para el botón de eliminar */
        .delete-row {
            display: none;
            /* Ocultar el ícono por defecto */
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
            z-index: 1050;
            /* Asegurarse de que esté por encima de otros elementos */
            display: none;
        }

        #amount {
            border: 1px solid #ced4da;
            /* Color del borde del input */
            border-radius: .25rem;
            /* Bordes redondeados */
            padding: .375rem .75rem;
            /* Espaciado interno */
            font-size: 1rem;
            /* Tamaño de la fuente */
            line-height: 1.5;
            /* Altura de línea */
            color: #495057;
            /* Color del texto */
            background-color: #fff;
            /* Color de fondo */
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, .075);
            /* Sombra interna */
        }

        /* Opcional: Estilo para cuando el campo está en foco */
        #amount:focus {
            border-color: #80bdff;
            /* Color del borde en foco */
            outline: 0;
            /* Quitar el contorno predeterminado */
            box-shadow: 0 0 0 .2rem rgba(38, 143, 255, .25);
            /* Sombra en foco */
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
                                <input type="text" value="Alfredo Olivas Jímenez" disabled>
                            </div>
                            <div class="input-container">
                                <label>ID:</label>
                                <input type="text" id="idEmpleado" value="1000001" disabled>
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
                                            <th>¿Duplex?</th>
                                            <th>Tamaño Papel</th>
                                            <th>Tipo de Papel</th>
                                            <th>Tipo de Impresión</th>
                                            <th>Total</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="right-pane">
                                <!-- Botón de Propiedades -->
                                <button type="button" class="btn btn-primary" name="botonAgregar" id="botonAgregar" data-bs-toggle="modal" data-bs-target="#propiedadesPapelModal">
                                    Agregar Lotes
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
                                <button id="paper-plane-button" class="futuristic-button" data-bs-toggle="modal" data-bs-target="#scanQRModal">
                                    <i class="fas"></i> Scan QR code
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
                                    <label for="tamañoPapelSelect">Tamaño de papel</label>
                                    <select class="form-control" id="tamañoPapelSelect">
                                        <option value="">Selecciona</option>
                                    </select>
                                </div>
                                <div class="col-md-4 text-center">
                                    <label for="tipoPapelSelect">Tipo de papel</label>
                                    <select class="form-control" id="tipoPapelSelect">
                                        <option value="">Selecciona</option>
                                    </select>
                                </div>
                                <div class="col-md-4 text-center">
                                    <label for="tipoImpresionSelect">Tipo de impresión</label>
                                    <select class="form-control" id="tipoImpresionSelect">
                                        <option value="">Selecciona</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 text-center">
                                    <label for="duplex">¿Duplex?:</label>
                                    <select class="form-control" id="duplex">
                                        <option value="Sí">Sí</option>
                                        <option value="No">No</option>
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
                                        <i class="fas fa-shopping-cart"></i> Añadir
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

    <!-- Modal para el escáner QR -->
    <div class="modal fade" id="scanQRModal" tabindex="-1" aria-labelledby="scanQRModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanQRModalLabel">Escanear Código QR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="reader" style="width: 100%; height: 400px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="js/lib/html5-qrcode.min.js"></script>


    <script>
        $(document).ready(function() {
            let html5QrCode = null;
            let scanTimeout = null;

            // Función para iniciar el escaneo
            function iniciarEscaneo() {
                if (html5QrCode && html5QrCode.isRunning) {
                    html5QrCode.stop().then(() => {
                        startQrCodeScanner();
                    }).catch(err => {
                        console.log("Error al detener el escaneo: ", err);
                        startQrCodeScanner();
                    });
                } else {
                    startQrCodeScanner();
                }
            }

            // Función para comenzar el escaneo
            function startQrCodeScanner() {
                html5QrCode = new Html5Qrcode("reader");
                html5QrCode.start({
                        facingMode: "environment"
                    }, {
                        fps: 10,
                        qrbox: 250
                    },
                    qrCodeMessage => {
                        console.log("QR Code detected: ", qrCodeMessage);
                        clearTimeout(scanTimeout); // Limpiar temporizador si se detecta un QR
                        html5QrCode.stop().then(() => {
                            $('#scanQRModal').modal('hide');
                            let clienteId = qrCodeMessage;
                            if (clienteId) {
                                $.post('controller/CobrosQRController.php', {
                                    clienteId: clienteId
                                }, function(response) {
                                    if (response.status === 'success') {
                                        $('#cliente').val(clienteId);
                                        $('#saldo').val(response.saldo);
                                        mostrarMensaje('Cliente encontrado exitosamente.', 'success');
                                    } else {
                                        mostrarMensaje(response.message, 'error');
                                    }
                                }, 'json').fail(function() {
                                    mostrarMensaje('Error al obtener los datos del cliente.', 'error');
                                });
                            }
                        }).catch(err => {
                            console.log("Error al detener el escaneo: ", err);
                        });
                    },
                    errorMessage => {
                        console.log("QR Code no match: ", errorMessage);
                    }
                ).then(() => {
                    html5QrCode.isRunning = true; // Indica que el escáner está corriendo
                }).catch(err => {
                    console.log("Unable to start scanning.", err);
                });

                scanTimeout = setTimeout(() => {
                    if (html5QrCode && html5QrCode.isRunning) {
                        html5QrCode.stop().then(() => {
                            $('#scanQRModal').modal('hide');
                        }).catch(err => {
                            console.log("Error al detener el escaneo: ", err);
                        });
                    }
                }, 20000);
            }

            $('#paper-plane-button').click(function() {
                $('#scanQRModal').modal('show');
                setTimeout(() => iniciarEscaneo(), 500);
            });

            // Manejo del cierre del modal
            $('#scanQRModal').on('hidden.bs.modal', function() {
                if (html5QrCode && html5QrCode.isRunning) {
                    html5QrCode.stop().then(() => {
                        html5QrCode = null;
                    }).catch(err => {
                        console.log("Error al detener el escaneo: ", err);
                        html5QrCode = null;
                    });
                }
                clearTimeout(scanTimeout);
            });

            // Función para mostrar mensajes
            function mostrarMensaje(mensaje, tipo) {
                var color = tipo === 'success' ? 'green' : 'red';
                $('#mensajeModal').remove();
                $('body').append('<div id="mensajeModal" style="position:fixed;top:20px;right:20px;background:' + color + ';color:white;padding:10px;border-radius:5px;">' + mensaje + '</div>');
                setTimeout(function() {
                    $('#mensajeModal').remove();
                }, 3000);
            }

            $('#reset-payment').click(function() {
                location.reload();
            });
        });
    </script>

    <script>
        const precios = {
            tamañoPapel: 0,
            tipoImpresion: 0,
            tipoPapel: 0
        };

        function populateTamañoPapel() {
            fetch('../FSP-main-2/controller/cobro_controller.php?type=tamañoPapel', {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    const tamañoPapelSelect = document.getElementById('tamañoPapelSelect');
                    tamañoPapelSelect.innerHTML = '<option value="">Seleccione un tamaño de papel</option>';

                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.ideTamaño;
                        option.textContent = item.NombreTam;
                        option.dataset.precio = item.PreciopUTaP; // Almacenar el precio como un dataset
                        tamañoPapelSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        function populateTipoImpresion() {
            fetch('../FSP-main-2/controller/cobro_controller.php?type=tipoImpresion', {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    const tipoImpresionSelect = document.getElementById('tipoImpresionSelect');
                    tipoImpresionSelect.innerHTML = '<option value="">Seleccione un tipo de impresión</option>';

                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.ideTipoI;
                        option.textContent = item.NombreTipoI;
                        option.dataset.precio = item.PreciopUTiI; // Almacenar el precio como un dataset
                        tipoImpresionSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        function populateTipoPapel() {
            fetch('../FSP-main-2/controller/cobro_controller.php?type=tipoPapel', {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    const tipoPapelSelect = document.getElementById('tipoPapelSelect');
                    tipoPapelSelect.innerHTML = '<option value="">Seleccione un tipo de papel</option>';

                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.ideTipoP;
                        option.textContent = item.NombreTipoP;
                        option.dataset.precio = item.PreciopUTiP; // Almacenar el precio como un dataset
                        tipoPapelSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }



        // Llamada a las funciones para poblar los selects al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            populateTamañoPapel();
            populateTipoImpresion();
            populateTipoPapel();

            document.getElementById('new-batch').addEventListener('click', (event) => {
                event.preventDefault();
                agregarLoteATabla();
            });

            document.getElementById('tamañoPapelSelect').addEventListener('change', actualizarPrecios);
            document.getElementById('tipoImpresionSelect').addEventListener('change', actualizarPrecios);
            document.getElementById('tipoPapelSelect').addEventListener('change', actualizarPrecios);
            document.getElementById('hojas').addEventListener('input', actualizarPrecios);
            document.getElementById('duplex').addEventListener('change', actualizarPrecios);
            verificarEstadoBotonAgregar();
        });




        function verificarEstadoBotonAgregar() {
            const saldoInput = document.getElementById('saldo');
            const botonAgregar = document.getElementById('botonAgregar');

            if (saldoInput.value.trim() === '') {
                botonAgregar.disabled = true;
                botonAgregar.classList.add('disabled');
            } else {
                botonAgregar.disabled = false;
                botonAgregar.classList.remove('disabled');
            }
        }

        let contadorLotes = 0;

        async function getMaxIdCobro() {
            const response = await fetch('../FSP-main-2/controller/cobro_controller.php?type=maxIdCobro');
            const data = await response.json();
            return data.maxIdCobro;
        }

        function incrementarIdCobro(idCobroActual) {
            let nuevoIdCobroNumerico;

            if (idCobroActual === null || idCobroActual === '0') {
                // Si idCobroActual es null o 0, establecer el nuevo ID en 00000001000
                nuevoIdCobroNumerico = 1000; // Convertir a número 1000
            } else {
                const idCobroNumerico = parseInt(idCobroActual, 10);
                nuevoIdCobroNumerico = idCobroNumerico + 1000; // Incrementar en 1000
            }

            // Convertir el número a cadena y rellenar con ceros a la izquierda hasta 11 dígitos
            return nuevoIdCobroNumerico.toString().padStart(11, '0');
        }


        async function calcularIdCobro() {
            const maxIdCobro = await getMaxIdCobro();
            return incrementarIdCobro(maxIdCobro);
        }

        function calcularIdLoteIm(idCobro) {
            contadorLotes++;
            if (contadorLotes > 999) {
                alert("No se pueden hacer más de 999 lotes de impresión en un solo cobro.");
                return null;
            }
            return idCobro.slice(0, 8) + contadorLotes.toString().padStart(3, '0');
        }

        let TotalCobro = 0;

        async function agregarLoteATabla() {
            const tamañoPapelSelect = document.getElementById('tamañoPapelSelect');
            const tipoPapelSelect = document.getElementById('tipoPapelSelect');
            const tipoImpresionSelect = document.getElementById('tipoImpresionSelect');
            const duplexSelect = document.getElementById('duplex');
            const hojasInput = document.getElementById('hojas');

            const tamañoPapel = tamañoPapelSelect.selectedOptions[0].textContent;
            const idTamano = tamañoPapelSelect.value;
            const tipoPapel = tipoPapelSelect.selectedOptions[0].textContent;
            const idTipoP = tipoPapelSelect.value;
            const tipoImpresion = tipoImpresionSelect.selectedOptions[0].textContent;
            const idTipoI = tipoImpresionSelect.value;
            const duplex = duplexSelect.value;
            const duplexBool = getDuplexValue(); // Convertir a 1 o 0
            const hojas = parseInt(hojasInput.value, 10);

            if (!idTamano || !idTipoP || !idTipoI || !hojas) {
                alert("Por favor, ingrese todos los datos necesarios.");
                return;
            }

            const idCobro = await calcularIdCobro();
            const idLoteIm = calcularIdLoteIm(idCobro);
            const total = calcularTotal();

            if (!idLoteIm) return;

            TotalCobro += total; // Sumar el total del lote al total general
            document.getElementById('amount').value = TotalCobro.toFixed(2); // Actualizar el valor en el input

            const tablaCompras = document.querySelector('.table tbody');
            const nuevaFila = document.createElement('tr');
            nuevaFila.dataset.idTamano = idTamano;
            nuevaFila.dataset.idTipoP = idTipoP;
            nuevaFila.dataset.idTipoI = idTipoI;
            nuevaFila.dataset.duplexBool = duplexBool;

            nuevaFila.innerHTML = `
                <td>${idLoteIm}</td>
                <td>${hojas}</td>
                <td>${duplex}</td>
                <td>${tamañoPapel}</td>
                <td>${tipoPapel}</td>
                <td>${tipoImpresion}</td>
                <td>${total.toFixed(2)}</td>
                <td><button class="btn btn-danger delete">Eliminar</button></td>
            `;

            tablaCompras.appendChild(nuevaFila);

            nuevaFila.querySelector('.delete').addEventListener('click', () => {
                TotalCobro -= total; // Restar el total del lote al total general
                document.getElementById('amount').value = TotalCobro.toFixed(2); // Actualizar el valor en el input
                nuevaFila.remove();
                contadorLotes--;
            });

            // Reiniciar valores
            tamañoPapelSelect.selectedIndex = 0;
            tipoPapelSelect.selectedIndex = 0;
            tipoImpresionSelect.selectedIndex = 0;
            duplexSelect.selectedIndex = 0;
            hojasInput.value = '';
        }

        function calcularTotal() {
            const g = 2; // Ganancia estática
            const h = parseInt(document.getElementById('hojas').value, 10); // Cantidad de hojas

            const x = precios.tamañoPapel;
            const y = precios.tipoPapel;
            const z = precios.tipoImpresion;

            const duplex = getDuplexValue();

            if (duplex === 1) {
                return (x + y + z) * g * h;
            } else {
                return ((x + y + z) * g * h) + ((x + y + z) * g * h * 0.1);
            }
        }

        function getDuplexValue() {
            // Obtiene el valor del elemento con id 'duplex'
            const value = document.getElementById('duplex').value;
            // Devuelve 1 si el valor es 'Sí', 0 en caso contrario
            return value === "Sí" ? 1 : 0;
        }


        function actualizarPrecios() {
            const tamañoPapelSelect = document.getElementById('tamañoPapelSelect');
            const tipoImpresionSelect = document.getElementById('tipoImpresionSelect');
            const tipoPapelSelect = document.getElementById('tipoPapelSelect');

            precios.tamañoPapel = parseFloat(tamañoPapelSelect.selectedOptions[0].dataset.precio) || 0;
            precios.tipoImpresion = parseFloat(tipoImpresionSelect.selectedOptions[0].dataset.precio) || 0;
            precios.tipoPapel = parseFloat(tipoPapelSelect.selectedOptions[0].dataset.precio) || 0;
        }

        async function obtenerSaldo(idCliente) {
            try {
                const response = await fetch(`../FSP-main-2/controller/cobro_controller.php?type=obtenerSaldo&idCliente=${idCliente}`);
                const data = await response.json();
                return data.saldo;
            } catch (error) {
                console.error('Error al obtener el saldo:', error);
                return null;
            }
        }

        document.getElementById('charge').addEventListener('click', async function() {
            const idCliente = document.getElementById('cliente').value;
            const saldoActual = await obtenerSaldo(idCliente);
            const TotalCobro = parseFloat(document.getElementById('amount').value);

            if (TotalCobro > saldoActual) {
                alert('El saldo del cliente no es suficiente para realizar este cobro.');
                return;
            }

            await registrarCobro(saldoActual);
        });

        async function registrarCobro(saldoActual) {
            const TotalCobro = parseFloat(document.getElementById('amount').value);
            const idCliente = document.getElementById('cliente').value;
            const idEmpleado = document.getElementById('idEmpleado').value;

            if (!idCliente || !idEmpleado) {
                alert('ID de cliente o empleado no válido.');
                return;
            }

            const filas = document.querySelectorAll('.table tbody tr');

            if (filas.length === 0) {
                alert('No hay lotes para registrar.');
                return;
            }

            const idLoteImPrimeraFila = parseInt(filas[0].children[0].textContent);
            const idCobro = idLoteImPrimeraFila - 1;

            const datos = {
                idCobro,
                idCliente,
                idEmpleado,
                TotalCobro: TotalCobro.toFixed(2),
                nuevoSaldo: (saldoActual - TotalCobro).toFixed(2),
                lotes: []
            };

            filas.forEach(fila => {
                const celdas = fila.children;
                datos.lotes.push({
                    idLoteIm: parseInt(celdas[0].textContent),
                    CantHojas: parseFloat(celdas[1].textContent),
                    DuplexBool: fila.dataset.duplexBool === '1',
                    idTamano: parseInt(fila.dataset.idTamano), // Asegúrate de que aquí sea 'idTamano'
                    idTipoP: parseInt(fila.dataset.idTipoP),
                    idTipoI: parseInt(fila.dataset.idTipoI),
                    CostoLote: parseFloat(celdas[6].textContent)
                });
            });


            try {
                const responseCobro = await fetch('../FSP-main-2/controller/cobro_controller.php?type=registrarCobro', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                });

                if (!responseCobro.ok) {
                    throw new Error('Error al registrar el cobro.');
                }

                const dataCobro = await responseCobro.json();

                if (dataCobro.success) {
                    const responseLotes = await fetch('../FSP-main-2/controller/cobro_controller.php?type=registrarLotes', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            idCobro,
                            lotes: datos.lotes
                        })
                    });

                    if (!responseLotes.ok) {
                        throw new Error('Error al registrar los lotes de impresión.');
                    }

                    const dataLotes = await responseLotes.json();

                    if (dataLotes.success) {
                        alert('Cobro y lotes registrados exitosamente');
                        document.querySelector('.table tbody').innerHTML = '';
                        document.getElementById('amount').value = '0.00';
                        document.getElementById('saldo').value = datos.nuevoSaldo;
                    } else {
                        alert('Error al registrar los lotes de impresión: ' + dataLotes.message);
                    }
                } else {
                    alert('Error al registrar el cobro: ' + dataCobro.message);
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }












        // Guardar propiedades al hacer clic en "Guardar"
        $('#save-properties').click(function() {

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
        document.getElementById('cliente').addEventListener('keypress', function(e) {
            if (e.which == 13) { // Enter key
                var idCliente = $(this).val();
                $.ajax({
                    url: 'buscar_cliente.php',
                    method: 'GET',
                    data: {
                        idClien: idCliente
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.found) {
                            $('#saldo').val('$' + response.saldo);
                            mostrarMensaje('Cliente encontrado exitosamente.', 'success');
                        } else {
                            $('#saldo').val('');
                            mostrarMensaje('Cliente no encontrado.', 'error');
                        }
                        verificarEstadoBotonAgregar();
                    },
                    error: function() {
                        $('#saldo').val('');
                        mostrarMensaje('Error al buscar el cliente.', 'error');
                        verificarEstadoBotonAgregar();
                    }
                });
            }
        });

        function mostrarMensaje(mensaje, tipo) {
            var color = tipo === 'success' ? 'green' : 'red';
            $('#mensajeModal').remove();
            $('body').append('<div id="mensajeModal" style="position:fixed;top:20px;right:20px;background:' + color + ';color:white;padding:10px;border-radius:5px;">' + mensaje + '</div>');
            setTimeout(function() {
                $('#mensajeModal').remove();
            }, 3000);
        }
    </script>

</body>

</html>