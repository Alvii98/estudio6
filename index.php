<?php
require_once __DIR__.'/libs/smarty3.php';
require_once __DIR__.'/clases/consultas.php';

$smarty->assign('ACTIVIDADES', datos::actividades());
// $smarty->assign('DEUDAS_TOTALES', datos::deudas_totales());
$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));

if (!isset($_SESSION['USUARIO'])) {
    $smarty->display('login.html');
}else {
    $smarty->display('index.html');
}
?>