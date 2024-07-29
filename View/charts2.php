<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graficas</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            position: relative;
        }
        .chart-overlay {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 5px;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Graficas</h1>
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
        <!-- Area Chart (Top) -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Consumo de Papel Mensual</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLinkTop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLinkTop">
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
                    <div class="chart-area">
                        <canvas id="myAreaChartTop"></canvas>
                    </div>
                    <!-- Inputs to update chart -->
                    <div class="form-group mt-4">
                        <label for="quantity">Cantidad (Q):</label>
                        <input type="number" id="quantity" class="form-control" placeholder="Ingrese la cantidad">
                    </div>
                    <div class="form-group mt-4">
                        <label for="originalPrice">Precio Original (Po):</label>
                        <input type="number" id="originalPrice" class="form-control" placeholder="Ingrese el precio original">
                    </div>
                    <div class="form-group mt-4">
                        <label for="newPrice">Precio Nuevo (Pn):</label>
                        <input type="number" id="newPrice" class="form-control" placeholder="Ingrese el precio nuevo">
                    </div>
                    <button id="updateChartTop" class="btn btn-primary">Actualizar Gráfica</button>

                    <!-- Additional Information -->
                    <div id="additionalInfoTop" class="mt-4">
                        <p><strong>Ganancias Calculadas (G):</strong> <span id="calculatedEarningsTop"></span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cobros Chart (Replacing Bottom Chart) -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Cobros Mensuales</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body chart-container">
                    <div class="chart-overlay">
                        <strong>Fórmula:</strong> C(t) = 9.72t<sup>2</sup> + 25.01t + 1000
                    </div>
                    <div class="chart-area">
                        <canvas id="myCobrosChart"></canvas>
                    </div>
                    <!-- Additional Information -->
                    <div id="additionalInfoCobros" class="mt-4">
                        <p><strong>Total de Cobros:</strong> <span id="totalCobros"></span></p>
                        <p><strong>Tendencias de Cobros:</strong> <span id="cobrosTrends"></span></p>
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
    var ctxTop = document.getElementById('myAreaChartTop').getContext('2d');
    var myAreaChartTop = new Chart(ctxTop, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            datasets: [{
                label: 'Consumo de Papel',
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

    function calculateCobros(t) {
        return 9.72 * Math.pow(t, 2) + 25.01 * t + 1000;
    }

    function generateCobrosData() {
        const labels = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        const values = [];
        for (let t = 0; t < 12; t++) {
            values.push(calculateCobros(t));
        }
        return { labels, values };
    }

    function updateCobrosChart(data) {
        var ctxCobros = document.getElementById('myCobrosChart').getContext('2d');
        var myCobrosChart = new Chart(ctxCobros, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Cobros Mensuales',
                    data: data.values,
                    backgroundColor: 'rgba(54, 185, 204, 0.5)',
                    borderColor: 'rgba(54, 185, 204, 1)',
                    borderWidth: 1
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
    }

    document.addEventListener('DOMContentLoaded', function() {
        const cobrosData = generateCobrosData();
        updateCobrosChart(cobrosData);
        document.getElementById('totalCobros').textContent = cobrosData.values.reduce((a, b) => a + b, 0).toFixed(2);
        document.getElementById('cobrosTrends').textContent = "Tendencia de cobros mensuales basada en la fórmula cuadrática.";
    });

    document.getElementById('updateChartTop').addEventListener('click', function() {
        var Q = parseInt(document.getElementById('quantity').value);
        var Po = parseInt(document.getElementById('originalPrice').value);
        var Pn = parseInt(document.getElementById('newPrice').value);
        
        if (Q && Po && Pn) {
            var G = Q * (Pn - Po);
            
            // Actualiza el gráfico superior con el nuevo dato
            myAreaChartTop.data.datasets[0].data.push(G);
            myAreaChartTop.data.labels.push(getNextLabel(myAreaChartTop.data.labels));
            myAreaChartTop.update();

            // Actualiza la información adicional
            document.getElementById('calculatedEarningsTop').textContent = "$" + G;

            // Actualiza la información adicional
            document.getElementById('totalSalesTop').textContent = "$" + (Pn * Q);
            document.getElementById('unitsSoldTop').textContent = Q + " unidades";
            document.getElementById('monthlyTrendsTop').textContent = "Tendencia basada en el último dato ingresado.";
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
