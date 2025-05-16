<?php
require_once __DIR__.'/../clases/consultas.php';

$json = new StdClass();

$json->resp = '';
$json->error = '';

if (!empty($_POST['id_registro'])) {    
    $resp = datos::eliminar_registro($_POST['id_registro']);
    if ($resp) {
        $json->resp = 'Eliminado correctamente';
    }else {
        $json->error = 'Ocurrio un error inesperado, vuelva a intentar.';
    }
}elseif (!empty($_POST['id_agente'])) {
    $resp = datos::eliminar_agente($_POST['id_agente']);
    if ($resp) {
        $json->resp = 'Eliminado correctamente';
    }else {
        $json->error = 'Ocurrio un error inesperado, vuelva a intentar.';
    }
}else {
    $json->error = 'No llegaron los parametros, vuelva a intentar.';
}

print json_encode($json);

?>