<?php
require_once '../clases/consultas.php';
$json = new StdClass();
$json->resp = '';
$json->erro = '';

$datos = json_decode(file_get_contents('php://input'));

if (isset($datos->deudas_alumno) && isset($datos->id_alumno)) {

    $array = ['enero' => $datos->deudas_alumno->enero,
        'febrero' => $datos->deudas_alumno->febrero,
        'marzo' => $datos->deudas_alumno->marzo,
        'abril' => $datos->deudas_alumno->abril,
        'mayo' => $datos->deudas_alumno->mayo,
        'junio' => $datos->deudas_alumno->junio,
        'julio' => $datos->deudas_alumno->julio,
        'agosto' => $datos->deudas_alumno->agosto,
        'septiembre' => $datos->deudas_alumno->septiembre,
        'octubre' => $datos->deudas_alumno->octubre,
        'noviembre' => $datos->deudas_alumno->noviembre,
        'diciembre' => $datos->deudas_alumno->diciembre];

    if (empty(datos::deudas_alumno($datos->id_alumno))) {
        $json->resp = datos::insert_deudas_alumno($datos->id_alumno,$array);
    }else {
        $json->resp = datos::update_deudas_alumno($datos->id_alumno,$array);
    }
}else if (isset($datos->deudas_vinculo) && isset($datos->vinculo)) {

    $array = ['enero' => $datos->deudas_vinculo->enero,
        'febrero' => $datos->deudas_vinculo->febrero,
        'marzo' => $datos->deudas_vinculo->marzo,
        'abril' => $datos->deudas_vinculo->abril,
        'mayo' => $datos->deudas_vinculo->mayo,
        'junio' => $datos->deudas_vinculo->junio,
        'julio' => $datos->deudas_vinculo->julio,
        'agosto' => $datos->deudas_vinculo->agosto,
        'septiembre' => $datos->deudas_vinculo->septiembre,
        'octubre' => $datos->deudas_vinculo->octubre,
        'noviembre' => $datos->deudas_vinculo->noviembre,
        'diciembre' => $datos->deudas_vinculo->diciembre];

    if (empty(datos::deudas_vinculo($datos->vinculo))) {
        $json->resp = datos::insert_deudas_vinculo($datos->vinculo,$array);
    }else {
        $json->resp = datos::update_deudas_vinculo($datos->vinculo,$array);
    }
}


print json_encode($json);
?>