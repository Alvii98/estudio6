<?php
/* Smarty version 3.1.34-dev-7, created on 2025-01-21 19:32:33
  from 'C:\xampp\htdocs\estudio6\templates\actividades.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_678fe8414db4f6_53227317',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a2d7bea75adad5a9b7fbdf889c9e04bf383679c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\actividades.html',
      1 => 1737484352,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_678fe8414db4f6_53227317 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\estudio6\\libs\\smarty3\\plugins\\modifier.escape.php','function'=>'smarty_modifier_escape',),));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividades</title>
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
    <?php echo '<script'; ?>
 src="js/ajax_editar_datos.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="js/buscador.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
>
    <!-- ESTILOS PARA LOGIN -->
    <link rel="stylesheet" href="css/estilo.css?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
">
</head>
<body>
    <?php echo $_smarty_tpl->tpl_vars['HEADER']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['MODAL_ACTIVIDAD']->value;?>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <h3>Actividades</h3>
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
            <div class="col-md-12 d-flex justify-content-center">
                <div class="form-group">
                    <label>Descuento por combo o Flia</label>
                    <input type="text" class="form-control col-9" style="text-align: center;font-size: 16px !important;" id="descuento_actividad" value="<?php echo $_smarty_tpl->tpl_vars['DESCUENTO_ACT']->value;?>
" oninput="this.value = this.value.replace(/[^0-9]/g, '');this.nextElementSibling.style.display = 'block';">
                    <label style="position: absolute;bottom: 18%;left: 49%;font-size: 15px !important;">%</label>
                    <i class="bi bi-floppy" role="button" onclick="editar_descuentos()" style="position: absolute;bottom: 22px;margin-left: 116px;"></i>
                </div>
                <!-- <div class="form-group">
                    <label>Descuento por familiar</label>
                    <input type="text" class="form-control col-6" id="descuento_familiar" value="<?php echo $_smarty_tpl->tpl_vars['DESCUENTO_FAM']->value;?>
" oninput="this.value = this.value.replace(/[^0-9]/g, '');this.nextElementSibling.style.display = 'block';">
                    <i class="bi bi-floppy" role="button" onclick="editar_descuentos()" style="position: absolute;bottom: 20px;margin-left: 54px;"></i>
                </div> -->
            </div>
            <div class="col-md-12 d-flex justify-content-center mt-2">
                <div class="scroll-actividades mb-3">
                    <table class="table table-bordered text-body table-actividades">
                        <thead align="center">
                            <tr>
                                <th colspan="15" class="text-center">
                                    <select name="columna" id="columna" class="mt-1 form-control col-md-2 mr-2 float-left">
                                        <option value="-">-- Buscar por --</option>
                                        <option value="0">Actividad</option>
                                        <option value="3">D&iacute;as y horarios</option>
                                        <option value="4">Profe</option>
                                    </select>
                                    <input type="text" id="buscar" autocomplete="off" style="display:none;" placeholder="Buscar en columna" class="mt-1 form-control col-md-2 float-left">
                                </th>
                            </tr>
                            <tr>
                                <th>Actividad</th>
                                <th>Valor</th>
                                <th>Valor x2</th>
                                <th>D&iacute;as y horarios</th>
                                <th>Profe</th>
                                <th>Edades</th>
                                <th>Cupos</th>
                                <th>Disp.</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACTIVIDADES']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                            <tr>
                                <td onclick="datos_actividad('<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['actividad'], 'utf8_encode');?>
</td>
                                <td onclick="datos_actividad('<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['una_vez'], 'utf8_encode');?>
</td>
                                <td onclick="datos_actividad('<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['dos_veces'], 'utf8_encode');?>
</td>
                                <td onclick="datos_actividad('<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['dias_horarios'], 'utf8_encode');?>
</td>
                                <td onclick="datos_actividad('<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['profe'], 'utf8_encode');?>
</td>
                                <td onclick="datos_actividad('<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')"><?php echo $_smarty_tpl->tpl_vars['value']->value['min_edad'];?>
 A <?php echo $_smarty_tpl->tpl_vars['value']->value['max_edad'];?>
</td>
                                <td onclick="datos_actividad('<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['cupos'], 'utf8_encode');?>
</td>
                                <td onclick="datos_actividad('<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['disponibles'], 'utf8_encode');?>
</td>
                                <th><i class="bi bi-pencil-square" onclick="editar_actividad(this,'<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')"></i></th>
                                <th><i class="bi bi-trash" onclick="eliminar_actividad_bdd(this,'<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')"></i></th>
                            </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            <th colspan="15" class="text-center" id="no_datos" style="display:none;">NO SE ENCONTRARON DATOS</th>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <hr>
                <div class="form-group col-md-2 float-left">
                    <label for="exampleFormControlInput1">Actividad</label>
                    <input list="actividades" type="text" id="id_guardar_actividad" class="form-control">
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
                    </datalist>
                </div>
                <div class="form-group col-md-1 float-left">
                    <label for="exampleFormControlInput1">Valor</label>
                    <input type="number" id="id_guardar_una" class="form-control">
                </div>
                <div class="form-group col-md-1 float-left">
                    <label for="exampleFormControlInput1">Valor x2</label>
                    <input type="number" id="id_guardar_dos" class="form-control">
                </div>
                <div class="form-group col-md-2 float-left">
                    <label for="exampleFormControlInput1">D&iacute;as y horarios</label>
                    <input type="text" id="id_guardar_dias" class="form-control">
                </div>
                <div class="form-group col-md-2 float-left">
                    <label for="exampleFormControlInput1">Profe</label>
                    <input type="text" id="id_guardar_profe" class="form-control">
                </div>
                <div class="form-group col-md-2 float-left">
                    <label>Edades</label><br>
                    <input type="number" id="id_guardar_edad_min" class="form-control col-5 float-left">
                    <label class="float-left m-2">A</label>
                    <input type="number" id="id_guardar_edad_max" class="form-control col-5 float-left">
                </div>
                <div class="form-group col-md-1 float-left">
                    <label for="exampleFormControlInput1">Cupos</label>
                    <input type="number" id="id_guardar_cupos" class="form-control">
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-center mt-3">
                <div class="form-group col-md-12">
                    <!-- <button id="guardar_actividad" class="btn btn-dark btn-lg rounded-pill float-right col-md-2 mt-2">Editar actividad</button> -->
                    <button id="guardar_actividad" onclick="guardar_actividad()" class="btn btn-dark btn-lg rounded-pill float-right col-md-3 mt-2">Guardar actividad</button>
                </div>
            </div>
        </div>
    </div>
        
    <?php echo $_smarty_tpl->tpl_vars['FOOTER']->value;?>

</body>
</html><?php }
}
