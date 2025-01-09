<?php
/* Smarty version 3.1.34-dev-7, created on 2025-01-09 19:37:01
  from 'C:\xampp\htdocs\estudio6\templates\actividades.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6780174d8180d2_34671197',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a2d7bea75adad5a9b7fbdf889c9e04bf383679c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\actividades.html',
      1 => 1736446686,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6780174d8180d2_34671197 (Smarty_Internal_Template $_smarty_tpl) {
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
                    <label>Descuento por actividades</label>
                    <input type="text" class="form-control col-6" id="descuento_actividad" value="<?php echo $_smarty_tpl->tpl_vars['DESCUENTO_ACT']->value;?>
" oninput="this.value = this.value.replace(/[^0-9]/g, '');this.nextElementSibling.style.display = 'block';">
                    <i class="bi bi-floppy" role="button" onclick="editar_descuentos()" style="position: absolute;bottom: 20px;margin-left: 54px;"></i>
                </div>
                <div class="form-group">
                    <label>Descuento por familiar</label>
                    <input type="text" class="form-control col-6" id="descuento_familiar" value="<?php echo $_smarty_tpl->tpl_vars['DESCUENTO_FAM']->value;?>
" oninput="this.value = this.value.replace(/[^0-9]/g, '');this.nextElementSibling.style.display = 'block';">
                    <i class="bi bi-floppy" role="button" onclick="editar_descuentos()" style="position: absolute;bottom: 20px;margin-left: 54px;"></i>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-center mt-2">
                <div class="scroll mb-3">
                    <table class="table table-bordered text-body">
                        <thead align="center">
                            <tr>
                                <th>Actividad</th>
                                <th>Una deb</th>
                                <th>Una efec</th>
                                <th>Dos deb</th>
                                <th>Dos efec</th>
                                <th>Días y horarios</th>
                                <th>Profe</th>
                                <th>Edades</th>
                                <th>Cupos totales</th>
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
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['actividad'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['una_vez'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['una_vez_efec'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['dos_veces'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['dos_veces_efec'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['dias_horarios'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['profe'], 'utf8_encode');?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['value']->value['min_edad'];?>
 A <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['max_edad'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['cupos'], 'utf8_encode');?>
</td>
                                <td><i class="bi bi-pencil-square" onclick="editar_actividad(this,'<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')" style="font-size: xx-large;"></i></td>
                                <td><i class="bi bi-trash" onclick="eliminar_actividad_bdd(this,'<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')" style="font-size: xx-large;"></i></td>
                            </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <hr>
                <div class="form-group col-md-3 float-left">
                    <label for="exampleFormControlInput1">Actividad</label>
                    <input type="text" id="id_guardar_actividad" class="form-control">
                </div>
                <div class="form-group col-md-2 float-left">
                    <label for="exampleFormControlInput1">Una deb</label>
                    <input type="number" id="id_guardar_una" class="form-control">
                </div>
                <div class="form-group col-md-2 float-left">
                    <label for="exampleFormControlInput1">Una efec</label>
                    <input type="number" id="id_guardar_una_efectivo" class="form-control">
                </div>
                <div class="form-group col-md-2 float-left">
                    <label for="exampleFormControlInput1">Dos deb</label>
                    <input type="number" id="id_guardar_dos" class="form-control">
                </div>
                <div class="form-group col-md-2 float-left">
                    <label for="exampleFormControlInput1">Dos efec</label>
                    <input type="number" id="id_guardar_dos_efectivo" class="form-control">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label for="exampleFormControlInput1">D&iacute;as y horarios</label>
                    <input type="text" id="id_guardar_dias" class="form-control">
                </div>
                <div class="form-group col-md-2 float-left">
                    <label for="exampleFormControlInput1">Profe</label>
                    <input type="text" id="id_guardar_profe" class="form-control">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label>Edades</label><br>
                    <input type="number" id="id_guardar_edad_min" class="form-control col-5 float-left">
                    <label class="float-left m-2">A</label>
                    <input type="number" id="id_guardar_edad_max" class="form-control col-5 float-left">
                </div>
                <div class="form-group col-md-2 float-left">
                    <label for="exampleFormControlInput1">Cupos totales</label>
                    <input type="text" id="id_guardar_cupos" class="form-control">
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-center mt-3">
                <div class="form-group col-md-12">
                    <button id="guardar_actividad" class="btn btn-dark btn-lg rounded-pill float-right col-md-2 mt-2">Editar actividad</button>
                    <button id="nueva_actividad" class="btn btn-dark btn-lg rounded-pill float-right col-md-3 mt-2">Guardar nueva actividad</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['FOOTER']->value;?>

</body>
</html><?php }
}
