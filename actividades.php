<?php
require_once __DIR__.'/libs/smarty3.php';
require_once __DIR__.'/clases/consultas.php';

$smarty->assign('ACTIVIDADES', datos::actividades());
$smarty->assign('DESCUENTO_ACT', isset(datos::administracion()[0]['descuento']) ? datos::administracion()[0]['descuento'] : 0);

$smarty->assign('CAMARA', $smarty->fetch('partials/camara.html'));
$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));
$smarty->assign('MODAL_ACTIVIDAD', $smarty->fetch('partials/modal.html'));

if (!isset($_SESSION['USUARIO'])) {
    $smarty->display('login.html');
}else {
    $smarty->display('actividades.html');
}
?>