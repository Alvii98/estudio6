<?php
/* Smarty version 3.1.34-dev-7, created on 2025-06-25 20:29:16
  from 'C:\xampp\htdocs\estudio6\templates\login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_685c3ffca9dc62_35652997',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cae5852df8dd6d36dd980fee42c58b56b34a6ddf' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\login.html',
      1 => 1746536370,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_685c3ffca9dc62_35652997 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
	<link rel="icon" href="img/logo.png" type="image/x-icon">
    <!-- BOOTSTRAP 4.6 -->
    <!-- <link rel="stylesheet" href="libs/bootstrap-4.6.1/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="libs/bootstrap-icons/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- JQUERY -->
    <?php echo '<script'; ?>
 src="libs/jquery-3.5.1.min.js"><?php echo '</script'; ?>
>
    <!-- ALERTIFY -->
	<link rel="stylesheet" href="libs/alertifyjs/css/alertify.min.css" />
	<link rel="stylesheet" href="libs/alertifyjs/css/themes/default.min.css" />
	<?php echo '<script'; ?>
 src="libs/alertifyjs/alertify.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="libs/alertifyjs/settings.js"><?php echo '</script'; ?>
>
    <!-- JS -->
    <?php echo '<script'; ?>
 src="js/login.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
> 
    <!-- ESTILOS -->
    <link rel="stylesheet" href="css/estilo.css?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
">
</head>
<body>
    <?php echo $_smarty_tpl->tpl_vars['HEADER']->value;?>

    <div class="container">
        <div class="row d-flex justify-content-center mt-3 mb-3">
            <div class="col-md-6 border border-color rounded pb-3" style="margin: 10px;box-shadow: 2px 3px 12px black;">
                <div class="form-group d-flex flex-column align-items-center">
                    <i class="bi bi-person-circle" style="font-size:80px;"></i>
                    <h4>Iniciar sesi&oacute;n</h4>
                </div>
                <div class="form-group d-flex flex-column align-items-center">
                    <input type="text" class="form-control" id="usuario" placeholder="Ingresa tu usuario">
                </div>
                <div class="form-group d-flex flex-column align-items-center">
                    <input type="password" class="form-control" id="clave" placeholder="Ingresa tu clave">
                </div>
                <p class="text-center" id="resp_login"></p>
                <div class="form-group d-flex justify-content-center">
                    <button onclick="iniciar_sesion()" class="btn btn-dark btn-lg rounded-pill col-md-5">Ingresar</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['FOOTER']->value;?>

</body>
</html><?php }
}
