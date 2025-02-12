<!--Aqui estaba el problema fuerte, las opciones del sidebar funcionan con links o referencias, entonces como se copio del index.html
pues se quedo con las referencias de html. Además tenía una referencia bien locota (ve a la linea 61 de este archivo), la nueva referencia 
es del archivo Gestionar.php (igual te falto crear ese por eso se iba al index porque no habia otro archivo-->
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="NuevoCobro_Empleado.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">FSP Admin<sup>©</sup></div>
</a>

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
            <a class="collapse-item" href="NuevoCobro_Empleado.php">Nuevo Cobro</a>
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
            <a class="collapse-item" href="TarjetaEmpleado.php">Tarjetas</a>
            <a class="collapse-item" href="#">Recargar Tarjeta</a>
        </div>
    </div>
</li><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="img/fsplogo.svg" alt="...">
</div>
</li>
</ul>
