<?php
/* Smarty version 3.1.34-dev-7, created on 2025-09-29 15:02:24
  from 'C:\xampp\htdocs\estudio6\templates\partials\modal.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_68da8360922670_02283963',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b2bfa454260b7d848f597979df3a7f26c42878f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\partials\\modal.html',
      1 => 1757335242,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68da8360922670_02283963 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- <div class="modal-overlay"></div> -->
<div id="datos_actividad" class="modal-login" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <i class="bi bi-x exit-card" onclick="document.querySelector('#datos_actividad').style.display = 'none'"></i>
            <div class="modal-header d-flex justify-content-center">
                <h4>Datos de actividad </h4>
                <i class="bi bi-file-earmark-spreadsheet-fill float-right h2" onclick="exportarExcelActividad('alumnos_actividad')" id="exportar_excel"
                style="position:absolute;top:4%;right:13%;"></i>
            </div>
            <div class="col-md-12 p-3">
                <h5 align="center" id="nom_actividad"></h5>
                <div class="scroll-modal mb-3">
                    <table class="table table-bordered text-body" id="alumnos_actividad">
                        <thead align="center">
                            <tr>
                                <th>Alumnos</th>
                            </tr>
                        </thead>
                        <tbody align="center" id="mostrar_datos_actividad">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>


<div id="deudas_alumno" class="modal-login" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <i class="bi bi-x exit-card" onclick="document.querySelector('#deudas_alumno').style.display = 'none'"></i>
            <div class="modal-header d-flex justify-content-center">
                <h4>Deudas del alumno</h4>
            </div>
            <div class="col-md-12 p-3">
                <div class="scroll-modal mb-3">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DEUDAS_ALUMNO']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                        <div class="form-group col-md-3 float-left">
                            <label>Enero</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="enero" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['enero'],0,',','.');?>
">
                        </div>
                        <div class="form-group col-md-3 float-left">
                            <label>Febrero</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="febrero" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['febrero'],0,',','.');?>
">
                        </div>
                        <div class="form-group col-md-3 float-left">
                            <label>Marzo</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="marzo" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['marzo'],0,',','.');?>
">
                        </div>
                        <div class="form-group col-md-3 float-left">
                            <label>Abril</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="abril" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['abril'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Mayo</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="mayo" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['mayo'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Junio</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="junio" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['junio'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Julio</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="julio" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['julio'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Agosto</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="agosto" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['agosto'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Septiembre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="septiembre" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['septiembre'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Octubre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="octubre" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['octubre'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Noviembre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="noviembre" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['noviembre'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Diciembre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="diciembre" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['diciembre'],0,',','.');?>
">
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <div class="form-group col-md-12 mt-3">
                        <button onclick="guardar_deuda_alumno()" class="btn btn-dark btn-lg rounded-pill float-right">Guardar datos</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<div id="deudas_vinculo" class="modal-login" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <i class="bi bi-x exit-card" onclick="document.querySelector('#deudas_vinculo').style.display = 'none'"></i>
            <div class="modal-header d-flex justify-content-center">
                <h4>Deudas del vinculo familiar</h4>
            </div>
            <div class="col-md-12 p-3">
                <div class="scroll-modal mb-3">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['DEUDAS_VINCULO']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                        <div class="form-group col-md-3 float-left">
                            <label>Enero</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="enero2" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['enero'],0,',','.');?>
">
                        </div>
                        <div class="form-group col-md-3 float-left">
                            <label>Febrero</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="febrero2" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['febrero'],0,',','.');?>
">
                        </div>
                        <div class="form-group col-md-3 float-left">
                            <label>Marzo</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="marzo2" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['marzo'],0,',','.');?>
">
                        </div>
                        <div class="form-group col-md-3 float-left">
                            <label>Abril</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="abril2" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['abril'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Mayo</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="mayo2" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['mayo'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Junio</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="junio2" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['junio'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Julio</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="julio2" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['julio'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Agosto</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="agosto2" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['agosto'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Septiembre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="septiembre2" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['septiembre'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Octubre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="octubre2" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['octubre'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Noviembre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="noviembre2" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['noviembre'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Diciembre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="diciembre2" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['diciembre'],0,',','.');?>
">
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <div class="form-group col-md-12 mt-3">
                        <button onclick="guardar_deuda_vinculo()" class="btn btn-dark btn-lg rounded-pill float-right">Guardar datos</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>


<div id="afavor_alumno" class="modal-login" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <i class="bi bi-x exit-card" onclick="document.querySelector('#afavor_alumno').style.display = 'none'"></i>
            <div class="modal-header d-flex justify-content-center">
                <h4>Saldo a favor del alumno</h4>
            </div>
            <div class="col-md-12 p-3">
                <div class="scroll-modal mb-3">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['AFAVOR_ALUMNO']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                        <div class="form-group col-md-3 float-left">
                            <label>Enero</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="enero3" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['enero'],0,',','.');?>
">
                        </div>
                        <div class="form-group col-md-3 float-left">
                            <label>Febrero</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="febrero3" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['febrero'],0,',','.');?>
">
                        </div>
                        <div class="form-group col-md-3 float-left">
                            <label>Marzo</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="marzo3" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['marzo'],0,',','.');?>
">
                        </div>
                        <div class="form-group col-md-3 float-left">
                            <label>Abril</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="abril3" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['abril'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Mayo</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="mayo3" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['mayo'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Junio</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="junio3" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['junio'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Julio</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="julio3" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['julio'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Agosto</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="agosto3" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['agosto'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Septiembre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="septiembre3" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['septiembre'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Octubre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="octubre3" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['octubre'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Noviembre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="noviembre3" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['noviembre'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Diciembre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="diciembre3" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['diciembre'],0,',','.');?>
">
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <div class="form-group col-md-12 mt-3">
                        <button onclick="guardar_afavor_alumno()" class="btn btn-dark btn-lg rounded-pill float-right">Guardar datos</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<div id="afavor_vinculo" class="modal-login" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <i class="bi bi-x exit-card" onclick="document.querySelector('#afavor_vinculo').style.display = 'none'"></i>
            <div class="modal-header d-flex justify-content-center">
                <h4>Saldo a favor del vinculo familiar</h4>
            </div>
            <div class="col-md-12 p-3">
                <div class="scroll-modal mb-3">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['AFAVOR_VINCULO']->value, 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
                        <div class="form-group col-md-3 float-left">
                            <label>Enero</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="enero4" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['enero'],0,',','.');?>
">
                        </div>
                        <div class="form-group col-md-3 float-left">
                            <label>Febrero</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="febrero4" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['febrero'],0,',','.');?>
">
                        </div>
                        <div class="form-group col-md-3 float-left">
                            <label>Marzo</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="marzo4" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['marzo'],0,',','.');?>
">
                        </div>
                        <div class="form-group col-md-3 float-left">
                            <label>Abril</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="abril4" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['abril'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Mayo</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="mayo4" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['mayo'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Junio</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="junio4" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['junio'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Julio</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="julio4" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['julio'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Agosto</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="agosto4" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['agosto'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Septiembre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="septiembre4" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['septiembre'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Octubre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="octubre4" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['octubre'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Noviembre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="noviembre4" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['noviembre'],0,',','.');?>
">
                        </div>                
                        <div class="form-group col-md-3 float-left">
                            <label>Diciembre</label>
                            <input type="text" oninput="validateNumberPunto(this)" id="diciembre4" class="form-control" value="<?php echo number_format($_smarty_tpl->tpl_vars['value']->value['diciembre'],0,',','.');?>
">
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <div class="form-group col-md-12 mt-3">
                        <button onclick="guardar_afavor_vinculo()" class="btn btn-dark btn-lg rounded-pill float-right">Guardar datos</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div><?php }
}
