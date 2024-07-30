<?php
session_start();
if (!isset($_SESSION['idEmple'])) {
    header("Location: index.php"); // Redirige a la página de inicio de sesión si no hay sesión iniciada
    exit();
}
?>
<?php
require_once 'config.php'; // Incluir la configuración global antes de cualquier salida
?><!DOCTYPE html>
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

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Admin.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">FSP Admin<sup>©</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="Admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Panel de Gestión</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interfaz de Administración
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-money-bill"></i>
                    <span>Cobros</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Operaciones de Cobros:</h6>
                        <a class="collapse-item" href="Nuevo_Cobro.php">Nuevo Cobro</a>
                        <a class="collapse-item" href="Historial_Cobros.php">Historial de Cobros</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Tarjetas</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Operaciones con Tarjetas:</h6>
                        <a class="collapse-item" href="Tarjeta.php">Tarjetas</a>
                        <a class="collapse-item" href="Recargar_Tarjeta.php">Recargar Tarjeta</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Administración</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menú de Administración:</h6>
                        <a class="collapse-item" href="Empleados.php">Empleados</a>
                        <a class="collapse-item" href="Agregar_Productos.php">Agregar Producto</a>
                        <a class="collapse-item" href="Gestionar.php">Gestionar elementos</a>
                        <!--Esta referencia tenía: ?controller=MenuGestionar&action=index-->
                        <a class="collapse-item" href="Proveedores.php">Proovedores</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Reportes y Gráficas
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Cobros</span>
                </a>
                <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Gráficas</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tablas de Datos</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/Logo2.2.png" alt="..." width="150px" height="300px">
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="Index.html">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

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



                </div>
                <!-- End of Content Wrapper -->
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->


            <!-- Bootstrap core JavaScript-->
            <script src="../FSP-main-2/vendor/jquery/jquery.min.js"></script>
            <script src="../FSP-main-2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="../FSP-main-2/vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="../FSP-main-2/js/sb-admin-2.min.js"></script>
        </div>
</body>

</html>