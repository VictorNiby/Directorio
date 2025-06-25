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
                    <span class="breadcrumb-item active">Historial</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <?php if(count($history) > 0) : ?>
            <div class="row px-xl-5">
                <div class="col-lg-12 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Imagen</th>
                                <th>Servicio</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Estado Del Pago</th>
                                <th>Acciones</th> 
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                           <?php foreach($history as $item) : ?>
                                <tr>
                                    <td class="align-middle">
                                        <img src="<?= URL_BASE ?>/publico/img/servicios/<?= $item["imagen"]?>" alt="Imagen del servicio" style="width: 50px;">
                                    </td>

                                    <td class="align-middle">            
                                        <a href="<?= URL_BASE ?>/rutas/rutas.php?page=service&id=<?= $item["id_servicio"] ?>" class="text-dark">
                                            <?= $item["titulo"] ?>
                                        </a>
                                    </td>

                                    <td class="align-middle">
                                        $<?= number_format($item["total"]) ?>
                                    </td>

                                    <td class="align-middle">
                                        <?= date($item["fecha"]) ?>
                                    </td>

                                    <td class="align-middle">
                                        <?= $item['estado'] ?>
                                    </td>

                                    <td class="align-middle">
                                        <?php if (!in_array($item["estado"],["Cancelado","Realizado","Pagado"])) : ?>
                                            <button class="btn btn-sm btn-danger"
                                            style="margin-right: 10px;"
                                            data-service="<?= $item["id_servicio"] ?>"
                                            title="Cancelar Servicio"
                                            id="btnCancel">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        <?php endif ?>
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
                        <p class="text-dark">No has realizado ninguna compra...</p>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
    <!-- Cart End -->

<script type="module" src="<?= URL_BASE ?>/publico/js/history/history.js"></script>
<?php include_once (RUTA_BASE .'/app/vistas/landing/plantilla/footer.php'); ?>