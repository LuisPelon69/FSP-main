<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Gestión</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Gestión</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Ganancias (Mensuales)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ganancias (Anuales)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Alcance de Metas</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Correos Recibidos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Ganancias Mensuales Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ganancias Mensuales</h6>
                    <span><strong>Fórmula: G = Q × (Pn - Po) - Cf</strong></span>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                    <!-- Inputs to update chart -->
                    <div class="form-group mt-4">
                        <label for="quantity">Cantidad de Hojas a vender (Q):</label>
                        <input type="number" id="quantity" class="form-control" placeholder="Ingrese la cantidad">
                    </div>
                    <div class="form-group mt-4">
                        <label for="originalPrice">Precio Original de Hojas (Po):</label>
                        <input type="number" id="originalPrice" class="form-control" placeholder="Ingrese el precio original">
                    </div>
                    <div class="form-group mt-4">
                        <label for="newPrice">Precio Nuevo de Hojas (Pn):</label>
                        <input type="number" id="newPrice" class="form-control" placeholder="Ingrese el precio nuevo">
                    </div>
                    <div class="form-group mt-4">
                        <label for="fixedCost">Costos Fijos (Cf):</label>
                        <input type="number" id="fixedCost" class="form-control" value="2000" disabled>
                        <small id="fixedCostHelp" class="form-text text-muted">
                            Ejemplos de costos fijos: alquiler, salarios, servicios públicos, seguros, licencias, mantenimiento de equipos, impuestos de propiedad, marketing y publicidad, servicios de limpieza, software y herramientas.
                        </small>
                    </div>
                    <button id="updateChart" class="btn btn-primary">Actualizar Gráfica</button>

                    <!-- Additional Information -->
                    <div id="additionalInfo" class="mt-4">
                        <p><strong>Ganancias Calculadas (G):</strong> <span id="calculatedEarnings"></span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Fuentes de Ingreso Mensual</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink1">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Ingreso Página Web
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Local
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Otros
                        </span>
                    </div>
                </div>
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

<!-- Chart.js -->
<script>
    var ctx = document.getElementById('myAreaChart').getContext('2d');
    var myAreaChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [{
                label: 'Ganancias Papel',
                data: [12, 19, 3, 5, 2, 3, 7, 10, 8, 12, 15, 20],
                backgroundColor: 'rgba(78, 115, 223, 0.2)',
                borderColor: 'rgba(78, 115, 223, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    document.getElementById('updateChart').addEventListener('click', function() {
        const Q = parseInt(document.getElementById('quantity').value);
        const Po = parseInt(document.getElementById('originalPrice').value);
        const Pn = parseInt(document.getElementById('newPrice').value);
        const Cf = parseInt(document.getElementById('fixedCost').value); // Costos fijos predefinidos

        if (Q && Po && Pn) {
            const G = Q * (Pn - Po) - Cf; // Fórmula simplificada

            // Actualiza el gráfico con el nuevo dato
            myAreaChart.data.datasets[0].data.push(G);
            myAreaChart.data.labels.push(getNextLabel(myAreaChart.data.labels));
            myAreaChart.update();

            // Actualiza la información adicional
            document.getElementById('calculatedEarnings').textContent = "$" + G.toFixed(2);
        }
    });

    function getNextLabel(labels) {
        const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        const lastLabel = labels[labels.length - 1];
        let [lastMonth, lastYear] = lastLabel.split(' ');
        lastYear = lastYear ? parseInt(lastYear) : new Date().getFullYear();

        let nextMonthIndex = months.indexOf(lastMonth) + 1;
        if (nextMonthIndex >= months.length) {
            nextMonthIndex = 0;
            lastYear++;
        }

        return `${months[nextMonthIndex]} ${lastYear}`;
    }
</script>

</body>
</html>
