<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../FSP-main-2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../FSP-main-2/css/Style.css">
    <link rel="stylesheet" type="text/css" href="../FSP-main-2/css/index2.css">

</head>
<body>
    <!--Cabecera-->
    <header>
        <div class="logo">
            <img src="../FSP-main-2/img/Logo3.png" alt="FSPLAY Logo" style="height:50px;">
        </div>
        <nav>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Nosotros</a></li>
                <li><a href="#">Opiniones</a></li>
                <li><a href="#">Descubrir</a></li>
                <li><a href="Promos_sub.php">Contacto</a></li>
            </ul>
        </nav>
        <div class="actions">
            <a href="https://www.facebook.com/profile.php?id=100014590638861">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook">
                    <path d="M18 2h-3a4 4 0 0 0-4 4v3H8v4h3v8h4v-8h3l1-4h-4V6a1 1 0 0 1 1-1h3z"></path>
                </svg>
            </a>
            <a href="https://www.instagram.com/santiagoopuc/">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">
                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                    <line x1="17.5" y1="6.5" x2="17.5" y2="6.5"></line>
                </svg>
            </a>
            <a href="../FSP-main-2/controller/AutenticacionController.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </a>
        </div>
    </header>
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
                <img src="img/indeximg.png" class="d-block w-100" alt="..." height="640px">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="img/2.1.png" class="d-block w-100" alt="..." height="640px">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="img/3.png" class="d-block w-100" alt="..." height="640px">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!--Contenido después del carrusel-->
    <div class="container main-container">
        <!--Contenedor 1-->
        <div class="col-md-4">
            <div class="container-custom">
                <div class="image-container" >
                <a href="View\SaldoIndex.php">
                    <img src="img/4.png" alt="Usuarios" class="aside">
                    </a>
                </div>
                <div class="text">
                    <p>Revisa tu saldo</p>
                </div>
            </div>
        </div>
        <!--Logo-->
        <div class="col-md-4 d-flex justify-content-center align-items-center">
            <center><img class="Logo" src="../FSP-main-2/img/Logo2.2.png" width="450px"></center>
        </div>
        <!--Contenedor 2-->
        <div class="col-md-4">
          <div class="container-custom">
              <div class="image-container">
                  <a href="../FSP-main-2/controller/AutenticacionController.php">
                      <img src="img/5.png" alt="Empresas" class="aside">
                  </a>
              </div>
              <div class="text">
                  <p>Grandes empresas</p>
              </div>
          </div>
      </div>
    </div>
    <br><br>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
    <script src="Js/Scripts.js"></script>
    <script>
        document.addEventListener('scroll', function() {
            var button = document.getElementById('membresia-btn');
            if (window.scrollY > 100) {
                button.classList.add('btn-to-corner');
                button.classList.remove('btn-original');
            } else {
                button.classList.remove('btn-to-corner');
                button.classList.add('btn-original');
            }
        });
    </script>
</body>
</html>
