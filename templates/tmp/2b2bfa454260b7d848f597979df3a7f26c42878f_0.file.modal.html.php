<?php
/* Smarty version 3.1.34-dev-7, created on 2025-01-14 14:05:31
  from 'C:\xampp\htdocs\estudio6\templates\partials\modal.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6786611beca0e1_62319045',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b2bfa454260b7d848f597979df3a7f26c42878f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\partials\\modal.html',
      1 => 1736525908,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6786611beca0e1_62319045 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- <div class="modal-overlay"></div> -->
<div id="datos_actividad" class="modal-login" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <i class="bi bi-x exit-card" onclick="document.querySelector('#datos_actividad').style.display = 'none'"></i>
            <div class="modal-header d-flex justify-content-center">
                <h4>Datos de actividad </h4>
            </div>
            <div class="col-md-12 p-3">
                <div class="scroll-modal mb-3">
                    <table class="table table-bordered text-body">
                        <thead align="center">
                            <tr>
                                <th>Actividad</th>
                                <th>Alumno</th>
                                <th>Días y horarios</th>
                                <th>Profe</th>
                            </tr>
                        </thead>
                        <tbody id="mostrar_datos_actividad">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div><?php }
}
