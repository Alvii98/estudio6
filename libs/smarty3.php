<?php
require_once __DIR__ .'/smarty3/Smarty.class.php';
session_start();
$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates/tmp');
$smarty->setCacheDir('templates/tmp');

$smarty->clearAllCache();

$smarty->assign("NO_CACHE", rand(1, 1000000));

if (isset($_SESSION['USUARIO'])) $smarty->assign("LOGOUT", true);
else $smarty->assign("LOGOUT", false);