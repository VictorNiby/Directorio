
<?php 
define('RUTA_BASE', dirname(__DIR__)); // Obtiene la ruta raíz del proyecto
include_once RUTA_BASE . '/landing/plantilla/header.php';

if (!defined('URL_BASE')) {
    $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    define('URL_BASE', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio/rutas/rutas.php");
    define('URL_BASE_TIENDA', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio/app/vistas/landing");
}

?>
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#header-carousel" data-slide-to="1"></li>
                        <li data-target="#header-carousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item position-relative active" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-1.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Men Fashion</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-2.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Women Fashion</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item position-relative" style="height: 430px;">
                            <img class="position-absolute w-100 h-100" src="img/carousel-3.jpg" style="object-fit: cover;">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">Kids Fashion</h1>
                                    <p class="mx-md-5 px-5 animate__animated animate__bounceIn">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/offer-1.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
                <div class="product-offer mb-30" style="height: 200px;">
                    <img class="img-fluid" src="img/offer-2.jpg" alt="">
                    <div class="offer-text">
                        <h6 class="text-white text-uppercase">Save 20%</h6>
                        <h3 class="text-white mb-3">Special Offer</h3>
                        <a href="" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check-circle text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Servicios verificados</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-users text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">Profesionales confiables</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fas fa-handshake text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Satisfacción garantizada</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center bg-light mb-4" style="padding: 30px;">
                    <h1 class="fa fa-headset text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">Soporte personalizado</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured End -->


    <!-- Categories Start -->
    <div class="container-fluid pt-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">Categorías</span>
        </h2>
        <div class="row px-xl-5 pb-3">
        <?php
        $iconos = [
            'Electricista' => 'fa-bolt',
            'Mecánico' => 'fa-wrench',
            'Carpintero' => 'fa-hammer',
            'Pintor' => 'fa-paint-roller',
            'Plomero' => 'fa-faucet',
            'Jardinero' => 'fa-seedling',
            'Albañil' => 'fa-hard-hat',
            'Abogado' => 'fa-scale-balanced',
            'Contador' => 'fa-calculator',
            'Gimnasio' => 'fa-dumbbell',
            'Estilista' => 'fa-scissors',
            'Masajista' => 'fa-spa',
            'Arquitecto' => 'fa-drafting-compass',
            'Psicólogo' => 'fa-brain',
            'Diseñador Gráfico' => 'fa-pen-nib',
            'Transporte' => 'fa-truck',
            'Servicio de Limpieza' => 'fa-soap',
            'Veterinario' => 'fa-dog',
            'Fotógrafo' => 'fa-camera',
            'Cocinero' => 'fa-utensils',
            'Diseño Web' => 'fa-code',
            'Desarrollador de Software' => 'fa-laptop-code',
            'Mantenimiento de Computadoras' => 'fa-computer',
            'Técnico en Electrónica' => 'fa-microchip'
        ];
        ?>

        <?php foreach ($info as $categoria): 
            $id = $categoria["id_categoria"];
            $nombre = $categoria['categoria'];
            $cantidad = $categoria['cantidad_servicios'];
            $icono = $iconos[$nombre] ?? 'fa-folder';
        ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <a class="text-decoration-none" href="<?= URL_BASE ?>/rutas/rutas.php?page=shop&category=<?= $id ?>">
                    <div class="cat-item img-zoom d-flex align-items-center mb-4">
                    <div class="d-flex justify-content-center align-items-center bg-light" style="width: 100px; height: 100px;">
                        <i class="fa <?= $icono ?> fa-3x text-primary"></i>
                    </div>

                        <div class="flex-fill pl-3">
                            <h6><?= htmlspecialchars($nombre) ?></h6>
                            <small class="text-body"><?= $cantidad ?> Servicios</small>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

    <!-- Categories End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Servicios Más Solicitados</span>
    </h2>
    <div class="row px-xl-5">
        <?php foreach ($services as $service): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden" style="height: 200px;">
                        <img class="img-fluid w-100 h-100 object-fit-cover" src="<?php RUTA_BASE ?>/directorio/publico/img/servicios/<?php echo $service["imagen_ref"];?>" 
                            alt="<?php echo htmlspecialchars($service['titulo']); ?>">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" 
                                href="<?php URL_BASE ?>?page=service&id=<?php echo $service["id_servicio"] ?>">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate d-block" style="max-width: 100%;" 
                            href="<?php URL_BASE ?>?page=service&id=<?php echo $service["id_servicio"] ?>" 
                            title="<?php echo htmlspecialchars($service['titulo']); ?>">
                            <?php echo htmlspecialchars($service['titulo']); ?>
                        </a>

                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>$<?php echo number_format($service['precio'], 2); ?></h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="text-muted">Solicitudes: <?php echo $service['total_solicitudes']; ?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

 <?php include_once RUTA_BASE . '/landing/plantilla/footer.php'; ?>