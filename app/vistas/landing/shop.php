<?php 
define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/app/vistas/landing/plantilla/header.php';
?>
<body>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-5">
                    <a class="breadcrumb-item text-dark" href="<?= URL_BASE ?>/rutas/rutas.php?page=home">Inicio</a>
                    <a class="breadcrumb-item text-dark" href="<?= URL_BASE ?>/rutas/rutas.php?page=shop">Tienda</a>
                    <span class="breadcrumb-item active">Lista de Servicios</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- INICIO CONTENIDO TIENDA -->
    <div class="container-fluid">
        <div class="row px-xl-5">

            <!-- INICIO SIDEBAR FILTROS -->
            <div class="col-lg-3 col-md-4">
                    <!-- INICIO FILTRO PRECIO -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filtrar por precio</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <?php
                            $category = isset($_GET["category"]) && is_numeric($_GET["category"]) ? $_GET["category"] : null;

                            $filterURL = isset($category) ? 'rutas.php?page=shop&category='.$category : 'rutas.php?page=shop'; 
                        ?>

                        <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                            <a href="<?= $filterURL ?>&price=0" class="text-<?= isset($_GET["price"]) && $_GET["price"] === "0" ? 'primary' : 'dark'?>">
                                Cualquier precio
                            </a>
                        </div>

                        <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                            <a href="<?= $filterURL ?>&price=1" class="text-<?= isset($_GET["price"]) && $_GET["price"] === "1" ? 'primary' : 'dark'?>">
                                $0 - $5.000
                            </a>
                        </div>

                        <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                            <a href="<?= $filterURL ?>&price=2" class="text-<?= isset($_GET["price"]) && $_GET["price"] === "2" ? 'primary' : 'dark'?>">
                                $5.000 - $15.000
                            </a>
                        </div>

                        <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                            <a href="<?= $filterURL ?>&price=3" class="text-<?= isset($_GET["price"]) && $_GET["price"] === "3" ? 'primary' : 'dark'?>">
                                $15.000 - $30.000
                            </a>
                        </div>

                        <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                            <a href="<?= $filterURL ?>&price=4" class="text-<?= isset($_GET["price"]) && $_GET["price"] === "4" ? 'primary' : 'dark'?>">
                                $30.000 - $60.000
                            </a>
                        </div>

                        <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                            <a href="<?= $filterURL ?>&price=5" class="text-<?= isset($_GET["price"]) && $_GET["price"] === "5" ? 'primary' : 'dark'?>">
                                $60.000 - $100.000
                            </a>
                        </div>

                        <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                            <a href="<?= $filterURL ?>&price=6" class="text-<?= isset($_GET["price"]) && $_GET["price"] === "6" ? 'primary' : 'dark'?>">
                                $100.000 +
                            </a>
                        </div>
                    </div>
                    <!-- FINAL FILTRO PRECIO  -->
                    
                    <!-- INICIO FILTRO CATEGORIAS  -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filtro por categoria</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <?php
                            $price = isset($_GET["price"]) && is_numeric($_GET["price"]) ? $_GET["price"] : null;
                        ?>

                        <?php foreach ($data as $index => $category) : ?>
                        <div class="custom-control mb-3 d-flex justify-content-between">
                            <a href="rutas.php?page=shop&category=<?= $category["id_categoria"] ?><?= isset($price) ? '&price='.$price : '' ?>"
                            class="text-<?= isset($_GET["category"]) && $_GET["category"] === strval($category["id_categoria"]) ? 'primary' : 'dark'?>">
                                <?= $category["nombre"] ?>
                            </a>

                            <span class="badge border font-weight-normal p-2">
                                <?php echo $services_count[$index]["service_count"] ?>
                            </span>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <!-- FIN FILTRO CATEGORIAS !-->
            </div>
            <!-- FIN FILTROS-->
            
            <!-- INICIO MAIN-->
            <main class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <!--INICIO ORDENAR POR!-->
                    <!-- <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Ordenar</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Mas reciente</a>
                                        <a class="dropdown-item" href="#">Más popular</a>
                                        <a class="dropdown-item" href="#">Mejor calificación</a>
                                    </div>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Mostrar</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!--FIN ORDENAR POR!-->

                    <!--INICIO LISTA PRODUCTOS!-->
                    <?php if (count($services) > 0) : ?>
                        <?php foreach($services as $index => $service) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden" style="height: 200px;">
                                        <img class="img-fluid w-100 h-100 object-fit-cover" src="<?= URL_BASE ?>/publico/img/servicios/<?= $service["imagen_servicio"] ?>" alt="Imagen del servicio">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" 
                                                href="<?php URL_BASE ?>?page=service&id=<?php echo $service["id_servicio"] ?>">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a role="button" class="btn btn-outline-dark btn-square"
                                            id="btnFavorite" data-service="<?= $service['id_servicio'] ?>">
                                                <?php if(count($favs) > 0 && in_array($service["id_servicio"],$favs)) : ?>
                                                    <i class="fas fa-heart text-primary" id="fav-icon"></i>
                                                <?php else : ?>
                                                    <i class="far fa-heart text-primary" id="fav-icon"></i>
                                                <?php endif ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate d-block"           style="max-width: 100%;" 
                                        href="<?php URL_BASE ?>?page=service&id=<?php echo $service["id_servicio"] ?>" 
                                        title="<?php echo htmlspecialchars($service['titulo']); ?>">
                                            <?php echo htmlspecialchars($service['titulo']); ?>
                                        </a>

                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5><?= number_format($service["precio"]) ?></h5>
                                        </div>

                                        <?php if($reviews[$index]["total_reviews"] > 0) : ?>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <?php for ($i=0; $i < round($reviews[$index]["calificacion"]); $i++) : ?>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                <?php endfor ?>

                                                <?php if($reviews[$index]["calificacion"] < 5) : ?>
                                                    <?php for($i = 0;$i < (5 - round($reviews[$index]["calificacion"]));$i++) : ?>
                                                        <small class="fa-regular fa-star text-primary mr-1"></small>
                                                    <?php endfor ?>
                                                <?php endif ?>

                                                <small><?= $reviews[$index]["total_reviews"] ?></small>
                                            </div>
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
                        <?php endforeach ?>
                    <?php else : ?>
                        <div class="card w-100 p-3">
                            <p class="text-center text-black h3">No hay servicios...</p>
                        </div>
                        
                    <?php endif ?>
                    <!--FIN LISTA PRODUCTOS!-->
                    
                    <!--INICIO PAGINACIÓN !-->
                    <!-- <?php if (count($services) > 0) : ?>
                        <div class="col-12">
                            <nav>
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled"><a class="page-link" href="#">Anterior</span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                            </ul>
                            </nav>
                        </div>
                    <?php endif ?> -->
                    <!--FIN PAGINACIÓN !-->
                </div>
            </main>
            <!-- END MAIN -->
        </div>
    </div>
    <!-- FIN CONTENIDO TIENDA  -->

<script type="module" src="<?= URL_BASE ?>/publico/js/shop/shop.js"></script>
<?php include_once RUTA_BASE . '/app/vistas/landing/plantilla/footer.php'; ?>