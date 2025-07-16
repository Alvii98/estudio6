<?php
require_once '../clases/consultas.php';
$json = new StdClass();
$json->resp = '';
$json->erro = '';

$datos = json_decode(file_get_contents('php://input'));

if (isset($datos->afavor_alumno) && isset($datos->id_alumno)) {

    $array = ['enero' => $datos->afavor_alumno->enero,
        'febrero' => $datos->afavor_alumno->febrero,
        'marzo' => $datos->afavor_alumno->marzo,
        'abril' => $datos->afavor_alumno->abril,
        'mayo' => $datos->afavor_alumno->mayo,
        'junio' => $datos->afavor_alumno->junio,
        'julio' => $datos->afavor_alumno->julio,
        'agosto' => $datos->afavor_alumno->agosto,
        'septiembre' => $datos->afavor_alumno->septiembre,
        'octubre' => $datos->afavor_alumno->octubre,
        'noviembre' => $datos->afavor_alumno->noviembre,
        'diciembre' => $datos->afavor_alumno->diciembre];

    if (empty(datos::afavor_alumno($datos->id_alumno))) {
        $json->resp = datos::insert_afavor_alumno($datos->id_alumno,$array);
    }else {
        $json->resp = datos::update_afavor_alumno($datos->id_alumno,$array);
    }
}else if (isset($datos->afavor_vinculo) && isset($datos->vinculo)) {

    $array = ['enero' => $datos->afavor_vinculo->enero,
        'febrero' => $datos->afavor_vinculo->febrero,
        'marzo' => $datos->afavor_vinculo->marzo,
        'abril' => $datos->afavor_vinculo->abril,
        'mayo' => $datos->afavor_vinculo->mayo,
        'junio' => $datos->afavor_vinculo->junio,
        'julio' => $datos->afavor_vinculo->julio,
        'agosto' => $datos->afavor_vinculo->agosto,
        'septiembre' => $datos->afavor_vinculo->septiembre,
        'octubre' => $datos->afavor_vinculo->octubre,
        'noviembre' => $datos->afavor_vinculo->noviembre,
        'diciembre' => $datos->afavor_vinculo->diciembre];

    if (empty(datos::afavor_vinculo($datos->vinculo))) {
        $json->resp = datos::insert_afavor_vinculo($datos->vinculo,$array);
    }else {
        $json->resp = datos::update_afavor_vinculo($datos->vinculo,$array);
    }
}


print json_encode($json);
?>