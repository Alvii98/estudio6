<?php
require_once '../clases/consultas.php';
$json = new StdClass();

$datos = json_decode(file_get_contents('php://input'));

$array_insert = ['id_alumno' => $datos->familiar->id_alumno,
                'nom_ape' => $datos->familiar->nom_ape,
                'vinculo' => $datos->familiar->vinculo,
                'tel_familiar' => $datos->familiar->tel_familiar,
                'observacion_familiar' => $datos->familiar->observacion_familiar];

$json->respFamiliar = datos::insert_familiar($array_insert);

print json_encode($json);
?>