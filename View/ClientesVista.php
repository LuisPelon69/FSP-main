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
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <button id="add-card">Agregar Nueva Tarjeta</button>
                <button id="view-qr" class="QR">Ver QR</button>
                <button class="edit-button">Editar</button>
                <button class="delete-button">Eliminar</button>
            </div>
            <form class="d-none d-sm-inline-block form-inline">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control bg-light border-0 small" placeholder="Buscar por nombre..."
                        aria-label="Search" aria-describedby="basic-addon2">
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
                <h6 class="m-0 font-weight-bold text-primary">Tarjetas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SELECCIONAR</th>
                                <th>Nombre</th>
                                <th>Saldo Total</th>
                                <th>Correo Electrónico</th>
                                <th>Teléfono</th>
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

<!-- Modal para mostrar el QR -->
<div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrModalLabel">Código QR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div id="qrcode" class="d-flex justify-content-center"></div>
            </div>
            <div class="modal-footer">
                <button id="download-qr" class="btn btn-primary">Descargar QR</button>
                <button id="close-modal" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


    <!-- Modal de Altas-->
    <div id="modal" class="modal">
        <div class="modal-content">
            <div class="card">
                <strong>
                    <h1>Crear Nuevo Cliente</h1>
                </strong>
            </div>
            <form class="form-container" id="addForm">
                <div class="form-group">
                    <label for="NombreClien">Nombres:</label>
                    <input type="text" id="NombreClien" name="NombreClien">
                    <span id="error-NombreClien"></span><br>
                </div>

                <div class="form-group">
                    <label for="ApellidoP">Apellido Paterno:</label>
                    <input type="text" id="ApellidoP" name="ApellidoP">
                    <span id="error-ApellidoP"></span><br>
                </div>

                <div class="form-group">
                    <label for="ApellidoM">Apellido Materno:</label>
                    <input type="text" id="ApellidoM" name="ApellidoM">
                    <span id="error-ApellidoM"></span><br>
                </div>

                <div class="form-group">
                    <label for="Telefono">Teléfono:</label>
                    <input type="text" id="Telefono" name="Telefono">
                    <span id="error-Telefono"></span><br>
                </div>

                <div class="form-group">
                    <label for="Correo">Correo:</label>
                    <input type="email" id="Correo" name="Correo">
                    <span id="error-Correo"></span><br>
                </div>

                <div class="form-group"></div>

                <div class="form-group">
                    <label for="passwClien">Contraseña:</label>
                    <input type="password" id="passwClien" name="passwClien">
                    <div class="password-input-container">
                        <span class="toggle-password" id="togglePassword">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                    <span id="error-passwClien"></span><br>

                </div>

                <div class="form-group">
                    <label for="confirm-passwClien">Confirmar Contraseña:</label>
                    <input type="password" id="confirm-passwClien" name="confirm-passwClien">
                    <div class="password-input-container">
                        <span class="toggle-password" id="toggleConfirmPassword">
                            <i class="fas fa-eye" id="eyeIconConfirm"></i>
                        </span>
                    </div>
                    <span id="error-confirm-passwClien"></span><br>

                </div>

                <div class="form-buttons">
                    <button type="button" class="cancel" id="cancel-button">Cancelar</button>
                    <button type="submit" class="submit" id="save">Agregar Tarjeta</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal de Edición -->
    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <div class="card">
                <strong>
                    <h1>Editar Cliente</h1>
                </strong>
            </div>
            <form class="form-container" id="editForm">
                <input type="hidden" id="editId" name="id">

                <div class="form-group">
                    <label for="editNombre">Nombre:</label>
                    <input type="text" id="editNombre" name="NombreClien">
                    <span id="error-editNombre"></span>
                </div>

                <div class="form-group">
                    <label for="editApellidoP">Apellido Paterno:</label>
                    <input type="text" id="editApellidoP" name="ApellidoP">
                    <span id="error-editApellidoP"></span>
                </div>

                <div class="form-group">
                    <label for="editApellidoM">Apellido Materno:</label>
                    <input type="text" id="editApellidoM" name="ApellidoM">
                    <span id="error-editApellidoM"></span>
                </div>

                <div class="form-group"></div>

                <div class="form-group">
                    <label for="editTelefono">Teléfono:</label>
                    <input type="text" id="editTelefono" name="Telefono">
                    <span id="error-editTelefono"></span>
                </div>

                <div class="form-group">
                    <label for="editCorreo">Correo:</label>
                    <input type="email" id="editCorreo" name="Correo">
                    <span id="error-editCorreo"></span>
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
            <p>¿Estás seguro de que deseas eliminar <span id="delete-count"></span> registros seleccionados?</p>
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

<script src="js\qrcode.min.js"></script>
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
        function fetchClientes() {
            fetch('../FSP-main-2/controller/cliente_controller.php', {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                if (!data || data.error) {
                    console.error('Error al obtener clientes:', data.error);
                    return;
                }
                populateTable(data);
            })
            .catch(error => console.error('Error:', error));
        }

        function populateTable(data) {
            let table = document.querySelector("table tbody");
            table.innerHTML = ''; // Limpiar la tabla antes de llenarla
            data.forEach(cliente => {
                let row = table.insertRow();
                row.setAttribute('data-id', cliente.idClien);

                // Checkbox con la ID del cliente como valor
                let cellCheckbox = row.insertCell(0);
                let checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.classList.add('select-checkbox');
                checkbox.value = cliente.idClien;
                cellCheckbox.appendChild(checkbox);

                // Nombre completo
                let cellNombre = row.insertCell(1);
                cellNombre.textContent = `${cliente.NombreClien} ${cliente.ApellidoP} ${cliente.ApellidoM}`;

                // Saldo
                let cellSaldo = row.insertCell(2);
                cellSaldo.textContent = `$ ${cliente.Saldo}`;

                // Correo
                let cellCorreo = row.insertCell(3);
                cellCorreo.textContent = cliente.Correo;

                // Teléfono
                let cellTelefono = row.insertCell(4);
                cellTelefono.textContent = cliente.Telefono;
            });
            updateButtonState();
        }

        fetchClientes();

        function updateButtonState() {
            const checkboxes = document.querySelectorAll('.select-checkbox:checked');
            const addButton = document.getElementById('add-card');
            const editButton = document.querySelector('.edit-button');
            const deleteButton = document.querySelector('.delete-button');
            const viewQrButton = document.getElementById('view-qr');

            if (checkboxes.length === 0) {
                addButton.classList.remove('disabled');
                addButton.disabled = false;

                editButton.classList.add('disabled');
                editButton.disabled = true;

                deleteButton.classList.add('disabled');
                deleteButton.disabled = true;

                viewQrButton.classList.add('disabled');
                viewQrButton.disabled = true;
            } else if (checkboxes.length === 1) {
                addButton.classList.add('disabled');
                addButton.disabled = true;

                editButton.classList.remove('disabled');
                editButton.disabled = false;

                deleteButton.classList.remove('disabled');
                deleteButton.disabled = false;

                viewQrButton.classList.remove('disabled');
                viewQrButton.disabled = false;
            } else {
                addButton.classList.add('disabled');
                addButton.disabled = true;

                editButton.classList.add('disabled');
                editButton.disabled = true;

                deleteButton.classList.remove('disabled');
                deleteButton.disabled = false;

                viewQrButton.classList.add('disabled');
                viewQrButton.disabled = true;
            }
        }

        function filterTable() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');
            rows.forEach(row => {
                const name = row.cells[1].textContent.toLowerCase();
                if (name.includes(searchInput)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        document.getElementById('searchInput').addEventListener('input', filterTable);

        const NombreClien = document.getElementById('NombreClien');
        const ApellidoP = document.getElementById('ApellidoP');
        const ApellidoM = document.getElementById('ApellidoM');
        const Telefono = document.getElementById('Telefono');
        const Correo = document.getElementById('Correo');
        const passwClien = document.getElementById('passwClien');
        const confirmPassword = document.getElementById('confirm-passwClien');
        const modal = document.getElementById('modal');
        const saveButton = document.getElementById('save');
        const closeButton = document.querySelector('.close');
        const tableBody = document.querySelector('table tbody');

        function validarNombres(value) {
            const regex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g;
            return regex.test(value);
        }

        function validarTelefono(value) {
            const regex = /^\d{10}$/;
            return regex.test(value);
        }

        function validarCorreo(value) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(value);
        }

        function validarContrasena(value) {
            const regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+={}\[\]:;<>,.?~\-]).{8,}$/;
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

        NombreClien.addEventListener('input', function() {
            if (!validarNombres(NombreClien.value.trim())) {
                mostrarError(NombreClien, 'Ingrese un nombre válido (solo letras y espacios)');
            } else {
                limpiarError(NombreClien);
            }
        });

        ApellidoP.addEventListener('input', function() {
            if (!validarNombres(ApellidoP.value.trim())) {
                mostrarError(ApellidoP, 'Ingrese un apellido paterno válido (solo letras y espacios)');
            } else {
                limpiarError(ApellidoP);
            }
        });

        ApellidoM.addEventListener('input', function() {
            if (!validarNombres(ApellidoM.value.trim())) {
                mostrarError(ApellidoM, 'Ingrese un apellido materno válido (solo letras y espacios)');
            } else {
                limpiarError(ApellidoM);
            }
        });

        Telefono.addEventListener('input', function() {
            if (!validarTelefono(Telefono.value.trim())) {
                mostrarError(Telefono, 'Ingrese un número de teléfono válido (10 dígitos numéricos)');
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

        passwClien.addEventListener('input', function() {
            if (!validarContrasena(passwClien.value.trim())) {
                mostrarError(passwClien, 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un carácter especial y un número');
            } else {
                limpiarError(passwClien);
            }
        });

        confirmPassword.addEventListener('input', function() {
            const passwordValue = passwClien.value.trim();
            const confirmPasswordValue = confirmPassword.value.trim();
            if (passwordValue !== confirmPasswordValue) {
                mostrarError(confirmPassword, 'Las contraseñas no coinciden');
            } else {
                limpiarError(confirmPassword);
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

            if (!validarNombres(NombreClien.value.trim()) ||
                !validarNombres(ApellidoP.value.trim()) ||
                !validarNombres(ApellidoM.value.trim()) ||
                !validarTelefono(Telefono.value.trim()) ||
                !validarCorreo(Correo.value.trim()) ||
                !validarContrasena(passwClien.value.trim()) ||
                passwClien.value.trim() !== confirmPassword.value.trim()) {
                alert('Por favor corrija los campos antes de guardar.');
                return;
            }

            const form = document.getElementById('addForm');
            const data = {
                NombreClien: form.elements['NombreClien'].value,
                ApellidoP: form.elements['ApellidoP'].value,
                ApellidoM: form.elements['ApellidoM'].value,
                Telefono: form.elements['Telefono'].value,
                Correo: form.elements['Correo'].value,
                passwClien: form.elements['passwClien'].value
            };

            fetch('../FSP-main-2/controller/cliente_controller.php', {
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
                    alert('Cliente creado exitosamente');
                    form.reset();
                    fetchClientes();
                    cerrarModal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error: ' + error.message);
            });
        });

        fetchClientes();

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
                console.log('Abrir modal para editar la tarjeta con ID:', selectedId);
                abrirModalEdicion(selectedId);
            }
        });

        document.getElementById('cancelEdit-button').addEventListener('click', function() {
            cerrarModalEdicion();
        });

        document.querySelector('.delete-button').addEventListener('click', function() {
            if (!this.classList.contains('disabled')) {
                const selectedIds = Array.from(document.querySelectorAll('.select-checkbox:checked')).map(cb => cb.value);
                console.log('Eliminar tarjetas con IDs:', selectedIds);
                abrirModalEliminar(selectedIds);
            }
        });

        function abrirModalEdicion(id) {
            const modal = document.getElementById('edit-modal');
            const form = document.getElementById('editForm');

            fetch(`../FSP-main-2/controller/cliente_controller.php?id=${id}`, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(cliente => {
                if (!cliente || cliente.error) {
                    console.error('Error al obtener cliente:', cliente.error);
                    return;
                }
                form.elements['id'].value = cliente.idClien;
                form.elements['NombreClien'].value = cliente.NombreClien;
                form.elements['ApellidoP'].value = cliente.ApellidoP;
                form.elements['ApellidoM'].value = cliente.ApellidoM;
                form.elements['Telefono'].value = cliente.Telefono;
                form.elements['Correo'].value = cliente.Correo;

                modal.style.display = 'block';
            })
            .catch(error => console.error('Error:', error));
        }

        function cerrarModalEdicion() {
            const modal = document.getElementById('edit-modal');
            modal.style.display = 'none';
        }

        function validarNombres(value) {
            const regex = /^[a-zA-Z\s]+$/;
            return regex.test(value);
        }

        function validarTelefono(value) {
            const regex = /^\d{10}$/;
            return regex.test(value);
        }

        function validarCorreo(value) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
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

            if (elemento.id === 'NombreClien' || elemento.id === 'ApellidoP' || elemento.id === 'ApellidoM') {
                if (!validarNombres(valor)) {
                    mostrarError(elemento, 'Ingrese un nombre/apellido válido (solo letras y espacios)');
                } else {
                    limpiarError(elemento);
                }
            } else if (elemento.id === 'Telefono') {
                if (!validarTelefono(valor)) {
                    mostrarError(elemento, 'Ingrese un número de teléfono válido (10 dígitos numéricos)');
                } else {
                    limpiarError(elemento);
                }
            } else if (elemento.id === 'Correo') {
                if (!validarCorreo(valor)) {
                    mostrarError(elemento, 'Ingrese un correo electrónico válido');
                } else {
                    limpiarError(elemento);
                }
            }
        }

        document.getElementById('editSave').addEventListener('click', function(event) {
            event.preventDefault();

            const form = document.getElementById('editForm');
            const NombreClien = form.elements['NombreClien'];
            const ApellidoP = form.elements['ApellidoP'];
            const ApellidoM = form.elements['ApellidoM'];
            const Telefono = form.elements['Telefono'];
            const Correo = form.elements['Correo'];

            if (!validarNombres(NombreClien.value.trim())) {
                mostrarError(NombreClien, 'Ingrese un nombre válido (solo letras y espacios)');
                return;
            } else {
                limpiarError(NombreClien);
            }

            if (!validarNombres(ApellidoP.value.trim())) {
                mostrarError(ApellidoP, 'Ingrese un apellido paterno válido (solo letras y espacios)');
                return;
            } else {
                limpiarError(ApellidoP);
            }

            if (!validarNombres(ApellidoM.value.trim())) {
                mostrarError(ApellidoM, 'Ingrese un apellido materno válido (solo letras y espacios)');
                return;
            } else {
                limpiarError(ApellidoM);
            }

            if (!validarTelefono(Telefono.value.trim())) {
                mostrarError(Telefono, 'Ingrese un número de teléfono válido (10 dígitos numéricos)');
                return;
            } else {
                limpiarError(Telefono);
            }

            if (!validarCorreo(Correo.value.trim())) {
                mostrarError(Correo, 'Ingrese un correo electrónico válido');
                return;
            } else {
                limpiarError(Correo);
            }

            const data = {
                idClien: form.elements['id'].value,
                NombreClien: NombreClien.value,
                ApellidoP: ApellidoP.value,
                ApellidoM: ApellidoM.value,
                Telefono: Telefono.value,
                Correo: Correo.value
            };

            fetch('../FSP-main-2/controller/cliente_controller.php', {
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
                    alert('Cliente actualizado exitosamente');
                    fetchClientes(); // Actualizar la tabla
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

        document.getElementById('editForm').addEventListener('input', validarCampoEnTiempoReal);
        document.getElementById('editForm').addEventListener('blur', validarCampoEnTiempoReal, true);

        document.getElementById('deleteForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const ids = JSON.parse(event.target.elements['ids'].value);

            fetch('../FSP-main-2/controller/cliente_controller.php', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ ids: ids })
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
                    alert('Cliente(s) eliminado(s) exitosamente');
                    fetchClientes(); // Actualizar la tabla
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

        document.getElementById('view-qr').addEventListener('click', function() {
            const selectedCheckbox = document.querySelector('input.select-checkbox:checked');
            if (!selectedCheckbox) {
                alert('Por favor, seleccione un cliente.');
                return;
            }
            const clientId = selectedCheckbox.value;
            const qrContainer = document.getElementById('qrcode');
            qrContainer.innerHTML = '';

            // Generar el QR
            if (QRCode) {
                console.log('QRCode is loaded:', QRCode); // Verificar si QRCode está definido
                const qr = new QRCode(qrContainer, {
                    text: clientId,
                    width: 128,
                    height: 128
                });
                $('#qrModal').modal('show');
            } else {
                console.error('QRCode is not defined');
            }
        });

        document.getElementById('download-qr').addEventListener('click', function() {
            const qrCanvas = document.querySelector('#qrcode canvas');
            const url = qrCanvas.toDataURL("image/png");
            const link = document.createElement('a');
            link.href = url;
            link.download = 'QR_Code.png';
            link.click();
        });

        document.getElementById('close-modal').addEventListener('click', function() {
            $('#qrModal').modal('hide');
        });

    });

    $('#togglePassword').click(function() {
        var passwordField = $('#passwClien');
        var fieldType = passwordField.attr('type');

        if (fieldType === 'password') {
            passwordField.attr('type', 'text');
            $('#eyeIcon').removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            $('#eyeIcon').removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Mostrar u ocultar confirmación de contraseña
    $('#toggleConfirmPassword').click(function() {
        var confirmPasswordField = $('#confirmpasswClien');
        var fieldType = confirmPasswordField.attr('type');

        if (fieldType === 'password') {
            confirmPasswordField.attr('type', 'text');
            $('#eyeIconConfirm').removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            confirmPasswordField.attr('type', 'password');
            $('#eyeIconConfirm').removeClass('fa-eye-slash').addClass('fa-eye');
        }
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