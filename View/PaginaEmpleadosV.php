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
                                    <input type="text" id="cliente" value="ABC Corp" disabled>
                                </div>
                                <div class="input-container">
                                    <label>Saldo:</label>
                                    <input type="text" id="saldo" value="$500.00" disabled>
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
                                            <th>Acción</th> <!-- Nueva columna para la acción -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>500</td>
                                            <td>Sí</td>
                                            <td>A4</td>
                                            <td>Bond</td>
                                            <td>Color</td>
                                            <td>$200.00</td>
                                            <td><button class="btn btn-danger delete-row"><i class="fas fa-trash-alt"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>1000</td>
                                            <td>No</td>
                                            <td>A3</td>
                                            <td>Mate</td>
                                            <td>Blanco y Negro</td>
                                            <td>$150.00</td>
                                            <td><button class="btn btn-danger delete-row"><i class="fas fa-trash-alt"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>750</td>
                                            <td>Sí</td>
                                            <td>Legal</td>
                                            <td>Glossy</td>
                                            <td>Color</td>
                                            <td>$300.00</td>
                                            <td><button class="btn btn-danger delete-row"><i class="fas fa-trash-alt"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="right-pane">
                                <!-- Botón de Propiedades -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#propiedadesPapelModal">
                                    Ver Propiedades
                                </button>
                                <!-- Opciones de Duplex y Número de hojas -->
                                <div class="mt-3">
                                    <div class="input-container">
                                        <label for="duplex">Duplex:</label>
                                        <select id="duplex">
                                            <option value="si">Sí</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="input-container">
    <label for="hojas">Cantidad de hojas:</label>
    <input type="number" id="hojas" min="1" max="999" step="1" pattern="\d{1,3}" title="Debe ser un número entre 1 y 999 con hasta 3 dígitos" required>
</div>
                                    
                                </div>
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
                            <button id="new-batch" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                            <div class="cart-icon"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Propiedades de Papel-->
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
                                <img src="img\Logo3.png" alt="Icono de Papel" class="img-fluid">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <label for="clb_TamañoPapel">Tamaño de papel</label>
                                <select class="form-control" id="clb_TamañoPapel">
                                    <option value="">Selecciona</option>
                                    <option value="A4">A4</option>
                                    <option value="A3">A3</option>
                                    <option value="Carta">Carta</option>
                                </select>
                            </div>
                            <div class="col-md-4 text-center">
                                <label for="clb_TipoPapel">Tipo de papel</label>
                                <select class="form-control" id="clb_TipoPapel">
                                    <option value="">Selecciona</option>
                                    <option value="Mate">Mate</option>
                                    <option value="Brillante">Brillante</option>
                                    <option value="Satinado">Satinado</option>
                                </select>
                            </div>
                            <div class="col-md-4 text-center">
                                <label for="clb_TipoImpresion">Tipo de impresión</label>
                                <select class="form-control" id="clb_TipoImpresion">
                                    <option value="">Selecciona</option>
                                    <option value="Offset">Offset</option>
                                    <option value="Digital">Digital</option>
                                    <option value="Serigrafía">Serigrafía</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col text-center">
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
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
<script src="js\modalCobro.js"></script>
<script>
    document.getElementById('hojas').addEventListener('input', function (e) {
        const value = e.target.value;
        if (value.length > 3) {
            e.target.value = value.slice(0, 3);
        }
    });
</script>



