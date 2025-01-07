<?php
require_once '../clases/consultas.php';

$json = new StdClass();

$datos = datos::alumnos();

$datosFam = datos::familiares();

$json->resp = $datos;
$json->resp2 = $datosFam;

print json_encode($json);

?>