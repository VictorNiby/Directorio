<?php
date_default_timezone_set('America/Bogota');

define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
if (!defined('URL_IMG')) {
    $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    define('URL_IMG', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio/publico/img");
}

include_once RUTA_BASE . '/app/vistas/landing/plantilla/header.php';
?>

<body>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="<?php URL_BASE ?>?page=home">Inicio</a>
                    <a class="breadcrumb-item text-dark" href="#">Servicio</a>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Inicio Detalles del servicio  -->
    <div class="container-fluid pb-5">
        
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <?php if(count($service_imgs) > 1) : ?>
                    <div class="swiper swiper-services">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <?php foreach($service_imgs as $img) : ?>
                                 <div class="swiper-slide">
                                    <img class="w-100 h-100" src="<?= URL_IMG ?>/servicios/<?= $img["imagen_ref"] ?>" alt="Imagen del servicio">
                                 </div>
                             <?php endforeach ?>
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                <?php else : ?>

                <?php foreach($service_imgs as $img) : ?>
                    <div class="card p-3 border-0">
                        <img class="w-100 h-100 img-fluid" src="<?= URL_IMG ?>/servicios/<?php echo $img["imagen_ref"] ?>" alt="Imagen del servicio">
                    </div>
                <?php endforeach ?>

                <?php endif ?>
            </div>

            <?php ?>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3> <?php echo $service["titulo"] ?> </h3>
                    <div class="d-flex mb-3">
                        <?php if($total_reviews["total_reviews"] > 0) : ?>
                            <div class="text-primary mr-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star-half-alt"></small>
                                <small class="far fa-star"></small>
                            </div>
                        <?php endif ?>
                        <small class="pt-1"><?php echo $total_reviews["total_reviews"] > 0 ? $total_reviews["total_reviews"] : "Este servicio no tiene reseñas." ?></small>
                    </div>

                    <h3 class="font-weight-semi-bold mb-4"><?php echo number_format($service["precio"]) ?></h3>
                    <p class="mb-4">
                        <?php echo $service["descripcion"] ?>
                    </p>

                    <div class="d-flex align-items-center mb-4 pt-2">
                        <button class="btn btn-primary px-3"
                        id="btnManageFav" data-service="<?= $service["id_servicio"] ?>">
                            <i class="far fa-heart" id="fav-icon"></i>
                            <?= count($favs) > 0 && in_array($service["id_servicio"],$favs)? 'Eliminar de Mis Favoritos' : 'Añadir a Mis favoritos' ?>
                            
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Descripción</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Información</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reseñas (<?php echo $total_reviews["total_reviews"]?>)</a>
                    </div>
                    <div class="tab-content">
                        <!--Descripcion del producto !-->
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Descripción del servicio</h4>
                            <p><?php echo $service["descripcion"] ?></p>
                        </div>
                        
                        <!--Informacion adicional!-->
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Información adicional</h4>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Precio: <?php echo $service["precio"]?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            Descripción completa: <?php echo $service["descripcion"]?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            Categoría: <?php echo $service["categoria"]?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <?php $fecha = explode(" ",$service["fecha_creacion"])?>
                                            Fecha de creación: <?php echo $fecha[0]?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            Dirección: <?php echo $service["direccion"]?>
                                        </li>

                                      </ul> 
                                </div>
                            </div>
                        </div>

                        <!--Apartado de reseñas!-->
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <!--Col de reseñas !-->
                                <?php if($total_reviews["total_reviews"] > 0) : ?>
                                    <div class="col-md-6">
                                        <h4 class="mb-4">
                                            Reseñas totales: <?php echo $total_reviews["total_reviews"] ?>
                                        </h4>

                                        <?php foreach($reviews as $review) : ?>
                                            <?php 
                                                $fecha = explode(" ",$review["fecha"]);
                                                $hora = strtotime($fecha[1]);
                                            ?>

                                            <div class="media mb-4">
                                                <img src="<?= URL_IMG ?>/usuarios/<?php echo $review['usuario_foto']?>" alt="Imagen de perfil del usuario" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                                
                                                <div class="media-body">
                                                    <h6><?php echo $review["nombre_usuario"] ?>
                                                        <small> - 
                                                            <i>
                                                                <?php echo date($fecha[0]) ?> <?php echo date('h:i:s',$hora)?>
                                                            </i>
                                                        </small>
                                                    </h6>
                                                    <div class="text-primary mb-2">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                        <i class="far fa-star"></i>
                                                    </div>

                                                    <p><?php echo $review["comentario"]?></p>
                                                </div>
                                            </div>
                                        <?php endforeach ?>

                                    </div>
                                <?php endif ?>
                                <!--FIN RESEÑAS!-->

                                <!--Col para añadir una nueva reseñas!-->
                                <div class="col-md-<?php echo $total_reviews["total_reviews"] > 0 ? '6' : '12' ?>">
                                    <h4 class="mb-4">Deja una reseña!</h4>

                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Tu calificación:</p>
                                        <div class="text-primary">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <form>
                                        <input type="number" hidden name="calificacion">

                                        <div class="form-group">
                                            <label for="message">Tu reseña *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"
                                            name="comentario"></textarea>
                                        </div>

                                        <div class="form-group mb-0">
                                            <button type="submit" name="action" value="new_review" class="btn btn-primary px-3">
                                                Enviar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!--FIN AÑADIR RESEÑAS!-->
                            </div>
                        </div>
                        <!--FIN APARTADO RESEÑAS!-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Detalles del servicio  --> 

    <!--  Inicio Servicios Relacionados -->
    <?php if(!$isEmpty) : ?> 
        <div class="container-fluid py-5">
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Puede que también te interesen</span></h2>
            <div class="row px-xl-5">
                <div class="col">
                    <?php if(count($related_services) > 1)  : ?>
                        <div class="owl-carousel related-carousel">
                            <?php foreach($related_services as $related) : ?>

                            <div class="product-item bg-light w-25 overflow-hidden">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="<?= URL_IMG ?>/servicios/<?= $related["servicio_imagen"] ?>" alt="Imágen del servicio recomendado">

                                    <div class="product-action" id="btnFavorite" data-service="<?= $related['id_servicio'] ?>">
                                        <a role="button" class="btn btn-outline-dark btn-square">
                                            <?php if(count($favs) > 0 && in_array($related["id_servicio"],$favs)) : ?>
                                                <i class="fas fa-heart text-primary" id="fav-icon"></i>
                                            <?php else : ?>
                                                <i class="far fa-heart text-primary" id="fav-icon"></i>
                                            <?php endif ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="<?php URL_BASE ?>?page=service&id=<?php echo $related["id_servicio"] ?>">
                                        <?= $related["titulo"] ?>
                                    </a>

                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5> <?= $related["precio"] ?> </h5>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small><?= $related["total_reviews"] ?></small>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                        </div>
                    <?php else : ?>
                        <div class="product-item bg-light w-25 overflow-hidden">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" src="<?= URL_IMG ?>/servicios/<?= $related_services[0]["servicio_imagen"] ?>" 
                                    alt="Imágen del servicio recomendado">

                                    <div class="product-action" id="btnFavorite" data-service="<?= $related_services[0]['id_servicio'] ?>">
                                        <a role="button" class="btn btn-outline-dark btn-square">
                                            <?php if(count($favs) > 0 && in_array($related_services[0]["id_servicio"],$favs)) : ?>
                                                <i class="fas fa-heart text-primary" id="fav-icon"></i>
                                            <?php else : ?>
                                                <i class="far fa-heart text-primary" id="fav-icon"></i>
                                            <?php endif ?>
                                        </a>
                                    </div>
                                </div>

                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="<?php URL_BASE ?>?page=service&id=<?php echo $related_services[0]["id_servicio"] ?>">
                                    <?= $related_services[0]["titulo"] ?>
                                </a>

                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5> <?= $related_services[0]["precio"] ?> </h5>
                                </div>

                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small><?= $related_services[0]["total_reviews"] ?></small>
                                </div>
                            </div>

                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <!-- Fin Servicios Relacionados -->

    <!-- SWIPER.JS !-->
    <script>
        window.addEventListener('DOMContentLoaded',()=>{
            const swiper = new Swiper(".swiper-services", {
                loop: true,
                pagination: {
                el: ".swiper-pagination",
                clickable: true,
                },
                navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
                },
                autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                },
            })
        })
    </script>

<script type="module" src="<?= URL_BASE ?>/publico/js/details/details.js"></script>
<?php include_once RUTA_BASE . '/app/vistas/landing/plantilla/footer.php'; ?>