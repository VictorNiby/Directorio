<?php 
if (!defined('URL_BASE')) {
    $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    define('URL_BASE', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio/publico");
}
?>  
    <!-- Footer Start -->
    <div class="container-fluid bg-title-didi text-secondary mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Contáctanos</h5>
                <p class="mb-4">¡Estamos aquí para ayudarte! Escríbenos y resolveremos todas tus preguntas sobre nuestros servicios.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Memes Rancios Calle. 4, Cartago, Colombia</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>nibyminson@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+57 314 7506 117</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-5 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Acceso Rápido</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Inicio</a>
                            <!-- <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a> -->
                        </div>
                    </div>

                    <div class="col-md-7 mb-5">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Escribe tu correo electrónico">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">Únete ahora</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Mantente conectado</h6>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">Directorio <?php echo date("Y"); ?></a>. Todos los derechos reservados. Diseñado por
                    <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="img/payments.png" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
 
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <script src="<?= URL_BASE ?>/lib/easing/easing.min.js"></script>
    <script src="<?= URL_BASE ?>/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="<?= URL_BASE ?>/mail/jqBootstrapValidation.min.js"></script>
    <script src="<?= URL_BASE ?>/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="<?= URL_BASE ?>/js/main.js"></script>


</body>
</html>