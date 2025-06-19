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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
  <script type="module" src="<?= URL_BASE ?>/publico/js/session/signup.js"></script>
  <link rel="stylesheet" href="<?= URL_BASE ?>/publico/css/register.css">
</head>
<body>
  <div class="register-container animate__animated animate__fadeIn">
    <div class="register-animation">
      <!-- Lottie animación local o externa -->
      <div id="lottie"></div>
    </div>
    <div class="register-form">
      <h2>Crear Cuenta</h2>
      <form enctype="multipart/form-data" method="post" id="form">
        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Nombre completo" name="nombre" required>
        </div>
        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Documento de identidad" name="documento" required>
        </div>
        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Telefono" name="telefono" required>
        </div>
        <div class="mb-3">
          <input type="date" class="form-control" placeholder="Fecha de nacimiento" name="nacimiento" required>
        </div>
        <div class="mb-3">
          <input type="email" class="form-control" placeholder="Correo electrónico" name="correo" required>
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="password" required>
        </div>
        <div class="mb-4">
          <input type="file" class="form-control" name="foto">
        </div>
        <button type="submit" class="btn">Registrarse</button>
      </form>
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
      path: '<?= URL_BASE ?>/publico/img/login/login.json'
    });
  </script>
</body>
</html>