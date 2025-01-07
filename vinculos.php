<?php
require_once __DIR__.'/libs/smarty3.php';
require_once __DIR__.'/clases/consultas.php';

$smarty->assign('ALUMNOS', datos::alumnos());
$smarty->assign('VINCULOS', datos::vinculos());
$smarty->assign('CAMARA', $smarty->fetch('partials/camara.html'));
$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));

$smarty->display('vinculos.html');
?>