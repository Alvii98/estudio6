<?php
/* Smarty version 3.1.34-dev-7, created on 2025-05-06 14:29:44
  from 'C:\xampp\htdocs\estudio6\templates\historico.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_681a00b81d4320_40092470',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '414e1d43bf12e30e8c3706a1c00b6caceab8f817' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\historico.html',
      1 => 1741286674,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_681a00b81d4320_40092470 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\estudio6\\libs\\smarty3\\plugins\\modifier.escape.php','function'=>'smarty_modifier_escape',),1=>array('file'=>'C:\\xampp\\htdocs\\estudio6\\libs\\smarty3\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda historica</title>
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
 src="js/historico.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
> 
   <!-- <?php echo '<script'; ?>
 src="js/excel.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
> 
   <?php echo '<script'; ?>
 src="js/exportar_excel.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
>  -->
    <!-- ESTILOS -->
    <link rel="stylesheet" href="css/estilo.css?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
">
</head>
<body>
    <?php echo $_smarty_tpl->tpl_vars['HEADER']->value;?>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <h3>Buscar alumno/a en la tabla historica</h3>
            </div>
        </div>
    </div>
    <div class="container border border-color rounded mb-4 text-body">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 d-flex justify-content-center param-busqueda mt-4">
                <div class="form-group col-md-3">
                    <label>Apellido</label>
                    <input type="text" id="apellido" placeholder="Apellido" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label>Nombre</label>
                    <input type="text" id="nombre" placeholder="Nombre" class="form-control">
                </div>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['ACTUALIZAR']->value) {?><p style="color: green;">La tabla historica esta actualizada <i class="bi bi-check-circle"></i></p>
            <?php } else { ?><p style="color: red;">La tabla historica no se pudo actualizar <i class="bi bi-x-circle"></i></p><?php }?>
            <div class="col-md-12 text-center">
                <button class="btn btn-dark rounded-pill" id="alumnosTotales" style="cursor:pointer;">Alumnos: <?php echo $_smarty_tpl->tpl_vars['CANTIDAD']->value;?>
</button>
                <button class="btn btn-dark rounded-pill" id="bajasTotales" style="cursor:pointer;">Bajas: <?php echo $_smarty_tpl->tpl_vars['BAJAS']->value;?>
</button>
                <button class="btn btn-dark rounded-pill" id="soloHistorica" style="cursor:pointer;">Solo en historica: <?php echo $_smarty_tpl->tpl_vars['SOLOHISTORICA']->value;?>
</button>
                <div class="scroll mb-3 mt-2">
                    <table class="table table-bordered text-body">
                        <thead align="center">
                            <tr>
                                <th>Foto</th>
                                <th>Apellido</th>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Fecha de nacimiento</th>
                                <th>Contacto</th>
                                <th>Baja</th>
                                <!-- <th>Eliminar</th> -->
                            </tr>
                        </thead>
                        <tbody id="datos_historicos">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ALUMNOS']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                            <tr <?php if (!empty($_smarty_tpl->tpl_vars['value']->value['baja'])) {?>style="text-decoration:line-through;"<?php }?>>
                                <?php if (file_exists($_smarty_tpl->tpl_vars['value']->value['foto_perfil'])) {?>
                                    <td><img src="<?php echo $_smarty_tpl->tpl_vars['value']->value['foto_perfil'];?>
" class="foto-navbar"></td>
                                <?php } else { ?>
                                    <td><img src="img/icono.jpg" class="foto-navbar"></td>
                                <?php }?>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['apellido'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['nombre'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['edad'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['value']->value['fecha_nac'],'%d/%m/%Y');?>
</td>
                                <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['tel_movil'], 'utf8_encode');?>
</td>
                                <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['value']->value['baja'],'%d/%m/%Y');?>
</td>
                                <!-- <th><i class="bi bi-trash" onclick="eliminar_alumno(this,'<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
')"></i></th> -->
                            </tr>
                            <?php
}
if ($_smarty_tpl->tpl_vars['value']->do_else) {
?>
                            <tr><td colspan="7">NO ENCONTRAMOS DATOS HISTORICOS</td></tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
