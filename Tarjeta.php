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
            opacity: 0.6;
            pointer-events: none;
        }
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                    })
                    .catch(error => console.error('Error:', error));
            }

            fetchClientes();

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

                const form = document.getElementById('clienteForm');
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

            document.getElementById('add-card').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    console.log('Abrir modal para agregar una nueva tarjeta');
                    // Aquí puedes abrir el modal para agregar una nueva tarjeta
                }
            });

            document.querySelector('.edit-button').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    const selectedId = document.querySelector('.select-checkbox:checked').value;
                    console.log('Abrir modal para editar la tarjeta con ID:', selectedId);
                    abrirModalEdicion(selectedId);
                }
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

            document.querySelector('#edit-modal .close').addEventListener('click', function() {
                cerrarModalEdicion();
            });

            window.addEventListener('click', function(event) {
                if (event.target === document.getElementById('edit-modal')) {
                    cerrarModalEdicion();
                }
            });
<<<<<<< HEAD
=======
        });
<<<<<<< HEAD
        document.getElementById('clienteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    fetch('path/to/ClienteController.php', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mostrar el código QR en el modal
            const qrModal = document.getElementById('qrModal');
            const qrImage = document.getElementById('qrImage');
            qrImage.src = data.qrCodePath;
            qrModal.style.display = 'block';
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});
document.querySelectorAll('.close').forEach(closeButton => {
    closeButton.onclick = function() {
        this.parentElement.parentElement.style.display = 'none';
    };
});


    </script>
    
=======
>>>>>>> 964b71e0afa411e29d89bfcfcb13d38528e257b2
>>>>>>> b939bf45ebabd23a9363b4d66a81602e0eed0016

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
        });
    </script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<<<<<<< HEAD
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Admin.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
=======
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
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-fw fa-money-bill"></i>
                <span>Cobros</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Operaciones de Cobros:</h6>
                    <a class="collapse-item" href="Cobros_sub.php">Nuevo Cobro</a>
                    <a class="collapse-item" href="Historial_Cobros.php">Historial de Cobros</a>
>>>>>>> b939bf45ebabd23a9363b4d66a81602e0eed0016
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
                        <a class="collapse-item" href="Empleado.php">Empleados</a>
                        <a class="collapse-item" href="Agregar_Productos.php">Agregar Producto</a>
                        <a class="collapse-item" href="Gestionar.php">Gestionar elementos</a> <!--Esta referencia tenía: ?controller=MenuGestionar&action=index-->
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
                            <button id="add-card">Agregar Nueva Tarjeta</button>
                            <button class="edit-button">Editar</button>
                            <button class="delete-button">Eliminar</button>
                            <button class="VerQR-button">Ver QR</button>    
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

                    <script href="../FSP-main-2/js/tarjetas_js/tabla_tarjetas.js"></script>
                    <!-- Modal de Altas-->
                    <div id="modal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <div class="card">
                                <strong>
                                    <h1>Crear Nuevo Cliente</h1>
                                </strong>
                                <form id="clienteForm">
                                    <label for="NombreClien">Nombres:</label>
                                    <input type="text" id="NombreClien" name="NombreClien">
                                    <span id="error-NombreClien"></span><br>

                                    <label for="ApellidoP">Apellido Paterno:</label>
                                    <input type="text" id="ApellidoP" name="ApellidoP">
                                    <span id="error-ApellidoP"></span><br>

                                    <label for="ApellidoM">Apellido Materno:</label>
                                    <input type="text" id="ApellidoM" name="ApellidoM">
                                    <span id="error-ApellidoM"></span><br>

                                    <label for="Telefono">Teléfono:</label>
                                    <input type="text" id="Telefono" name="Telefono">
                                    <span id="error-Telefono"></span><br>

                                    <label for="Correo">Correo:</label>
                                    <input type="email" id="Correo" name="Correo">
                                    <span id="error-Correo"></span><br>

                                    <label for="passwClien">Contraseña:</label>
                                    <input type="password" id="passwClien" name="passwClien">
                                    <span id="error-passwClien"></span><br>

                                    <label for="confirm-passwClien">Confirmar Contraseña:</label>
                                    <input type="password" id="confirm-passwClien" name="confirm-passwClien">
                                    <span id="error-confirm-passwClien"></span><br>

                                    <button id="save">Guardar</button>
                                </form>

                            </div>
                        </div>
                    </div>


                    <!-- Modal de Edición -->
                    <div id="edit-modal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <div class="card">
                                <strong>
                                    <h1>Editar Cliente</h1>
                                </strong>
                                <form id="editForm">
                                    <input type="hidden" id="editId" name="id">

                                    <div>
                                        <label for="editNombre">Nombre:</label>
                                        <input type="text" id="editNombre" name="NombreClien">
                                        <span id="error-editNombre"></span>
                                    </div>

                                    <div>
                                        <label for="editApellidoP">Apellido Paterno:</label>
                                        <input type="text" id="editApellidoP" name="ApellidoP">
                                        <span id="error-editApellidoP"></span>
                                    </div>

                                    <div>
                                        <label for="editApellidoM">Apellido Materno:</label>
                                        <input type="text" id="editApellidoM" name="ApellidoM">
                                        <span id="error-editApellidoM"></span>
                                    </div>

                                    <div>
                                        <label for="editTelefono">Teléfono:</label>
                                        <input type="text" id="editTelefono" name="Telefono">
                                        <span id="error-editTelefono"></span>
                                    </div>

                                    <div>
                                        <label for="editCorreo">Correo:</label>
                                        <input type="email" id="editCorreo" name="Correo">
                                        <span id="error-editCorreo"></span>
                                    </div>

                                    <button id="editSave" type="submit">Guardar Cambios</button>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- Modal de Eliminación -->
                    <div id="delete-modal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
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
<<<<<<< HEAD
                <!-- End of Main Content -->
=======
                
                <div>
                    <label for="editApellidoP">Apellido Paterno:</label>
                    <input type="text" id="editApellidoP" name="ApellidoP">
                    <span id="error-editApellidoP"></span>
                </div>
                
                <div>
                    <label for="editApellidoM">Apellido Materno:</label>
                    <input type="text" id="editApellidoM" name="ApellidoM">
                    <span id="error-editApellidoM"></span>
                </div>
                
                <div>
                    <label for="editTelefono">Teléfono:</label>
                    <input type="text" id="editTelefono" name="Telefono">
                    <span id="error-editTelefono"></span>
                </div>
                
                <div>
                    <label for="editCorreo">Correo:</label>
                    <input type="email" id="editCorreo" name="Correo">
                    <span id="error-editCorreo"></span>
                </div>
            
                <button id="editSave" type="submit">Guardar Cambios</button>
            </form>
            
        </div>
    </div>
</div>

<!-- Modal de Eliminación -->
<div id="delete-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Confirmar Eliminación</h2>
        <p>¿Estás seguro de que deseas eliminar <span id="delete-count"></span> registros seleccionados?</p>
        <form id="deleteForm">
            <input type="hidden" name="ids" id="delete-ids">
            <button id="deleteConfirm" type="submit">Confirmar</button>
        </form>
    </div>
</div>
<!-- Modal de Código QR -->
<div id="qrModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Código QR del Cliente</h2>
        <img id="qrImage" src="" alt="Código QR">
        <a id="downloadQR" download="QRCode.png">Descargar Código QR</a>
    </div>
</div>

>>>>>>> b939bf45ebabd23a9363b4d66a81602e0eed0016



            </div>
            <!-- End of Content Wrapper -->

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
        </div>
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
        <!--Cuando se metan a View o a cualquier otra carpeta a TODAS las rutas se le elimina el "/FSP-main-1" para que tome las rutas correctamente.-->

<<<<<<< HEAD
=======
    <!-- Custom scripts for all pages-->
    <script src="../FSP-main-2/js/sb-admin-2.min.js"></script>
    <script src="../FSP-main-2/js/tarjetas_js/altas_tarjetas.js"></script> <!--Cuando se metan a View o a cualquier otra carpeta a TODAS las rutas se le elimina el "/FSP-main-2" para que tome las rutas correctamente.-->
    
>>>>>>> b939bf45ebabd23a9363b4d66a81602e0eed0016
    </div>
</body>

</html>