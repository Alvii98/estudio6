<?php
require_once __DIR__.'/../libs/smarty3.php';
require_once __DIR__.'/clases/consultas.php';

if (isset($_SESSION['FICHADOR'])) $smarty->assign("LOGIN", true);
else $smarty->assign("LOGIN", false);

$smarty->assign('HORARIOS', datos::horarios());
$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));

if (isset($_SESSION['FICHADOR'])) $smarty->display('horarios.html');
else $smarty->display('login.html');
?>