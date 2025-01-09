<?php
require_once __DIR__.'/libs/smarty3.php';
require_once __DIR__.'/clases/consultas.php';

$smarty->assign('ACTIVIDADES', datos::actividades());
$smarty->assign('DESCUENTO_ACT', datos::descuentos_actividades()[0]['descuento_actividad']);
$smarty->assign('DESCUENTO_FAM', datos::descuentos_actividades()[0]['descuento_familiar']);

$smarty->assign('CAMARA', $smarty->fetch('partials/camara.html'));
$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));

if (!isset($_SESSION['USUARIO'])) {
    $smarty->display('login.html');
}else {
    $smarty->display('actividades.html');
}
?>