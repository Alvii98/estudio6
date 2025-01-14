<?php
error_reporting(0);
require_once __DIR__.'/libs/smarty3.php';
require_once __DIR__.'/clases/consultas.php';
require_once __DIR__.'/clases/calcular_precio.php';

if(!isset($_GET['id']) && !isset($_GET['vinculo'])) header('Location: index.php');

// $combo_actividades = datos::actividades();

$smarty->assign('ACTIVIDADES', datos::actividades());
$smarty->assign('CAMARA', $smarty->fetch('partials/camara.html'));
$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));

if(isset($_GET['id'])){
    
    $smarty->assign('ID', $_GET['id']);
    $alumno = datos::alumno_id($_GET['id']);
    $smarty->assign('VINCULO', datos::busqueda_familiar('',$_GET['id'])[0]['vinculo']);
    
    if(empty($alumno)) header('Location: index.php');
    
    $smarty->assign('ALUMNO', $alumno[0]);
    $smarty->assign('BAJA', $alumno[0]['baja']);
    $smarty->assign('DEBEMES', $alumno[0]['debemes']);
    $smarty->assign('INFO_DEUDA', $alumno[0]['info_deuda']);
    $smarty->assign('APELLIDO', $alumno[0]['apellido']);
    $smarty->assign('NOMBRE', $alumno[0]['nombre']);
    $smarty->assign('FECHA_NAC', $alumno[0]['fecha_nac']);
    $smarty->assign('NOTAS', $alumno[0]['notas']);
    $smarty->assign('OBSERVACIONES', $alumno[0]['observaciones']);
    $smarty->assign('DOCUMENTO', $alumno[0]['documento']);
    $smarty->assign('MAIL', $alumno[0]['mail']);
    $smarty->assign('TEL_MOVIL', $alumno[0]['tel_movil']);
    $smarty->assign('TEL_FIJO', $alumno[0]['tel_fijo']);
    $smarty->assign('NACIONALIDAD', $alumno[0]['nacionalidad']);
    $smarty->assign('LOCALIDAD', $alumno[0]['localidad']);
    $smarty->assign('DOMICILIO', $alumno[0]['domicilio']);
    $smarty->assign('SALUD', $alumno[0]['salud']);
    $smarty->assign('NACIONALIDAD', $alumno[0]['localidad']);
    
    $smarty->assign('EDAD', datos::obtener_edad($alumno[0]['fecha_nac']));
    $smarty->assign('ACTIVIDADES_ALUMNO', datos::actividades_alumno($_GET['id']));
    $smarty->assign('FOTO', !file_exists($alumno[0]['foto_perfil']) ? 'img/icono.jpg' :$alumno[0]['foto_perfil']);
    
    $valores = valores::precio_por_alumno($_GET['id']);

    $valor = number_format($valores['valor'], 2, ',', ' ');
    $combo = number_format($valores['combo'], 2, ',', ' ');

    $smarty->assign('VALOR', $valor);
    $smarty->assign('COMBO', $combo);

    $smarty->assign('FAMILIAR', datos::familiar($_GET['id']));
    // print'<pre>';print_r(datos::actividades());exit;
    if (!isset($_SESSION['USUARIO'])) {
        $smarty->display('login.html');
    }else {
        $smarty->display('datos.html');
    }

}elseif(isset($_GET['vinculo'])){

    $vinculos = datos::busqueda_familiar_datos($_GET['vinculo']);
    $alumnos = array();
    foreach ($vinculos as $value) {
        $debemes = $value['debemes'];
        $debe_info = $value['info_deuda'];
        $alumno = datos::alumno_id($value['id_alumno']);

        $alumnos[] = array('id' => $alumno[0]['id'],
                    'apellido' => $alumno[0]['apellido'],
                    'nombre' => $alumno[0]['nombre'],
                    'actividad' => '');
    }
    // print'<pre>';print_r($alumnos);exit;
    $smarty->assign('VINCULO', $_GET['vinculo']);
    $smarty->assign('DEBEMES', $debemes);
    $smarty->assign('DEBE_INFO', $debe_info);
    $smarty->assign('ALUMNOS', $alumnos);

    $valores = valores::precio_por_familia($alumnos);
    
    $valor = number_format($valores['valor'], 2, ',', ' ');
    $efectivo = number_format($valores['efectivo'], 2, ',', ' ');
    $combo = number_format($valores['combo'], 2, ',', ' ');
    
    $smarty->assign('VALOR', $valor);
    $smarty->assign('EFECTIVO', $efectivo);
    $smarty->assign('COMBO', $combo);

    if (!isset($_SESSION['USUARIO'])) {
        $smarty->display('login.html');
    }else {
        $smarty->display('datos_vinculo.html');
    }
}
?>