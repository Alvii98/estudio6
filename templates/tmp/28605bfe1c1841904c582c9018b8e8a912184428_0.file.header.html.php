<?php
/* Smarty version 3.1.34-dev-7, created on 2025-01-10 20:09:23
  from 'C:\xampp\htdocs\estudio6\templates\partials\header.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_67817063137923_87652533',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '28605bfe1c1841904c582c9018b8e8a912184428' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\partials\\header.html',
      1 => 1736518075,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67817063137923_87652533 (Smarty_Internal_Template $_smarty_tpl) {
?><header class="container-fluid border-bottom border-color p-3">
    <img src="img/logo-Negro.png" role="button" class="logo" onclick="location.href='index.php'" width="350px" height="80px">
    <?php if ($_smarty_tpl->tpl_vars['LOGOUT']->value) {?><i class="bi bi-door-closed cerrar_sesion" role="button" onclick="iniciar_sesion(true)"></i><?php }?>
</header><?php }
}
