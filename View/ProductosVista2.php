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
            margin-left: 566px;
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
                    <label for="NombreTam">Nombre:</label>
                    <input type="text" id="NombreTam" name="NombreTam">
                    <span id="error-NombreTam"></span><br>
                </div>
                <div class="form-group">
                    <label for="PreciopUTaP">Precio Unitario:</label>
                    <input type="text" id="PreciopUTaP" name="PreciopUTaP">
                    <span id="error-PreciopUTaP"></span><br>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonTA">Cancelar</button>
                    <button type="submit" class="submit" id="saveButtonTA">Agregar Tamaño de Papel</button>
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
                    <label for="NombreTipoP">Nombre:</label>
                    <input type="text" id="NombreTipoP" name="NombreTipoP">
                    <span id="error-NombreTipoP"></span><br>
                </div>
                <div class="form-group">
                    <label for="PreciopUTiP">Precio Unitario:</label>
                    <input type="text" id="PreciopUTiP" name="PreciopUTiP">
                    <span id="error-PreciopUTiP"></span><br>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonTP">Cancelar</button>
                    <button type="submit" class="submit" id="saveButtonTP">Agregar Tipo de Papel</button>
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
                    <label for="NombreTipoI">Nombre:</label>
                    <input type="text" id="NombreTipoI" name="NombreTipoI">
                    <span id="error-NombreTipoI"></span><br>
                </div>
                <div class="form-group">
                    <label for="PreciopUTiI">Precio Unitario:</label>
                    <input type="text" id="PreciopUTiI" name="PreciopUTiI">
                    <span id="error-PreciopUTiI"></span><br>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonTI">Cancelar</button>
                    <button type="submit" class="submit" id="saveButtonTI">Agregar Tipo de Impresión</button>
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
                <input type="hidden" id="editIdTA" name="id">
                <div class="form-group">
                    <label for="editNombreTam">Nombre:</label>
                    <input type="text" id="editNombreTam" name="Nombre">
                    <span id="error-editNombreTam"></span><br>
                </div>
                <div class="form-group">
                    <label for="editPreciopUTaP">Precio Unitario:</label>
                    <input type="text" id="editPreciopUTaP" name="PrecioUnitario">
                    <span id="error-editPreciopUTaP"></span><br>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonEditTA">Cancelar</button>
                    <button type="submit" class="submitchanges" id="saveEditTA">Guardar Cambios</button>
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
                <input type="hidden" id="editIdTP" name="id">
                <div class="form-group">
                    <label for="editNombreTipoP">Nombre:</label>
                    <input type="text" id="editNombreTipoP" name="Nombre">
                    <span id="error-editNombreTipoP"></span><br>
                </div>
                <div class="form-group">
                    <label for="editPreciopUTiP">Precio Unitario:</label>
                    <input type="text" id="editPreciopUTiP" name="PrecioUnitario">
                    <span id="error-editPreciopUTiP"></span><br>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonEditTP">Cancelar</button>
                    <button type="submit" class="submitchanges" id="saveEditTP">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    <div id="edit-modalTI" class="modal">
        <div class="modal-content">
            <div class="card">
                <strong>
                    <h1>Editar Tipo de Impresión</h1>
                </strong>
            </div>
            <form class="form-container" id="editFormTI">
                <input type="hidden" id="editIdTI" name="id">
                <div class="form-group">
                    <label for="editNombreTipoI">Nombre:</label>
                    <input type="text" id="editNombreTipoI" name="Nombre">
                    <span id="error-editNombreTipoI"></span><br>
                </div>
                <div class="form-group">
                    <label for="editPreciopUTiI">Precio Unitario:</label>
                    <input type="text" id="editPreciopUTiI" name="PrecioUnitario">
                    <span id="error-editPreciopUTiI"></span><br>
                </div>
                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-buttonEditTI">Cancelar</button>
                    <button type="submit" class="submitchanges" id="saveEditTI">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Eliminación -->
    <div id="modalDeleteTA" class="modal">
        <div class="modal-content">
            <span class="close" id="closeDeleteTA">&times;</span>
            <div class="card">
                <strong>
                    <h1>Eliminar Tamaño de Papel</h1>
                </strong>
            </div>
            <form class="form-container" id="deleteFormTA">
                <input type="hidden" name="ids" id="deleteIdsTA">
                <div class="form-group">
                    <p>¿Está seguro de que desea eliminar este Tamaño de Papel?</p>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="submit" id="deleteTA">Eliminar Tamaño de Papel</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalDeleteTP" class="modal">
        <div class="modal-content">
            <span class="close" id="closeDeleteTP">&times;</span>
            <div class="card">
                <strong>
                    <h1>Eliminar Tipo de Papel</h1>
                </strong>
            </div>
            <form class="form-container" id="deleteFormTP">
                <input type="hidden" name="ids" id="deleteIdsTP">
                <div class="form-group">
                    <p>¿Está seguro de que desea eliminar este Tipo de Papel?</p>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="submit" id="deleteTP">Eliminar Tipo de Papel</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalDeleteTI" class="modal">
        <div class="modal-content">
            <span class="close" id="closeDeleteTI">&times;</span>
            <div class="card">
                <strong>
                    <h1>Eliminar Tipo de Impresión</h1>
                </strong>
            </div>
            <form class="form-container" id="deleteFormTI">
                <input type="hidden" name="ids" id="deleteIdsTI">
                <div class="form-group">
                    <p>¿Está seguro de que desea eliminar este Tipo de Impresión?</p>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="submit" id="deleteTI">Eliminar Tipo de Impresión</button>
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

            // Obtener referencias a los modales de edición
            const editModalTA = document.getElementById('edit-modalTA');
            const editModalTP = document.getElementById('edit-modalTP');
            const editModalTI = document.getElementById('edit-modalTI');

            const formTA = document.getElementById('editFormTA');
            const formTP = document.getElementById('editFormTP');
            const formTI = document.getElementById('editFormTI');

            // Función para obtener y rellenar el formulario
            function fetchAndPopulateForm(url, form, fieldMapping) {
                fetch(url, {
                        method: 'GET'
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Datos recibidos:', data); // Log para depuración
                        if (data.error) {
                            console.error('Error al obtener datos:', data.error);
                            return;
                        }

                        // Mapear los datos a los campos del formulario
                        for (let field in fieldMapping) {
                            let fieldName = fieldMapping[field];
                            if (data[field] !== undefined && form.elements[fieldName]) {
                                form.elements[fieldName].value = data[field];
                                console.log(`Campo ${fieldName} actualizado con valor ${data[field]}`); // Log para depuración
                            } else {
                                console.warn(`Campo ${fieldName} no encontrado en el formulario o dato ${field} no presente en la respuesta.`);
                            }
                        }
                    })
                    .catch(error => console.error('Error al obtener datos:', error));
            }

            // Mapeos de campos para cada formulario
            const fieldMappingTA = {
                'ideTamaño': 'id',
                'NombreTam': 'Nombre',
                'PreciopUTaP': 'PrecioUnitario'
            };

            const fieldMappingTP = {
                'ideTipoP': 'id',
                'NombreTipoP': 'Nombre',
                'PreciopUTiP': 'PrecioUnitario'
            };

            const fieldMappingTI = {
                'ideTipoI': 'id',
                'NombreTipoI': 'Nombre',
                'PreciopUTiI': 'PrecioUnitario'
            };

            // Obtener referencias a los botones de edición
            const editButtonTA = document.getElementById('edit-button-tamaño');
            const editButtonTP = document.getElementById('edit-button-tipo');
            const editButtonTI = document.getElementById('edit-button-impresion');

            // Función para obtener la ID seleccionada
            function getSelectedId() {
                const selectedCheckbox = document.querySelector('.select-checkbox:checked');
                return selectedCheckbox ? selectedCheckbox.value : null;
            }

            // Asociar eventos a los botones de edición
            editButtonTA.addEventListener('click', function() {
                const id = getSelectedId();
                if (!id) {
                    console.error('No se ha seleccionado ningún registro.');
                    return;
                }
                openModal(editModalTA);
                fetchAndPopulateForm(`../FSP-main-2/controller/producto_controller.php?tipo=tamañoPapel&id=${id}`, formTA, fieldMappingTA);
            });

            editButtonTP.addEventListener('click', function() {
                const id = getSelectedId();
                if (!id) {
                    console.error('No se ha seleccionado ningún registro.');
                    return;
                }
                openModal(editModalTP);
                fetchAndPopulateForm(`../FSP-main-2/controller/producto_controller.php?tipo=tipoPapel&id=${id}`, formTP, fieldMappingTP);
            });

            editButtonTI.addEventListener('click', function() {
                const id = getSelectedId();
                if (!id) {
                    console.error('No se ha seleccionado ningún registro.');
                    return;
                }
                openModal(editModalTI);
                fetchAndPopulateForm(`../FSP-main-2/controller/producto_controller.php?tipo=tipoImpresion&id=${id}`, formTI, fieldMappingTI);
            });

            // Obtener referencias a los botones de cancelar en los modales de edición
            const cancelButtonEditTA = document.getElementById('cancel-buttonEditTA');
            const cancelButtonEditTP = document.getElementById('cancel-buttonEditTP');
            const cancelButtonEditTI = document.getElementById('cancel-buttonEditTI');

            const deleteModalTA = document.getElementById('modalDeleteTA');
            const deleteModalTP = document.getElementById('modalDeleteTP');
            const deleteModalTI = document.getElementById('modalDeleteTI');

            // Obtener referencias a los botones de eliminación
            const deleteButtonTA = document.getElementById('delete-button-tamaño');
            const deleteButtonTP = document.getElementById('delete-button-tipo');
            const deleteButtonTI = document.getElementById('delete-button-impresion');

            // Obtener referencias a los botones de cerrar en los modales de eliminación
            const closeDeleteTA = document.getElementById('closeDeleteTA');
            const closeDeleteTP = document.getElementById('closeDeleteTP');
            const closeDeleteTI = document.getElementById('closeDeleteTI');

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

            let selectedId = null;

            // Asociar eventos a los botones de cancelar en los modales de edición
            cancelButtonEditTA.addEventListener('click', function() {
                closeModal(editModalTA);
            });

            cancelButtonEditTP.addEventListener('click', function() {
                closeModal(editModalTP);
            });

            cancelButtonEditTI.addEventListener('click', function() {
                closeModal(editModalTI);
            });

            // Asociar eventos a los botones de eliminación
            deleteButtonTA.addEventListener('click', function() {
                openModal(deleteModalTA);
            });

            deleteButtonTP.addEventListener('click', function() {
                openModal(deleteModalTP);
            });

            deleteButtonTI.addEventListener('click', function() {
                openModal(deleteModalTI);
            });

            // Asociar eventos a los botones de cerrar en los modales de eliminación
            closeDeleteTA.addEventListener('click', function() {
                closeModal(deleteModalTA);
            });

            closeDeleteTP.addEventListener('click', function() {
                closeModal(deleteModalTP);
            });

            closeDeleteTI.addEventListener('click', function() {
                closeModal(deleteModalTI);
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

                // Añadir event listeners a las casillas de verificación
                document.querySelectorAll('.select-checkbox').forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        updateButtonState('tamaño');
                    });
                });

                // Actualizar el estado de los botones al llenar la tabla
                updateButtonState('tamaño');
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

                // Añadir event listeners a las casillas de verificación
                document.querySelectorAll('.select-checkbox').forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        updateButtonState('tipo');
                    });
                });

                // Actualizar el estado de los botones al llenar la tabla
                updateButtonState('tipo');
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

                // Añadir event listeners a las casillas de verificación
                document.querySelectorAll('.select-checkbox').forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        updateButtonState('impresion');
                    });
                });

                // Actualizar el estado de los botones al llenar la tabla
                updateButtonState('impresion');
            }

            function updateButtonState(type) {
                let checkboxes = document.querySelectorAll(`#${type}Container .select-checkbox`);
                let anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                let editButton = document.querySelector(`#edit-button-${type}`);
                let deleteButton = document.querySelector(`#delete-button-${type}`);

                editButton.disabled = !anyChecked;
                deleteButton.disabled = !anyChecked;
            }

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

            function updateButtonState(tipo) {
                const checkboxes = document.querySelectorAll(`#${tipo}-table .select-checkbox:checked`);
                const addButton = document.getElementById(`add-${tipo}`);
                const editButton = document.getElementById(`edit-button-${tipo}`);
                const deleteButton = document.getElementById(`delete-button-${tipo}`);

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

            // Añadir un event listener a las casillas de verificación para actualizar el estado de los botones cuando se seleccione o deseleccione una casilla.
            document.querySelectorAll('.select-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    const tipo = checkbox.closest('table').id.replace('-table', '');
                    updateButtonState(tipo);
                });
            });

            // Funciones de filtrado
            function filterTableTA() {
                const searchInput = searchInputTA.value.toLowerCase();
                const rows = document.querySelectorAll('#tamañoPapelContainer table tbody tr');
                rows.forEach(row => {
                    const name = row.cells[1].textContent.toLowerCase();
                    if (name.includes(searchInput)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            function filterTableTP() {
                const searchInput = searchInputTP.value.toLowerCase();
                const rows = document.querySelectorAll('#tipoPapelContainer table tbody tr');
                rows.forEach(row => {
                    const name = row.cells[1].textContent.toLowerCase();
                    if (name.includes(searchInput)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            function filterTableTI() {
                const searchInput = searchInputTI.value.toLowerCase();
                const rows = document.querySelectorAll('#tipoImpresionContainer table tbody tr');
                rows.forEach(row => {
                    const name = row.cells[1].textContent.toLowerCase();
                    if (name.includes(searchInput)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Asociar eventos de entrada a las funciones de filtrado
            searchInputTA.addEventListener('input', filterTableTA);
            searchInputTP.addEventListener('input', filterTableTP);
            searchInputTI.addEventListener('input', filterTableTI);

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

            const NombreTam = document.getElementById('NombreTam');
            const PreciopUTaP = document.getElementById('PreciopUTaP');
            const NombreTipoP = document.getElementById('NombreTipoP');
            const PreciopUTiP = document.getElementById('PreciopUTiP');
            const NombreTipoI = document.getElementById('NombreTipoI');
            const PreciopUTiI = document.getElementById('PreciopUTiI');

            function validarNombres(value) {
                const regex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1])[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g;
                return regex.test(value);
            }

            function validarPrecios(value) {
                const regex = /^[1-9]\d{0,2}(\.\d{1,2})?$/;
                return regex.test(value);
            }

            function mostrarError(elemento, mensaje) {
                const errorElemento = document.getElementById('error-' + elemento.id);
                errorElemento.textContent = mensaje;
                errorElemento.style.color = 'red';
            }

            function limpiarError(elemento) {
                const errorElemento = document.getElementById('error-' + elemento.id);
                errorElemento.textContent = '';
            }

            NombreTam.addEventListener('input', function() {
                if (!validarNombres(NombreTam.value.trim())) {
                    mostrarError(NombreTam, 'Ingrese un nombre válido (solo letras y espacios)');
                } else {
                    limpiarError(NombreTam);
                }
            });

            PreciopUTaP.addEventListener('input', function() {
                if (!validarPrecios(PreciopUTaP.value.trim())) {
                    mostrarError(PreciopUTaP, 'Ingrese un precio válido (solo números y máximo dos decimales)');
                } else {
                    limpiarError(PreciopUTaP);
                }
            });

            NombreTipoP.addEventListener('input', function() {
                if (!validarNombres(NombreTipoP.value.trim())) {
                    mostrarError(NombreTipoP, 'Ingrese un nombre válido (solo letras y espacios)');
                } else {
                    limpiarError(NombreTipoP);
                }
            });

            PreciopUTiP.addEventListener('input', function() {
                if (!validarPrecios(PreciopUTiP.value.trim())) {
                    mostrarError(PreciopUTiP, 'Ingrese un precio válido (solo números y máximo dos decimales)');
                } else {
                    limpiarError(PreciopUTiP);
                }
            });

            NombreTipoI.addEventListener('input', function() {
                if (!validarNombres(NombreTipoI.value.trim())) {
                    mostrarError(NombreTipoI, 'Ingrese un nombre válido (solo letras y espacios)');
                } else {
                    limpiarError(NombreTipoI);
                }
            });

            PreciopUTiI.addEventListener('input', function() {
                if (!validarPrecios(PreciopUTiI.value.trim())) {
                    mostrarError(PreciopUTiI, 'Ingrese un precio válido (solo números y máximo dos decimales)');
                } else {
                    limpiarError(PreciopUTiI);
                }
            });

            // Asociar eventos a los formularios de guardado
            document.getElementById('saveButtonTA').addEventListener('click', function(event) {
                event.preventDefault();

                const form = document.getElementById('addFormTA');
                const data = {
                    NombreTam: form.elements['NombreTam'].value,
                    PreciopUTaP: form.elements['PreciopUTaP'].value
                };

                fetch('../FSP-main-2/controller/producto_controller.php?tipo=tamañoPapel', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            console.error('Error al guardar tamaño de papel:', data.error);
                            return;
                        } else {
                            console.log('Tamaño de papel guardado con éxito');
                            form.reset();
                            fetchTamañoPapel();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error: ' + error.message);
                    });

                closeModal(document.getElementById('modalTA'));
            });

            document.getElementById('saveButtonTP').addEventListener('click', function(event) {
                event.preventDefault();

                const form = document.getElementById('addFormTP');
                const data = {
                    NombreTipoP: form.elements['NombreTipoP'].value,
                    PreciopUTiP: form.elements['PreciopUTiP'].value
                };

                fetch('../FSP-main-2/controller/producto_controller.php?tipo=tipoPapel', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            console.error('Error al guardar tipo de papel:', data.error);
                            return;
                        } else {
                            console.log('Tipo de papel guardado con éxito');
                            form.reset();
                            fetchTipoPapel();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error: ' + error.message);
                    });

                closeModal(document.getElementById('modalTP'));
            });

            document.getElementById('saveButtonTI').addEventListener('click', function(event) {
                event.preventDefault();

                const form = document.getElementById('addFormTI');
                const data = {
                    NombreTipoI: form.elements['NombreTipoI'].value,
                    PreciopUTiI: form.elements['PreciopUTiI'].value
                };

                fetch('../FSP-main-2/controller/producto_controller.php?tipo=tipoImpresion', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            console.error('Error al guardar tipo de impresión:', data.error);
                            return;
                        } else {
                            console.log('Tipo de impresión guardado con éxito');
                            form.reset();
                            fetchTipoImpresion();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error: ' + error.message);
                    });

                closeModal(document.getElementById('modalTI'));
            });

            // Función para manejar el envío del formulario de eliminación
            function handleDeleteFormSubmit(formId, modalId, tipo, fetchFunction) {
                document.getElementById(formId).addEventListener('submit', function(event) {
                    event.preventDefault();

                    const ids = JSON.parse(event.target.elements['ids'].value);

                    fetch(`../FSP-main-2/controller/producto_controller.php?tipo=${tipo}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                ids: ids
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.error) {
                                alert('Error: ' + data.error);
                            } else {
                                alert(`${tipo} eliminado(s) exitosamente`);
                                fetchFunction(); // Actualizar la tabla
                                document.getElementById(modalId).style.display = 'none';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Ocurrió un error: ' + error.message);
                        });
                });
            }

            // Asignar eventos de submit a los formularios de eliminación
            handleDeleteFormSubmit('deleteFormTA', 'modalDeleteTA', 'tamañoPapel', fetchTamañoPapel);
            handleDeleteFormSubmit('deleteFormTP', 'modalDeleteTP', 'tipoPapel', fetchTipoPapel);
            handleDeleteFormSubmit('deleteFormTI', 'modalDeleteTI', 'tipoImpresion', fetchTipoImpresion);

            // Asignar eventos de clic a los botones de cerrar los modales
            document.getElementById('closeDeleteTA').addEventListener('click', function() {
                document.getElementById('modalDeleteTA').style.display = 'none';
            });

            document.getElementById('closeDeleteTP').addEventListener('click', function() {
                document.getElementById('modalDeleteTP').style.display = 'none';
            });

            document.getElementById('closeDeleteTI').addEventListener('click', function() {
                document.getElementById('modalDeleteTI').style.display = 'none';
            });

            // Función para abrir el modal de eliminación y asignar el ID del elemento a eliminar
            function openDeleteModal(modalId, formId, selectedIds) {
                document.getElementById(modalId).style.display = 'block';
                document.getElementById(formId).elements['ids'].value = JSON.stringify(selectedIds);
            }

            // Asignar eventos de clic a los botones de eliminación para abrir los modales
            document.getElementById('deleteTA').addEventListener('click', function() {
                const selectedIds = Array.from(document.querySelectorAll('#tamaño-table .select-checkbox:checked')).map(cb => cb.value);
                if (selectedIds.length > 0) {
                    openDeleteModal('modalDeleteTA', 'deleteFormTA', selectedIds);
                }
            });

            document.getElementById('deleteTP').addEventListener('click', function() {
                const selectedIds = Array.from(document.querySelectorAll('#tipo-table .select-checkbox:checked')).map(cb => cb.value);
                if (selectedIds.length > 0) {
                    openDeleteModal('modalDeleteTP', 'deleteFormTP', selectedIds);
                }
            });

            document.getElementById('deleteTI').addEventListener('click', function() {
                const selectedIds = Array.from(document.querySelectorAll('#impresion-table .select-checkbox:checked')).map(cb => cb.value);
                if (selectedIds.length > 0) {
                    openDeleteModal('modalDeleteTI', 'deleteFormTI', selectedIds);
                }
            });

            // Función para manejar el envío del formulario de edición
            function handleEditFormSubmit(formId, modalId, tipo, fetchFunction) {
                document.getElementById(formId).addEventListener('submit', function(event) {
                    event.preventDefault();

                    const formData = new FormData(event.target);
                    const data = Object.fromEntries(formData.entries());
                    const id = data.id;

                    fetch(`../FSP-main-2/controller/producto_controller.php?tipo=${tipo}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                alert(`${tipo} actualizado exitosamente`);
                                fetchFunction(); // Actualizar la tabla
                                document.getElementById(modalId).style.display = 'none';
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Ocurrió un error: ' + error.message);
                        });
                });
            }

            // Asignar eventos de submit a los formularios de edición
            handleEditFormSubmit('editFormTA', 'edit-modalTA', 'tamañoPapel', fetchTamañoPapel);
            handleEditFormSubmit('editFormTP', 'edit-modalTP', 'tipoPapel', fetchTipoPapel);
            handleEditFormSubmit('editFormTI', 'edit-modalTI', 'tipoImpresion', fetchTipoImpresion);
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
