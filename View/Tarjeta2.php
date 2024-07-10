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
        <link rel="stylesheet" type="text/css" href="css/tarjeta.css">

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
    <script src="js/Tarjetas.js"></script>
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
                    
                    <script href="js/tarjetas_js/tabla_tarjetas.js"></script>
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
    <script src="js/tarjetas_js/altas_tarjetas.js"></script>
    
    </div>
</body>