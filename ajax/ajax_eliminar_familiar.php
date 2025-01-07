<?php
require_once '../clases/consultas.php';

$json = new StdClass();

$eliminar = datos::delete_familiar(trim($_POST['id']));

$json->resp = $eliminar ;

print json_encode($json);

?>