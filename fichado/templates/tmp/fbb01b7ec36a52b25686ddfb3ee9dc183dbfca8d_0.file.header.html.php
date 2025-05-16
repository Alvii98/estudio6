<?php
/* Smarty version 3.1.34-dev-7, created on 2025-05-17 00:15:39
  from 'C:\xampp\htdocs\estudio6\fichado\templates\partials\header.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6827b90bad8b44_72040492',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fbb01b7ec36a52b25686ddfb3ee9dc183dbfca8d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\fichado\\templates\\partials\\header.html',
      1 => 1747417941,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6827b90bad8b44_72040492 (Smarty_Internal_Template $_smarty_tpl) {
?><header class="container-fluid border-bottom border-color p-3">
    <div class="row">
        <div class="col-md-12">
            <?php if ($_smarty_tpl->tpl_vars['LOGIN']->value) {?><i class="bi bi-menu-button-wide float-left" onclick="openNav()" style="font-size: xx-large;" role="button"></i><?php }?>
            <img src="img/logo.png" role="button" class="logo" onclick="location.href='./'">
        </div>
    </div>
</header>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="index.php">Inicio</a>
    <a href="registrar.php">Registrar agente</a>
    <a href="cargas.php">Carga diferida</a>
    <a href="#" onclick="iniciar_sesion(true)">Cerrar sesión</a>
</div>
<?php }
}
