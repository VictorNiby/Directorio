<?php 
if (!defined('URL_BASE')) {
    $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    define('URL_BASE', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Directorio</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <!-- Animate.css -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
  <!-- Lottie Web -->
  <script src="https://unpkg.com/lottie-web@latest/build/player/lottie.min.js"></script>
  <!-- Sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
  <!-- JS CUSTOM -->
  <script src="<?= URL_BASE ?>/publico/js/session/login.js" type="module"></script>
  <!-- CSS CUSTOM -->
  <link rel="stylesheet" href="<?= URL_BASE ?>/publico/css/login.css">  
</head>
<body>

  <div class="login-container animate__animated animate__fadeIn">
    <div class="login-animation">
      <!-- Lottie animación local o externa -->
      <div id="lottie"></div>
    </div>
    <div class="login-form">
      <h2 class="mb-1">Bienvenido a</h2>
      <div class="d-flex align-items-center justify-content-center ms-0 mb-4">
        <span class="h4 text-uppercase text-niby didi px-2 pe-1">Direc</span>
        <span class="h4 text-uppercase text-didi niby px-2 ps-1">Torio</span>
      </div>
      <form method="post" enctype="multipart/form-data" id="form">
        <div class="mb-3">
          <input type="email" class="form-control" placeholder="ejemplo@gmail.com" name="email" required>
        </div>
        <div class="mb-4">
          <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
        </div>
        <button type="submit" class="btn">Ingresar</button>
      </form>
      <div class="links-container">
        <a href="<?= URL_BASE ?>/rutas/rutas.php?page=signUp">Crear Cuenta</a>
        <a href="#">¿Olvidaste tu contraseña?</a>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Inicializar Lottie -->
  <script>
    lottie.loadAnimation({
      container: document.getElementById('lottie'),
      renderer: 'svg',
      loop: true,
      autoplay: true,
      path: '../publico/img/login/login.json'
    });
  </script>

</body>
</html>
