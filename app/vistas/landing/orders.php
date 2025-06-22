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
                    <span class="breadcrumb-item active">Pedidos</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <?php if(count($orders) > 0) : ?>
            <div class="row px-xl-5">
                <div class="col-lg-12 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Imagen</th>
                                <th>Servicio</th>
                                <th>Cliente</th>
                                <th>Direccion</th>
                                <th>Total</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <?php foreach($orders as $order) : ?>
                                <?php $fecha = date_create($order["fecha"]) ?>
                                <tr>
                                    <td class="align-middle">
                                        <img src="<?= URL_BASE ?>/publico/img/servicios/<?= $order["imagen"]?>" alt="Imagen del servicio" style="width: 50px;">
                                    </td>

                                    <td class="align-middle">            
                                        <a href="<?= URL_BASE ?>/rutas/rutas.php?page=service&id=<?= $order["id_servicio"] ?>" class="text-dark">
                                            <?= $order["titulo"] ?>
                                        </a>
                                    </td>

                                    <td class="align-middle">            
                                        <?php echo $order["nombre"] ?>
                                    </td>

                                    <td class="align-middle">            
                                        <?php echo $order["direccion_usuario"] ?>
                                    </td>

                                    <td class="align-middle">            
                                        <?php echo number_format($order["total"]) ?>
                                    </td>

                                    <td class="align-middle">
                                        <?php echo date_format($fecha,'Y-m-d') ?>
                                    </td>

                                    <td class="align-middle">
                                        <?php echo date_format($fecha,'h:i a') ?>
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
                        <p class="text-dark">No tienes ningun pedido pendiente...</p>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
    <!-- Cart End -->

<script type="module" src="<?= URL_BASE ?>/publico/js/history/history.js"></script>
<?php include_once (RUTA_BASE .'/app/vistas/landing/plantilla/footer.php'); ?>