<?php
/* Smarty version 3.1.34-dev-7, created on 2025-01-21 16:04:08
  from 'C:\xampp\htdocs\estudio6\templates\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_678fb76897fcf8_18798291',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '93a80a132461c145b652dd9815556fc6a82093ca' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\index.html',
      1 => 1737467136,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_678fb76897fcf8_18798291 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\estudio6\\libs\\smarty3\\plugins\\modifier.escape.php','function'=>'smarty_modifier_escape',),));
?>
<!DOCTYPE html>
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
   <?php echo '<script'; ?>
 src="js/ajax_busqueda.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
> 
   <?php echo '<script'; ?>
 src="js/excel.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
> 
   <?php echo '<script'; ?>
 src="js/exportar_excel.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
> 
    <!-- ESTILOS -->
    <link rel="stylesheet" href="css/estilo.css?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
">
</head>
<body>
    <?php echo $_smarty_tpl->tpl_vars['HEADER']->value;?>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <h3>Buscar alumno/a</h3>
            </div>
        </div>
    </div>
    <div class="container border border-color rounded mb-4 text-body">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="col-md-3 boton-cargar" role="button" onclick="location.href='cargas.php'">Cargar alumno</div>
                <div class="col-md-3 boton-cargar" role="button" onclick="location.href='vinculos.php'">Vinculos familiares</div>
                <div class="col-md-3 boton-cargar" role="button" onclick="location.href='actividades.php'">Actividades</div>
                <i class="bi bi-file-earmark-spreadsheet-fill float-right h2" onclick="exportarExcel('alumnos')" id="exportar_excel"
                style="position:absolute;top:4%;right:5%;"></i>
            </div>
            <div class="col-md-10 d-flex justify-content-center param-busqueda">
                <input type="text" id="apellido" placeholder="Apellido" class="form-control ml-2 col-md-3 mt-3">
                <input type="text" id="nombre" placeholder="Nombre" class="form-control ml-2 col-md-3 mt-3">
                <input type="text" id="edad" placeholder="Edad" class="form-control ml-2 col-md-3 mt-3">
                <select class="form-control ml-2 col-md-3 mt-3" id="actividad">
                    <option selected value="0">-- Seleccione una actividad --</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACTIVIDADES']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">
                            <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['actividad'], 'utf8_encode');?>
 - <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['dias_horarios'], 'utf8_encode');?>

                        </option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
                <!-- <input list="actividades" id="actividad" placeholder="Actividad" class="form-control ml-2 col-md-3">
                <datalist id="actividades">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACTIVIDADES']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value['actividad'];?>
">
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </datalist> -->
            </div>
            <div class="col-md-12 text-center">
                <label id="cant_res"></label>
                <div class="scroll mb-3">
                    <table class="table table-bordered text-body" id="tabla_alumnos">
                        <thead align="center">
                            <tr>
                                <th>Apellido</th>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Actividad</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['FOOTER']->value;?>

</body>
</html><?php }
}
