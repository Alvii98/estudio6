<?php
$json = new StdClass();
$json->resp = '';
$json->error = '';
if (isset($_POST['contenido'])) {
    $contenido = $_POST['contenido'];
    $nombreArchivo = 'notas.txt';
    if (file_put_contents($nombreArchivo, $contenido)) {
        $json->resp = 'Guardado correctamente.';
    }else {
        $json->error = 'Ocurrio un error al guardar.';
    }

}else {
    $json->error = 'No llego el parametro.';
}
print json_encode($json);

?>
