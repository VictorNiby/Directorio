<?php 
if (!defined('URL_BASE')) {
    $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    define('URL_BASE', $protocolo . "://" . $_SERVER['HTTP_HOST'] . "/directorio");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu cuenta!</title>

    <style>
        body{
            margin: 0 auto;
            padding: 0 auto;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form{
            width: 40%;
        }

        .form-column{
            display: flex;
            flex-direction: column;
        }

        .form-row{
            padding: 10px;
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <form enctype="multipart/form-data" method="post">
        <div class="form-column">

            <div class="form-row">
                <label for="documento">Número de documento</label>  
                <input type="number" minlength="10" maxlength="10" min="0" name="documento" required>   
            </div>

            <div class="form-row">
                <label for="nombre">Nombre Completo</label>
                <input type="text" name="nombre" required>
            </div>

            <div class="form-row">
                <label for="correo">Correo Electrónico</label>
                <input type="email" name="correo" required>
            </div>
            
            <div class="form-row">
                <label for="password">Contraseña</label>
                <input type="password" name="password" minlength="6" required>
            </div>
            
            <div class="form-row">
                <label for="telefono">Número telefónico</label>
                <input type="number" maxlength="10" minlength="10" min="0" name="telefono" required>
            </div>
            
            <div class="form-row">
                <label for="foto">Foto de Perfil</label>
                <input type="file" name="foto" accept="image/*">
                <small>(Opcional)</small>
            </div>
            
            <div class="form-row">
                <label for="nacimiento">Fecha de Nacimiento</label>
                <input type="date" name="nacimiento" required>
            </div>

            
            <div class="form-row">
                <button type="submit">Enviar</button>
            </div>
        </div>
    </form>
</body>
</html>