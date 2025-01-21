<?php
/* Smarty version 3.1.34-dev-7, created on 2025-01-21 19:32:33
  from 'C:\xampp\htdocs\estudio6\templates\partials\header.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_678fe8410c5729_19452104',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '28605bfe1c1841904c582c9018b8e8a912184428' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\partials\\header.html',
      1 => 1736975009,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_678fe8410c5729_19452104 (Smarty_Internal_Template $_smarty_tpl) {
?><header class="container-fluid border-bottom border-color p-3">
    <?php if ($_smarty_tpl->tpl_vars['LOGOUT']->value) {?><i class="bi bi-menu-button-wide" onclick="openNav()" style="font-size: xx-large;" role="button"></i><?php }?>
    <img src="img/logo-Negro.png" role="button" class="logo" <?php if ($_smarty_tpl->tpl_vars['INSCRIPCIONES']->value) {?>onclick="location.href='index.php'"<?php }?> width="350px" height="80px">
    <!-- <?php if ($_smarty_tpl->tpl_vars['LOGOUT']->value) {?><i class="bi bi-door-closed cerrar_sesion" role="button" onclick="iniciar_sesion(true)"></i><?php }?> -->
</header>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="index.php">Inicio</a>
    <a href="cargas.php">Cargar alumno</a>
    <a href="vinculos.php">Vinculos familiares</a>
    <a href="actividades.php">Actividades</a>
    <a href="inscripciones.php">Inscripciones</a>
    <a href="#" onclick="iniciar_sesion(true)">Cerrar sesión</a>
</div>
<?php }
}
