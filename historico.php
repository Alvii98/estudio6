<?php
require_once __DIR__.'/libs/smarty3.php';
require_once __DIR__.'/clases/consultas.php';

$smarty->assign('ALUMNOS', datos::busqueda_historico());
$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));

// CREATE TABLE nueva_tabla LIKE tabla_original;INSERT INTO nueva_tabla SELECT * FROM tabla_original;

if (!isset($_SESSION['USUARIO'])) {
    $smarty->display('login.html');
}else {
    $smarty->display('historico.html');
}
?>