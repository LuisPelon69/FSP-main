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
    <style>
        .chart-container {
            position: relative;
            height: 300px; /* Ajusta la altura según tus necesidades */
            width: 100%;
        }
        .chart-pie-container {
            position: relative;
            height: 200px; /* Ajusta la altura según tus necesidades */
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Gestión</h1>
        
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Ganancias Mensuales Chart -->
        <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Ganancias Mensuales</h6>
                    <span><strong>Fórmula: G = Q × (Pn - Po) - Cf</strong></span>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="myAreaChartTop"></canvas>
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
                        <input type="number" id="fixedCost" class="form-control" value="1000" disabled>
                        <small id="fixedCostHelp" class="form-text text-muted">
                            Ejemplos de costos fijos: alquiler, salarios, servicios públicos, seguros, licencias, mantenimiento de equipos, impuestos de propiedad, marketing y publicidad, servicios de limpieza, software y herramientas.
                        </small>
                    </div>
                    <button id="updateChartTop" class="btn btn-primary">Actualizar Gráfica</button>

                    <!-- Additional Information -->
                    <div id="additionalInfoTop" class="mt-4">
                        <p><strong>Ganancias Calculadas (G):</strong> <span id="calculatedEarningsTop"></span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Fuentes de Ingreso Mensual Pie Chart -->
        <div class="col-xl-4 col-lg-4">
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
                    <div class="chart-pie-container">
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
    var ctxTop = document.getElementById('myAreaChartTop').getContext('2d');
    var myAreaChartTop = new Chart(ctxTop, {
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

    var ctxPie = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: ['Ingreso Página Web', 'Local', 'Otros'],
            datasets: [{
                data: [55, 30, 15],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: 'rgba(234, 236, 244, 1)',
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: 'rgb(255,255,255)',
                bodyFontColor: '#858796',
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });

    document.getElementById('updateChartTop').addEventListener('click', function() {
        var Q = parseInt(document.getElementById('quantity').value);
        var Po = parseInt(document.getElementById('originalPrice').value);
        var Pn = parseInt(document.getElementById('newPrice').value);
        var Cf = parseInt(document.getElementById('fixedCost').value); // Costos fijos predefinidos
        
        if (Q && Po && Pn) {
            var G = Q * (Pn - Po) - Cf; // Fórmula simplificada
            
            // Actualiza el gráfico superior con el nuevo dato
            myAreaChartTop.data.datasets[0].data.push(G);
            myAreaChartTop.data.labels.push(getNextLabel(myAreaChartTop.data.labels));
            myAreaChartTop.update();

            // Actualiza la información adicional
            document.getElementById('calculatedEarningsTop').textContent = "$" + G;
        }
    });

    function getNextLabel(labels) {
        var months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        var lastLabel = labels[labels.length - 1];
        var year = new Date().getFullYear();
        var [lastMonth, lastYear] = lastLabel.split(' ');
        
        var nextMonthIndex = months.indexOf(lastMonth) + 1;
        if (nextMonthIndex >= months.length) {
            nextMonthIndex = 0;
            year++;
        }

        var nextMonth = months[nextMonthIndex];
        if (lastYear) {
            year = parseInt(lastYear);
            return `${nextMonth} ${nextMonthIndex === 0 ? year + 1 : year}`;
        } else {
            return `${nextMonth} ${nextMonthIndex === 0 ? year + 1 : year}`;
        }
    }
</script>

</body>
</html>
