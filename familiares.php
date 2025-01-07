<?php
require_once __DIR__.'/libs/smarty3.php';
require_once __DIR__.'/clases/consultas.php';

if(!isset($_GET['id'])) header('Location: index.php');

$smarty->assign('ID', $_GET['id']);
$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));

$smarty->display('index.html');
?>