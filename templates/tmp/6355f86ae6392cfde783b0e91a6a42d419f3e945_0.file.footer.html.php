<?php
/* Smarty version 3.1.34-dev-7, created on 2026-01-26 16:00:05
  from 'C:\xampp\htdocs\estudio6\templates\partials\footer.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_697781755f28a7_06099646',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6355f86ae6392cfde783b0e91a6a42d419f3e945' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\partials\\footer.html',
      1 => 1767118348,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_697781755f28a7_06099646 (Smarty_Internal_Template $_smarty_tpl) {
?><header class="container-fluid border-top border-color pt-2 pb-2">
    <div class="row">
        <div class="col-md-12 custom-flex">
            <div class="col-md-8 form-group">
                <img src="img/logo-Negro.png" role="button" <?php if ($_smarty_tpl->tpl_vars['INSCRIPCIONES']->value) {?>onclick="location.href='index.php'"<?php }?> width="300px" height="60px">
            </div>
            <div class="col-md-4 form-group ml-2">
                <div class="col-md-12">
                    <label>Datos del desarrollador <i class="bi bi-laptop-fill"></i></label>
                </div>
                <div class="col-md-12">
                    <i class="bi bi-envelope h2 mr-5" onclick="location.href='mailto:alvaro.98@live.com.ar'"></i>
                    <i class="bi bi-linkedin h2 mr-5" onclick="window.open('https://www.linkedin.com/in/alvaro-caporaletti-68a104207/', '_blank')"></i>
                    <i class="bi bi-whatsapp h2" onclick="window.open('https://api.whatsapp.com/send?phone=5492346571470', '_blank')"></i>
                </div>
            </div>
        </div>
    </div>
</header><?php }
}
