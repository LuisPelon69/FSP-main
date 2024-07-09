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
        <link rel="stylesheet" type="text/css" href="css\tarjeta.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="main-container">
        <div class="table-container">
            <button id="add-card">Agregar Nueva Tarjeta</button>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tarjetas</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Saldo Total</th>
                                    <th>Teléfono</th>
                                    <th>Correo Electrónico</th>
                                    <th>Nombre(s)</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Filas de datos irán aquí -->
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button class="edit-button">Editar</button>
                                        <button class="delete-button">Eliminar</button>
                                    </td>
                                </tr>
                                <!-- Añadir más filas según sea necesario -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
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






    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->