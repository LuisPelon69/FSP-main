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
            <button id="add-card">Agregar Nuevo Empleado</button>
            <button class="edit-button">Editar</button>
            <button class="delete-button">Eliminar</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Empleados</h6>
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
                                    <th>RFC</th>
                                    <th>Rercargas Realizadas</th>
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
                        <h1>Crear Nuevo Empleado</h1>
                    </strong>
                </div>
                <form class="form-container" id="addForm">
                    <div class="form-group">
                        <label for="NombreEmp">Nombre Completo</label>
                        <input type="text" id="NombreEmp" name="NombreEmp">
                        <span id="error-NombreEmp"></span><br>
                    </div>
                    <div class="form-group">
                        <label id="tipoEmpleado">Tipo de Empleado:</label>
                        <select id="Idstatus" name="Idstatus">
                            <option value="">Seleccione un tipo de empleado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="CURPemp">CURP:</label>
                        <input type="text" id="CURPemp" name="CURPemp">
                        <span id="error-CURPemp"></span>
                    </div>

                    <div class="form-group">
                        <label for="RFC">RFC:</label>
                        <input type="text" id="RFC" name="RFC">
                        <span id="error-RFC"></span>
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

                    <div class="form-group">
                        <label for="PasswordE">Contraseña:</label>
                        <input type="password" id="PasswordE" name="PasswordE">
                        <div class="password-input-container">
                            <span class="toggle-password" id="togglePassword">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </span>
                        </div>
                        <span id="error-PasswordE"></span>
                    </div>

                    <div class="form-group">
                        <label for="confirm-PasswordE">Confirmar Contraseña:</label>
                        <input type="password" id="confirm-PasswordE" name="confirm-PasswordE">
                        <div class="password-input-container">
                            <span class="toggle-password" id="toggleConfirmPasswordE">
                                <i class="fas fa-eye" id="eyeIconConfirm"></i>
                            </span>
                        </div>
                        <span id="error-confirm-PasswordE"></span>
                    </div>

                    <div class="form-buttons">
                        <button type="button" class="cancel" id="cancel-button">Cancelar</button>
                        <button type="submit" class="submit" id="save">Agregar Empleado</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal de Edición -->
        <div id="edit-modal" class="modal">
            <div class="modal-content">

                <div class="card">
                    <strong>
                        <h1>Editar Empleado</h1>
                    </strong>
                </div>
                <form class="form-container" id="editForm">
                    <input type="hidden" id="editId" name="idEmple">

                    <div class="form-group">
                        <label for="NombreEmpE">Nombre Completo:</label>
                        <input type="text" id="NombreEmpE" name="NombreEmpE">
                        <span id="error-NombreEmpE"></span><br>
                    </div>

                    <div class="form-group">
                        <label for="CURPempE">CURP:</label>
                        <input type="text" id="CURPempE" name="CURPempE">
                        <span id="error-CURPempE"></span>
                    </div>

                    <div class="form-group">
                        <label for="RFCE">RFC:</label>
                        <input type="text" id="RFCE" name="RFCE">
                        <span id="error-RFCE"></span>
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
                <p>¿Estás seguro de que deseas eliminar <span idEmple="delete-count"></span> registros seleccionados?</p>
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
            fetch('../FSP-main-2/controller/empleado_controller.php?type=tiposempleado', {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    const tipoEmpleadoSelect = document.getElementById('Idstatus');
                    tipoEmpleadoSelect.innerHTML =
                        '<option value="">Seleccione un tipo</option>'; // Resetea las opciones antes de agregar las nuevas

                    data.forEach(tipo => {
                        const option = document.createElement('option');
                        option.value = tipo
                            .Idstatus; // Asume que 'id' es el campo que quieres usar como valor
                        option.textContent = tipo
                            .NombreStatus; // Asume que 'nombre' es el campo que quieres mostrar como texto
                        tipoEmpleadoSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));


                function fetchEmpleados() {
                fetch('../FSP-main-2/controller/empleado_controller.php', {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data || data.error) {
                            console.error('Error al obtener empleados:', data.error);
                            return;
                        }
                        let table = document.querySelector("table tbody");
                        table.innerHTML = ''; // Limpiar la tabla antes de llenarla
                        data.forEach(empleado => {
                            let row = table.insertRow();
                            row.setAttribute('data-id', empleado.idEmple);

                            // Checkbox con la ID del empleado como valor
                            let cellCheckbox = row.insertCell(0);
                            let checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            checkbox.classList.add('select-checkbox');
                            checkbox.value = empleado.idEmple;
                            cellCheckbox.appendChild(checkbox);

                            // Id del empleado
                            let cellidEmple = row.insertCell(1);
                            cellidEmple.textContent = empleado.idEmple;

                            // Nombre del empleado
                            let cellNombreEmp = row.insertCell(2);
                            cellNombreEmp.textContent = empleado.NombreEmp;

                            // Puesto
                            let cellNombreStatus = row.insertCell(3);
                            cellNombreStatus.textContent = empleado.NombreStatus;

                            // RFC
                            let cellRFC = row.insertCell(4);
                            cellRFC.textContent = empleado.RFC;

                            // Recargas realizadas
                            let cellRecargas = row.insertCell(5);
                            cellRecargas.textContent = empleado.Recargas;

                            // Cobros realizados
                            let cellCobros = row.insertCell(6);
                            cellCobros.textContent = empleado.Cobros;

                            // Dirección
                            let cellDireccion = row.insertCell(7);
                            cellDireccion.textContent =
                                `${empleado.Calle} ${empleado.NoExt} ${empleado.NoInterior} ${empleado.Colonia} ${empleado.Cruzamiento}`;
                        });
                        updateButtonState();
                    })
                    .catch(error => console.error('Error:', error));
            }

            fetchEmpleados();

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
            const CURPemp = document.getElementById('CURPemp');
            const RFC = document.getElementById('RFC');
            const CP = document.getElementById('CP');
            const Calle = document.getElementById('Calle');
            const NoInterior = document.getElementById('NoInterior');
            const NoExt = document.getElementById('NoExt');
            const Colonia = document.getElementById('Colonia');
            const Cruzamiento = document.getElementById('Cruzamiento');
            const PasswordE = document.getElementById('PasswordE');
            const confirmPasswordE = document.getElementById('confirm-PasswordE');
            const modal = document.getElementById('modal');
            const saveButton = document.getElementById('save');
            const closeButton = document.querySelector('.close');
            const tableBody = document.querySelector('table tbody');

            function validarNombreEmp(value) {
                const regex = /^[a-zA-Z\s]+$/;
                return regex.test(value);
            }

            function validarCURP(value) {
                const regex = /^[A-Z]{4}\d{6}[H|M][A-Z]{5}[A-Z0-9][0-9]$/;

                return regex.test(value);
            }

            function validarRFC(value) {
                const regex = /^[A-ZÑ&]{3,4}\d{6}(?:[A-Z\d]{3})?$/;
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


            NombreEmp.addEventListener('input', function() {
                if (!validarNombreEmp(NombreEmp.value.trim())) {
                    mostrarError(NombreEmp, 'Ingrese un nombre válido (solo letras y espacios)');
                } else {
                    limpiarError(NombreEmp);
                }
            });

            CURPemp.addEventListener('input', function() {
                if (!validarCURP(CURPemp.value.trim())) {
                    mostrarError(CURPemp, 'Ingrese una Clave CURP válida');
                } else {
                    limpiarError(CURPemp);
                }
            });

            RFC.addEventListener('input', function() {
                if (!validarRFC(RFC.value.trim())) {
                    mostrarError(RFC, 'Ingrese una RFC válida');
                } else {
                    limpiarError(RFC);
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

            PasswordE.addEventListener('input', function() {
                if (!validarContrasena(PasswordE.value.trim())) {
                    mostrarError(PasswordE, 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un carácter especial y un número');
                } else {
                    limpiarError(PasswordE);
                }
            });

            confirmPasswordE.addEventListener('input', function() {
                const passwordValue = PasswordE.value.trim();
                const confirmPasswordValue = confirmPasswordE.value.trim();
                if (passwordValue !== confirmPasswordValue) {
                    mostrarError(confirmPasswordE, 'Las contraseñas no coinciden');
                } else {
                    limpiarError(confirmPasswordE);
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
                    !validarCURP(CURPemp.value.trim()) ||
                    !validarRFC(RFC.value.trim()) ||
                    !validarCP(CP.value.trim()) ||
                    !validarCalle(Calle.value.trim()) ||
                    !validarNoInterior(NoInterior.value.trim()) ||
                    !validarNoExt(NoExt.value.trim()) ||
                    !validarColonia(Colonia.value.trim()) ||
                    !validarCruzamiento(Cruzamiento.value.trim()) ||
                    !validarContrasena(PasswordE.value.trim()) ||
                    PasswordE.value.trim() !== confirmPasswordE.value.trim()) {
                    alert('Por favor corrija los campos antes de guardar.');
                    return;
                }

                const form = document.getElementById('addForm');
                const data = {
                    NombreEmp: form.elements['NombreEmp'].value,
                    Idstatus: form.elements['Idstatus'].value,
                    CURPemp: form.elements['CURPemp'].value,
                    RFC: form.elements['RFC'].value,
                    CP: form.elements['CP'].value,
                    Calle: form.elements['Calle'].value,
                    NoInterior: form.elements['NoInterior'].value,
                    NoExt: form.elements['NoExt'].value,
                    Colonia: form.elements['Colonia'].value,
                    Cruzamiento: form.elements['Cruzamiento'].value,
                    PasswordE: form.elements['PasswordE'].value
                };

                fetch('../FSP-main-2/controller/empleado_controller.php', {
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
                            alert('Empleado creado exitosamente');
                            form.reset();
                            fetchEmpleados();
                            cerrarModal();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Ocurrió un error: ' + error.message);
                    });
            });


            fetchEmpleados();

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
                    console.log('Editar Empleado con ID:', selectedId);
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
                    console.log('Eliminar Empleados con IDs:', selectedIds);
                    abrirModalEliminar(selectedIds);
                }
            });

            function abrirModalEdicion(id) {
                const modal = document.getElementById('edit-modal');
                const form = document.getElementById('editForm');

                fetch(`../FSP-main-2/controller/empleado_controller.php?id=${id}`, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(empleadoz => {
                        if (!empleadoz || empleadoz.error) {
                            console.error('Error al obtener empleado:', empleadoz.error);
                            return;
                        }
                        form.elements['editId'].value = empleadoz.idEmple || '';
                        form.elements['NombreEmpE'].value = empleadoz.NombreEmp || '';
                        form.elements['CURPempE'].value = empleadoz.CURPemp || '';
                        form.elements['RFCE'].value = empleadoz.RFC || '';
                        form.elements['CalleE'].value = empleadoz.Calle || '';
                        form.elements['NoInteriorE'].value = empleadoz.NoInterior || '';
                        form.elements['NoExtE'].value = empleadoz.NoExt || '';
                        form.elements['ColoniaE'].value = empleadoz.Colonia || '';
                        form.elements['CruzamientoE'].value = empleadoz.Cruzamiento || '';
                        form.elements['CPE'].value = empleadoz.CP || '';

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

            function validarCURP(value) {
                const regex = /^[A-Z]{4}\d{6}[H|M][A-Z]{5}[A-Z0-9][0-9]$/;
                return regex.test(value);
            }

            function validarRFC(value) {
                const regex = /^[A-ZÑ&]{3,4}\d{6}(?:[A-Z\d]{3})?$/;
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
                } else if (elemento.id === 'CURPempE') {
                    if (!validarCURP(valor)) {
                        mostrarError(elemento, 'Ingrese una CURP válida (18 caracteres alfanuméricos)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'RFCE') {
                    if (!validarRFC(valor)) {
                        mostrarError(elemento, 'Ingrese un RFC válido (13 caracteres alfanuméricos)');
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
                    idEmple: form.elements['idEmple'].value,
                    NombreEmp: form.elements['NombreEmpE'].value,
                    CURPemp: form.elements['CURPempE'].value,
                    RFC: form.elements['RFCE'].value,
                    CP: form.elements['CPE'].value,
                    Calle: form.elements['CalleE'].value,
                    NoInterior: form.elements['NoInteriorE'].value,
                    NoExt: form.elements['NoExtE'].value,
                    Colonia: form.elements['ColoniaE'].value,
                    Cruzamiento: form.elements['CruzamientoE'].value
                };

                fetch('../FSP-main-2/controller/empleado_controller.php', {
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
                            fetchEmpleados(); // Actualizar la tabla
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

                fetch('../FSP-main-2/controller/empleado_controller.php', {
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
                            fetchEmpleados(); // Actualizar la tabla
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


        //---------------------------------------------------








        //document.getElementById('closeDelete').addEventListener('click', function() {
        //cerrarModalEliminar();
        //});





        $('#togglePassword').click(function() {
            var passwordField = $('#PasswordE');
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
        $('#toggleConfirmPasswordE').click(function() {
            var confirmPasswordField = $('#confirm-PasswordE');
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



</body>

</html>