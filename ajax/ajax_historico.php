<?php
require_once '../clases/consultas.php';
$json = new StdClass();
$json->datos = '';
$json->error = '';

if ($_POST['tipo'] == 'archivar') {
    if (empty(datos::archivados($_POST['anio']))) {
        if (datos::archivar_alumnos($_POST['anio'])){
            $json->datos = 'Guardado correctamente';
        }else {
            $json->error = 'Ocurrio un error al guardar los datos.';
        }
    }else {
        $json->error = 'Ya existe el archivo '.$_POST['anio'].'.';
    }
}else {
    $json->error = 'Faltan parametros.';
}


print json_encode($json);
?>