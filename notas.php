<?php
require_once __DIR__.'/libs/smarty3.php';
$contenido = file_get_contents('ajax/notas.txt');
// print$contenido;exit;
$smarty->assign('NOTAS', $contenido);
$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));

if (!isset($_SESSION['USUARIO'])) {
    $smarty->display('login.html');
}else {
    $smarty->display('notas.html');
}