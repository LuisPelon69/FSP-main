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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
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
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 90%;
            height: 90%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-bottom: 220px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
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
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const tipoEmpleadoSelect = document.querySelector('select[name="TipoEmpleado"]');
        const empleadoTableBody = document.querySelector("table tbody");

         // Cargar empleados en la tabla
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
                empleadoTableBody.innerHTML = '';
                data.forEach(empleado => {
                    let row = empleadoTableBody.insertRow();
                    row.setAttribute('data-id', empleado.idEmp);

                    let cellCheckbox = row.insertCell(0);
                    let checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.classList.add('select-checkbox');
                    checkbox.value = empleado.idEmp;
                    cellCheckbox.appendChild(checkbox);

                    row.insertCell(1).textContent = empleado.idEmp;
                    row.insertCell(2).textContent = empleado.NombreEmp;
                    row.insertCell(3).textContent = empleado.NombreStatus;
                    row.insertCell(4).textContent = empleado.RFC;
                    row.insertCell(5).textContent = empleado.RecargasRealizadas;
                    row.insertCell(6).textContent = empleado.CobrosRealizados;
                    row.insertCell(7).textContent = empleado.Direccion;
                });
            })
            .catch(error => console.error('Error:', error));
        }

        // Verificar si los elementos existen
        if (!tipoEmpleadoSelect || !empleadoTableBody) {
            console.error('No se encontraron los elementos necesarios en el DOM.');
            return;
        }

        // Cargar los tipos de empleados en el select
        fetch('../FSP-main-2/controller/empleado_controller.php?type=statuse', {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error al obtener los estados:', data.error);
                return;
            }
            data.forEach(status => {
                let option = document.createElement('option');
                option.value = status.idStatus;
                option.textContent = status.NombreStatus;
                tipoEmpleadoSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));

       

        // Actualizar el estado de los botones según los checkboxes seleccionados
        function updateButtonState() {
            const checkboxes = document.querySelectorAll('.select-checkbox:checked');
            document.querySelector('.edit-button').classList.toggle('disabled', checkboxes.length !== 1);
            document.querySelector('.delete-button').classList.toggle('disabled', checkboxes.length === 0);
        }

        // Verificar y agregar event listeners si los elementos existen
        const editButton = document.querySelector('.edit-button');
        const deleteButton = document.querySelector('.delete-button');
        const addCardButton = document.getElementById('add-card');
        const empleadoForm = document.getElementById('empleadoForm');
        const editForm = document.getElementById('editForm');
        const deleteForm = document.getElementById('deleteForm');
        const modal = document.getElementById('modal');
        const editModal = document.getElementById('edit-modal');
        const deleteModal = document.getElementById('delete-modal');

        if (editButton) {
            editButton.addEventListener('click', function() {
                const selectedCheckbox = document.querySelector('.select-checkbox:checked');
                if (selectedCheckbox) {
                    const empleadoId = selectedCheckbox.value;
                    fetch(`../FSP-main-2/controller/empleado_controller.php?id=${empleadoId}`, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            console.error('Error al obtener los detalles del empleado:', data.error);
                            return;
                        }
                        for (let key in data) {
                            if (editForm.elements[key]) {
                                editForm.elements[key].value = data[key];
                            }
                        }
                        editModal.style.display = 'block';
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        }

        if (deleteButton) {
            deleteButton.addEventListener('click', function() {
                const selectedCheckboxes = document.querySelectorAll('.select-checkbox:checked');
                if (selectedCheckboxes.length > 0) {
                    const ids = Array.from(selectedCheckboxes).map(cb => cb.value);
                    document.querySelector('#deleteForm input[name="ids"]').value = ids.join(',');
                    deleteModal.style.display = 'block';
                }
            });
        }

        if (addCardButton) {
            addCardButton.addEventListener('click', function() {
                modal.style.display = 'block';
            });
        }

        if (empleadoForm) {
            empleadoForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const form = event.target;
                if (!form.checkValidity()) {
                    return;
                }
                const formData = new FormData(form);
                fetch('../FSP-main-2/controller/empleado_controller.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error al crear empleado:', data.error);
                        return;
                    }
                    fetchEmpleados();
                    form.reset();
                    modal.style.display = 'none';
                })
                .catch(error => console.error('Error:', error));
            });
        }

        if (editForm) {
            editForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const form = event.target;
                if (!form.checkValidity()) {
                    return;
                }
                const formData = new FormData(form);
                fetch('../FSP-main-2/controller/empleado_controller.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error al editar empleado:', data.error);
                        return;
                    }
                    fetchEmpleados();
                    editModal.style.display = 'none';
                })
                .catch(error => console.error('Error:', error));
            });
        }

        if (deleteForm) {
            deleteForm.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(event.target);
                fetch('../FSP-main-2/controller/empleado_controller.php', {
                    method: 'DELETE',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error al eliminar empleado(s):', data.error);
                        return;
                    }
                    fetchEmpleados();
                    deleteModal.style.display = 'none';
                })
                .catch(error => console.error('Error:', error));
            });
        }

        // Cerrar modal al hacer clic en el botón de cerrar
        document.querySelectorAll('.modal .close').forEach(closeBtn => {
            closeBtn.addEventListener('click', function() {
                closeBtn.closest('.modal').style.display = 'none';
            });
        });

        // Autocompletar dirección basado en el CP
        const cpInput = document.getElementById('CP');
        if (cpInput) {
            cpInput.addEventListener('blur', function() {
                const cp = this.value;
                if (/^\d{5}$/.test(cp)) {
                    fetch(`../FSP-main-2/controller/codigo_postal_controller.php?cp=${cp}`, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            console.error('Error al obtener datos de dirección:', data.error);
                            return;
                        }
                        if (empleadoForm) {
                            if (data.calle) empleadoForm.elements['Calle'].value = data.calle;
                            if (data.colonia) empleadoForm.elements['Colonia'].value = data.colonia;
                            if (data.noInterior) empleadoForm.elements['NoInterior'].value = data.noInterior;
                            if (data.noExt) empleadoForm.elements['NoExt'].value = data.noExt;
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        }

        // Validar contraseñas
        const confirmarPasswordInput = document.getElementById('ConfirmarPassword');
        if (confirmarPasswordInput) {
            confirmarPasswordInput.addEventListener('input', function() {
                const password = document.querySelector('input[name="Password"]').value;
                const confirmPassword = this.value;
                if (password !== confirmPassword) {
                    this.setCustomValidity('Las contraseñas no coinciden');
                } else {
                    this.setCustomValidity('');
                }
            });
        }

        // Cargar empleados al iniciar
        fetchEmpleados();
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
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseThree">
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
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
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
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Administración</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menú de Administración:</h6>
                    <a class="collapse-item" href="Empleados.php">Empleados</a>
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

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
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
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
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
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
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
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
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
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
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
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
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
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
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
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
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
                        <button id="add-card">Agregar Empleado</button>
    <button class="edit-button disabled">Editar Empleado</button>
    <button class="delete-button disabled">Eliminar Empleado</button>

    <table border="1">
        <thead>
            <tr>
                <th>Seleccionar</th>
                <th>ID Empleado</th>
                <th>Nombre Completo</th>
                <th>Puesto</th>
                <th>RFC</th>
                <th>Recargas Realizadas</th>
                <th>Cobros Realizados</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            <!-- Las filas de la tabla se llenarán dinámicamente con JavaScript -->
        </tbody>
    </table>

    <!-- Modal de Altas -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="card">
                <strong><h1>Crear Nuevo Empleado</h1></strong>
            </div>
            <form id="nuevoEmpleadoForm" action="empleado_controller.php" method="POST">
        <label for="nombres">Nombre(s):</label>
        <input type="text" id="nombres" name="nombres" required>

        <label for="apellidoPaterno">Apellido Paterno:</label>
        <input type="text" id="apellidoPaterno" name="apellidoPaterno" required>

        <label for="apellidoMaterno">Apellido Materno:</label>
        <input type="text" id="apellidoMaterno" name="apellidoMaterno" required>

        <label for="idStatus">Tipo de Empleado:</label>
        <select id="idStatus" name="idStatus" required>
            <option value="">Seleccione un tipo de empleado</option>
        </select>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirmPassword">Confirmar Contraseña:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>

        <label for="CURP">CURP:</label>
        <input type="text" id="CURP" name="CURP" required>

        <label for="RFC">RFC:</label>
        <input type="text" id="RFC" name="RFC" required>

        <label for="CP">Código Postal:</label>
        <input type="text" id="CP" name="CP" required>

        <label for="Calle">Calle:</label>
        <input type="text" id="Calle" name="Calle" required>

        <label for="NoExt">Número Exterior:</label>
        <input type="text" id="NoExt" name="NoExt" required>

        <label for="NoInterior">Número Interior:</label>
        <input type="text" id="NoInterior" name="NoInterior">

        <label for="Colonia">Colonia:</label>
        <input type="text" id="Colonia" name="Colonia" required>

        <label for="Cruzamiento">Cruzamiento:</label>
        <input type="text" id="Cruzamiento" name="Cruzamiento">

        <button type="submit">Agregar Empleado</button>
    </form>
        </div>
    </div>

    <!-- Modal de Edición -->
    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="card">
                <strong><h1>Editar Empleado</h1></strong>
            </div>
            <form id="editForm">
                <input type="hidden" name="idEmp" />
                <label for="Nombre">Nombre(s):</label>
                <input type="text" name="Nombre" required pattern="[A-Za-z\s]+">
                <label for="ApellidoPaterno">Apellido Paterno:</label>
                <input type="text" name="ApellidoPaterno" required pattern="[A-Za-z\s]+">
                <label for="ApellidoMaterno">Apellido Materno:</label>
                <input type="text" name="ApellidoMaterno" required pattern="[A-Za-z\s]+">
                <label for="TipoEmpleado">Tipo de Empleado:</label>
                <select name="TipoEmpleado" required></select>
                <label for="Password">Contraseña:</label>
                <input type="password" name="Password" required>
                <label for="ConfirmarPassword">Confirmar Contraseña:</label>
                <input type="password" name="ConfirmarPassword" required>
                <label for="CURP">CURP:</label>
                <input type="text" name="CURP" required pattern="[A-Z0-9]{18}">
                <label for="RFC">RFC:</label>
                <input type="text" name="RFC" required pattern="[A-Z0-9]{13}">
                <label for="CP">Código Postal:</label>
                <input type="text" name="CP" required pattern="\d{5}">
                <label for="Calle">Calle:</label>
                <input type="text" name="Calle" required>
                <label for="NoInterior">No. Interior:</label>
                <input type="text" name="NoInterior" pattern="[A-Za-z0-9\-]*">
                <label for="NoExt">No. Exterior:</label>
                <input type="text" name="NoExt" required pattern="[A-Za-z0-9\-]+">
                <label for="Colonia">Colonia:</label>
                <input type="text" name="Colonia" required>
                <label for="Cruzamiento">Cruzamiento:</label>
                <input type="text" name="Cruzamiento" pattern="[A-Za-z0-9\s]*">
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <!-- Modal de Eliminación -->
    <div id="delete-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="card">
                <strong><h1>Confirmar Eliminación</h1></strong>
            </div>
            <form id="deleteForm">
                <input type="hidden" name="ids">
                <p>¿Está seguro de que desea eliminar el/los empleado(s) seleccionado(s)?</p>
                <button type="submit">Sí, eliminar</button>
                <button type="button" class="close">Cancelar</button>
            </form>
        </div>
    </div>





                    
 
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            

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
    </div>
</body>

</html>