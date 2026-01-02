<?php
require_once __DIR__.'/libs/smarty3.php';
require_once __DIR__.'/clases/consultas.php';

$smarty->assign('ACTIVIDADES', datos::actividades());
$smarty->assign('INSCRIPCION_OP', datos::administracion()[0]['inscripciones']);
$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));

$smarty->display('inscripciones.html');

?>