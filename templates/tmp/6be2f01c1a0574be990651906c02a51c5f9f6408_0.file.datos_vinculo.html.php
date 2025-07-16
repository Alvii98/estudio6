<?php
/* Smarty version 3.1.34-dev-7, created on 2025-07-16 17:20:47
  from 'C:\xampp\htdocs\estudio6\templates\datos_vinculo.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6877c34fdb9c41_88538924',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6be2f01c1a0574be990651906c02a51c5f9f6408' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\datos_vinculo.html',
      1 => 1752679245,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6877c34fdb9c41_88538924 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinculo familiar</title>
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
    <!-- JS PARA LOGIN -->
    <?php echo '<script'; ?>
 src="js/login.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
> 
    <?php echo '<script'; ?>
 src="js/ajax_editar_datos.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/foto_perfil.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
>
    <!-- ESTILOS PARA LOGIN -->
    <link rel="stylesheet" href="css/camara.css?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
">
    <link rel="stylesheet" href="css/estilo.css?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
">
</head>
<body>
    <?php echo $_smarty_tpl->tpl_vars['HEADER']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['CAMARA']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['MODAL_DEUDAS']->value;?>

    <input type="hidden" id="detalle_cuota" value="<?php echo $_smarty_tpl->tpl_vars['DETALLE_CUOTA']->value;?>
">

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <h3>Vinculo familiar</h3>
            </div>
        </div>
    </div>
    <div class="container border border-color rounded mb-4">
        <div class="row">
            <div class="col-md-12 mt-3 pr-5">
                <div class="form-group float-left">
                    <a class="btn btn-dark btn-lg rounded-pill" href="javascript:history.back()">Volver</a>
                </div>
                <div class="form-group float-right">
                    <i class="bi bi-copy" onclick="copiar_texto('deudas_vinculo','afavor_vinculo')" style="font-size: xx-large;"></i>
                    <!-- <a class="btn btn-dark btn-lg rounded-pill" >Detalle de cuota</a> -->
                </div>
                <div class="form-group float-right mr-4">
                    <div class="form-check">
                        <i class="bi bi-calendar-x" role="button" onclick="document.querySelector('#deudas_vinculo').style.display = 'block'" style="font-size: xx-large;"></i>
                        <i class="bi bi-calendar-check ml-3" role="button" onclick="document.querySelector('#afavor_vinculo').style.display = 'block'" style="font-size: xx-large;"></i>
                    </div>
                </div>
                <input type="hidden" id="nombre_vinculo" value="<?php echo $_smarty_tpl->tpl_vars['VINCULO']->value;?>
">
                <div class="form-group col-md-12 d-flex justify-content-center">
                    <div class="float-left">
                        <label>A pagar</label>
                        <input type="text" readonly="true" id="valor" class="form-control col-md-6 text-center f-10" value="$<?php echo number_format($_smarty_tpl->tpl_vars['VALOR']->value,0,",",".");?>
">
                    </div>
                    <div class="ml-3 float-left">
                        <label>Combo</label>
                        <input type="text" readonly="true" id="combo" class="form-control col-md-6 text-center f-10" value="$<?php echo number_format($_smarty_tpl->tpl_vars['COMBO']->value,0,",",".");?>
">
                    </div>
                    <div class="ml-3 float-left">
                        <label>Con recargo</label>
                        <input type="text" id="recargo" readonly="true" class="form-control col-md-6 text-center f-10" value="$<?php echo number_format($_smarty_tpl->tpl_vars['RECARGO']->value,0,",",".");?>
">
                    </div>
                </div>
                <div class="form-group col-md-12 d-flex justify-content-center">
                    <div class="float-left">
                        <label>Adeuda</label>
                        <input type="text" id="adeuda" readonly="true" class="form-control col-md-6 text-center f-10" value="$<?php echo number_format($_smarty_tpl->tpl_vars['ADEUDA']->value,0,",",".");?>
">
                    </div>
                    <div class="ml-3 float-left">
                        <label>Saldo a favor</label>
                        <input type="text" id="afavor" readonly="true" class="form-control col-md-6 text-center f-10" value="$<?php echo number_format($_smarty_tpl->tpl_vars['AFAVOR']->value,0,",",".");?>
">
                    </div>
                </div>
            </div>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALUMNOS']->value, 'value1');
$_smarty_tpl->tpl_vars['value1']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value1']->value) {
$_smarty_tpl->tpl_vars['value1']->do_else = false;
?>
                <div class="col-md-12">
                    <div class="form-group col-md-6 float-left">
                        <label>Apellido</label>
                        <input type="text" readonly="true" id="apellido" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['value1']->value['apellido'];?>
">
                    </div>
                    <div class="form-group col-md-6 float-left">
                        <label>Nombre</label>
                        <input type="text" readonly="true" id="nombre" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['value1']->value['nombre'];?>
">
                    </div>
                </div>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['value1']->value['actividad'], 'value2', false, 'key');
$_smarty_tpl->tpl_vars['value2']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value2']->value) {
$_smarty_tpl->tpl_vars['value2']->do_else = false;
?>
                    <div class="col-md-12">
                        <div class="form-group col-md-12 float-left">
                            <label>Actividad <?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
</label>
                            <input type="text" class="form-control" readonly="true" id="actividad" value="<?php echo $_smarty_tpl->tpl_vars['value2']->value['actividad'];?>
"</input>        
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <div class="col-md-12">
                    <hr>
                </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['FOOTER']->value;?>

</body>
</html><?php }
}
