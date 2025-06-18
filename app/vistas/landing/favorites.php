<?php 
define('RUTA_BASE', $_SERVER['DOCUMENT_ROOT'] . '/directorio');
include_once RUTA_BASE . '/app/vistas/landing/plantilla/header.php';
?>

<body>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="<?= URL_BASE ?>/rutas/rutas.php?page=home">Inicio</a>
                    <span class="breadcrumb-item active">Favoritos</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <?php if(count($favorites) > 0) : ?>
            <div class="row px-xl-5">
                <div class="col-lg-12 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Imagen</th>
                                <th>Servicio</th>
                                <th>Precio</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <?php foreach ($favorites as $favorite) : ?>
                                <tr>
                                    <td class="align-middle">
                                        <img src="<?= URL_BASE ?>/publico/img/servicios/<?= $favorite["imagen_ref"]?>" alt="Imagen del servicio" style="width: 50px;">
                                    </td>
                                    
                                    <td class="align-middle">            
                                        <a href="<?= URL_BASE ?>/rutas/rutas.php?page=service&id=<?= $favorite["id_servicio"] ?>" class="text-dark">
                                            <?= $favorite["titulo"] ?>
                                        </a>
                                    </td>

                                    <td class="align-middle">$<?= number_format($favorite["precio"]) ?></td>
                                    <td class="align-middle">
                                        <form action="routes.php" method="post"
                                        id="form">
                                            <input type="text" hidden value="<?= $favorite["id_servicio"]?>" name="servicio_id">
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else : ?>
            <div class="row px-xl-5">
                <div class="col-12">
                    <div class="card w-100 p-3 text-center">
                        <p class="text-dark">No tienes favoritos guardados...</p>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
    <!-- Cart End -->

<script type="module" src="<?= URL_BASE ?>/publico/js/favorites/favorites.js"></script>
<?php include_once (RUTA_BASE .'/app/vistas/landing/plantilla/footer.php'); ?>