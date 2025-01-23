<?php
require_once '../clases/consultas.php';
$json = new StdClass();
$json->resp = '';
$json->error = '';
$pathFile = '';
if(!empty($_POST['foto_perfil']) && !empty($_POST['id_alumno'])){
    $img = $_POST['foto_perfil'];
    if(strpos($img, 'data:image/png;base64,') !== FALSE){
        $img = str_replace('data:image/png;base64,', '', $img);
    }elseif (strpos($img, 'data:image/jpg;base64,') !== FALSE) {
        $img = str_replace('data:image/jpg;base64,', '', $img);
    }elseif (strpos($img, 'data:image/jpeg;base64,') !== FALSE) {
        $img = str_replace('data:image/jpeg;base64,', '', $img);
    }else{
        exit;
    }
    $img = str_replace(' ', '+', $img);

    $now = new DateTime();
    $fechaCompleta = $now->format('YmdHis');

    if (!file_exists('../img/perfil')) {
        mkdir('../img/perfil', 0777, true);
    }
    $pathFile = 'img/perfil/foto_'.$fechaCompleta.'.png';

    if (file_put_contents('../'.$pathFile, base64_decode($img))) {
        if (datos::update_foto($_POST['id_alumno'],$pathFile)) {
            $json->resp = 'La foto se subio correctamente.';
        }else {
            $json->error = 'Ocurrio un error al intentar registrar en la bdd.';
        }
    }else {
        $json->error = 'Ocurrio un error al intentar subir la foto.';
    }
}

print json_encode($json);
