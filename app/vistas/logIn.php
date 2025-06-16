<?php 
if (!defined('URL_BASE')) {
    $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    define('URL_BASE', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <!--JS PERSONALIZADO!-->
    <script src="<?= URL_BASE ?>/publico/js/session/login.js" type="module"></script>
</head>
<body>
    <form method="post" enctype="multipart/form-data" id="form">
        <input type="email" name="email" required>
        <input type="password" name="password" required>
        <button type="submit">Enviar</button>
    </form>

    <a href="<?= URL_BASE ?>/rutas/rutas.php?page=signUp">¿No tienes una cuenta? Creala aquí!</a>
</body>
</html>
