<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FSP - PRODUCTOS</title>

    <!-- Custom fonts for this template-->
    <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../FSP-main-2/css/tarjeta.css">
    <script src="/xampp/FSP-main-2/js/qrcode.min.js"></script>

    <!-- Custom styles for this template-->
    <link href="./css/sb-admin-2.min.css" rel="stylesheet">


    <!--TABLA DE CLIENTES-->
    <style>
        /* Ocultar la columna de ID */
        .hidden {
            display: none;
        }

        .disabled {
            pointer-events: none;
            opacity: 0.5;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }



        /* Estilos para el fondo del modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        /* Estilos para el contenido del modal */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            max-width: 900px;
            max-height: 700px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-75%, -50%);
            height: auto;
            overflow-y: auto;
        }

        /* Estilos para el formulario */
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            width: calc(50% - 10px);
            /* Dos columnas con un espacio entre ellas */
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }



        .error {
            color: red;
            font-size: 11px;
            font-family: Arial, sans-serif;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Estilos para el formulario */
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            width: calc(50% - 10px);
            /* Dos columnas con un espacio entre ellas */
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Estilos para el botón */
        .form-buttons {
            display: flex;
            justify-content: flex-end;
            width: 100%;
        }

        .form-buttons button {
            padding: 10px 20px;
            font-size: 14px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        .form-buttons .submit {
            background-color: #28a745;
            /* Color de fondo para el botón de enviar */
        }

        .form-buttons .submitchanges {
            background-color: #007bff;
            /* Color de fondo para el botón de enviar */
        }

        .form-buttons .cancel {
            background-color: #dc3545;
            /* Color de fondo para el botón de cancelar */
            margin-left: 0;
            /* Eliminar el margen izquierdo para alinear con el borde izquierdo */
        }

        /* Añadir espacio entre los botones */
        .form-buttons .cancel+.submit {
            margin-left: 626px;
            /* Ajustar el margen entre los botones */
        }

        .form-buttons .cancel+.submitchanges {
            margin-left: 615px;
            /* Ajustar el margen entre los botones */
        }


        .error {
            color: red;
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin-top: 5px;
            margin-bottom: 5px;
            display: block;
        }

        .password-input-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            transform: translateY(-130%);
            right: 10px;
            cursor: pointer;
        }

        .toggle-password i {
            color: #666;
        }

        .toggle-password.active i {
            color: #007bff;
        }
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Heading -->
    <div class="main-container">
        <div class="d-flex justify-content-end mb-3">
            <select id="productTypeSelect" class="form-control" style="width: 200px;">
                <option value="tamañoPapel">Tamaño de Papel</option>
                <option value="tipoPapel">Tipo de Papel</option>
                <option value="tipoImpresion">Tipo de Impresión</option>
            </select>
        </div>

        <!-- Contenedores -->
        <div id="tamañoPapelContainer" class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <button id="add-tamaño">Agregar Nuevo Tamaño de Papel</button>
                    <button class="edit-button" id="edit-button-tamaño">Editar</button>
                    <button class="delete-button" id="delete-button-tamaño">Eliminar</button>
                </div>
                <form class="d-none d-sm-inline-block form-inline">
                    <div class="input-group">
                        <input type="text" id="searchInputTA" class="form-control bg-light border-0 small" placeholder="Buscar por nombre..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 id="tableHeader" class="m-0 font-weight-bold text-primary">Tamaños de Papel</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tamaño-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>SELECCIONAR</th>
                                    <th>Nombre</th>
                                    <th>Precio Unitario</th>
                                    <th>Fecha de Última Modificación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Las filas se añadirán dinámicamente con JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="tipoPapelContainer" class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <button id="add-tipo">Agregar Nuevo Tipo de Papel</button>
                    <button class="edit-button" id="edit-button-tipo">Editar</button>
                    <button class="delete-button" id="delete-button-tipo">Eliminar</button>
                </div>
                <form class="d-none d-sm-inline-block form-inline">
                    <div class="input-group">
                        <input type="text" id="searchInputTP" class="form-control bg-light border-0 small" placeholder="Buscar por nombre..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 id="tableHeader" class="m-0 font-weight-bold text-primary">Tipos de Papel</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tipo-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>SELECCIONAR</th>
                                    <th>Nombre</th>
                                    <th>Precio Unitario</th>
                                    <th>Fecha de Última Modificación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Las filas se añadirán dinámicamente con JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="tipoImpresionContainer" class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <button id="add-impresion">Agregar Nuevo Tipo de Impresión</button>
                    <button class="edit-button" id="edit-button-impresion">Editar</button>
                    <button class="delete-button" id="delete-button-impresion">Eliminar</button>
                </div>
                <form class="d-none d-sm-inline-block form-inline">
                    <div class="input-group">
                        <input type="text" id="searchInputTI" class="form-control bg-light border-0 small" placeholder="Buscar por nombre..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 id="tableHeader" class="m-0 font-weight-bold text-primary">Tipos de Impresión</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="impresion-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>SELECCIONAR</th>
                                    <th>Nombre</th>
                                    <th>Precio Unitario</th>
                                    <th>Fecha de Última Modificación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Las filas se añadirán dinámicamente con JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modales -->
    <div id="modalTA" class="modal">
        <div class="modal-content">
            <div class="card">
                <strong>
                    <h1>Crear Nuevo Tamaño de Papel</h1>
                </strong>
            </div>
            <form class="form-container" id="addFormTA">
                <div class="form-group">
                    <label for="NombreProductoTA">Nombre:</label>
                    <input type="text" id="NombreProductoTA" name="NombreProductoTA">
                    <span id="error-NombreProductoTA"></span><br>
                </div>
                <div class="form-group">
                    <label for="PrecioUnitarioTA">Precio Unitario:</label>
                    <input type="text" id="PrecioUnitarioTA" name="PrecioUnitarioTA">
                    <span id="error-PrecioUnitarioTA"></span><br>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonTA">Cancelar</button>
                    <button type="submit" class="submit" id="saveTA">Agregar Tamaño de Papel</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalTP" class="modal">
        <div class="modal-content">
            <div class="card">
                <strong>
                    <h1>Crear Nuevo Tipo de Papel</h1>
                </strong>
            </div>
            <form class="form-container" id="addFormTP">
                <div class="form-group">
                    <label for="NombreProductoTP">Nombre:</label>
                    <input type="text" id="NombreProductoTP" name="NombreProductoTP">
                    <span id="error-NombreProductoTP"></span><br>
                </div>
                <div class="form-group">
                    <label for="PrecioUnitarioTP">Precio Unitario:</label>
                    <input type="text" id="PrecioUnitarioTP" name="PrecioUnitarioTP">
                    <span id="error-PrecioUnitarioTP"></span><br>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonTP">Cancelar</button>
                    <button type="submit" class="submit" id="saveTP">Agregar Tipo de Papel</button>
                </div>
            </form>
        </div>
    </div>


    <div id="modalTI" class="modal">
        <div class="modal-content">
            <div class="card">
                <strong>
                    <h1>Crear Nuevo Tipo de Impresión</h1>
                </strong>
            </div>
            <form class="form-container" id="addFormTI">
                <div class="form-group">
                    <label for="NombreProductoTI">Nombre:</label>
                    <input type="text" id="NombreProductoTI" name="NombreProductoTI">
                    <span id="error-NombreProductoTI"></span><br>
                </div>
                <div class="form-group">
                    <label for="PrecioUnitarioTI">Precio Unitario:</label>
                    <input type="text" id="PrecioUnitarioTI" name="PrecioUnitarioTI">
                    <span id="error-PrecioUnitarioTI"></span><br>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonTI">Cancelar</button>
                    <button type="submit" class="submit" id="saveTI">Agregar Tipo de Impresión</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal de Edición -->
    <div id="edit-modalTA" class="modal">
        <div class="modal-content">
            <div class="card">
                <strong>
                    <h1>Editar Tamaño de Papel</h1>
                </strong>
            </div>
            <form class="form-container" id="editFormTA">
                <div class="form-group">
                    <label for="editNombreProductoTA">Nombre:</label>
                    <input type="text" id="editNombreProductoTA" name="editNombreProductoTA">
                    <span id="error-editNombreProductoTA"></span><br>
                </div>
                <div class="form-group">
                    <label for="editPrecioUnitarioTA">Precio Unitario:</label>
                    <input type="text" id="editPrecioUnitarioTA" name="editPrecioUnitarioTA">
                    <span id="error-editPrecioUnitarioTA"></span><br>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonEditTA">Cancelar</button>
                    <button type="submit" class="submit" id="saveEditTA">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>


    <div id="edit-modalTP" class="modal">
        <div class="modal-content">
            <div class="card">
                <strong>
                    <h1>Editar Tipo de Papel</h1>
                </strong>
            </div>
            <form class="form-container" id="editFormTP">
                <div class="form-group">
                    <label for="editNombreProductoTP">Nombre:</label>
                    <input type="text" id="editNombreProductoTP" name="editNombreProductoTP">
                    <span id="error-editNombreProductoTP"></span><br>
                </div>
                <div class="form-group">
                    <label for="editPrecioUnitarioTP">Precio Unitario:</label>
                    <input type="text" id="editPrecioUnitarioTP" name="editPrecioUnitarioTP">
                    <span id="error-editPrecioUnitarioTP"></span><br>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonEditTP">Cancelar</button>
                    <button type="submit" class="submit" id="saveEditTP">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>


    <div id="edit-modalTP" class="modal">
        <div class="modal-content">
            <div class="card">
                <strong>
                    <h1>Editar Tipo de Impresión</h1>
                </strong>
            </div>
            <form class="form-container" id="editFormTI">
                <div class="form-group">
                    <label for="editNombreProductoTI">Nombre:</label>
                    <input type="text" id="editNombreProductoTI" name="editNombreProductoTI">
                    <span id="error-editNombreProductoTI"></span><br>
                </div>
                <div class="form-group">
                    <label for="editPrecioUnitarioTI">Precio Unitario:</label>
                    <input type="text" id="editPrecioUnitarioTI" name="editPrecioUnitarioTI">
                    <span id="error-editPrecioUnitarioTI"></span><br>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonEditTI">Cancelar</button>
                    <button type="submit" class="submit" id="saveEditTI">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal de Eliminación -->
    <div id="modalDeleteTA" class="modal">
        <div class="modal-content">
            <div class="card">
                <strong>
                    <h1>Eliminar Tamaño de Papel</h1>
                </strong>
            </div>
            <form class="form-container" id="deleteFormTA">
                <div class="form-group">
                    <p>¿Está seguro de que desea eliminar este Tamaño de Papel?</p>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonDeleteTA">Cancelar</button>
                    <button type="submit" class="submit" id="deleteTA">Eliminar Tamaño de Papel</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalDeleteTP" class="modal">
        <div class="modal-content">
            <div class="card">
                <strong>
                    <h1>Eliminar Tipo de Papel</h1>
                </strong>
            </div>
            <form class="form-container" id="deleteFormTP">
                <div class="form-group">
                    <p>¿Está seguro de que desea eliminar este Tipo de Papel?</p>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonDeleteTP">Cancelar</button>
                    <button type="submit" class="submit" id="deleteTP">Eliminar Tamaño de Papel</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalDeleteTI" class="modal">
        <div class="modal-content">
            <div class="card">
                <strong>
                    <h1>Eliminar Tipo de Impresión</h1>
                </strong>
            </div>
            <form class="form-container" id="deleteFormTI">
                <div class="form-group">
                    <p>¿Está seguro de que desea eliminar este Tipo de Impresión?</p>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonDeleteTI">Cancelar</button>
                    <button type="submit" class="submit" id="deleteTI">Eliminar Tamaño de Papel</button>
                </div>
            </form>
        </div>
    </div>

    </div>
    <!-- End of Main Content -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->

    <script src="js\qrcode.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor\jquery\jquery.min.js"></script>
    <script src="vendor\bootstrap\js\bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor\jquery-easing\jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js\sb-admin-2.min.js"></script>
    <!-- Incluye tus scripts al final del body -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            fetchTamañoPapel();

            const tamañoPapelContainer = document.getElementById('tamañoPapelContainer');
            const tipoPapelContainer = document.getElementById('tipoPapelContainer');
            const tipoImpresionContainer = document.getElementById('tipoImpresionContainer');
            const productTypeSelect = document.getElementById('productTypeSelect');


            const modalTA = document.getElementById('modalTA');
            const modalTP = document.getElementById('modalTP');
            const modalTI = document.getElementById('modalTI');

            const addButtonTA = document.getElementById('add-tamaño');
            const addButtonTP = document.getElementById('add-tipo');
            const addButtonTI = document.getElementById('add-impresion');

            const cancelButtonTA = document.getElementById('cancel-buttonTA');
            const cancelButtonTP = document.getElementById('cancel-buttonTP');
            const cancelButtonTI = document.getElementById('cancel-buttonTI');

            const saveButtonTA = document.getElementById('saveTA');
            const saveButtonTP = document.getElementById('saveTP');
            const saveButtonTI = document.getElementById('saveTI');

            // Función para mostrar y ocultar contenedores basados en la selección
            function showContainer(container) {
                tamañoPapelContainer.style.display = 'none';
                tipoPapelContainer.style.display = 'none';
                tipoImpresionContainer.style.display = 'none';
                container.style.display = 'block';
            }

            // Evento de cambio en el selector
            productTypeSelect.addEventListener('change', function() {
                switch (productTypeSelect.value) {
                    case 'tamañoPapel':
                        showContainer(tamañoPapelContainer);
                        fetchTamañoPapel();
                        break;
                    case 'tipoPapel':
                        showContainer(tipoPapelContainer);
                        fetchTipoPapel();
                        break;
                    case 'tipoImpresion':
                        showContainer(tipoImpresionContainer);
                        fetchTipoImpresion();
                        break;
                }
            });

            // Inicializar la vista con el contenedor correspondiente
            showContainer(tamañoPapelContainer);


            // Funciones para abrir y cerrar modales
            function openModal(modal) {
                modal.style.display = 'block';
            }

            function closeModal(modal) {
                modal.style.display = 'none';
            }

            // Asociar eventos a los botones de agregar
            addButtonTA.addEventListener('click', function() {
                openModal(modalTA);
            });

            addButtonTP.addEventListener('click', function() {
                openModal(modalTP);
            });

            addButtonTI.addEventListener('click', function() {
                openModal(modalTI);
            });

            // Asociar eventos a los botones de cancelar
            cancelButtonTA.addEventListener('click', function() {
                closeModal(modalTA);
            });

            cancelButtonTP.addEventListener('click', function() {
                closeModal(modalTP);
            });

            cancelButtonTI.addEventListener('click', function() {
                closeModal(modalTI);
            });

            document.getElementById('productTypeSelect').addEventListener('change', function() {
                const selectedType = this.value;

                // Ocultar todos los contenedores
                document.querySelectorAll('.product-container').forEach(container => {
                    container.style.display = 'none';
                });

                // Mostrar solo el contenedor relevante
                switch (selectedType) {
                    case 'tamañoPapel':
                        document.getElementById('tamañoPapelContainer').style.display = 'block';
                        fetchTamañoPapel();
                        break;
                    case 'tipoPapel':
                        document.getElementById('tipoPapelContainer').style.display = 'block';
                        fetchTipoPapel();
                        break;
                    case 'tipoImpresion':
                        document.getElementById('tipoImpresionContainer').style.display = 'block';
                        fetchTipoImpresion();
                        break;
                }
            });




            function fetchTamañoPapel() {
                fetch('../FSP-main-2/controller/producto_controller.php?tipo=tamañoPapel')
                    .then(response => response.json())
                    .then(data => {
                        if (!data || data.error) {
                            console.error('Error al obtener tamaños de papel:', data.error);
                            return;
                        }
                        populateTableTamañoPapel(data);
                    })
                    .catch(error => console.error('Error:', error));
            }


            function fetchTipoPapel() {
                fetch('../FSP-main-2/controller/producto_controller.php?tipo=tipoPapel')
                    .then(response => response.json())
                    .then(data => {
                        if (!data || data.error) {
                            console.error('Error al obtener tipos de papel:', data.error);
                            return;
                        }
                        populateTableTipoPapel(data);
                    })
                    .catch(error => console.error('Error:', error));
            }

            function fetchTipoImpresion() {
                fetch('../FSP-main-2/controller/producto_controller.php?tipo=tipoImpresion')
                    .then(response => response.json())
                    .then(data => {
                        if (!data || data.error) {
                            console.error('Error al obtener tipos de impresión:', data.error);
                            return;
                        }
                        populateTableTipoImpresion(data);
                    })
                    .catch(error => console.error('Error:', error));
            }





            function populateTableTamañoPapel(data) {
                let table = document.querySelector("table tbody");
                table.innerHTML = ''; // Limpiar la tabla antes de llenarla
                data.forEach(tamañoPapel => {
                    let row = table.insertRow();
                    row.setAttribute('data-id', tamañoPapel.ideTamaño);

                    // Checkbox con la ID del tamaño de papel como valor
                    let cellCheckbox = row.insertCell(0);
                    let checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.classList.add('select-checkbox');
                    checkbox.value = tamañoPapel.ideTamaño;
                    cellCheckbox.appendChild(checkbox);

                    // Nombre del tamaño de papel
                    let cellNombre = row.insertCell(1);
                    cellNombre.textContent = tamañoPapel.NombreTam;

                    // Precio Unitario
                    let cellPrecio = row.insertCell(2);
                    cellPrecio.textContent = `$ ${tamañoPapel.PreciopUTaP}`;

                    // Fecha de Última Modificación
                    let cellFecha = row.insertCell(3);
                    cellFecha.textContent = tamañoPapel.FechaUlModi;
                });
            }

            function populateTableTipoPapel(data) {
                let table = document.querySelector("#tipoPapelContainer table tbody");
                table.innerHTML = ''; // Limpiar la tabla antes de llenarla
                data.forEach(tipoPapel => {
                    let row = table.insertRow();
                    row.setAttribute('data-id', tipoPapel.ideTipoP);

                    // Checkbox con la ID del tipo de papel como valor
                    let cellCheckbox = row.insertCell(0);
                    let checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.classList.add('select-checkbox');
                    checkbox.value = tipoPapel.ideTipoP;
                    cellCheckbox.appendChild(checkbox);

                    // Nombre del tipo de papel
                    let cellNombre = row.insertCell(1);
                    cellNombre.textContent = tipoPapel.NombreTipoP;

                    // Precio Unitario
                    let cellPrecio = row.insertCell(2);
                    cellPrecio.textContent = `$ ${tipoPapel.PreciopUTiP}`;

                    // Fecha de Última Modificación
                    let cellFecha = row.insertCell(3);
                    cellFecha.textContent = tipoPapel.FechaUlModi;
                });
            }

            function populateTableTipoImpresion(data) {
                let table = document.querySelector("#tipoImpresionContainer table tbody");
                table.innerHTML = ''; // Limpiar la tabla antes de llenarla
                data.forEach(tipoImpresion => {
                    let row = table.insertRow();
                    row.setAttribute('data-id', tipoImpresion.ideTipoI);

                    // Checkbox con la ID del tipo de impresión como valor
                    let cellCheckbox = row.insertCell(0);
                    let checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.classList.add('select-checkbox');
                    checkbox.value = tipoImpresion.ideTipoI;
                    cellCheckbox.appendChild(checkbox);

                    // Nombre del tipo de impresión
                    let cellNombre = row.insertCell(1);
                    cellNombre.textContent = tipoImpresion.NombreTipoI;

                    // Precio Unitario
                    let cellPrecio = row.insertCell(2);
                    cellPrecio.textContent = `$ ${tipoImpresion.PreciopUTiI}`;

                    // Fecha de Última Modificación
                    let cellFecha = row.insertCell(3);
                    cellFecha.textContent = tipoImpresion.FechaUlModi;
                });
            }





            function updateButtonState(tipo) {
                const checkboxes = document.querySelectorAll(`#${tipo}-table .select-checkbox:checked`);
                const addButton = document.getElementById(`add-${tipo}`);
                const editButton = document.getElementById(`#edit-button-${tipo}`);
                const deleteButton = document.getElementById(`#delete-button-${tipo}`);

                if (checkboxes.length === 0) {
                    addButton.classList.remove('disabled');
                    addButton.disabled = false;

                    editButton.classList.add('disabled');
                    editButton.disabled = true;

                    deleteButton.classList.add('disabled');
                    deleteButton.disabled = true;

                } else if (checkboxes.length === 1) {
                    addButton.classList.add('disabled');
                    addButton.disabled = true;

                    editButton.classList.remove('disabled');
                    editButton.disabled = false;

                    deleteButton.classList.remove('disabled');
                    deleteButton.disabled = false;

                } else {
                    addButton.classList.add('disabled');
                    addButton.disabled = true;

                    editButton.classList.add('disabled');
                    editButton.disabled = true;

                    deleteButton.classList.remove('disabled');
                    deleteButton.disabled = false;
                }
            }


            document.getElementById('add-tamaño').addEventListener('click', function() {
                console.log('Abrir modal para agregar tamaño de papel');
                // Lógica para abrir el modal de agregar tamaño de papel
            });

            document.querySelector('#edit-button-tamaño').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    const selectedId = document.querySelector('.select-checkbox:checked').value;
                    console.log('Abrir modal para editar tamaño de papel con ID:', selectedId);
                    // Lógica para abrir el modal de edición para tamaño de papel
                }
            });

            document.querySelector('#delete-button-tamaño').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    const selectedIds = Array.from(document.querySelectorAll('.select-checkbox:checked')).map(cb => cb.value);
                    console.log('Eliminar tamaños de papel con IDs:', selectedIds);
                    // Lógica para abrir el modal de confirmación de eliminación para tamaño de papel
                }
            });



            document.getElementById('add-tipo').addEventListener('click', function() {
                console.log('Abrir modal para agregar tipo de papel');
                // Lógica para abrir el modal de agregar tipo de papel
            });

            document.querySelector('#edit-button-tipo').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    const selectedId = document.querySelector('.select-checkbox:checked').value;
                    console.log('Abrir modal para editar tipo de papel con ID:', selectedId);
                    // Lógica para abrir el modal de edición para tipo de papel
                }
            });

            document.querySelector('#delete-button-tipo').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    const selectedIds = Array.from(document.querySelectorAll('.select-checkbox:checked')).map(cb => cb.value);
                    console.log('Eliminar tipos de papel con IDs:', selectedIds);
                    // Lógica para abrir el modal de confirmación de eliminación para tipo de papel
                }
            });




            document.getElementById('add-impresion').addEventListener('click', function() {
                console.log('Abrir modal para agregar tipo de impresión');
                // Lógica para abrir el modal de agregar tipo de impresión
            });

            document.querySelector('#edit-button-impresion').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    const selectedId = document.querySelector('.select-checkbox:checked').value;
                    console.log('Abrir modal para editar tipo de impresión con ID:', selectedId);
                    // Lógica para abrir el modal de edición para tipo de impresión
                }
            });

            document.querySelector('#delete-button-impresion').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    const selectedIds = Array.from(document.querySelectorAll('.select-checkbox:checked')).map(cb => cb.value);
                    console.log('Eliminar tipos de impresión con IDs:', selectedIds);
                    // Lógica para abrir el modal de confirmación de eliminación para tipo de impresión
                }
            });










            // Asociar eventos a los formularios de guardado
            saveButtonTA.addEventListener('click', function(event) {
                event.preventDefault();
                // Validar y enviar datos del formulario
                // Aquí puedes añadir la lógica para guardar los datos y cerrar el modal
                closeModal(modalTA);
            });

            saveButtonTP.addEventListener('click', function(event) {
                event.preventDefault();
                // Validar y enviar datos del formulario
                // Aquí puedes añadir la lógica para guardar los datos y cerrar el modal
                closeModal(modalTP);
            });

            saveButtonTI.addEventListener('click', function(event) {
                event.preventDefault();
                // Validar y enviar datos del formulario
                // Aquí puedes añadir la lógica para guardar los datos y cerrar el modal
                closeModal(modalTI);
            });

            // Validaciones en tiempo real
            document.getElementById('NombreProductoTA').addEventListener('input', function() {
                const error = document.getElementById('error-NombreProductoTA');
                if (this.value.trim() === '') {
                    error.textContent = 'El nombre es obligatorio.';
                } else {
                    error.textContent = '';
                }
            });

            document.getElementById('PrecioUnitarioTA').addEventListener('input', function() {
                const error = document.getElementById('error-PrecioUnitarioTA');
                if (isNaN(this.value) || this.value.trim() === '') {
                    error.textContent = 'El precio debe ser un número.';
                } else {
                    error.textContent = '';
                }
            });

            document.getElementById('NombreProductoTP').addEventListener('input', function() {
                const error = document.getElementById('error-NombreProductoTP');
                if (this.value.trim() === '') {
                    error.textContent = 'El nombre es obligatorio.';
                } else {
                    error.textContent = '';
                }
            });

            document.getElementById('PrecioUnitarioTP').addEventListener('input', function() {
                const error = document.getElementById('error-PrecioUnitarioTP');
                if (isNaN(this.value) || this.value.trim() === '') {
                    error.textContent = 'El precio debe ser un número.';
                } else {
                    error.textContent = '';
                }
            });

            document.getElementById('NombreProductoTI').addEventListener('input', function() {
                const error = document.getElementById('error-NombreProductoTI');
                if (this.value.trim() === '') {
                    error.textContent = 'El nombre es obligatorio.';
                } else {
                    error.textContent = '';
                }
            });

            document.getElementById('PrecioUnitarioTI').addEventListener('input', function() {
                const error = document.getElementById('error-PrecioUnitarioTI');
                if (isNaN(this.value) || this.value.trim() === '') {
                    error.textContent = 'El precio debe ser un número.';
                } else {
                    error.textContent = '';
                }
            });
        });
    </script>

    <style>
        .modal-body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #qrcode {
            margin: 0 auto;
        }
    </style>
</body>

</html>