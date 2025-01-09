<?php
/* Smarty version 3.1.34-dev-7, created on 2025-01-09 16:01:16
  from 'C:\xampp\htdocs\estudio6\templates\cargas.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_677fe4bc0d3372_94738904',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b7599affa449ce2446c93d4eb2cbb799167e1d3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\cargas.html',
      1 => 1736433071,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_677fe4bc0d3372_94738904 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar alumno/a</title>
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
 src="js/foto_perfil.js?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
"><?php echo '</script'; ?>
>
    <!-- ESTILOS PARA LOGIN -->
    <link rel="stylesheet" href="css/estilo.css?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
">
    <link rel="stylesheet" href="css/camara.css?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
">
</head>
<body>
    <?php echo $_smarty_tpl->tpl_vars['HEADER']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['CAMARA']->value;?>

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <h3>Cargar alumno/a</h3>
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
                <div class="form-group col-md-2 float-right">
                    <div class="perfil-img d-flex justify-content-center">
                        <div class="file_1">
                            Tomar foto
                            <input type="file" capture="camera" name="fotoPerfil" id="fotoPerfil" readonly/>
                        </div>
                        <a id="tomar_foto" class="tomar_foto">Tomar foto</a>
                        <img role="button" src="img/icono.jpg" id="id_perfil" class="rounded-circle" height="125" width="130"/>
                        <input type="hidden" id="foto_base64" value="">
                        <div class="file">
                            Cambiar foto
                            <input type="file" name="fotoPerfil" id="fotoPerfil"/>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3 float-left mt-datos">
                    <label for="exampleFormControlInput1">Apellido (*)</label>
                    <input type="text" id="apellido" class="form-control">
                </div>
                <div class="form-group col-md-3 float-left mt-datos">
                    <label for="exampleFormControlInput1">Nombre (*)</label>
                    <input type="text" id="nombre" class="form-control">
                </div>
                <div class="form-group col-md-2 float-left mt-datos">
                    <label for="exampleFormControlInput1">Edad (*)</label>
                    <input type="text" id="edad" class="form-control">
                </div>
                <div class="form-group col-md-2 float-left mt-datos">
                    <label for="exampleFormControlInput1">Fecha de nac. (*)</label>
                    <input type="date" id="fecha_nac" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-3 float-left">
                    <label for="exampleFormControlInput1">Documento</label>
                    <input type="text" id="documento" class="form-control">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label for="exampleFormControlInput1">Correo</label>
                    <input type="text" id="correo" class="form-control">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label for="exampleFormControlInput1">Tel. movil</label>
                    <input type="text" id="tel_alumno" class="form-control">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label for="exampleFormControlInput1">Autorizado</label>
                    <input type="text" id="tel_fijo" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-3 float-left">
                    <label for="exampleFormControlInput1">Nacionalidad</label>
                    <input type="text" id="nacionalidad" class="form-control">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label for="exampleFormControlInput1">Localidad</label>
                    <input type="text" id="localidad" class="form-control">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label for="exampleFormControlInput1">Domicilio</label>
                    <input type="text" id="domicilio" class="form-control">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label for="exampleFormControlInput1">Salud</label>
                    <input type="text" id="salud" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-12 float-left">
                    <label>Actividad</label>
                    <i class="bi bi-plus-circle-dotted agregar_actividad" title="Agregar actividad" id="agregar_actividad"></i>

                    <input list="actividades" class="form-control" id="actividad">        
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
            </div> 
            <div id="nueva_actividad" class="col-md-12"></div>
            <div class="col-md-12">
                <div class="form-group col-md-12 float-left">
                    <label>Observacion</label>
                    <textarea class="form-control" id="observacion_alumno"></textarea>        
                </div>
            </div>
            <div class="col-md-12 mb-4 mt-3">
                <div class="form-group col-md-12">
                    <button class="btn btn-dark btn-lg rounded-pill float-right col-md-2" id="guardar_datos">Guardar datos</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['FOOTER']->value;?>

</body>
</html><?php }
}
