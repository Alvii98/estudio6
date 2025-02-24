<?php
require_once __DIR__.'/../clases/consultas.php';

$json = new StdClass();

$json->resp = '';
$json->error = '';

if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['documento'])) {
    
    $foto = isset($_FILES['foto']) ? file_get_contents($_FILES['foto']['tmp_name']) : '';

    $resp = datos::cargar_agente($_POST['apellido'].' '.$_POST['nombre'],$_POST['documento'],$foto);
    if ($resp) {
        $json->resp = 'Registrado correctamente';
    }else {
        $json->error = 'Ocurrio un error inesperado, vuelva a intentar.';
    }
}else {
    $json->error = 'Complete todos los campos y vuelva a intentar.';
}

print json_encode($json);

?>