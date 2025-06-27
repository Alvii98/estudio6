<?php
/* Smarty version 3.1.34-dev-7, created on 2025-06-25 20:33:03
  from 'C:\xampp\htdocs\estudio6\fichado\templates\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_685c40df34d612_12135488',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a6f508831a347ebd997820f55cabbbaea4743fac' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\fichado\\templates\\index.html',
      1 => 1750769861,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_685c40df34d612_12135488 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\estudio6\\libs\\smarty3\\plugins\\modifier.escape.php','function'=>'smarty_modifier_escape',),1=>array('file'=>'C:\\xampp\\htdocs\\estudio6\\libs\\smarty3\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de asistencia</title>
	<link rel="icon" href="img/logotipo.png?1?1" type="image/x-icon">
    <!-- BOOTSTRAP 4.6 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- ALERTIFY -->
	<link rel="stylesheet" href="../libs/alertifyjs/css/alertify.min.css" />
	<link rel="stylesheet" href="../libs/alertifyjs/css/themes/default.min.css" />
	<?php echo '<script'; ?>
 src="../libs/alertifyjs/alertify.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="../libs/alertifyjs/settings.js"><?php echo '</script'; ?>
>
    <!-- JS -->
   <?php echo '<script'; ?>
 src="js/funciones.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
> 
   <?php echo '<script'; ?>
 src="js/buscador.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
> 
   <?php echo '<script'; ?>
 src="js/login.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
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
                <h3>Datos agentes</h3>
            </div>
        </div>
    </div>
    <div class="container border border-color rounded mb-4 text-body">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="col-md-3 boton-cargar" style="background-color: rgb(70, 70, 70);" id="bot-agentes" role="button" onclick="cambiar_datos(this)">
                Agentes</div>
                <div class="col-md-3 boton-cargar" id="bot-registros-pendientes" role="button" onclick="cambiar_datos(this)">
                Registros pendientes</div>
                <div class="col-md-3 boton-cargar" id="bot-registros" role="button" onclick="cambiar_datos(this)">
                Registros</div>
            </div>
            <div class="col-md-12">
                <i class="bi bi-file-earmark-spreadsheet-fill float-right h2 mr-5 mt-1" onclick="exportarExcel()"></i>
                <div class="col-md-12 d-flex justify-content-center" id="fechas_registros" style="display: none !important;">
                    <div class="form-group col-md-3 float-left">
                        <label for="fecha">Fecha incio</label>
                        <input type="datetime-local" id="fecha_inicio" class="form-control">
                    </div>
                    <div class="form-group col-md-3 float-left">
                        <label for="fecha">Fecha final</label>
                        <input type="datetime-local" id="fecha_final" class="form-control">
                    </div>
                    <i class="bi bi-search" onclick="busqueda_registros()" style="font-size: 34px;margin-top: 18px;"></i>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="scroll mb-3">
                    <table class="table table-bordered text-body" id="agentes">
                        <thead>
                            <tr>
                                <th colspan="15" class="text-center">
                                    <select name="columna" id="columna" class="mt-1 form-control col-md-2 mr-2 float-left">
                                        <option value="-">-- Buscar por --</option>
                                        <option value="0">Agente</option>
                                        <option value="1">Documento</option>
                                    </select>
                                    <input type="text" id="buscar" autocomplete="off" style="display:none;" placeholder="Buscar en columna" class="mt-1 form-control col-md-2 float-left">
                                </th>
                            </tr>
                            <tr>
                                <th>Agente</th>
                                <th>Documento</th>
                                <th>Foto</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="datos_agentes">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['AGENTES']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['agente'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['documento'], 'utf8_encode');?>
</td>
                                <td>
                                    <?php if (!file_exists($_smarty_tpl->tpl_vars['value']->value['foto'])) {?>
                                    <img src="img/icono.jpg" class="foto-navbar">
                                    <?php } else { ?>
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['value']->value['foto'];?>
" class="foto-navbar">
                                    <?php }?>
                                </td>
                                <th style="padding: 0px;padding-left: 25px;">
                                    <i style="font-size: xx-large;" class="bi bi-trash" onclick="eliminar(this,'<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
','agente')"></i>
                                </th>
                            </tr>
                            <?php
}
if ($_smarty_tpl->tpl_vars['value']->do_else) {
?>
                            <tr><td colspan="15" class="text-center">No encontramos agentes disponibles</td></tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <th colspan="15" id="no_datos" style="display: none;" class="text-center">No encontramos agentes disponibles</th>
                        </tbody>
                    </table>
                    <table class="table table-bordered text-body" id="registros-pendientes" style="display: none;">
                        <thead>
                            <tr>
                                <th colspan="15" class="text-center">
                                    <select name="columna" id="columna" class="mt-1 form-control col-md-2 mr-2 float-left">
                                        <option value="-">-- Buscar por --</option>
                                        <option value="0">Agente</option>
                                        <option value="2">Fecha</option>
                                        <option value="3">Lugar</option>
                                    </select>
                                    <input type="text" id="buscar" autocomplete="off" style="display:none;" placeholder="Buscar en columna" class="mt-1 form-control col-md-2 float-left">
                                </th>
                            </tr>
                            <tr>
                                <th>Agente</th>
                                <th>Cruce</th>
                                <th style="min-width: 134px;">Fecha y hora</th>
                                <th>Lugar</th>
                                <th>Observaci&oacute;n</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="datos_registros_pendientes">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['REGISTROS_PENDIENTES']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['agente'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['cruce'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['value']->value['fecha'],'%d/%m/%Y %H:%M:%S');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['lugar'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['observacion'], 'utf8_encode');?>
</td>
                                <th style="padding: 0px;padding-left: 25px;">
                                    <i style="font-size: xx-large;color: green;" onclick="aceptar(this,'<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')" class="bi bi-check-circle"></i>
                                    <i style="font-size: xx-large;color: red;" onclick="eliminar(this,'<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
','registro')" class="bi bi-x-circle"></i>
                                </th>
                            </tr>
                            <?php
}
if ($_smarty_tpl->tpl_vars['value']->do_else) {
?>
                            <tr><td colspan="15" class="text-center">No encontramos registros disponibles</td></tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <th colspan="15" id="no_datos" style="display: none;" class="text-center">No encontramos registros disponibles</th>
                        </tbody>
                    </table>
                    <table class="table table-bordered text-body" id="registros" style="display: none;">
                        <thead>
                            <tr>
                                <th colspan="15" class="text-center">
                                    <select name="columna" id="columna" class="mt-1 form-control col-md-2 mr-2 float-left">
                                        <option value="-">-- Buscar por --</option>
                                        <option value="0">Agente</option>
                                        <option value="2">Fecha</option>
                                        <option value="3">Lugar</option>
                                    </select>
                                    <input type="text" id="buscar" autocomplete="off" style="display:none;" placeholder="Buscar en columna" class="mt-1 form-control col-md-2 float-left">
                                </th>
                            </tr>
                            <tr>
                                <th>Agente</th>
                                <th>Cruce</th>
                                <th style="min-width: 134px;">Fecha y hora</th>
                                <th>Lugar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="datos_registros">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['REGISTROS']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                            <tr>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['agente'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['cruce'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['value']->value['fecha'],'%d/%m/%Y %H:%M:%S');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['lugar'], 'utf8_encode');?>
</td>
                                <th style="padding: 0px;padding-left: 25px;">
                                    <i style="font-size: xx-large;" class="bi bi-trash" onclick="eliminar(this,'<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
','registro')"></i>
                                </th>
                            </tr>
                            <?php
}
if ($_smarty_tpl->tpl_vars['value']->do_else) {
?>
                            <tr><td colspan="15" class="text-center">No encontramos registros disponibles</td></tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <th colspan="15" id="no_datos" style="display: none;" class="text-center">No encontramos registros disponibles</th>
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
