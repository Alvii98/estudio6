<?php
require_once '../clases/consultas.php';

$json = new StdClass();

$json->datos = '';
$json->error = '';

if (!empty($_POST['fecha_inicio']) && !empty($_POST['fecha_final'])) {
    $datos = array();
    foreach (datos::busqueda_registros($_POST['fecha_inicio'],$_POST['fecha_final']) as $value) {
        
        $datos[] = ['id' => $value['id'],
                    'agente' => $value['agente'],
                    'cruce' => $value['cruce'],
                    'fecha' =>$value['fecha'],
                    'lugar' => $value['lugar']];
    }
    $json->datos = $datos;
}else {
    $json->error = 'Complete las fechas y vuelva a intentar.';
}


print json_encode($json);

?>