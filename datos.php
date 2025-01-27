<?php
error_reporting(0);
require_once __DIR__.'/libs/smarty3.php';
require_once __DIR__.'/clases/consultas.php';
require_once __DIR__.'/clases/calcular_precio.php';

if(!isset($_GET['id']) && !isset($_GET['vinculo'])) header('Location: index.php');


$smarty->assign('ACTIVIDADES', datos::actividades());
$smarty->assign('CAMARA', $smarty->fetch('partials/camara.html'));
$smarty->assign('HEADER', $smarty->fetch('partials/header.html'));
$smarty->assign('FOOTER', $smarty->fetch('partials/footer.html'));
$smarty->assign('DEUDAS_ALUMNO', false);
$smarty->assign('DEUDAS_VINCULO', false);


if(isset($_GET['id'])){
    
    $smarty->assign('ID', $_GET['id']);
    $alumno = datos::alumno_id($_GET['id']);
    $smarty->assign('VINCULO', datos::busqueda_familiar('',$_GET['id'])[0]['vinculo']);
    
    if(empty($alumno)) header('Location: index.php');
    
    $deudas = datos::deudas_alumno($_GET['id']);
    if (empty($deudas)) {
        $deudas = array(array("enero" => 0,"febrero" => 0,"marzo" => 0,"abril" => 0,"mayo" => 0,"junio" => 0,
                "julio" => 0,"agosto" => 0,"septiembre" => 0,"octubre" => 0,"noviembre" => 0,"diciembre" => 0));
        $smarty->assign('ADEUDA', 0);
    }else {
        $smarty->assign('ADEUDA', number_format($deudas[0]['total'], 2, ',', ' '));
    }
    
    $smarty->assign('DEUDAS_ALUMNO', $deudas);
    $smarty->assign('MODAL_DEUDAS', $smarty->fetch('partials/modal.html'));
    $smarty->assign('ALUMNO', $alumno[0]);
    $smarty->assign('BAJA', $alumno[0]['baja']);
    $smarty->assign('APELLIDO', $alumno[0]['apellido']);
    $smarty->assign('NOMBRE', $alumno[0]['nombre']);
    $smarty->assign('FECHA_NAC', $alumno[0]['fecha_nac']);
    $smarty->assign('NOTAS', $alumno[0]['notas']);
    $smarty->assign('OBSERVACIONES', $alumno[0]['observaciones']);
    $smarty->assign('DOCUMENTO', $alumno[0]['documento']);
    $smarty->assign('MAIL', $alumno[0]['mail']);
    $smarty->assign('TEL_MOVIL', $alumno[0]['tel_movil']);
    $smarty->assign('AUTORIZA', $alumno[0]['autoriza']);
    $smarty->assign('NACIONALIDAD', $alumno[0]['nacionalidad']);
    $smarty->assign('LOCALIDAD', $alumno[0]['localidad']);
    $smarty->assign('DOMICILIO', $alumno[0]['domicilio']);
    $smarty->assign('SALUD', $alumno[0]['salud']);
    
    $smarty->assign('EDAD', datos::obtener_edad($alumno[0]['fecha_nac']));
    $smarty->assign('ACTIVIDADES_ALUMNO', datos::actividades_alumno($_GET['id']));
    $smarty->assign('FOTO', !file_exists($alumno[0]['foto_perfil']) ? 'img/icono.jpg' :$alumno[0]['foto_perfil']);
    
    $valores = valores::precio_por_alumno($_GET['id']);

    $smarty->assign('VALOR', round($valores['valor'], -2));
    $smarty->assign('COMBO', round($valores['combo'], -2));

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
        $alumno = datos::alumno_id($value['id_alumno']);

        $alumnos[] = array('id' => $value['id_alumno'],
                    'apellido' => $value['apellido'],
                    'nombre' => $value['nombre'],
                    'actividad' => datos::actividades_alumno($value['id_alumno']));
    }
    $deudas = datos::deudas_vinculo($_GET['vinculo']);
    if (empty($deudas)) {
        $deudas = array(array("enero" => 0,"febrero" => 0,"marzo" => 0,"abril" => 0,"mayo" => 0,"junio" => 0,
                "julio" => 0,"agosto" => 0,"septiembre" => 0,"octubre" => 0,"noviembre" => 0,"diciembre" => 0));
        $smarty->assign('ADEUDA', 0);
    }else {
        $smarty->assign('ADEUDA', round($deudas[0]['total'], -2));
    }
    $smarty->assign('DEUDAS_VINCULO', $deudas);
    $smarty->assign('MODAL_DEUDAS', $smarty->fetch('partials/modal.html'));
    $smarty->assign('VINCULO', $_GET['vinculo']);
    $smarty->assign('ALUMNOS', $alumnos);

    $valores = valores::precio_por_familia($alumnos);

    $smarty->assign('VALOR', round($valores['valor'], -2));
    $smarty->assign('COMBO', round($valores['combo'], -2));

    if (!isset($_SESSION['USUARIO'])) {
        $smarty->display('login.html');
    }else {
        $smarty->display('datos_vinculo.html');
    }
}
?>