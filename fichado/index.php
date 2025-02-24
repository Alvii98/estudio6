<?php
require_once __DIR__.'/../libs/smarty3.php';
require_once __DIR__.'/clases/consultas.php';

$smarty->assign('AGENTES', datos::agente());
$smarty->assign('REGISTROS', datos::registros());

$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));

$smarty->display('index.html');

?>