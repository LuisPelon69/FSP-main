<!--Aqui estaba el problema fuerte, las opciones del sidebar funcionan con links o referencias, entonces como se copio del index.html
pues se quedo con las referencias de html. Además tenía una referencia bien locota (ve a la linea 61 de este archivo), la nueva referencia 
es del archivo Gestionar.php (igual te falto crear ese por eso se iba al index porque no habia otro archivo-->
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
            <a class="collapse-item" href="Cobros_sub.php">Nuevo Cobro</a>
            
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
            <a class="collapse-item" href="Clientes.php">Tarjetas</a>
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
            <a class="collapse-item" href="Productos.php">Productos</a>
            <a class="collapse-item" href="Proveedores.php">Proveedores</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Reportes
</div>



<!-- Nav Item - Charts 
<li class="nav-item">
    <a class="nav-link" href="Graficas_sub.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Gráficas</span></a>
</li>-->

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="reportes_sub.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Tablas de Datos</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="img/Logo2.2.png" alt="...">
</div>
</li>
</ul>