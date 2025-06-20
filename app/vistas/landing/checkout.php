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
                    <a class="breadcrumb-item text-dark" href="<?= URL_BASE ?>/rutas/rutas.php">Inicio</a>
                    <a class="breadcrumb-item text-dark" href="<?= URL_BASE ?>/rutas/rutas.php?page=service&id=<?= $_GET["service"] ?>">Tienda</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- COL FACTURACION !-->
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Dirección de Facturación</span></h5>

                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Nombre Completo</label>
                            <input class="form-control" type="text" disabled
                            value="<?= $_SESSION["name"] ?>">
                        </div>
                        
                        <div class="col-md-6 form-group">
                            <label>Correo Electrónico</label>
                            <input class="form-control" type="text"
                            disabled value="<?= $_SESSION["email"] ?>">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Número Telefónico</label>
                            <input class="form-control" type="text" disabled
                            value="<?= $_SESSION["phone_number"] ?>">
                        </div>

                        <div class="col-md-6 form-select">
                            <label>Barrio</label>
                            <select name="barrio" required
                            class="custom-select">
                                <option value="0" selected>Selecciona un barrio</option>
                                <?php foreach ($hoods as $hood) : ?>
                                    <option value="<?= $hood["id_barrio"] ?>">
                                        <?= $hood["nombre"] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Dirección</label>
                            <input class="form-control" type="text" placeholder="Calle 10 #14-190">
                        </div>
                                 
                    </div>
                </div>
            </div>

            <!-- COL PAGO !-->
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">TOTAL</span>
                </h5>

                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Servicio</h6>
                        <div class="d-flex justify-content-between">
                            <p><?= $service["titulo"] ?></p>
                            <p>$<?= number_format($service["precio"]) ?></p>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>$<?= number_format($service["precio"]) ?></h5>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Métodos de Pago</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div>

                        <button class="btn btn-block btn-primary font-weight-bold py-3">
                            Ordenar Servicio
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->


<?php include_once RUTA_BASE . '/app/vistas/landing/plantilla/footer.php'; ?>