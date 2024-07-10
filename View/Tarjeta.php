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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/tarjeta.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">


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
            fetch('../FSP-main-2/controller/cliente_controller.php', {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                let table = document.querySelector("table tbody");
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
        
            document.getElementById('add-card').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    // Aquí puedes abrir el modal para agregar una nueva tarjeta
                    console.log('Abrir modal para agregar una nueva tarjeta');
                }
            });
        
            document.querySelector('.edit-button').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    const selectedId = document.querySelector('.select-checkbox:checked').value;
                    // Aquí puedes abrir el modal para editar la tarjeta con el ID seleccionado
                    console.log('Abrir modal para editar la tarjeta con ID:', selectedId);
                    abrirModalEdicion(selectedId);
                }
            });
        
            document.querySelector('.delete-button').addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    const selectedIds = Array.from(document.querySelectorAll('.select-checkbox:checked')).map(cb => cb.value);
                    // Aquí puedes manejar la eliminación de las tarjetas con los IDs seleccionados
                    console.log('Eliminar tarjetas con IDs:', selectedIds);
                    abrirModalEliminar(selectedIds);
                }
            });
        
            function abrirModalEdicion(id) {
                const modal = document.getElementById('edit-modal');
                const form = document.getElementById('editForm');
        
                // Obtener los datos del cliente seleccionado
                fetch(`../FSP-main-1/controller/cliente_controller.php?id=${id}`, {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(cliente => {
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
        
            document.getElementById('editSave').addEventListener('click', function(event) {
                event.preventDefault();
        
                const form = document.getElementById('editForm');
                const data = {
                    idClien: form.elements['id'].value,
                    NombreClien: form.elements['NombreClien'].value,
                    ApellidoP: form.elements['ApellidoP'].value,
                    ApellidoM: form.elements['ApellidoM'].value,
                    Telefono: form.elements['Telefono'].value,
                    Correo: form.elements['Correo'].value
                };
        
                fetch('../FSP-main-1/controller/cliente_controller.php', {
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
                        form.reset();
                        cerrarModalEdicion();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error: ' + error.message);
                });
            });
        
            function cerrarModalEdicion() {
                const modal = document.getElementById('edit-modal');
                modal.style.display = 'none';
            }
        
            document.querySelector('#edit-modal .close').addEventListener('click', cerrarModalEdicion);
            window.addEventListener('click', function(event) {
                if (event.target === document.getElementById('edit-modal')) {
                    cerrarModalEdicion();
                }
            });
        
            // Validaciones
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
        
            document.getElementById('editNombre').addEventListener('input', function() {
                if (!validarNombres(this.value.trim())) {
                    mostrarError(this, 'Ingrese un nombre válido (solo letras y espacios)');
                } else {
                    limpiarError(this);
                }
            });
        
            document.getElementById('editApellidoP').addEventListener('input', function() {
                if (!validarNombres(this.value.trim())) {
                    mostrarError(this, 'Ingrese un apellido paterno válido (solo letras y espacios)');
                } else {
                    limpiarError(this);
                }
            });
        
            document.getElementById('editApellidoM').addEventListener('input', function() {
                if (!validarNombres(this.value.trim())) {
                    mostrarError(this, 'Ingrese un apellido materno válido (solo letras y espacios)');
                } else {
                    limpiarError(this);
                }
            });
        
            document.getElementById('editTelefono').addEventListener('input', function() {
                if (!validarTelefono(this.value.trim())) {
                    mostrarError(this, 'Ingrese un número de teléfono válido (10 dígitos numéricos)');
                } else {
                    limpiarError(this);
                }
            });
        
            document.getElementById('editCorreo').addEventListener('input', function() {
                if (!validarCorreo(this.value.trim())) {
                    mostrarError(this, 'Ingrese un correo válido');
                } else {
                    limpiarError(this);
                }
            });
        
            function abrirModalEliminar(ids) {
                const modal = document.getElementById('delete-modal');
                const form = document.getElementById('deleteForm');
                form.elements['ids'].value = ids.join(',');
                document.getElementById('delete-count').textContent = ids.length;
                modal.style.display = 'block';
            }
        
            document.getElementById('deleteConfirm').addEventListener('click', function(event) {
                event.preventDefault();
        
                const form = document.getElementById('deleteForm');
                const ids = form.elements['ids'].value.split(',');
        
                fetch('../FSP-main-1/controller/cliente_controller.php', {
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
                        alert('Clientes eliminados exitosamente');
                        form.reset();
                        cerrarModalEliminar();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error: ' + error.message);
                });
            });
        
            function cerrarModalEliminar() {
                const modal = document.getElementById('delete-modal');
                modal.style.display = 'none';
            }
        
            document.querySelector('#delete-modal .close').addEventListener('click', cerrarModalEliminar);
            window.addEventListener('click', function(event) {
                if (event.target === document.getElementById('delete-modal')) {
                    cerrarModalEliminar();
                }
            });
        });
        
    </script>

</head>

<body id="page-top">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="main-container">
                        <div class="table-container">
                            <button id="add-card">Agregar Nueva Tarjeta</button>
                            <button class="edit-button">Editar</button>
                            <button class="delete-button">Eliminar</button>
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
                    
                    <script href="../FSP-main-1/js/tarjetas_js/tabla_tarjetas.js"></script>
                   <!-- Modal de Altas-->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="card">
            <strong><h1>Crear Nuevo Cliente</h1></strong>
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
                <button id="cancel">Cancelar</button>
            </form>
            
        </div>
    </div>
</div>


<!-- Modal de Edición -->
<div id="edit-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="card">
            <strong><h1>Editar Cliente</h1></strong>
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
            
                <button id="editSave">Guardar Cambios</button>
                <button id="editCancel">Cancelar</button>
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
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="../FSP-main-1/js/tarjetas_js/altas_tarjetas.js"></script>
    
    </div>
</body>