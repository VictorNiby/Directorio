<?php
/**
 * Sube imagenes al proyecto, especificamente a la carpeta publico/img/servicios
 * @param string $file Nombre del campo del formulario que guarda las imágenes.
 * @return string Retorna el nombre del archivo subido.
 */
function uploadImage(String $file){
    $fileName = $_FILES[$file]["name"];
    //nombre custom para que no se repitan
    //consiste en: hora actual + '-' + Nombre original del archivo + '.' + extension
    $customName = time()."-".explode(".",$fileName)[0].".".pathinfo($_FILES[$file]['name'],PATHINFO_EXTENSION);

    $folderPath = realpath(__DIR__ . '/../../publico/img/servicios');

    $imageExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
    
    
    $allowedExt = ["jpg","png","jpeg"];
    if (!in_array($imageExt,$allowedExt)) {
        echo "Extensión de imagen no permitida (solo jpg, png, jpeg)";
        die();
    }

    $url = $folderPath."/".$customName;
    if (!move_uploaded_file($_FILES[$file]["tmp_name"],$url)) {
        echo "No se pudo subir la imágen";
        die();
    }

    return $customName;
}
