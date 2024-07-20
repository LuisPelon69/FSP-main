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
    <link href="css\Stylegestionar.css" rel="stylesheet">
    <style>
        /* Estilo personalizado para centrar el modal horizontalmente */
        .modal-dialog {
            display: flex;
            justify-content: center;
            margin: auto;
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

                <div class="content">
                    <!-- Tabla con filas que tienen íconos para editar, guardar y eliminar -->
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
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>500</td>
                                    <td>Sí</td>
                                    <td>A4</td>
                                    <td>Bond</td>
                                    <td>Color</td>
                                    <td>$200.00</td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn edit-row"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger delete-row"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Repite las filas según sea necesario -->
                            </tbody>
                        </table>
                    </div>
                    <div class="right-pane">
                        <!-- Botón de Gestionar Tabla centrado y convertido en un dropdown -->
                        <div class="dropdown centered-button">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Gestionar Tabla
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#">Gestionar Empleado</a></li>
                                <li><a class="dropdown-item" href="#">Gestionar Productos</a></li>
                                <li><a class="dropdown-item" href="#">Gestionar Proveedores</a></li>
                                <li><a class="dropdown-item" href="#">Gestionar Tarjetas</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Modal para Editar -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Fila</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="mb-3">
                            <label for="lote" class="form-label">Lote</label>
                            <input type="text" class="form-control" id="lote" required>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad de Hojas</label>
                            <input type="text" class="form-control" id="cantidad" required>
                        </div>
                        <div class="mb-3">
                            <label for="duplex" class="form-label">Duplex</label>
                            <input type="text" class="form-control" id="duplex" required>
                        </div>
                        <div class="mb-3">
                            <label for="tamano" class="form-label">Tamaño Papel</label>
                            <input type="text" class="form-control" id="tamano" required>
                        </div>
                        <div class="mb-3">
                            <label for="papel" class="form-label">Tipo de Papel</label>
                            <input type="text" class="form-control" id="papel" required>
                        </div>
                        <div class="mb-3">
                            <label for="impresion" class="form-label">Tipo de Impresión</label>
                            <input type="text" class="form-control" id="impresion" required>
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="text" class="form-control" id="total" required>
                        </div>
                        <button type="button" id="saveChanges" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="js/modalCobro.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Manejar el evento de clic en el botón de Editar
            document.querySelectorAll('.edit-row').forEach(button => {
                button.addEventListener('click', function () {
                    const row = this.closest('tr');
                    const cells = row.querySelectorAll('td');

                    // Llenar el formulario del modal con los datos actuales de la fila
                    document.getElementById('lote').value = cells[0].textContent;
                    document.getElementById('cantidad').value = cells[1].textContent;
                    document.getElementById('duplex').value = cells[2].textContent;
                    document.getElementById('tamano').value = cells[3].textContent;
                    document.getElementById('papel').value = cells[4].textContent;
                    document.getElementById('impresion').value = cells[5].textContent;
                    document.getElementById('total').value = cells[6].textContent;

                    // Guardar el índice de la fila en un atributo de datos
                    document.getElementById('saveChanges').setAttribute('data-row-index', row.rowIndex - 1);

                    // Mostrar el modal
                    var myModal = new bootstrap.Modal(document.getElementById('editModal'));
                    myModal.show();
                });
            });

            // Manejar el evento de clic en el botón de Guardar Cambios
            document.getElementById('saveChanges').addEventListener('click', function () {
                const rowIndex = this.getAttribute('data-row-index');
                const row = document.querySelector(`table tbody tr:nth-child(${parseInt(rowIndex) + 1})`);
                const cells = row.querySelectorAll('td');

                // Obtener valores del formulario
                const lote = document.getElementById('lote').value;
                const cantidad = document.getElementById('cantidad').value;
                const duplex = document.getElementById('duplex').value;
                const tamano = document.getElementById('tamano').value;
                const papel = document.getElementById('papel').value;
                const impresion = document.getElementById('impresion').value;
                const total = document.getElementById('total').value;

                // Actualizar la fila con los nuevos datos
                cells[0].textContent = lote;
                cells[1].textContent = cantidad;
                cells[2].textContent = duplex;
                cells[3].textContent = tamano;
                cells[4].textContent = papel;
                cells[5].textContent = impresion;
                cells[6].textContent = total;

                // Cerrar el modal
                var myModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
                myModal.hide();

                // Aquí puedes agregar lógica para enviar los cambios al servidor si es necesario
                // Ejemplo: sendUpdateToServer(row);
            });

            // Funcionalidad de eliminar fila
            document.querySelectorAll('.delete-row').forEach(button => {
                button.addEventListener('click', function () {
                    if (confirm('¿Estás seguro de que deseas eliminar esta fila?')) {
                        this.closest('tr').remove();
                    }
                });
            });

            // Función de ejemplo para enviar los cambios al servidor
            function sendUpdateToServer(row) {
                // Aquí iría la lógica para enviar los datos al servidor
                console.log("Enviar cambios al servidor");
            }
        });
    </script>
</body>

</html>
