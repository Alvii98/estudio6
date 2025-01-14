<?php
/* Smarty version 3.1.34-dev-7, created on 2025-01-13 19:59:18
  from 'C:\xampp\htdocs\estudio6\templates\vinculos.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6785628601f800_64339272',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bae6e2598e96103b9d98a4352a3bb992427b5587' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\vinculos.html',
      1 => 1736529135,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6785628601f800_64339272 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\estudio6\\libs\\smarty3\\plugins\\modifier.escape.php','function'=>'smarty_modifier_escape',),));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar vinculo</title>
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
    <!-- JS PARA guardar_datos -->
    <?php echo '<script'; ?>
 src="js/login.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
> 
    <?php echo '<script'; ?>
 src="js/ajax_guardar_datos.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
>
    <!-- ESTILOS PARA LOGIN -->
    <link rel="stylesheet" href="css/estilo.css?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
">
</head>
<body>
    <?php echo $_smarty_tpl->tpl_vars['HEADER']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['CAMARA']->value;?>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <h3>Cargar vinculo</h3>
                <label>(Seleccione alumno y seleccione el vinculo familiar o en caso de que no est&eacute;, escriba el nombre del grupo familiar.)</label>
            </div>
        </div>
    </div>
    <div class="container border border-color rounded mb-4">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="form-group float-left">
                    <a class="btn btn-dark btn-lg rounded-pill" href="index.php">Volver</a>
                </div>

            </div>
            <div class="col-md-12">
                <div class="form-group col-md-6 float-left">
                    <label class="ml-2">Vinculo familiar (*)</label>
                    <select class="form-control ml-2" id="nom_vinculo">
                        <option selected value="0">-- Seleccione el vinculo --</option>
                        <?php $_smarty_tpl->_assignInScope('vinculo', '');?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['VINCULOS']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                            <?php if ($_smarty_tpl->tpl_vars['vinculo']->value == $_smarty_tpl->tpl_vars['value']->value['vinculo']) {?>
                                <?php continue 1;?>
                            <?php }?>
                            <?php $_smarty_tpl->_assignInScope('vinculo', $_smarty_tpl->tpl_vars['value']->value['vinculo']);?>
                            <option value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['vinculo'], 'utf8_encode');?>
">
                                <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['vinculo'], 'utf8_encode');?>

                            </option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
                <div class="form-group col-md-6 float-left">
                    <label class="ml-2">Alumno/a (*)</label>
                    <select class="form-control ml-2" id="id_alumno">
                        <option selected value="0">-- Seleccione un alumno/a --</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALUMNOS']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">
                            <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['apellido'], 'utf8_encode');?>
 <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['nombre'], 'utf8_encode');?>

                        </option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <div class="form-group col-md-6">
                    <label class="ml-2">Nombre del grupo familiar (*)</label>
                    <input type="text" id="nom_vinculo_nuevo" placeholder="Apellidos de alumnos" class="form-control">
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-center mt-2">
                <div class="form-group col-md-12">
                    <button id="guardar_vinculo" class="btn btn-dark btn-lg rounded-pill float-right col-md-2 mt-2">Guardar vinculo</button>
                    <button id="desvincular" class="btn btn-dark btn-lg rounded-pill float-right col-md-3 mt-2">Desvincular alumno</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo '<?php ';?>
include('partials\footer_temp.php');<?php echo '?>';?>

</body>
</html><?php }
}
