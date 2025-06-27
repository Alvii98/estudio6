<?php
require_once __DIR__.'/../clases/consultas.php';

$json = new StdClass();

$json->resp = '';
$json->error = '';

if (!empty($_POST['id_registro'])) {    
    if (datos::eliminar_registro($_POST['id_registro'])) {
        $json->resp = 'Eliminado correctamente';
    }else {
        $json->error = 'Ocurrio un error inesperado, vuelva a intentar.';
    }
}elseif (!empty($_POST['id_agente'])) {
    if (datos::eliminar_agente($_POST['id_agente'])) {
        $json->resp = 'Eliminado correctamente';
    }else {
        $json->error = 'Ocurrio un error inesperado, vuelva a intentar.';
    }
}elseif (isset($_POST['id_eliminar'])) {
    if (datos::eliminar_horario($_POST['id_eliminar'])) {
        $json->resp = 'Eliminadi correctamente.';
    }else {
        $json->error = 'Ocurrio un error inesperado, vuelva a intentar.';
    }    
}else {
    $json->error = 'No llegaron los parametros, vuelva a intentar.';
}

print json_encode($json);

?>