<?php
/* Smarty version 3.1.34-dev-7, created on 2025-05-05 18:52:39
  from 'C:\xampp\htdocs\estudio6\templates\datos.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6818ecd7309615_05280951',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ce26efb37a756fd2475f960eb278d3fb7e8b7031' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\datos.html',
      1 => 1740752030,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6818ecd7309615_05280951 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp\\htdocs\\estudio6\\libs\\smarty3\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),1=>array('file'=>'C:\\xampp\\htdocs\\estudio6\\libs\\smarty3\\plugins\\modifier.escape.php','function'=>'smarty_modifier_escape',),));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos del alumno/a</title>
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

    <?php if ($_smarty_tpl->tpl_vars['VALOR']->value == '0,00') {?>
        <?php echo '<script'; ?>
>
             alertify.alert('Datos del alumno/a','No se pudo cargar el monto a pagar, revice el nombre de las actividades o los valores por favor.')
        <?php echo '</script'; ?>
>    
    <?php }?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <h3>Datos del alumno/a</h3>
            </div>
        </div>
    </div>
    <div class="container border border-color rounded mb-4">
        <div class="row">
            <div class="col-md-12 mt-3 pr-4">
                <div class="form-group float-left">
                    <a class="btn btn-dark btn-lg rounded-pill" href="index.php">Volver</a>
                </div>
                <?php ob_start();
echo $_smarty_tpl->tpl_vars['VINCULO']->value;
$_prefixVariable1 = ob_get_clean();
if (empty($_prefixVariable1)) {?>
                    <div class="form-group float-right">
                        <i class="bi bi-copy" onclick="copiar_texto('deudas_alumno')" style="font-size: xx-large;"></i>
                    </div>
                    <div class="form-group float-right mr-4">
                        <div class="form-check">
                            <i class="bi bi-calendar-x" role="button" onclick="document.querySelector('#deudas_alumno').style.display = 'block'" style="font-size: xx-large;"></i>
                        </div>
                    </div>
                <?php }?>
                <div class="form-group float-right mr-3 ml-2">
                    <div class="form-check">
                        <input <?php if ($_smarty_tpl->tpl_vars['BAJA']->value !== null) {?> checked <?php }?> class="form-check-input" role="button" type="checkbox" name="baja_alumno" id="baja_alumno">
                        <label class="form-check-label">Baja del alumno/a</label>
                        <p class="form-check-label" id="info_baja" style="font-size: 12px;">
                        <?php if ($_smarty_tpl->tpl_vars['BAJA']->value !== null) {?>Baja - <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['BAJA']->value,'%d/%m/%Y');
}?>
                        </p>
                    </div>
                </div>
                <?php ob_start();
echo $_smarty_tpl->tpl_vars['VINCULO']->value;
$_prefixVariable2 = ob_get_clean();
if (empty($_prefixVariable2)) {?>
                    <div class="form-group col-md-12 d-flex justify-content-center">
                        <div class="float-left">
                            <label>A pagar</label>
                            <input type="text" id="valor" readonly="true" name="alumno" class="form-control col-md-6 text-center" value="$<?php echo number_format($_smarty_tpl->tpl_vars['VALOR']->value,0,",",".");?>
">
                        </div>
                        <div class="ml-3 float-left">
                            <label>Combo</label>
                            <input type="text" id="combo" readonly="true" class="form-control col-md-6 text-center" value="$<?php echo number_format($_smarty_tpl->tpl_vars['COMBO']->value,0,",",".");?>
">
                        </div>
                        <div class="ml-3 float-left">
                            <label>Adeuda</label>
                            <input type="text" id="adeuda" readonly="true" class="form-control col-md-6 text-center" value="$<?php echo number_format($_smarty_tpl->tpl_vars['ADEUDA']->value,0,",",".");?>
">
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="form-group float-left ml-3">
                        <a href="datos.php?vinculo=<?php echo $_smarty_tpl->tpl_vars['VINCULO']->value;?>
" class="btn btn-dark btn-lg rounded-pill ">Ir a grupo familiar</a>
                    </div>
                <?php }?>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-2 float-right">
                    <div class="perfil-img d-flex justify-content-center">
                        <div class="file_1">
                            Tomar foto
                            <input type="file" capture="camera" name="fotoPerfil" id="fotoPerfil" readonly/>
                        </div>
                        <a id="tomar_foto" class="tomar_foto">Tomar foto</a>
                        <img role="button" src="<?php echo $_smarty_tpl->tpl_vars['FOTO']->value;?>
?<?php echo $_smarty_tpl->tpl_vars['NO_CACHE']->value;?>
" id="id_perfil" style="object-fit: cover;" class="rounded-circle" height="130" width="130"/>
                        <input type="hidden" id="foto_base64" value="">
                        <div class="file">
                            Cambiar foto
                            <input type="file" name="fotoPerfil" id="fotoPerfil" readonly/>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3 float-left mt-datos">
                    <label>Apellido</label>
                    <input type="hidden" id="id_alumno" value="<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
">
                    <input type="text" id="apellido" class="form-control" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['APELLIDO']->value, 'utf8_encode');?>
">
                </div>
                <div class="form-group col-md-3 float-left mt-datos">
                    <label>Nombre</label>
                    <input type="text" id="nombre" class="form-control" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['NOMBRE']->value, 'utf8_encode');?>
">
                </div>
                <div class="form-group col-md-2 float-left mt-datos">
                    <label>Edad</label>
                    <input type="text" id="edad" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['EDAD']->value;?>
">
                </div>
                <div class="form-group col-md-2 float-left mt-datos">
                    <label>Fecha de nac.</label>
                    <input type="date" id="fecha_nac" class="form-control" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['FECHA_NAC']->value, 'utf8_encode');?>
">
                </div>
            </div>
            <?php if (empty($_smarty_tpl->tpl_vars['ACTIVIDADES_ALUMNO']->value)) {?>
                <div class="col-md-12">
                    <div class="form-group col-md-12 float-left">
                        <label>Actividad 1</label>
                        <i class="bi bi-plus-circle-dotted agregar_actividad" title="Agregar actividad" id="agregar_actividad"></i>
                        <select class="form-control" id="actividad">
                            <option selected value="0">-- Seleccione una actividad --</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACTIVIDADES']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                                <?php if ($_smarty_tpl->tpl_vars['value']->value['disponibles'] > 0) {?>  
                                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">
                                    <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['actividad'], 'utf8_encode');?>
 - <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value']->value['dias_horarios'], 'utf8_encode');?>

                                </option>
                                <?php }?>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </div>
                </div> 
            <?php } else { ?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACTIVIDADES_ALUMNO']->value, 'value1', false, 'key');
$_smarty_tpl->tpl_vars['value1']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value1']->value) {
$_smarty_tpl->tpl_vars['value1']->do_else = false;
?>
                    <?php if (empty(trim($_smarty_tpl->tpl_vars['value1']->value['actividad']))) {?> <?php continue 1;?> <?php }?>
                    <div class="col-md-12">
                        <div class="form-group col-md-12 float-left">
                            <label>Actividad <?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
</label>
                            <?php if ($_smarty_tpl->tpl_vars['key']->value == 0) {?>
                                <i class="bi bi-plus-circle-dotted agregar_actividad" title="Agregar actividad" id="agregar_actividad"></i>
                            <?php } else { ?>
                                <i class="bi bi-dash-circle-dotted eliminar_actividad" title="Eliminar actividad" id="eliminar_actividad"></i>
                            <?php }?>
                            <select class="form-control" id="actividad">
                                <option value="0">-- Seleccione una actividad --</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ACTIVIDADES']->value, 'value2');
$_smarty_tpl->tpl_vars['value2']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value2']->value) {
$_smarty_tpl->tpl_vars['value2']->do_else = false;
?>
                                    <?php if ($_smarty_tpl->tpl_vars['value2']->value['disponibles'] > 0 || $_smarty_tpl->tpl_vars['value2']->value['id'] == $_smarty_tpl->tpl_vars['value1']->value['id']) {?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['value2']->value['id'];?>
"
                                    <?php if ($_smarty_tpl->tpl_vars['value2']->value['id'] == $_smarty_tpl->tpl_vars['value1']->value['id']) {?> selected <?php }?>>
                                    <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value2']->value['actividad'], 'utf8_encode');?>
 - <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['value2']->value['dias_horarios'], 'utf8_encode');?>

                                    </option>
                                    <?php }?>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                        </div>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>

            <div id="nueva_actividad" class="col-md-12"></div>
            <div class="col-md-12">
                <div class="form-group col-md-12 float-left">
                    <label>Notas del estudio</label>
                    <textarea class="form-control" id="notas"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['NOTAS']->value, 'utf8_encode');?>
</textarea>        
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-12 float-left">
                    <label>Observacion</label>
                    <textarea class="form-control" id="observacion_alumno"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['OBSERVACIONES']->value, 'utf8_encode');?>
</textarea>        
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-3 float-left">
                    <label>Documento</label>
                    <input type="text" id="documento" class="form-control" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['DOCUMENTO']->value, 'utf8_encode');?>
">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label>Correo</label>
                    <input type="text" id="correo" class="form-control" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['MAIL']->value, 'utf8_encode');?>
">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label>Tel. movil</label>
                    <input type="text" id="tel_alumno" class="form-control" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['TEL_MOVIL']->value, 'utf8_encode');?>
">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label>¿Se retira solo?</label>
                    <input type="text" id="autoriza" class="form-control" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['AUTORIZA']->value, 'utf8_encode');?>
">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group col-md-3 float-left">
                    <label>Nacionalidad</label>
                    <input type="text" id="nacionalidad" class="form-control" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['NACIONALIDAD']->value, 'utf8_encode');?>
">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label>Localidad</label>
                    <input type="text" id="localidad" class="form-control" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['LOCALIDAD']->value, 'utf8_encode');?>
">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label>Domicilio</label>
                    <input type="text" id="domicilio" class="form-control" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['DOMICILIO']->value, 'utf8_encode');?>
">
                </div>
                <div class="form-group col-md-3 float-left">
                    <label>Salud</label>
                    <input type="text" id="salud" class="form-control" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['SALUD']->value, 'utf8_encode');?>
">
                </div>
            </div>
            <?php if (!empty($_smarty_tpl->tpl_vars['FAMILIAR']->value)) {?>
                <div class="col-md-12">
                    <h3 class="ml-3 mt-3">Familiares</h3>
                </div>
            <?php }?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['FAMILIAR']->value, 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                <?php if (empty($_smarty_tpl->tpl_vars['value']->value['nombre_apellido']) && empty($_smarty_tpl->tpl_vars['value']->value['vinculo']) && empty($_smarty_tpl->tpl_vars['value']->value['telefono'])) {?> continue <?php }?>
                <div class="col-md-12">
                    <div class="form-group col-md-4 float-left">
                        <label>Nombre y apellido</label>
                        <i class="bi bi-dash-circle-dotted eliminar_actividad" title="Eliminar familiar" id="eliminar_familiar"></i>
                        <input type="hidden" id="id_familiar" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
">
                        <input type="text" id="nom_ape" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['nombre_apellido'];?>
">
                    </div>
                    <div class="form-group col-md-4 float-left">
                        <label>Vinculo</label>
                        <input type="text" id="vinculo" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['vinculo'];?>
">
                    </div>
                    <div class="form-group col-md-4 float-left">
                        <label>Telefono</label>
                        <input type="text" id="tel_familiar" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['value']->value['telefono'];?>
">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group col-md-12 float-left">
                        <label>Observacion</label>
                        <textarea class="form-control" id="observacion_familiar"><?php echo $_smarty_tpl->tpl_vars['value']->value['observacion'];?>
</textarea>        
                    </div>
                </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <div class="col-md-12 mb-4 mt-3">
                <div class="form-group col-md-12">
                    <button id="editar_datos" class="btn btn-dark btn-lg rounded-pill float-right col-md-2 mt-2">Guardar datos</button>
                    <button id="eliminar_alumno" class="btn btn-dark btn-lg rounded-pill float-right col-md-2  mt-2">Eliminar alumno</button>
                    <button id="agregar_familiar" onclick="location.href='familiares.php?id=<?php echo $_smarty_tpl->tpl_vars['ID']->value;?>
'" class="btn btn-dark btn-lg rounded-pill float-right col-md-2 mt-2">Agregar familiar</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['FOOTER']->value;?>

</body>
</html><?php }
}
