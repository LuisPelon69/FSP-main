<!DOCTYPE html>
<<<<<<< HEAD
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch and display employees
            fetch('../FSP-main-2/controller/empleado_controller.php?type=tiposempleado', {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    const tipoEmpleadoSelect = document.getElementById('tipoEmpleado');
                    tipoEmpleadoSelect.innerHTML =
                        '<option value="">Seleccione un tipo</option>'; // Resetea las opciones antes de agregar las nuevas

                    data.forEach(tipo => {
                        const option = document.createElement('option');
                        option.value = tipo
                            .idStatus; // Asume que 'id' es el campo que quieres usar como valor
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

            document.getElementById('add-card').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    abrirModal();
                }
            });

            document.getElementById('cancel-button').addEventListener('click', function() {
                cerrarModal();
            });

            document.getElementById('cancelChanges-button').addEventListener('click', function() {
                cerrarModalEdicion();
            });

            document.querySelector('.edit-button').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    const selectedId = document.querySelector('.select-checkbox:checked').value;
                    abrirModalEdicion(selectedId);
                }
            });

            document.querySelector('.delete-button').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    const selectedIds = Array.from(document.querySelectorAll('.select-checkbox:checked'))
                        .map(cb => cb.value);
                    abrirModalEliminar(selectedIds);
                }
            });

            document.getElementById('closeDelete').addEventListener('click', function() {
                cerrarModalEliminar();
            });

            function abrirModalEdicion(id) {
                const modal = document.getElementById('edit-modal');
                const form = document.getElementById('editForm');

                fetch(`../FSP-main-2/controller/empleado_controller.php?id=${id}`, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(empleado => {
                        if (!empleado || empleado.error) {
                            console.error('Error al obtener empleado:', empleado.error);
                            return;
                        }
                        form.elements['idEmple'].value = empleado.idEmple;
                        form.elements['NombreEmp'].value = empleado.NombreEmp;
                        form.elements['CURPemp'].value = empleado.CURPemp;
                        form.elements['RFC'].value = empleado.RFC;
                        form.elements['Calle'].value = empleado.Calle;
                        form.elements['NoInterior'].value = empleado.NoInterior;
                        form.elements['NoExt'].value = empleado.NoExt;
                        form.elements['Colonia'].value = empleado.Colonia;
                        form.elements['Cruzamiento'].value = empleado.Cruzamiento;
                        form.elements['CP'].value = empleado.CP;

                        modal.style.display = 'block';
                    })
                    .catch(error => console.error('Error:', error));
            }


            function cerrarModalEdicion() {
                const modal = document.getElementById('edit-modal');
                modal.style.display = 'none';
            }

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
            $('#toggleConfirmPassword').click(function() {
                var confirmPasswordField = $('#confirmPasswordE');
                var fieldType = confirmPasswordField.attr('type');

                if (fieldType === 'password') {
                    confirmPasswordField.attr('type', 'text');
                    $('#eyeIconConfirm').removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    confirmPasswordField.attr('type', 'password');
                    $('#eyeIconConfirm').removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });

            function validarNombreEmp(value) {
                const regex = /^[a-zA-Z\s]+$/;
                return regex.test(value);
            }

            function validarCURP(value) {
                const regex = /^[A-Z]{4}\d{6}[H|M][A-Z]{5}\d{2}$/;
                return regex.test(value);
            }

            function validarRFC(value) {
                const regex = /^[A-ZÑ&]{3,4}\d{6}(?:[A-Z\d]{3})?$/;
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

            function validarCP(value) {
                const regex = /^\d{5}$/;
                return regex.test(value);
            }

            function mostrarError(elemento, mensaje) {
                // Elimina cualquier mensaje de error previo
                const erroresPrevios = elemento.parentElement.querySelectorAll('.error');
                erroresPrevios.forEach(error => error.remove());

                const error = document.createElement('div');
                error.classList.add('error');
                error.textContent = mensaje;

                elemento.parentElement.appendChild(error);
            }


            function limpiarError(elemento) {
                const div = elemento.parentElement;
                const error = div.querySelector('.error');
                if (error) {
                    div.removeChild(error);
                }
            }

            function validarCampoEnTiempoReal(event) {
                const elemento = event.target;
                const valor = elemento.value.trim();

                if (elemento.id === 'NombreEmp') {
                    if (!validarNombreEmp(valor)) {
                        mostrarError(elemento, 'Ingrese un nombre válido (solo letras y espacios)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'CURPemp') {
                    if (!validarCURP(valor)) {
                        mostrarError(elemento, 'Ingrese una CURP válida (18 caracteres alfanuméricos)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'RFC') {
                    if (!validarRFC(valor)) {
                        mostrarError(elemento, 'Ingrese un RFC válido (13 caracteres alfanuméricos)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'Calle') {
                    if (!validarCalle(valor)) {
                        mostrarError(elemento, 'Ingrese una calle válida (solo letras, números y espacios)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'NoInterior') {
                    if (!validarNoInterior(valor)) {
                        mostrarError(elemento,
                            'Ingrese un número interior válido (puede ser vacío, letras, números y espacios)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'NoExt') {
                    if (!validarNoExt(valor)) {
                        mostrarError(elemento,
                            'Ingrese un número exterior válido (solo letras, números y espacios)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'Colonia') {
                    if (!validarColonia(valor)) {
                        mostrarError(elemento, 'Ingrese una colonia válida (solo letras, números y espacios)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'Cruzamiento') {
                    if (!validarCruzamiento(valor)) {
                        mostrarError(elemento,
                            'Ingrese un cruzamiento válido (puede ser vacío, letras, números y espacios)');
                    } else {
                        limpiarError(elemento);
                    }
                } else if (elemento.id === 'CP') {
                    if (!validarCP(valor)) {
                        mostrarError(elemento, 'Ingrese un código postal válido (5 dígitos)');
                    } else {
                        limpiarError(elemento);
                    }
                }
            }

            const camposValidables = document.querySelectorAll('#editForm input, #addForm input');

            camposValidables.forEach(campo => {
                campo.addEventListener('input', validarCampoEnTiempoReal);
            });

            document.getElementById('addForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Evita el envío estándar del formulario

                const form = event.target;
                const campos = {
                    NombreEmp: form.elements['NombreEmp'].value.trim(),
                    CURPemp: form.elements['CURPemp'].value.trim(),
                    RFC: form.elements['RFC'].value.trim(),
                    Calle: form.elements['Calle'].value.trim(),
                    NoInterior: form.elements['NoInterior'].value.trim(),
                    NoExt: form.elements['NoExt'].value.trim(),
                    Colonia: form.elements['Colonia'].value.trim(),
                    Cruzamiento: form.elements['Cruzamiento'].value.trim(),
                    CP: form.elements['CP'].value.trim(),
                    Idstatus: form.elements['tipoEmpleado'].value // Obtener el valor del select
                };

                let esValido = true;

                // Validaciones
                if (!validarNombreEmp(campos.NombreEmp)) {
                    mostrarError(form.elements['NombreEmp'],
                        'Ingrese un nombre válido (solo letras y espacios)');
                    esValido = false;
                }
                if (!validarCURP(campos.CURPemp)) {
                    mostrarError(form.elements['CURPemp'],
                        'Ingrese una CURP válida (18 caracteres alfanuméricos)');
                    esValido = false;
                }
                if (!validarRFC(campos.RFC)) {
                    mostrarError(form.elements['RFC'],
                        'Ingrese un RFC válido (13 caracteres alfanuméricos)');
                    esValido = false;
                }
                if (!validarCalle(campos.Calle)) {
                    mostrarError(form.elements['Calle'],
                        'Ingrese una calle válida (solo letras, números y espacios)');
                    esValido = false;
                }
                if (!validarNoInterior(campos.NoInterior)) {
                    mostrarError(form.elements['NoInterior'],
                        'Ingrese un número interior válido (puede ser vacío, letras, números y espacios)'
                    );
                    esValido = false;
                }
                if (!validarNoExt(campos.NoExt)) {
                    mostrarError(form.elements['NoExt'],
                        'Ingrese un número exterior válido (solo letras, números y espacios)');
                    esValido = false;
                }
                if (!validarColonia(campos.Colonia)) {
                    mostrarError(form.elements['Colonia'],
                        'Ingrese una colonia válida (solo letras, números y espacios)');
                    esValido = false;
                }
                if (!validarCruzamiento(campos.Cruzamiento)) {
                    mostrarError(form.elements['Cruzamiento'],
                        'Ingrese un cruzamiento válido (puede ser vacío, letras, números y espacios)');
                    esValido = false;
                }
                if (!validarCP(campos.CP)) {
                    mostrarError(form.elements['CP'], 'Ingrese un código postal válido (5 dígitos)');
                    esValido = false;
                }

                if (esValido) {
                    fetch('../FSP-main-2/controller/empleado_controller.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(campos)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                fetchEmpleados(); // Actualiza la lista de empleados
                                cerrarModal(); // Cierra el modal
                            } else {
                                alert('Error al agregar empleado: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Ocurrió un error: ' + error.message);
                        });
                }
            });

            function abrirModal() {
                const modal = document.getElementById('modal');
                const form = document.getElementById('nuevoEmpleadoForm');
                modal.style.display = 'block';
            }

            function cerrarModal() {
                const modal = document.getElementById('modal');
                modal.style.display = 'none';
            }

            function cerrarModalEliminar() {
                const modal = document.getElementById('delete-modal');
                modal.style.display = 'none';
            }

            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('addForm');
                if (form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        const form = event.target;

                        let esValido = true;

                        const campos = {
                            NombreEmp: form.elements['NombreEmp'].value.trim(),
                            CURPemp: form.elements['CURPemp'].value.trim(),
                            RFC: form.elements['RFC'].value.trim(),
                            Calle: form.elements['Calle'].value.trim(),
                            NoInterior: form.elements['NoInterior'].value.trim(),
                            NoExt: form.elements['NoExt'].value.trim(),
                            Colonia: form.elements['Colonia'].value.trim(),
                            Cruzamiento: form.elements['Cruzamiento'].value.trim(),
                            CP: form.elements['CP'].value.trim(),
                            Idstatus: form.elements['Idstatus']
                                .value // Aquí es donde tomas el valor del select
                        };

                        if (!validarNombreEmp(campos.NombreEmp)) {
                            mostrarError(form.elements['NombreEmp'],
                                'Ingrese un nombre válido (solo letras y espacios)');
                            esValido = false;
                        }
                        if (!validarCURP(campos.CURPemp)) {
                            mostrarError(form.elements['CURPemp'],
                                'Ingrese una CURP válida (18 caracteres alfanuméricos)');
                            esValido = false;
                        }
                        if (!validarRFC(campos.RFC)) {
                            mostrarError(form.elements['RFC'],
                                'Ingrese un RFC válido (13 caracteres alfanuméricos)');
                            esValido = false;
                        }
                        if (!validarCalle(campos.Calle)) {
                            mostrarError(form.elements['Calle'],
                                'Ingrese una calle válida (solo letras, números y espacios)');
                            esValido = false;
                        }
                        if (!validarNoInterior(campos.NoInterior)) {
                            mostrarError(form.elements['NoInterior'],
                                'Ingrese un número interior válido (puede ser vacío, letras, números y espacios)'
                            );
                            esValido = false;
                        }
                        if (!validarNoExt(campos.NoExt)) {
                            mostrarError(form.elements['NoExt'],
                                'Ingrese un número exterior válido (solo letras, números y espacios)'
                            );
                            esValido = false;
                        }
                        if (!validarColonia(campos.Colonia)) {
                            mostrarError(form.elements['Colonia'],
                                'Ingrese una colonia válida (solo letras, números y espacios)');
                            esValido = false;
                        }
                        if (!validarCruzamiento(campos.Cruzamiento)) {
                            mostrarError(form.elements['Cruzamiento'],
                                'Ingrese un cruzamiento válido (puede ser vacío, letras, números y espacios)'
                            );
                            esValido = false;
                        }
                        if (!validarCP(campos.CP)) {
                            mostrarError(form.elements['CP'],
                                'Ingrese un código postal válido (5 dígitos)');
                            esValido = false;
                        }

                        if (esValido) {
                            fetch('../FSP-main-2/controller/empleado_controller.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify(campos)
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        fetchEmpleados();
                                        cerrarModal();
                                    } else {
                                        console.error('Error al agregar empleado:', data.error);
                                    }
                                })
                                .catch(error => console.error('Error:', error));
                        }
                    });
                } else {
                    console.error('Elemento con id "addForm" no encontrado');
                }
            });

            document.querySelectorAll('.close-modal').forEach(button => {
                button.addEventListener('click', cerrarModal);
                button.addEventListener('click', cerrarModalEdicion);
            });

            window.onclick = function(event) {
                const modal = document.getElementById('modal');
                const editModal = document.getElementById('edit-modal');
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
                if (event.target == editModal) {
                    editModal.style.display = 'none';
                }
            }
        });
    </script>



</head>

<body id="page-top">
                <!-- Begin Page Content -->

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
                                        <input type="text" id="NombreEmp" name="NombreEmp" required> <br>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipoEmpleado">Tipo de Empleado:</label>
                                        <select id="tipoEmpleado" name="Idstatus" required>
                                            <option value="">Seleccione un tipo de empleado</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="CURPemp">CURP:</label>
                                        <input type="text" id="CURPemp" name="CURPemp" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="RFC">RFC:</label>
                                        <input type="text" id="RFC" name="RFC" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="CP">Código Postal:</label>
                                        <input type="text" id="CP" name="CP" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="Calle">Calle:</label>
                                        <input type="text" id="Calle" name="Calle" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="NoInterior">Número Interior:</label>
                                        <input type="text" id="NoInterior" name="NoInterior">
                                    </div>

                                    <div class="form-group">
                                        <label for="NoExt">Número Exterior:</label>
                                        <input type="text" id="NoExt" name="NoExt" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="Colonia">Colonia:</label>
                                        <input type="text" id="Colonia" name="Colonia" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="Cruzamiento">Cruzamiento:</label>
                                        <input type="text" id="Cruzamiento" name="Cruzamiento">

                                    </div>

                                    <div class="form-group">
                                        <label for="PasswordE">Contraseña:</label>
                                        <input type="password" id="PasswordE" name="PasswordE" required>
                                        <div class="password-input-container">
                                            <span class="toggle-password" id="togglePassword">
                                                <i class="fas fa-eye" id="eyeIcon"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="confirmPasswordE">Confirmar Contraseña:</label>
                                        <input type="password" id="confirmPasswordE" name="confirmPasswordE" required>
                                        <div class="password-input-container">
                                            <span class="toggle-password" id="toggleConfirmPassword">
                                                <i class="fas fa-eye" id="eyeIconConfirm"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-buttons">
                                        <button type="button" class="cancel" id="cancel-button">Cancelar</button>
                                        <button type="submit" class="submit" id="saveButton">Agregar Empleado</button>
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

                                    <input type="hidden" name="idEmple">


                                    <div class="form-group">
                                        <label for="NombreEmp">Nombre Completo:</label>
                                        <input type="text" id="NombreEmpE" name="NombreEmp" required pattern="[A-Za-z\s]+">
                                    </div>

                                    <div class="form-group">
                                        <label for="CURPemp">CURP:</label>
                                        <input type="text" id="CURPempE" name="CURPemp" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="RFC">RFC:</label>
                                        <input type="text" id="RFCE" name="RFC" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="CP">Código Postal:</label>
                                        <input type="text" id="CPE" name="CP" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="Calle">Calle:</label>
                                        <input type="text" id="CalleE" name="Calle" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="NoInterior">Número Interior:</label>
                                        <input type="text" id="NoInteriorE" name="NoInterior">
                                    </div>

                                    <div class="form-group">
                                        <label for="NoExt">Número Exterior:</label>
                                        <input type="text" id="NoExtE" name="NoExt" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="Colonia">Colonia:</label>
                                        <input type="text" id="ColoniaE" name="Colonia" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="Cruzamiento">Cruzamiento:</label>
                                        <input type="text" id="CruzamientoE" name="Cruzamiento">
                                    </div>

                                    <div class="form-buttons">
                                        <button type="button" class="cancel" id="cancelChanges-button">Cancelar</button>
                                        <button type="submit" class="submitchanges" id="saveChangesButton">Guardar Cambios</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <!-- Modal de Eliminación -->
                        <div id="delete-modal" class="modal">
                            <div class="modal-content">
                                <span class="close" id="closeDelete">&times;</span>
                                <h2>Confirmar Eliminación</h2>
                                <p>¿Estás seguro de que deseas eliminar <span idEmple="delete-count"></span> registros
                                    seleccionados?</p>
                                <form id="deleteForm">
                                    <input type="hidden" name="ids" id="delete-ids">
                                    <button id="deleteConfirm" type="submit">Confirmar</button>
                                </form>
                            </div>
                        </div>







                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->




</body>

</html>
=======
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



>>>>>>> b939bf45ebabd23a9363b4d66a81602e0eed0016
