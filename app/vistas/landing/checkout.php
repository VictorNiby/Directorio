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
                            <select name="barrio" class="custom-select">
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
                            <input class="form-control" name="direccion" type="text" placeholder="Calle 10 #14-190">
                        </div>
                                 
                    </div>
                </div>

                <div class="bg-light p-30 mb-5"
                style="display: none;"
                id="creditCardInfo">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Número Tarjeta</label>
                            <input class="form-control" type="number"
                            name="numero_tarjeta" min="0"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        
                        <div class="col-md-6 form-group">
                            <label>Fecha Vencimiento</label>
                            <input class="form-control" type="month"
                            name="fecha_vencimiento_tarjeta"
                            min="<?=date('Y')?>-<?=date('m')?>">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>CVV</label>
                            <input class="form-control" type="number" name="cvv" min="0"
                            pattern="^\d{3,4}$" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
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

                <form class="mb-5" id="formCheckOut" enctype="multipart/form-data" data-service="<?php echo $service["id_servicio"] ?>">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Métodos de Pago</span></h5>
                    <div class="bg-light p-30">

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="directcheck" value="pago_directo" required>
                                <label class="custom-control-label" for="directcheck">Pago Directo</label>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="creditCard" value="tarjeta" required>

                                <label class="custom-control-label" for="creditCard">Tarjeta de Crédito/Débito</label>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input type="checkbox" name="terminos_condiciones" id="terminos_condiciones"
                            class="form-check-input" value="checked" required>
                            <label for="terminos_condiciones" class="form-check-label">
                                Al realizar esta compra, estás aceptando nuestros 
                                <a href="#" data-toggle="modal" data-target="#modalTerminos">
                                    <strong>Términos y Condiciones.</strong>
                                </a>
                            </label>
                        </div>

                        <button class="btn btn-block btn-primary font-weight-bold py-3"
                        type="submit">
                            Ordenar Servicio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Checkout End -->
    
    <!-- MODAL TERMINOS Y CONDICIONES !-->
    <div class="modal fade" tabindex="-1" id="modalTerminos">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Términos y Condiciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2>1. Aceptación de los Términos</h2>
                <p>
                    Al acceder y utilizar esta plataforma, el usuario acepta cumplir estos Términos y Condiciones. 
                    Si no está de acuerdo con alguno de los términos aquí establecidos, debe abstenerse de utilizar el sitio.
                </p>

                <h2>2. Descripción del Servicio</h2>
                <p>
                    Esta plataforma funciona como un intermediario digital entre personas residentes en <strong>Cartago, Valle del Cauca</strong> 
                    que ofrecen servicios (en adelante, "Proveedores") y otras personas interesadas en reservar dichos servicios 
                    (en adelante, "Clientes"). Ejemplos de servicios incluyen, pero no se limitan a, renta de lavadoras, reparaciones, 
                    transporte, entre otros.
                </p>

                <h2>3. Registro de Usuarios</h2>
                <ul>
                    <li>Todos los usuarios deben registrarse con información real y actualizada.</li>
                    <li>Los usuarios pueden ser tanto Proveedores como Clientes.</li>
                    <li>Está prohibido crear cuentas falsas o suplantar a otras personas.</li>
                </ul>

                <h2>4. Publicación de Servicios</h2>
                <ul>
                    <li>Los Proveedores son responsables del contenido que publican: descripción, precio, disponibilidad y condiciones del servicio.</li>
                    <li>No se permite la publicación de servicios ilegales, peligrosos o que infrinjan derechos de terceros.</li>
                    <li>La plataforma se reserva el derecho de eliminar cualquier publicación que infrinja estos términos o las leyes locales.</li>
                </ul>

                <h2>5. Reservas y Pagos</h2>
                <ul>
                    <li>Los Clientes pueden realizar reservas a través del sistema integrado de la plataforma.</li>
                    <li>El método de pago será definido por la plataforma o acordado directamente entre las partes.</li>
                    <li>La plataforma <strong>no garantiza</strong> el cumplimiento de los servicios por parte de los Proveedores, pero puede intervenir en caso de disputas.</li>
                </ul>

                <h2>6. Cancelaciones y Reembolsos</h2>
                <p>
                    Las condiciones para cancelar una reserva o solicitar reembolso deben estar claras en cada publicación.
                    En caso de conflictos, la plataforma puede mediar, pero no se hace responsable de pérdidas económicas entre las partes.
                </p>

                <h2>7. Responsabilidades del Usuario</h2>
                <ul>
                    <li>Usar la plataforma de manera ética y legal.</li>
                    <li>No acosar, amenazar o estafar a otros usuarios.</li>
                    <li>Cumplir con los acuerdos establecidos al reservar o aceptar una reserva.</li>
                </ul>

                <h2>8. Limitación de Responsabilidad</h2>
                <p>
                    La plataforma <strong>no se responsabiliza</strong> por daños, pérdidas o incumplimientos derivados de los servicios ofrecidos o reservados por usuarios.
                    La responsabilidad del cumplimiento de los servicios recae exclusivamente en los usuarios involucrados.
                </p>

                <h2>9. Propiedad Intelectual</h2>
                <p>
                    Todo el contenido, diseño y desarrollo de la plataforma es propiedad de <strong>DIRECTORIO</strong>.
                    Los usuarios conservan derechos sobre sus publicaciones, pero autorizan a la plataforma a mostrar ese contenido mientras esté activo.
                </p>

                <h2>10. Modificaciones a los Términos</h2>
                <p>
                    Estos Términos y Condiciones pueden ser modificados en cualquier momento.
                    Se notificará a los usuarios por medios electrónicos o dentro de la plataforma en caso de cambios sustanciales.
                </p>

                <h2>11. Ley Aplicable</h2>
                <p>
                    Estos Términos se regirán por las leyes de Colombia y cualquier disputa será resuelta ante los tribunales competentes en <strong>Cartago, Valle del Cauca</strong>.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Aceptar</button>
            </div>
            </div>
        </div>
    </div>

    <script type="module" src="<?=URL_BASE ?>/publico/js/checkout/checkout.js"></script>

<?php include_once RUTA_BASE . '/app/vistas/landing/plantilla/footer.php'; ?>