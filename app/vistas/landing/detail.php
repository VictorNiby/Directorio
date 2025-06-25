<?php
date_default_timezone_set('America/Bogota');

define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
if (!defined('URL_IMG')) {
    $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    define('URL_IMG', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio/publico/img");
}

include_once RUTA_BASE . '/app/vistas/landing/plantilla/header.php';
?>
<style>
.swiper-slide {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 400px;
  background-color: #f8f9fa;
}
.swiper-slide img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}
</style>
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
                                    <img src="<?= URL_IMG ?>/servicios/<?= $img["imagen_ref"] ?>" alt="Imagen del servicio">
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

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3> <?php echo $service["titulo"] ?> </h3>
                    <div class="d-flex mb-3">
                        <?php if($serviceReviews["total_reviews"] > 0) : ?>
                            <div class="text-primary mr-2">
                                <?php for($i = 0;$i < round($serviceReviews["reviews_promedio"]);$i++) : ?>
                                    <small class="fas fa-star"></small>
                                <?php endfor ?>
                                
                                <?php if(round($serviceReviews["reviews_promedio"]) < 5) : ?>
                                    <?php for($i = 0;$i < (5 - round($serviceReviews["reviews_promedio"]));$i++) : ?>
                                        <small class="fa-regular fa-star"></small>
                                    <?php endfor ?>
                                <?php endif ?>
                            </div>
                        <?php endif ?>
                        <small class="pt-1"><?php echo $serviceReviews["total_reviews"] > 0 ? $serviceReviews["total_reviews"] : "Este servicio no tiene reseñas." ?></small>
                    </div>

                    <h3 class="font-weight-semi-bold mb-4"><?php echo number_format($service["precio"]) ?></h3>
                    <p class="mb-4">
                        <?php echo $service["descripcion"] ?>
                    </p>

                    <div class="d-flex align-items-center mb-4 pt-2">
                        <a href="<?= URL_BASE ?>/rutas/rutas.php?page=checkout&service=<?= $service["id_servicio"] ?>" class="btn btn-primary px-3" style="margin-right: 10px;">
                            <i class="fa-solid fa-check" id="fav-icon"></i>
                            Encargar Servicio
                        </a>
                        
                        <button class="btn btn-primary px-3"
                        id="btnManageFav" data-service="<?= $service["id_servicio"] ?>">
                            <i class="far fa-heart" id="fav-icon"></i>
                            <?= count($favs) > 0 && in_array($service["id_servicio"],$favs)? 'Eliminar de Mis Favoritos' : 'Añadir a Mis Favoritos' ?>
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
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reseñas (<?php echo $serviceReviews["total_reviews"]?>)</a>
                    </div>
                    <div class="tab-content">
                        <!--Descripcion del producto !-->
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Descripción del Servicio</h4>
                            <p><?php echo $service["descripcion"] ?></p>
                        </div>
                        
                        <!--Informacion adicional!-->
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Información Adicional</h4>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            <strong>Dueño del Servicio:</strong> 
                                            <?php echo $service["nombre"]?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <strong>Correo del Dueño:</strong> 
                                            <?php echo $service["correo"]?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <strong>Número Telefónico del Dueño:</strong> 
                                            <?php echo $service["telefono"]?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <strong>Precio:</strong>
                                            <?php echo $service["precio"]?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <strong>Descripción Completa:</strong>
                                            <?php echo $service["descripcion"]?>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <strong>Categoría:</strong>
                                            <?php echo $service["categoria"]?>
                                        </li>
                                        
                                        <li class="list-group-item px-0">
                                            <strong>Dirección: </strong>
                                            <?php echo $service["direccion"]?>
                                        </li>

                                      </ul> 
                                </div>
                            </div>
                        </div>

                        <!--Apartado de reseñas!-->
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <!--Col de reseñas !-->
                                <div class="col-md-6">
                                    <?php if($serviceReviews["total_reviews"] > 0) : ?>
                                        <h4 class="mb-4">
                                            Reseñas totales: <?php echo $serviceReviews["total_reviews"] ?>
                                        </h4>

                                        <?php foreach($reviews as $review) : ?>
                                            <?php 
                                                $fecha = explode(" ",$review["fecha"]);
                                                $hora = strtotime($fecha[1]);
                                            ?>

                                            <div class="media mb-4">
                                                <img src="<?= URL_IMG ?>/usuarios/<?php echo $review['usuario_foto']?>" alt="Imagen de perfil del usuario" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                                
                                                <div class="media-body">
                                                    <h6>
                                                        <?php echo $review["nombre_usuario"] ?>
                                                        <small> - 
                                                            <i>
                                                                <?php echo date($fecha[0]) ?> <?php echo date('h:i a',$hora)?>
                                                            </i>
                                                        </small>
                                                    </h6>

                                                    <?php for($i = 0;$i < $review["calificacion"];$i++) : ?>
                                                        <small class="fas fa-star text-primary"></small>
                                                    <?php endfor ?>
                                                    
                                                    <?php if($review["calificacion"] < 5) : ?>
                                                        <?php for($i = 0;$i < (5 - $review["calificacion"]);$i++) : ?>
                                                            <small class="fa-regular fa-star text-primary"></small>
                                                        <?php endfor ?>
                                                    <?php endif ?>

                                                    <p><?php echo $review["comentario"]?></p>
                                                </div>
                                            </div>
                                        <?php endforeach ?>

                                    <?php else : ?>
                                        <p class="mb-4">No hay reseñas aún para este servicio...</p>
                                    <?php endif ?>        
                                </div>
                                
                                <!--FIN RESEÑAS!-->

                                <!--Col para añadir una nueva reseñas!-->
                                <?php if($canUserRateService) : ?>
                                    <div class="col-md-6">
                                        <h4 class="mb-4">Deja una reseña!</h4>

                                        <div class="d-flex my-3">
                                            <p class="mb-0 mr-2">Tu calificación:</p>
                                            <div class="text-primary"
                                            id="starsContainer">
                                                <i class="far fa-star" id="rate"></i>
                                                <i class="far fa-star" id="rate"></i>
                                                <i class="far fa-star" id="rate"></i>
                                                <i class="far fa-star" id="rate"></i>
                                                <i class="far fa-star" id="rate"></i>
                                            </div>
                                        </div>
                                        <form id="formRating" enctype="multipart/form-data">
                                            <input type="number" name="servicio_id" id="servicio_id"
                                            hidden value="<?= $service["id_servicio"] ?>">

                                            <div class="form-group w-100">
                                                <label for="message">Tu reseña *</label>
                                                <textarea id="message" class="form-control"
                                                name="comentario"></textarea>
                                            </div>

                                            <div class="form-group mb-0">
                                                <button type="submit" class="btn btn-primary px-3">
                                                    Enviar
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                <?php endif ?>
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
            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                <span class="bg-secondary pr-3">Puede que también te interesen</span>
            </h2>
            <div class="row px-xl-5">
                <?php foreach($related_services as $related) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden" style="height: 200px;">
                                <img class="img-fluid w-100 h-100 object-fit-cover" src="<?= URL_IMG ?>/servicios/<?= $related["servicio_imagen"] ?>" alt="Imágen del servicio recomendado">

                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" 
                                    href="<?php URL_BASE ?>?page=service&id=<?php echo $related["id_servicio"] ?>">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a role="button" class="btn btn-outline-dark btn-square"
                                    id="btnFavorite" data-service="<?= $related['id_servicio'] ?>">
                                        <?php if(count($favs) > 0 && in_array($related["id_servicio"],$favs)) : ?>
                                            <i class="fas fa-heart text-primary" id="fav-icon"></i>
                                        <?php else : ?>
                                            <i class="far fa-heart text-primary" id="fav-icon"></i>
                                        <?php endif ?>
                                    </a>
                                </div>
                            </div>

                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate d-block"              style="max-width: 100%;" 
                                href="<?php URL_BASE ?>?page=service&id=<?php echo $related["id_servicio"] ?>" 
                                title="<?php echo htmlspecialchars($related["titulo"]); ?>">
                                    <?php echo htmlspecialchars($related["titulo"]); ?>
                                </a>

                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5> <?= $related["precio"] ?> </h5>
                                </div>

                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <?php if($related["calificacion"] > 0) : ?>
                                        <?php for($i = 0;$i < round($related["calificacion"]);$i++) : ?>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        <?php endfor ?>

                                        <?php if(round($related["calificacion"]) < 5) : ?>
                                            <?php for($i = 0;$i < (5 - round($related["calificacion"]));$i++) : ?>
                                                <small class="fa-regular fa-star text-primary mr-1"></small>
                                            <?php endfor ?>
                                        <?php endif ?>

                                        <small><?= $related["total_reviews"] ?></small>

                                    <?php else : ?>
                                        <small class="fa-regular fa-star text-primary mr-1"></small>
                                        <small class="fa-regular fa-star text-primary mr-1"></small>
                                        <small class="fa-regular fa-star text-primary mr-1"></small>
                                        <small class="fa-regular fa-star text-primary mr-1"></small>
                                        <small class="fa-regular fa-star text-primary mr-1"></small>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
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