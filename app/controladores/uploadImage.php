<?php
/**
 * Sube imagenes al proyecto, especificamente a la carpeta publico/img/servicios
 * @param string $file Nombre del campo del formulario que guarda las imágenes.
 * @param string $type Representa que tipo de imágen se está subiendo ('service' para un servicio, 'user' para una pfp).
 * @return string Retorna el nombre del archivo subido.
 */
function uploadImage(String $file, String $type){
    $fileName = $_FILES[$file]["name"];
    //nombre custom para que no se repitan
    //consiste en: hora actual + '-' + Nombre original del archivo + '.' + extension
    $customName = time()."-".explode(".",$fileName)[0].".".pathinfo($_FILES[$file]['name'],PATHINFO_EXTENSION);

    $folderPath = "";

    switch ($type) {
        case 'user':
            $folderPath = realpath(__DIR__ . '/../../publico/img/usuarios');
            break;
        
        case 'service':
            $folderPath = realpath(__DIR__ . '/../../publico/img/servicios');
            break;
        
        default:
            $folderPath = realpath(__DIR__ . '/../../publico/img');
            break;
    }

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

function UploadServiceGallery(String $inputFileName){
    $imagenRefs = [];
    $response = [];

    $count = count($_FILES[$inputFileName]['name']);

    for ($index=0; $index < $count; $index++) {
        $fileName = $_FILES[$inputFileName]["name"][$index];

        //nombre custom para que no se repitan
        //consiste en: hora actual + '-' + Nombre original del archivo + '.' + extension
        $customName = time()."-".explode(".",$fileName)[0].".".pathinfo($_FILES[$inputFileName]['name'][$index],PATHINFO_EXTENSION);

        $folderPath = realpath(__DIR__ . '/../../publico/img/servicios');

        $imageExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
        
        $allowedExt = ["jpg","png","jpeg"];
        
        if (!in_array($imageExt,$allowedExt)) {
            return $response = ["status"=>false,"msg"=>"Extensión de imagen no permitida (solo jpg, png, jpeg)."];
        }

        $url = $folderPath."/".$customName;
        if (!move_uploaded_file($_FILES[$inputFileName]["tmp_name"][$index],$url)) {
            return $response = ["status"=>false,"msg"=>"No se pudo subir la imágen."];
        }

        $imagenRefs[] = $customName;
    }
    

    $response = ["status"=>true,"data"=>$imagenRefs];
    return $response;
}
