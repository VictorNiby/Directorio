<?php
if (!defined('URL_BASE')) {
    $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    define('URL_BASE', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio/publico");
    define('URL_ADMIN', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio/app/vistas");
}
?>

<!--
=========================================================
* Material Dashboard 3 - v3.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= URL_BASE ?>/img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?= URL_BASE ?>/img/favicon.png">
  <title>
    Directorio | Dashboard
  </title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="<?= URL_BASE ?>/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?= URL_BASE ?>/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= URL_BASE ?>/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>
<style>
.sidenav {
  z-index: 1030 !important;
}
</style>
<body class="g-sidenav-show  bg-gray-100">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand px-4 py-3 m-0 d-flex align-items-center" href="<?= URL_BASE ?>">
      <div class="ms-0 d-flex align-items-center">
        <span class="h4 text-uppercase text-niby bg-title-didi px-2 pe-1">Direc</span>
        <span class="h4 text-uppercase text-dark bg-title-niby px-2 ps-1">Torio</span>
      </div>
    </a>
  </div>

  <hr class="horizontal dark mt-0 mb-2">

  <!-- Sidebar Content -->
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      
      <!-- Dashboard -->
      <li class="nav-item">
        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'dashboard' ? 'active' : '' ?>" 
           href="/directorio/rutas/rutas.php?page=dashboard">
          <div class="icon icon-shape icon-sm bg-gradient-dark shadow-dark text-center border-radius-md d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
            <i class="material-symbols-rounded text-white pb-2" style="font-size: 18px; line-height: 1;">dashboard</i>
          </div>
          <span class="nav-link-text ms-1 text-dark font-weight-bold">Dashboard</span>
        </a>
      </li>

      <!-- Barrios -->
      <li class="nav-item">
        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'hoods' ? 'active' : '' ?>" 
           href="/directorio/rutas/rutas.php?page=hoods">
          <div class="icon icon-shape icon-sm bg-gradient-primary shadow-primary text-center border-radius-md d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
            <i class="material-symbols-rounded text-white pb-2" style="font-size: 18px; line-height: 1;">location_city</i>
          </div>
          <span class="nav-link-text ms-1 text-dark">Barrios</span>
        </a>
      </li>

      <!-- Categorías -->
      <li class="nav-item">
        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'categories' ? 'active' : '' ?>" 
           href="/directorio/rutas/rutas.php?page=categories">
          <div class="icon icon-shape icon-sm bg-gradient-info shadow-info text-center border-radius-md d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
            <i class="material-symbols-rounded text-white pb-2" style="font-size: 18px; line-height: 1;">category</i>
          </div>
          <span class="nav-link-text ms-1 text-dark">Categorías</span>
        </a>
      </li>

      <!-- Chats -->
      <li class="nav-item">
        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'chats' ? 'active' : '' ?>" 
           href="/directorio/rutas/rutas.php?page=chats">
          <div class="icon icon-shape icon-sm bg-gradient-success shadow-success text-center border-radius-md d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
            <i class="material-symbols-rounded text-white pb-2" style="font-size: 18px; line-height: 1;">chat</i>
          </div>
          <span class="nav-link-text ms-1 text-dark">Chats</span>
        </a>
      </li>

      <!-- Servicios -->
      <li class="nav-item">
        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'services' ? 'active' : '' ?>" 
           href="/directorio/rutas/rutas.php?page=services">
          <div class="icon icon-shape icon-sm bg-gradient-warning shadow-warning text-center border-radius-md d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
            <i class="material-symbols-rounded text-white pb-2" style="font-size: 18px; line-height: 1;">handyman</i>
          </div>
          <span class="nav-link-text ms-1 text-dark">Servicios</span>
        </a>
      </li>

      <!-- Usuarios -->
      <li class="nav-item">
        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'users' ? 'active' : '' ?>" 
           href="/directorio/rutas/rutas.php?page=users">
          <div class="icon icon-shape icon-sm bg-gradient-danger shadow-danger text-center border-radius-md d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
            <i class="material-symbols-rounded text-white pb-2" style="font-size: 18px; line-height: 1;">group</i>
          </div>
          <span class="nav-link-text ms-1 text-dark">Usuarios</span>
        </a>
      </li>

      <!-- Ventas -->
      <li class="nav-item">
        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] === 'sales' ? 'active' : '' ?>" 
           href="/directorio/rutas/rutas.php?page=sales">
          <div class="icon icon-shape icon-sm bg-gradient-secondary shadow-secondary text-center border-radius-md d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
            <i class="material-symbols-rounded text-white pb-2" style="font-size: 18px; line-height: 1;">point_of_sale</i>
          </div>
          <span class="nav-link-text ms-1 text-dark">Ventas</span>
        </a>
      </li>

    </ul>
  </div>
</aside>
  

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg mt-0">
            <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Directorio</li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Dashboard</a></li>
            
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
            </div>
          </div>
          <ul class="navbar-nav d-flex align-items-center  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="material-symbols-rounded fixed-plugin-button-nav">settings</i>
              </a>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="../pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
                <i class="material-symbols-rounded">account_circle</i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <!-- Metalo ahi -->