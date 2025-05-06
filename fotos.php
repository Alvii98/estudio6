<?php
require_once __DIR__.'/libs/smarty3.php';
require_once __DIR__.'/clases/consultas.php';

$fotos = glob('img/perfil/' . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
$fotos_data = [];
if (count($fotos) > 0) {
    foreach ($fotos as $foto) {
        $datos = datos::fotos_path($foto);
        if (!empty($datos)) {
            $datos[0]['tel_movil'] = ltrim($datos[0]['tel_movil'], '0');
            $datos[0]['tel_movil'] = ltrim($datos[0]['tel_movil'], '+54');
            $datos[0]['tel_movil'] = ltrim($datos[0]['tel_movil'], '54');
            $fotos_data[] = ['src' => $foto,
                'apellido' => $datos[0]['apellido'],
                'nombre' => $datos[0]['nombre'],
                'edad' => $datos[0]['edad'],
                'celular' => '+54'.$datos[0]['tel_movil']];
        }else unlink($foto);
    }
}
// print'<pre>';print_r($fotos_data);exit;
usort($fotos_data, function($a, $b) {
    return $b['edad'] <=> $a['edad'];
});
$smarty->assign('FOTOS', $fotos_data);
$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));

if (!isset($_SESSION['USUARIO'])) {
    $smarty->display('login.html');
}else {
    $smarty->display('fotos.html');
}