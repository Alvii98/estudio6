<?php
require_once '../clases/consultas.php';
$json = new StdClass();
$json->datos = '';
$json->error = '';


if (isset($_POST['apellido']) && isset($_POST['nombre'])) {
    $alumnos = array();
    
    foreach (datos::busqueda_historico(trim($_POST['apellido']),trim($_POST['nombre'])) as $value) {
        $alumnos[] = ['foto_perfil' => file_exists('../'.$value['foto_perfil']) && !empty($value['foto_perfil']) ? $value['foto_perfil'] : 'img/icono.jpg',
                    'apellido' => $value['apellido'],
                    'nombre' => $value['nombre'],
                    'edad' => $value['edad'],
                    'fecha_nac' => empty($value['fecha_nac']) ? '' : date("d/m/Y", strtotime($value['fecha_nac'])),
                    'tel_movil' => $value['tel_movil'],
                    'baja' => empty($value['baja']) ? '' : date("d/m/Y", strtotime($value['baja']))];
    }

    $json->datos = $alumnos;
}


print json_encode($json);
?>