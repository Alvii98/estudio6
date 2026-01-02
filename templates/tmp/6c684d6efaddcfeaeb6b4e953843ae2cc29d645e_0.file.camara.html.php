<?php
/* Smarty version 3.1.34-dev-7, created on 2026-01-02 21:55:54
  from 'C:\xampp\htdocs\estudio6\templates\partials\camara.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_695830da83d157_34257111',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c684d6efaddcfeaeb6b4e953843ae2cc29d645e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\estudio6\\templates\\partials\\camara.html',
      1 => 1767118348,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_695830da83d157_34257111 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="openModal" class="modalDialog" style="display: none;">
    <div class="container mt-5">
        <div class="row">
            <!-- <div class="col-md-12 float-right">
                <i class="bi bi-x-circle closee" role="button" id="close"></i>
            </div> -->
            <div class="col-md-12 d-flex justify-content-center mt-4">
                <!-- Aquí el video embebido de la webcam  -->
                <video id="video" class="video" playsinline autoplay></video>
                <canvas id="canvas" height="125" width="130" style="display: none;"></canvas>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <label id="datos_camara"></label>
            </div>
            <div class="col-md-12 d-flex justify-content-center">
                <label id="datos_camara"></label>
                <i class="bi bi-camera-fill" id="boton" role="button"></i>
            </div>
        </div>
    </div>
</div><?php }
}
