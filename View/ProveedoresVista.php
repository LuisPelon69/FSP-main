<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FSP Administrador</title>

    <!-- Custom fonts for this template-->
    <link href="../FSP-main-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../FSP-main-2/css/tarjeta.css">

    <!-- Custom styles for this template-->
    <link href="../FSP-main-2/css/sb-admin-2.min.css" rel="stylesheet">


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
            margin-left: 580px;
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
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body id="page-top">


    <!-- Page Heading -->
    <div class="main-container">
        <div class="table-container">
            <button id="add-card">Agregar Nuevo Proveedor</button>
            <button class="edit-button">Editar</button>
            <button class="delete-button">Eliminar</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Proveedores</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>SELECCIONAR</th>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Puesto</th>
                                    <th>Correo</th>
                                    <th>Recargas Realizadas</th>
                                    <th>Cobro Realizados</th>
                                    <th>Dirección</th>
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

        <!-- Modal de Altas -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <div class="card">
                    <strong>
                        <h1>Crear Nuevo Proveedor</h1>
                    </strong>
                </div>
                <form class="form-container" id="addForm">
                    <div class="form-group">
                        <label for="NombreEmp">Nombre Completo</label>
                        <input type="text" id="NombreEmp" name="NombreEmp">
                        <span id="error-NombreEmp"></span><br>
                    </div>
                    <div class="form-group">
                        <label id="tipoProveedor">Tipo de Proveedor:</label>
                        <select id="Idstatus" name="Idstatus">
                            <option value="">Seleccione un tipo de Proveedor</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Telefono">Teléfono:</label>
                        <input type="text" id="Telefono" name="Telefono">
                        <span id="error-Telefono"></span>
                    </div>

                    <div class="form-group">
                        <label for="Correo">Correo:</label>
                        <input type="text" id="Correo" name="Correo">
                        <span id="error-Correo"></span>
                    </div>

                    <div class="form-group">
                        <label for="CP">Código Postal:</label>
                        <input type="text" id="CP" name="CP">
                        <span id="error-CP"></span>
                    </div>

                    <div class="form-group">
                        <label for="Calle">Calle:</label>
                        <input type="text" id="Calle" name="Calle">
                        <span id="error-Calle"></span>
                    </div>

                    <div class="form-group">
                        <label for="NoInterior">Número Interior:</label>
                        <input type="text" id="NoInterior" name="NoInterior">
                        <span id="error-NoInterior"></span>
                    </div>

                    <div class="form-group">
                        <label for="NoExt">Número Exterior:</label>
                        <input type="text" id="NoExt" name="NoExt">
                        <span id="error-NoExt"></span>
                    </div>

                    <div class="form-group">
                        <label for="Colonia">Colonia:</label>
                        <input type="text" id="Colonia" name="Colonia">
                        <span id="error-Colonia"></span>
                    </div>

                    <div class="form-group">
                        <label for="Cruzamiento">Cruzamiento:</label>
                        <input type="text" id="Cruzamiento" name="Cruzamiento">
                        <span id="error-Cruzamiento"></span>
                    </div>

                    <div class="form-buttons">
                        <button type="button" class="cancel" id="cancel-button">Cancelar</button>
                        <button type="submit" class="submit" id="save">Agregar Proveedor</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal de Edición -->
        <div id="edit-modal" class="modal">
            <div class="modal-content">

                <div class="card">
                    <strong>
                        <h1>Editar Proveedor</h1>
                    </strong>
                </div>
                <form class="form-container" id="editForm">
                    <input type="hidden" id="editId" name="idProveedor">

                    <div class="form-group">
                        <label for="NombreEmpE">Nombre Completo:</label>
                        <input type="text" id="NombreEmpE" name="NombreEmpE">
                        <span id="error-NombreEmpE"></span><br>
                    </div>

                    <div class="form-group">
                        <label for="TelefonoE">Teléfono:</label>
                        <input type="text" id="TelefonoE" name="TelefonoE">
                        <span id="error-TelefonoE"></span>
                    </div>

                    <div class="form-group">
                        <label for="CorreoE">Correo:</label>
                        <input type="text" id="CorreoE" name="CorreoE">
                        <span id="error-CorreoE"></span>
                    </div>

                    <div class="form-group">
                        <label for="CPE">Código Postal:</label>
                        <input type="text" id="CPE" name="CPE">
                        <span id="error-CPE"></span>
                    </div>

                    <div class="form-group">
                        <label for="CalleE">Calle:</label>
                        <input type="text" id="CalleE" name="CalleE">
                        <span id="error-CalleE"></span>
                    </div>

                    <div class="form-group">
                        <label for="NoInteriorE">Número Interior:</label>
                        <input type="text" id="NoInteriorE" name="NoInteriorE">
                        <span id="error-NoInteriorE"></span>
                    </div>

                    <div class="form-group">
                        <label for="NoExtE">Número Exterior:</label>
                        <input type="text" id="NoExtE" name="NoExtE">
                        <span id="error-NoExtE"></span>
                    </div>

                    <div class="form-group">
                        <label for="ColoniaE">Colonia:</label>
                        <input type="text" id="ColoniaE" name="ColoniaE">
                        <span id="error-ColoniaE"></span>
                    </div>

                    <div class="form-group">
                        <label for="CruzamientoE">Cruzamiento:</label>
                        <input type="text" id="CruzamientoE" name="CruzamientoE">
                        <span id="error-CruzamientoE"></span>
                    </div>

                    <div class="form-buttons">
                        <button type="button" class="cancel" id="cancelEdit-button">Cancelar</button>
                        <button type="submit" class="submitchanges" id="editSave">Guardar Cambios</button>
                    </div>
                </form>


            </div>
        </div>

        <!-- Modal de Eliminación -->
        <div id="delete-modal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeDelete">&times;</span>
                <h2>Confirmar Eliminación</h2>
                <p>¿Estás seguro de que deseas eliminar <span idProveedor="delete-count"></span> registros seleccionados?</p>
                <form id="deleteForm">
                    <input type="hidden" name="ids" id="delete-ids">
                    <button id="deleteConfirm" type="submit">Confirmar</button>
                </form>
            </div>
        </div>





        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->



    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->


    <!-- Bootstrap core JavaScript-->
    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="./js/sb-admin-2.min.js"></script>
    <!-- Incluye tus scripts al final del body -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.getElementById('cancel-button').addEventListener('click', function() {
                cerrarModalEliminar();
            });

            document.getElementById('add-card').addEventListener('click', function() {
                abrirModal();
            });

            // Fetch and display employees
            fetch('../FSP-main-2/controller/Proveedor_Controller.php?type=tiposProveedor', {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    const tipoProveedoresSelect = document.getElementById('Idstatus');
                    tipoProveedoresSelect.innerHTML =
                        '<option value="">Seleccione un tipo</option>'; // Resetea las opciones antes de agregar las nuevas

                    data.forEach(tipo => {
                        const option = document.createElement('option');
                        option.value = tipo
                            .Idstatus; // Asume que 'id' es el campo que quieres usar como valor
                        option.textContent = tipo
                            .NombreStatus; // Asume que 'nombre' es el campo que quieres mostrar como texto
                        tipoProveedoresSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));


                function fetchProveedores() {
                fetch('../FSP-main-2/controller/Proveedor_Controller.php', {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data || data.error) {
                            console.error('Error al obtener Proveedores:', data.error);
                            return;
                        }
                        let table = document.querySelector("table tbody");
                        table.innerHTML = ''; // Limpiar la tabla antes de llenarla
                        data.forEach(Proveedor => {
                            let row = table.insertRow();
                            row.setAttribute('data-id', Proveedor.idProveedor);

                            // Checkbox con la ID del Proveedor como valor
                            let cellCheckbox = row.insertCell(0);
                            let checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            checkbox.classList.add('select-checkbox');
                            checkbox.value = Proveedor.idProveedor;
                            cellCheckbox.appendChild(checkbox);

                            // Id del Proveedor
                            let cellidProveedor = row.insertCell(1);
                            cellidProveedor.textContent = Proveedor.idProveedor;

                            // Nombre del Proveedor
                            let cellNombreEmp = row.insertCell(2);
                            cellNombreEmp.textContent = Proveedor.NombreEmp;

                            // Puesto
                            let cellNombreStatus = row.insertCell(3);
                            cellNombreStatus.textContent = Proveedor.NombreStatus;

                            // Correo
                            let cellCorreo = row.insertCell(4);
                            cellCorreo.textContent = Proveedor.Correo;

                            // Recargas realizadas
                            let cellRecargas = row.insertCell(5);
                            cellRecargas.textContent = Proveedor.Recargas;

                            // Cobros realizados
                            let cellCobros = row.insertCell(6);
                            cellCobros.textContent = Proveedor.Cobros;

                            // Dirección
                            let cellDireccion = row.insertCell(7);
                            cellDireccion.textContent =
                                `${Proveedor.Calle} ${Proveedor.NoExt} ${Proveedor.NoInterior} ${Proveedor.Colonia} ${Proveedor.Cruzamiento}`;
                        });
                        updateButtonState();
                    })
                    .catch(error => console.error('Error:', error));
            }

            fetchProveedores();

            function updateButtonState() {
                const checkboxes = document.querySelectorAll('.select-checkbox:checked');
                const addButton = document.getElementById('add-card');
                const editButton = document.querySelector('.edit-button');
                const deleteButton = document.querySelector('.delete-button');

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

            const NombreEmp = document.getElementById('NombreEmp');
            const Idstatus = document.getElementById('Idstatus');
            const Telefono = document.getElementById('Telefono');
            const Correo = document.getElementById('Correo');
            const CP = document.getElementById('CP');
            const Calle = document.getElementById('Calle');
            const NoInterior = document.getElementById('NoInterior');
            const NoExt = document.getElementById('NoExt');
            const Colonia = document.getElementById('Colonia');
            const Cruzamiento = document.getElementById('Cruzamiento');
            const modal = document.getElementById('modal');
            const saveButton = document.getElementById('save');
            const closeButton = document.querySelector('.close');
            const tableBody = document.querySelector('table tbody');

            function validarNombreEmp(value) {
                const regex = /^[a-zA-Z\s]+$/;
                return regex.test(value);
            }

            function validarTelefono(value) {
                const regex = /^[0-9]{10}$/;
                return regex.test(value);
            }

            function validarCorreo(value) {
                const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                return regex.test(value);
            }

            function validarCP(value) {
                const regex = /^\d{5}$/;
                return regex.test(value);
            }

            function validarCalle(value) {
                const regex = /^[a-zA-Z0-9\s]+$/;
                return regex.test(value);
            }

            function validarNoInterior(value) {
                const regex = /^[a-zA-Z0-9\s]*$/; // Puede ser alfanumérico o vacío
                return regex.test(value);
            }

            function validarNoExt(value) {
                const regex = /^[a-zA-Z0-9\s]+$/; // Debe ser alfanumérico y no vacío
                return regex.test(value);
            }

            function validarColonia(value) {
                const regex = /^[a-zA-Z0-9\s]+$/;
                return regex.test(value);
            }

            function validarCruzamiento(value) {
                const regex = /^[a-zA-Z0-9\s]*$/; // Puede ser alfanumérico o vacío
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

            function abrirModal() {
                modal.style.display = 'block';
            }

            function cerrarModal() {
                modal.style.display = 'none';
            }

            NombreEmp.addEventListener('input', function() {
                if (!validarNombreEmp(NombreEmp.value.trim())) {
                    mostrarError(NombreEmp, 'Ingrese un nombre válido (solo letras y espacios)');
                } else {
                    limpiarError(NombreEmp);
                }
            });

            Telefono.addEventListener('input', function() {
                if (!validarTelefono(Telefono.value.trim())) {
                    mostrarError(Telefono, 'Ingrese un número de teléfono válido (10 dígitos)');
                } else {
                    limpiarError(Telefono);
                }
            });

            Correo.addEventListener('input', function() {
                if (!validarCorreo(Correo.value.trim())) {
                    mostrarError(Correo, 'Ingrese un correo electrónico válido');
                } else {
                    limpiarError(Correo);
                }
            });

            CP.addEventListener('input', function() {
                if (!validarCP(CP.value.trim())) {
                    mostrarError(CP, 'Ingrese un Código Postal válido');
                } else {
                    limpiarError(CP);
                }
            });

            Calle.addEventListener('input', function() {
                if (!validarCalle(Calle.value.trim())) {
                    mostrarError(Calle, 'Ingrese un nombre o número de calle válido');
                } else {
                    limpiarError(Calle);
                }
            });

            NoInterior.addEventListener('input', function() {
                if (!validarNoInterior(NoInterior.value.trim())) {
                    mostrarError(NoInterior, 'Ingrese un número interior de domicilio válido (o no lo ingrese)');
                } else {
                    limpiarError(NoInterior);
                }
            });

            NoExt.addEventListener('input', function() {
                if (!validarNoExt(NoExt.value.trim())) {
                    mostrarError(NoExt, 'Ingrese un número exterior de domicilio válido');
                } else {
                    limpiarError(Calle);
                }
            });

            Colonia.addEventListener('input', function() {
                if (!validarColonia(Colonia.value.trim())) {
                    mostrarError(Colonia, 'Ingrese un nombre de colonia válido');
                } else {
                    limpiarError(Colonia);
                }
            });

            Colonia.addEventListener('input', function() {
                if (!validarColonia(Colonia.value.trim())) {
                    mostrarError(Colonia, 'Ingrese un nombre de colonia válido');
                } else {
                    limpiarError(Colonia);
                }
            });

            Cruzamiento.addEventListener('input', function() {
                if (!validarCruzamiento(Cruzamiento.value.trim())) {
                    mostrarError(Cruzamiento, 'Ingrese un nombre de cruzamiento válido (o no lo ingrese)');
                } else {
                    limpiarError(Cruzamiento);
                }
            });

            document.getElementById('add-card').addEventListener('click', abrirModal);

            document.getElementById('cancel-button').addEventListener('click', function() {
                cerrarModal();
            });

            closeButton.addEventListener('click', cerrarModal);

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    cerrarModal();
                }
            });

            saveButton.addEventListener('click', function(event) {
                event.preventDefault();

                if (!validarNombreEmp(NombreEmp.value.trim()) ||
                    !validarTelefono(Telefono.value.trim()) ||
                    !validarCorreo(Correo.value.trim()) ||
                    !validarCP(CP.value.trim()) ||
                    !validarCalle(Calle.value.trim()) ||
                    !validarNoInterior(NoInterior.value.trim()) ||
                    !validarNoExt(NoExt.value.trim()) ||
                    !validarColonia(Colonia.value.trim()) ||
                    !validarCruzamiento(Cruzamiento.value.trim())) {
                    alert('Por favor corrija los campos antes de guardar.');
                    return;
                }

                const form = document.getElementById('addForm');
                const data = {
                    NombreEmp: form.elements['NombreEmp'].value,
                    Idstatus: form.elements['Idstatus'].value,
                    Telefono: form.elements['Telefono'].value,
                    Correo: form.elements['Correo'].value,
                    CP: form.elements['CP'].value,
                    Calle: form.elements['Calle'].value,
                    NoInterior: form.elements['NoInterior'].value,
                    NoExt: form.elements['NoExt'].value,
                    Colonia: form.elements['Colonia'].value,
                    Cruzamiento: form.elements['Cruzamiento'].value
                };

                fetch('../FSP-main-2/controller/Proveedor_Controller.php', {
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
                            alert('Error: ' + data.error);
                        } else {
                            alert('Proveedor creado exitosamente');
                            form.reset();
                            fetchProveedores();
                            cerrarModal();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error: ' + error.message);
                    });
            });

            fetchProveedores();

            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('select-checkbox')) {
                    updateButtonState();
                }
            });

            function abrirModalEliminar(ids) {
                const modal = document.getElementById('delete-modal');
                const form = document.getElementById('deleteForm');
                form.elements['ids'].value = JSON.stringify(ids);
                modal.style.display = 'block';
            }

            document.querySelector('.edit-button').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    const selectedId = document.querySelector('.select-checkbox:checked').value;
                    console.log('Editar Proveedor con ID:', selectedId);
                    abrirModalEdicion(selectedId);
                }
            });

            document.getElementById('cancelEdit-button').addEventListener('click', function() {
                cerrarModalEdicion();
            });

            document.querySelector('.delete-button').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    const selectedIds = Array.from(document.querySelectorAll('.select-checkbox:checked'))
                        .map(cb => cb.value);
                    console.log('Eliminar Proveedor con IDs:', selectedIds);
                    abrirModalEliminar(selectedIds);
                }
            });

            function abrirModalEdicion(id) {
                const modal = document.getElementById('edit-modal');
                const form = document.getElementById('editForm');

                fetch(`../FSP-main-2/controller/Proveedor_Controller.php?id=${id}`, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(proveedorz => {
                        if (!proveedorz || proveedorz.error) {
                            console.error('Error al obtener empleado:', proveedorz.error);
                            return;
                        }
                        form.elements['editId'].value = proveedorz.idProveedor || '';
                        form.elements['NombreEmpE'].value = proveedorz.NombreEmp || '';
                        form.elements['TelefonoE'].value = proveedorz.Telefono || '';
                        form.elements['CorreoE'].value = proveedorz.Correo || '';
                        form.elements['CalleE'].value = proveedorz.Calle || '';
                        form.elements['NoInteriorE'].value = proveedorz.NoInterior || '';
                        form.elements['NoExtE'].value = proveedorz.NoExt || '';
                        form.elements['ColoniaE'].value = proveedorz.Colonia || '';
                        form.elements['CruzamientoE'].value = proveedorz.Cruzamiento || '';
                        form.elements['CPE'].value = proveedorz.CP || '';

                        modal.style.display = 'block';
                    })
                    .catch(error => console.error('Error:', error));
            }

            function cerrarModalEdicion() {
                const modal = document.getElementById('edit-modal');
                modal.style.display = 'none';
            }

            function cerrarModalEliminar() {
                const modal = document.getElementById('delete-modal');
                modal.style.display = 'none';
            }

            function validarNombreEmp(value) {
                const regex = /^[a-zA-Z\s]+$/;
                return regex.test(value);
            }

            function validarTelefono(value) {
                const regex = /^[0-9]{10}$/;
                return regex.test(value);
            }

            function validarCorreo(value) {
                const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                return regex.test(value);
            }

            function validarCP(value) {
                const regex = /^\d{5}$/;
                return regex.test(value);
            }

            function validarCalle(value) {
                const regex = /^[a-zA-Z0-9\s]+$/;
                return regex.test(value);
            }

            function validarNoInterior(value) {
                const regex = /^[a-zA-Z0-9\s]*$/; // Puede ser alfanumérico o vacío
                return regex.test(value);
            }

            function validarNoExt(value) {
                const regex = /^[a-zA-Z0-9\s]+$/; // Debe ser alfanumérico y no vacío
                return regex.test(value);
            }

            function validarColonia(value) {
                const regex = /^[a-zA-Z0-9\s]+$/;
                return regex.test(value);
            }

            function validarCruzamiento(value) {
                const regex = /^[a-zA-Z0-9\s]*$/; // Puede ser alfanumérico o vacío
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

            function validarCampoEnTiempoReal(event) {
                const elemento = event.target;
                const valor = elemento.value.trim();

                if (elemento.id === 'NombreEmpE') {
                    if (!validarNombreEmp(valor)) {
                        mostrarError(elemento, 'Ingrese un nombre y apellido válido (solo letras y espacios)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'TelefonoE') {
                    if (!validarTelefono(valor)) {
                        mostrarError(elemento, 'Ingrese un número de teléfono válido (10 dígitos)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'CorreoE') {
                    if (!validarCorreo(valor)) {
                        mostrarError(elemento, 'Ingrese un correo electrónico válido');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'CPE') {
                    if (!validarCP(valor)) {
                        mostrarError(elemento, 'Ingrese un código postal válido (5 dígitos numéricos)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'CalleE') {
                    if (!validarCalle(valor)) {
                        mostrarError(elemento, 'Ingrese un nombre de calle válido');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'NoInteriorE') {
                    if (!validarNoInterior(valor)) {
                        mostrarError(elemento, 'Ingrese un número interior de domicilio válido (o no lo ingrese)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'NoExtE') {
                    if (!validarNoExt(valor)) {
                        mostrarError(elemento, 'Ingrese un número exterior de domicilio válido');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'ColoniaE') {
                    if (!validarColonia(valor)) {
                        mostrarError(elemento, 'Ingrese un nombre de colonia válido');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'CruzamientoE') {
                    if (!validarCruzamiento(valor)) {
                        mostrarError(elemento, 'Ingrese un nombre de cruzamiento válido (o no lo ingrese)');
                    } else {
                        limpiarError(elemento);
                    }
                }
            }

            document.getElementById('editForm').addEventListener('input', validarCampoEnTiempoReal);

            document.getElementById('editSave').addEventListener('click', function(event) {
                event.preventDefault();

                const form = document.getElementById('editForm');
                const data = {
                    idProveedor: form.elements['idProveedor'].value,
                    NombreEmp: form.elements['NombreEmpE'].value,
                    Telefono: form.elements['TelefonoE'].value,
                    Correo: form.elements['CorreoE'].value,
                    CP: form.elements['CPE'].value,
                    Calle: form.elements['CalleE'].value,
                    NoInterior: form.elements['NoInteriorE'].value,
                    NoExt: form.elements['NoExtE'].value,
                    Colonia: form.elements['ColoniaE'].value,
                    Cruzamiento: form.elements['CruzamientoE'].value
                };

                fetch('../FSP-main-2/controller/Proveedor_Controller.php', {
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
                        if (data.error) {
                            alert('Error: ' + data.error);
                        } else {
                            alert('Empleado actualizado exitosamente');
                            fetchProveedores(); // Actualizar la tabla
                            cerrarModalEdicion();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error: ' + error.message);
                    });
            });

            window.addEventListener('click', function(event) {
                if (event.target === document.getElementById('edit-modal')) {
                    cerrarModalEdicion();
                }
            });

            document.getElementById('deleteForm').addEventListener('submit', function(event) {
                event.preventDefault();

                const ids = JSON.parse(event.target.elements['ids'].value);

                fetch('../FSP-main-2/controller/Proveedor_Controller.php', {
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
                            alert('Empleado(s) eliminado(s) exitosamente');
                            fetchProveedores(); // Actualizar la tabla
                            document.getElementById('delete-modal').style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error: ' + error.message);
                    });
            });

            document.querySelector('#delete-modal .close').addEventListener('click', function() {
                document.getElementById('delete-modal').style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target === document.getElementById('delete-modal')) {
                    document.getElementById('delete-modal').style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
