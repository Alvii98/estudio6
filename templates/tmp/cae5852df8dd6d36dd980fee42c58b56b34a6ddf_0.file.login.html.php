<?php
/* Smarty version 3.1.34-dev-7, created on 2025-02-11 16:10:08
  from 'C:\xampp\htdocs\estudio6\templates\login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_67ab68508a1e58_59696565',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cae5852df8dd6d36dd980fee42c58b56b34a6ddf' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\login.html',
      1 => 1737460619,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67ab68508a1e58_59696565 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda</title>
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

    <div class="container border border-color rounded mb-4 mt-4 text-body">
        <div class="row d-flex justify-content-center p-5 mb-4 mt-4">
            <!-- <div class="modal-overlay"></div>
            <div id="login" class="modal-login">
                <div class="modal-dialog" role="document">
                    <div class="modal-content"> -->
            <div class="col-md-12">
                <div class="col-md-12 d-flex justify-content-center">
                    <h4>Iniciar sesi&oacute;n</h4>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="Usuario">Usuario</label>
                            <input type="text" id="usuario" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="Contraseña">Contrase&ntilde;a</label>
                            <input type="password" id="clave" class="form-control">
                            <label id="resp_login"></label>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center mb-3">
                        <button onclick="iniciar_sesion()" class="btn btn-dark btn-lg rounded-pill col-md-5">Ingresar</button>
                    </div>
                </div>
                        <!-- <div class="modal-footer"></div>
                    </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['FOOTER']->value;?>

</body>
</html><?php }
}
