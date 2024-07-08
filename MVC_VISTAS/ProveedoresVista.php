<!DOCTYPE html>
<html lang="en">

<head>

    <!--YA NO MUEVAN ESTO HIJOS DE LA CHINGADA-->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Other Utilities</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../startbootstrap-sb-admin-2-gh-pages/css/Style_login.css">
    <link href="../FSP-main-2/css/proveedores.css" rel="stylesheet" type="text/css">

</head>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Contacta a nuestros proveedores</h1>
    <p class="mb-4">Ingresa la información sobre proveedores o productos que necesites
    </p><br><br><br>

        <!-- Content Row -->
        <div class="row">
            <div class="container" id="container">
                <div class="form-container sign-up">
                    <form>
                        <h1>Información</h1>
                        <br>

                        <label for="material">Tipo de papel</label>
                        <select id="material" name="material">
                        <option value="papel">Hoja blanca</option>
                        <option value="carton">Hoja color</option>
                        <option value="plastico">Opalina</option>
                        <option value="metal">Bond</option>
                        </select>

                        <label for="tamaño">Tamaño</label>
                        <select id="tamaño" name="tamaño">
                        <option value="papel">Carta</option>
                        <option value="carton">A4</option>
                        <option value="plastico">Oficio</option>
                        <option value="metal">Tabloide</option>
                        </select>
                        
                        <input type="number" placeholder="Cantidad">

                        <label for="proveedores">Proveedores</label>
                        <select id="prov" name="prov">
                        <option value="papel">Norma</option>
                        <option value="carton">COPINSA</option>
                        <option value="plastico">APSA</option>
                        <option value="metal">COPAMEX</option>
                        <option value="metal">Vertiz</option>
                        </select>

                        <button type="submit">Buscar</button>
                    </form>
                </div>
                <div class="toggle-container">
                    <div class="toggle">
                        <div class="toggle-panel toggle-left">
                            <h1>Bienvenido!</h1>
                            <p>Ingresa el material y proveedor para buscar en la base de datos</p>
                            <img src="../FSP-main-1/img/Logo2.png" alt="Logo" class="logo" height="200" width="250">
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
            <script src="../startbootstrap-sb-admin-2-gh-pages/js/Script_login.js"></script>
        </div>

</div><br><br><br><br>
<!-- /.container-fluid -->