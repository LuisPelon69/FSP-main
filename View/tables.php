<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Reportes de Cobros</title>

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
        <p class="mb-4">Selecciona el tipo de reporte y la fecha de inicio a fin</p>

        <!-- DataTales Example for Cobros -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Reportes de Cobros</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTableCobros" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Cobro</th>
                                <th>ID Cliente</th>
                                <th>ID Empleado</th>
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

    </div>
    <!-- /.container-fluid -->

    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="./js/sb-admin-2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function fetchCobros() {
                fetch('../FSP-main-2/controller/Cobro_Controller.php', {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data || data.error) {
                            console.error('Error al obtener cobros:', data.error);
                            return;
                        }
                        let table = document.querySelector("#dataTableCobros tbody");
                        table.innerHTML = '';
                        data.forEach(cobro => {
                            let row = table.insertRow();

                            let cellIdCobro = row.insertCell(0);
                            cellIdCobro.textContent = cobro.idCobro;

                            let cellIdCliente = row.insertCell(1);
                            cellIdCliente.textContent = cobro.idCliente;

                            let cellIdEmpleado = row.insertCell(2);
                            cellIdEmpleado.textContent = cobro.idEmpleado;

                            let cellFechaHoraC = row.insertCell(3);
                            cellFechaHoraC.textContent = cobro.FechaHoraC;

                            let cellTotalCobro = row.insertCell(4);
                            cellTotalCobro.textContent = `$ ${cobro.TotalCobro}`;
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }

            fetchCobros();
        });
    </script>
</body>

</html>
