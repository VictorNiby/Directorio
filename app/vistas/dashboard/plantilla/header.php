<?php
if (!defined('URL_BASE')) {
    $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    define('URL_BASE', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio/publico");
    define('URL_ADMIN', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio/app/vistas");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Directorio</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= URL_BASE ?>/css/styles.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">DIRECTORIO</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item">VictorNiby</a></li>
                    <br>
                    <li><a class="dropdown-item" href="#!">Salir</a></li>

                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">

                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Inicio</div>
                        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'dashboard' ? 'active' : '' ?>"
                            href="/directorio/rutas/rutas.php?page=dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-house"></i></div>
                            Inicio
                        </a>

                        <div class="sb-sidenav-menu-heading">Laboratorio</div>

                        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'hoods' ? 'active' : '' ?>"
                            href="/directorio/rutas/rutas.php?page=hoods">
                            <div class="sb-nav-link-icon"><i class="fas fa-city"></i></div>
                            Barrios
                        </a>

                        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'categories' ? 'active' : '' ?>"
                            href="/directorio/rutas/rutas.php?page=categories">
                            <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                            Categorías
                        </a>

                        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'chats' ? 'active' : '' ?>"
                            href="/directorio/rutas/rutas.php?page=chats">
                            <div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                            Chats
                        </a>

                        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'services' ? 'active' : '' ?>"
                            href="/directorio/rutas/rutas.php?page=services">
                            <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
                            Servicios
                        </a>

                        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'users' ? 'active' : '' ?>"
                            href="/directorio/rutas/rutas.php?page=users">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Usuarios
                        </a>

                        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'sales' ? 'active' : '' ?>"
                            href="/directorio/rutas/rutas.php?page=sales">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Ventas
                        </a>
                    </div>

                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Conectado como:</div>
                    VictorNiby
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <!-- AQUI VA EL BODY.PHP  -->