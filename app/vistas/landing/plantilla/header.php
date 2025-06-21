<?php 
if (!defined('URL_BASE')) {
    $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    define('URL_BASE', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio");
    define('URL_BASE_TIENDA', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio/app/vistas/landing");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Directorio de Servicios | Rápido y Seguro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Directorio de servicios, negocios, búsqueda rápida">
    <meta name="description" content="Encuentra servicios y negocios de manera rápida y segura.">

    <!-- Favicon -->
    <link href="<?= URL_BASE ?>/publico/img/favicon.ico" rel="icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= URL_BASE ?>/publico/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= URL_BASE ?>/publico/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= URL_BASE ?>/publico/css/style.min.css" rel="stylesheet">

    <!-- SWIPE JS !-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    
    <style>
        .bg-title-niby{
        background-color: #FFC332;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        }
        .text-niby{
        color: #FFC332 !important;
        }
        .bg-title-didi{
        background-color: #1c2833;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
        }
        .bg-didi-header {
        background-color: #1c2833 !important;
        }
        .bg-niby-nav {
        background-color: #FFC332 !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="<?= URL_BASE ?>/publico/js/header/header.js" type="module"></script>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5 bg-didi-header">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-white mr-3" href="<?= URL_BASE ?>/rutas/rutas.php?page=faqs">FAQs</a>
                </div>
            </div>

            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Mi cuenta</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <?php if(isset($_SESSION["name"])) : ?>
                                <button class="dropdown-item">
                                    <?= $_SESSION["name"] ?>
                                </button>

                                <form action="rutas.php" method="post">
                                    <button class="dropdown-item" type="submit" name="action" value="logOut">
                                        Cerrar sesión
                                    </button>
                                </form>
                                
                            <?php else : ?>
                                <a class="dropdown-item" href="<?= URL_BASE ?>/rutas/rutas.php?page=logIn">
                                    Inicia sesión aquí!
                                </a>

                                <a class="dropdown-item" href="<?= URL_BASE ?>/rutas/rutas.php?page=signUp">
                                    Crea tu cuenta
                                </a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

                <?php if(count($_SESSION) > 0) : ?>
                    <div class="d-inline-flex align-items-center d-block d-lg-none">
                        <a href="<?= URL_BASE ?>/rutas/rutas.php?page=favorites" class="btn px-0 ml-2">
                            <i class="fas fa-heart text-primary"></i>
                            <span class="badge border border-dark rounded-circle" style="padding-bottom: 2px;" id="responsiveFavs">
                                0
                            </span>
                        </a>
                    </div>
                <?php endif ?>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="<?= URL_BASE ?>/rutas/rutas.php?page=home" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-title-didi px-2">Direc</span>
                    <span class="h1 text-uppercase text-dark bg-title-niby px-2 ml-n1">Torio</span>
                </a>
            </div>

            <div class="col-lg-4 col-6 text-left">
                <form action="<?= URL_BASE ?>/search.php" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="Buscar productos">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Inicio de la Barra de Navegación -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-niby-nav w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categorías</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999; max-height: 400px; overflow-y: auto;">
                    <div class="navbar-nav w-100">
                        <?php foreach ($data as $categoria): ?>
                            <a href="<?= URL_BASE ?>/rutas/rutas.php?page=shop&category=<?= $categoria["id_categoria"] ?>" class="nav-item nav-link">
                                <?= htmlspecialchars($categoria['nombre']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="<?= URL_BASE ?>/rutas/rutas.php?page=home" class="nav-item nav-link <?= $_GET["page"] === 'home' ? 'active' : '' ?>">
                                Inicio
                            </a>
                            <a href="<?= URL_BASE ?>/rutas/rutas.php?page=shop" class="nav-item nav-link <?= $_GET["page"] === 'shop' ? 'active' : '' ?>">
                                Tienda
                            </a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle <?= $_GET["page"] === 'cart' || $_GET["page"] === 'checkout' ? 'active' : '' ?>" data-toggle="dropdown"> 
                                    Páginas <i class="fa fa-angle-down mt-1"></i>
                                </a>

                                <div class="dropdown-menu bg-primary rounded-0 border-0 m-0">
                                    <a href="<?= URL_BASE ?>/rutas/rutas.php?page=checkout" class="dropdown-item">Realizar Compra</a>
                                </div>
                            </div>
                            <a href="<?= URL_BASE ?>/rutas/rutas.php?page=contact" class="nav-item nav-link <?= $_GET["page"] === 'contact' ? 'active' : '' ?>">
                                Contacto
                            </a>
                        </div>

                        <?php if(count($_SESSION) > 0) : ?>
                            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                                <a href="<?= URL_BASE ?>/rutas/rutas.php?page=favorites" class="btn px-0"
                                title="Tus Servicios Favoritos">
                                    <i class="fas fa-heart text-primary"></i>
                                    <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"
                                    id="navbarFavs">
                                        0
                                    </span>
                                </a>
                            </div>
                        <?php endif ?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Fin de la Barra de Navegación -->
