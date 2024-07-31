<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reportes de Cobros, Lote de Impresión, Recargas y Logins</title>

    <!-- Fuentes personalizadas para esta plantilla-->
    <link href="../FSP-main-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Estilos personalizados para esta plantilla-->
    <link href="../FSP-main-2/css/sb-admin-2.min.css" rel="stylesheet">

    <!--TABLA DE CLIENTES-->
    <style>
        .table-responsive {
            margin-top: 20px;
        }
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Reportes</h1>
        <p class="mb-4">Reportes de Cobros, Lote de Impresión, Recargas y Logins</p>

        <!-- Selector de tipo de reporte -->
        <div class="d-flex justify-content-end mb-3">
            <select id="reporteTypeSelect" class="form-control" style="width: 200px;">
                <option value="cobros">Cobros</option>
                <option value="loteImpresion">Lote de Impresión</option>
                <option value="recargas">Recargas</option>
                <option value="logins">Registros de Log-In</option>
            </select>
        </div>

        <!-- DataTales Example for Cobros -->
        <div id="cobrosContainer" class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reportes de Cobros</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableCobros" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Cobro</th>
                                <th>Cliente</th>
                                <th>Empleado</th>
                                <th>Fecha y Hora</th>
                                <th>Total Cobro</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be inserted here dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- DataTales Example for Lote de Impresión -->
        <div id="loteImpresionContainer" class="card shadow mb-4" style="display:none;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reportes de Lote de Impresión</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableLoteImpresion" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Lote</th>
                                <th>ID Cobro</th>
                                <th>Tamaño</th>
                                <th>Tipo Papel</th>
                                <th>Tipo Impresión</th>
                                <th>Cantidad Hojas</th>
                                <th>Dúplex</th>
                                <th>Costo Lote</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be inserted here dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- DataTales Example for Recargas -->
        <div id="recargasContainer" class="card shadow mb-4" style="display:none;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reportes de Recargas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableRecargas" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Recarga</th>
                                <th>Cliente</th>
                                <th>Empleado</th>
                                <th>Fecha y Hora</th>
                                <th>Valor Recarga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be inserted here dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- DataTales Example for Logins -->
        <div id="loginsContainer" class="card shadow mb-4" style="display:none;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reportes de Logins</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableLogins" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Fecha y Hora de Login</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be inserted here dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="./js/sb-admin-2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cobrosContainer = document.getElementById('cobrosContainer');
            const loteImpresionContainer = document.getElementById('loteImpresionContainer');
            const recargasContainer = document.getElementById('recargasContainer');
            const loginsContainer = document.getElementById('loginsContainer');
            const reporteTypeSelect = document.getElementById('reporteTypeSelect');

            function showContainer(container) {
                cobrosContainer.style.display = 'none';
                loteImpresionContainer.style.display = 'none';
                recargasContainer.style.display = 'none';
                loginsContainer.style.display = 'none';
                container.style.display = 'block';
            }

            reporteTypeSelect.addEventListener('change', function() {
                switch (reporteTypeSelect.value) {
                    case 'cobros':
                        showContainer(cobrosContainer);
                        fetchData('cobros', populateTableCobros);
                        break;
                    case 'loteImpresion':
                        showContainer(loteImpresionContainer);
                        fetchData('loteImpresion', populateTableLoteImpresion);
                        break;
                    case 'recargas':
                        showContainer(recargasContainer);
                        fetchData('recargas', populateTableRecargas);
                        break;
                    case 'logins':
                        showContainer(loginsContainer);
                        fetchData('logins', populateTableLogins);
                        break;
                }
            });

            showContainer(cobrosContainer);
            fetchData('cobros', populateTableCobros);

            function fetchData(tipo, callback) {
                fetch(`../FSP-main-2/controller/reporte_controller.php?tipo=${tipo}`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data || data.error) {
                            console.error(`Error al obtener datos de ${tipo}:`, data.error);
                            return;
                        }
                        callback(data);
                    })
                    .catch(error => console.error('Error:', error));
            }

            function populateTableCobros(data) {
                let table = document.querySelector("#dataTableCobros tbody");
                table.innerHTML = '';
                data.forEach(cobro => {
                    let row = table.insertRow();
                    row.insertCell(0).textContent = cobro.idCobro;
                    row.insertCell(1).textContent = cobro.NombreCliente;
                    row.insertCell(2).textContent = cobro.NombreEmpleado;
                    row.insertCell(3).textContent = cobro.FechaHoraC;
                    row.insertCell(4).textContent = `$ ${cobro.TotalCobro}`;
                });
            }

            function populateTableLoteImpresion(data) {
                let table = document.querySelector("#dataTableLoteImpresion tbody");
                table.innerHTML = '';
                data.forEach(lote => {
                    let row = table.insertRow();
                    row.insertCell(0).textContent = lote.idLoteIm;
                    row.insertCell(1).textContent = lote.idCobro;
                    row.insertCell(2).textContent = lote.NombreTamano;
                    row.insertCell(3).textContent = lote.NombreTipoPapel;
                    row.insertCell(4).textContent = lote.NombreTipoImpresion;
                    row.insertCell(5).textContent = lote.CantHojas;
                    row.insertCell(6).textContent = lote.DuplexBool ? 'Sí' : 'No';
                    row.insertCell(7).textContent = `$ ${lote.CostoLote}`;
                });
            }

            function populateTableRecargas(data) {
                let table = document.querySelector("#dataTableRecargas tbody");
                table.innerHTML = '';
                data.forEach(recarga => {
                    let row = table.insertRow();
                    row.insertCell(0).textContent = recarga.FoRecarga;
                    row.insertCell(1).textContent = recarga.NombreCliente;
                    row.insertCell(2).textContent = recarga.NombreEmpleado;
                    row.insertCell(3).textContent = recarga.FechaHoraR;
                    row.insertCell(4).textContent = `$ ${recarga.ValorR}`;
                });
            }

            function populateTableLogins(data) {
                let table = document.querySelector("#dataTableLogins tbody");
                table.innerHTML = '';
                data.forEach(login => {
                    let row = table.insertRow();
                    row.insertCell(0).textContent = login.NombreEmpleado;
                    row.insertCell(1).textContent = login.FechaHoraLog;
                });
            }
        });
    </script>
</body>

</html>