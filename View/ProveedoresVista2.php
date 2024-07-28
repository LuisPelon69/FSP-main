<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FSP Administrador</title>

    <!-- Fuentes personalizadas para esta plantilla-->
    <link href="../FSP-main-2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../FSP-main-2/css/tarjeta.css">

    <!-- Estilos personalizados para esta plantilla-->
    <link href="../FSP-main-2/css/sb-admin-2.min.css" rel="stylesheet">

    <!--TABLA DE CLIENTES-->
    <style>
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
            transform: translate(-50%, -50%);
            height: auto;
            overflow-y: auto;
        }

        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            width: calc(50% - 10px);
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
        }

        .form-buttons .submitchanges {
            background-color: #007bff;
        }

        .form-buttons .cancel {
            background-color: #dc3545;
            margin-left: 0;
        }

        .form-buttons .cancel+.submit {
            margin-left: 10px;
        }

        .form-buttons .cancel+.submitchanges {
            margin-left: 10px;
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


    <div class="main-container">
        <div class="table-container">
            <button id="add-card">Agregar Nuevo Proveedor</button>
            <button class="edit-button disabled">Editar</button>
            <button class="delete-button disabled">Eliminar</button>
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
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Dirección</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal" class="modal">
            <div class="modal-content">
                <div class="card">
                    <strong>
                        <h1>Crear Nuevo Proveedor</h1>
                    </strong>
                </div>
                <form class="form-container" id="addForm">
                    <div class="form-group">
                        <label for="NombreProveedor">Nombre Completo</label>
                        <input type="text" id="NombreProveedor" name="NombreProveedor">
                        <span id="error-NombreProveedor"></span><br>
                    </div>
                    <div class="form-group">
                        <label id="tipoProveedor">Tipo de Proveedor:</label>
                        <select id="IdTipo" name="IdTipo">
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
                        <label for="CodigoPostal">Código Postal:</label>
                        <input type="text" id="CodigoPostal" name="CodigoPostal">
                        <span id="error-CodigoPostal"></span>
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
                        <label for="NombreProveedorE">Nombre Completo:</label>
                        <input type="text" id="NombreProveedorE" name="NombreProveedorE">
                        <span id="error-NombreProveedorE"></span><br>
                    </div>

                    <div class="form-group">
                        <label for="IdTipoE">Tipo de Proveedor:</label>
                        <select id="IdTipoE" name="IdTipoE">
                            <option value="">Seleccione un tipo de Proveedor</option>
                        </select>
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
                        <label for="CodigoPostalE">Código Postal:</label>
                        <input type="text" id="CodigoPostalE" name="CodigoPostalE">
                        <span id="error-CodigoPostalE"></span>
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

    </div>
    
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="./vendor/jquery/jquery.min.js"></script>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="./js/sb-admin-2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('add-card').addEventListener('click', function() {
                abrirModal();
            });

            document.getElementById('cancel-button').addEventListener('click', function() {
                cerrarModal();
            });

            fetch('../FSP-main-2/controller/Proveedor_Controller.php?tipos=true', {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    const tipoProveedoresSelect = document.getElementById('IdTipo');
                    tipoProveedoresSelect.innerHTML = '<option value="">Seleccione un tipo de Proveedor</option>';
                    data.forEach(tipo => {
                        const option = document.createElement('option');
                        option.value = tipo.IdTipo;
                        option.textContent = tipo.Descripcion;
                        tipoProveedoresSelect.appendChild(option);
                    });

                    const tipoProveedoresEditSelect = document.getElementById('IdTipoE');
                    tipoProveedoresEditSelect.innerHTML = '<option value="">Seleccione un tipo de Proveedor</option>';
                    data.forEach(tipo => {
                        const option = document.createElement('option');
                        option.value = tipo.IdTipo;
                        option.textContent = tipo.Descripcion;
                        tipoProveedoresEditSelect.appendChild(option);
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
                        table.innerHTML = '';
                        data.forEach(proveedor => {
                            let row = table.insertRow();
                            row.setAttribute('data-id', proveedor.idProveedor);

                            let cellCheckbox = row.insertCell(0);
                            let checkbox = document.createElement('input');
                            checkbox.type = 'checkbox';
                            checkbox.classList.add('select-checkbox');
                            checkbox.value = proveedor.idProveedor;
                            cellCheckbox.appendChild(checkbox);

                            let cellidProveedor = row.insertCell(1);
                            cellidProveedor.textContent = proveedor.idProveedor;

                            let cellNombreProveedor = row.insertCell(2);
                            cellNombreProveedor.textContent = proveedor.NombreProveedor;

                            let cellTelefono = row.insertCell(3);
                            cellTelefono.textContent = proveedor.Telefono;

                            let cellCorreo = row.insertCell(4);
                            cellCorreo.textContent = proveedor.Correo;

                            let cellDireccion = row.insertCell(5);
                            cellDireccion.textContent = `${proveedor.Calle} ${proveedor.NoExt} ${proveedor.NoInterior} ${proveedor.Colonia} ${proveedor.Cruzamiento}`;
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

            const NombreProveedor = document.getElementById('NombreProveedor');
            const IdTipo = document.getElementById('IdTipo');
            const Telefono = document.getElementById('Telefono');
            const Correo = document.getElementById('Correo');
            const CodigoPostal = document.getElementById('CodigoPostal');
            const Calle = document.getElementById('Calle');
            const NoInterior = document.getElementById('NoInterior');
            const NoExt = document.getElementById('NoExt');
            const Colonia = document.getElementById('Colonia');
            const Cruzamiento = document.getElementById('Cruzamiento');
            const modal = document.getElementById('modal');
            const saveButton = document.getElementById('save');
            const closeButton = document.querySelector('.close');
            const tableBody = document.querySelector('table tbody');

            function validarNombreProveedor(value) {
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

            function validarCodigoPostal(value) {
                const regex = /^\d{5}$/;
                return regex.test(value);
            }

            function validarCalle(value) {
                const regex = /^[a-zA-Z0-9\s]+$/;
                return regex.test(value);
            }

            function validarNoInterior(value) {
                const regex = /^[a-zA-Z0-9\s]*$/;
                return regex.test(value);
            }

            function validarNoExt(value) {
                const regex = /^[a-zA-Z0-9\s]+$/;
                return regex.test(value);
            }

            function validarColonia(value) {
                const regex = /^[a-zA-Z0-9\s]+$/;
                return regex.test(value);
            }

            function validarCruzamiento(value) {
                const regex = /^[a-zA-Z0-9\s]*$/;
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

            NombreProveedor.addEventListener('input', function() {
                if (!validarNombreProveedor(NombreProveedor.value.trim())) {
                    mostrarError(NombreProveedor, 'Ingrese un nombre válido (solo letras y espacios)');
                } else {
                    limpiarError(NombreProveedor);
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

            CodigoPostal.addEventListener('input', function() {
                if (!validarCodigoPostal(CodigoPostal.value.trim())) {
                    mostrarError(CodigoPostal, 'Ingrese un Código Postal válido');
                } else {
                    limpiarError(CodigoPostal);
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
                    limpiarError(NoExt);
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

                if (!validarNombreProveedor(NombreProveedor.value.trim()) ||
                    !validarTelefono(Telefono.value.trim()) ||
                    !validarCorreo(Correo.value.trim()) ||
                    !validarCodigoPostal(CodigoPostal.value.trim()) ||
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
                    NombreProveedor: form.elements['NombreProveedor'].value,
                    IdTipo: form.elements['IdTipo'].value,
                    Telefono: form.elements['Telefono'].value,
                    Correo: form.elements['Correo'].value,
                    CodigoPostal: form.elements['CodigoPostal'].value,
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
                    abrirModalEliminar(selectedIds);
                }
            });

            function abrirModalEdicion(id) {
                const modal = document.getElementById('edit-modal');
                const form = document.getElementById('editForm');

                fetch(`../FSP-main-2/controller/Proveedor_Controller.php?idProveedor=${id}`, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(proveedor => {
                        if (!proveedor || proveedor.error) {
                            console.error('Error al obtener proveedor:', proveedor.error);
                            return;
                        }
                        form.elements['idProveedor'].value = proveedor.idProveedor || '';
                        form.elements['NombreProveedorE'].value = proveedor.NombreProveedor || '';
                        form.elements['IdTipoE'].value = proveedor.IdTipo || '';
                        form.elements['TelefonoE'].value = proveedor.Telefono || '';
                        form.elements['CorreoE'].value = proveedor.Correo || '';
                        form.elements['CodigoPostalE'].value = proveedor.CodigoPostal || '';
                        form.elements['CalleE'].value = proveedor.Calle || '';
                        form.elements['NoInteriorE'].value = proveedor.NoInterior || '';
                        form.elements['NoExtE'].value = proveedor.NoExt || '';
                        form.elements['ColoniaE'].value = proveedor.Colonia || '';
                        form.elements['CruzamientoE'].value = proveedor.Cruzamiento || '';

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

            function validarCampoEnTiempoReal(event) {
                const elemento = event.target;
                const valor = elemento.value.trim();

                if (elemento.id === 'NombreProveedorE') {
                    if (!validarNombreProveedor(valor)) {
                        mostrarError(elemento, 'Ingrese un nombre válido (solo letras y espacios)');
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
                } else if (elemento.id === 'CodigoPostalE') {
                    if (!validarCodigoPostal(valor)) {
                        mostrarError(elemento, 'Ingrese un Código Postal válido (5 dígitos numéricos)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'CalleE') {
                    if (!validarCalle(valor)) {
                        mostrarError(elemento, 'Ingrese un nombre o número de calle válido');
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
                    NombreProveedor: form.elements['NombreProveedorE'].value,
                    IdTipo: form.elements['IdTipoE'].value,
                    Telefono: form.elements['TelefonoE'].value,
                    Correo: form.elements['CorreoE'].value,
                    CodigoPostal: form.elements['CodigoPostalE'].value,
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
                            alert('Proveedor actualizado exitosamente');
                            fetchProveedores();
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
                            alert('Proveedor(es) eliminado(s) exitosamente');
                            fetchProveedores();
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
