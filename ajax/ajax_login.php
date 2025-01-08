<?php
if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    if ($_POST['usuario'] == 'administrador' && $_POST['clave'] == '4dmin') {
        session_start();
        $_SESSION['USUARIO'] = 'Administador';
    }else {
        session_destroy();
    }
}else {
    session_destroy();
}
