<?php
require_once __DIR__.'/libs/smarty3.php';
require_once __DIR__.'/clases/consultas.php';

$smarty->assign('ALUMNOS', datos::busqueda_historico());
$smarty->assign('CANTIDAD', datos::busqueda_historico()[0]['cantidad']);
$smarty->assign('BAJAS', datos::busqueda_historico()[0]['bajas']);
$smarty->assign('SOLOHISTORICA', datos::busqueda_historico()[0]['solohistorico']);
$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));
try {
    if(datos::actualizar_historico()) $smarty->assign('ACTUALIZAR', true);
    else $smarty->assign('ACTUALIZAR', false);
} catch (\Throwable $th) {
    $smarty->assign('ACTUALIZAR', false);
}
// CREATE TABLE nueva_tabla LIKE tabla_original;INSERT INTO nueva_tabla SELECT * FROM tabla_original;

if (!isset($_SESSION['USUARIO'])) {
    $smarty->display('login.html');
}else {
    $smarty->display('historico.html');
}
?>