<?php
require_once '../clases/consultas.php';

$json = new StdClass();

$apellido = trim($_POST['apellido']);
$nombre = trim($_POST['nombre']);
$edad = trim($_POST['edad']);
$actividad = trim($_POST['actividad']);

$datos = datos::busqueda($apellido,$nombre,$edad,$actividad);

$alumnos = array();
$foto_rota = array();
$foto = true;
$id = 0;
$cant_alumnos = 0;
$cant_bajas = 0;
$cant_familiares = 0;

foreach ($datos as $value) {
    if($value['edad'] != datos::obtener_edad($value['fecha_nac'])){
        datos::update_acomodar_edad($value['id'],datos::obtener_edad($value['fecha_nac']));
    }
    $value['actividad'] = is_null($value['actividad']) ? '' : $value['actividad'];
    if((!file_exists('../'.$value['foto_perfil']) && $value['baja'] == 0) || ($value['foto_perfil'] == '' && $value['baja'] == 0)) {
        if ($id == $value['id']) {
            $ultimo_alumno = end($foto_rota);
            $ultimo_alumno['actividad'] = $ultimo_alumno['actividad'].' <br> '.$value['actividad'].' - '.$value['dias_horarios'];
            $foto_rota[key($foto_rota)] = $ultimo_alumno;        
            continue;
        }
        $id = $value['id'];

        if (empty($value['baja'])) $cant_alumnos = $cant_alumnos + 1;
        else $cant_bajas = $cant_bajas + 1;

        $foto_rota[] = ['id' => $value['id'],
        'apellido' => $value['apellido'],
        'nombre' => $value['nombre'],
        'vinculo' =>'Sin vinculo',
        'baja' =>$value['baja'],
        'edad' => datos::obtener_edad($value['fecha_nac']),
        'actividad' => $value['actividad'].' - '.$value['dias_horarios']];

        continue;
    }
    if ($id == $value['id']) {
        $ultimo_alumno = end($alumnos);
        $ultimo_alumno['actividad'] = $ultimo_alumno['actividad'].'<br>'.$value['actividad'].' - '.$value['dias_horarios'];
        $alumnos[key($alumnos)] = $ultimo_alumno;        
        continue;
    }
    $id = $value['id'];
    if (empty($value['baja'])) $cant_alumnos = $cant_alumnos + 1;
    else $cant_bajas = $cant_bajas + 1;
    $alumnos[] = ['id' => $value['id'],
                'apellido' => $value['apellido'],
                'nombre' => $value['nombre'],
                'vinculo' =>'Sin vinculo',
                'baja' =>$value['baja'],
                'edad' => datos::obtener_edad($value['fecha_nac']),
                'actividad' => $value['actividad'].' - '.$value['dias_horarios']];
}

if((empty($nombre) && empty($edad) && empty($actividad)) || !empty($apellido) ){

    $datos2 = datos::busqueda_familiar($apellido);
    $vinculo = '';

    foreach ($datos2 as $value) {
        if($vinculo == $value['vinculo']) continue;
        $vinculo = $value['vinculo'];
        $cant_familiares = $cant_familiares + 1;

        $alumnos[] = ['id' => '0',
        'apellido' => $value['vinculo'],
        'nombre' => '',
        'vinculo' => 'Familia',
        'baja' => '',
        'edad' => '',
        'actividad' => ''];
    }
}
$json->datos = $alumnos ;
$json->foto_rota = $foto_rota;
$json->cant_alumnos = $cant_alumnos;
$json->cant_bajas = $cant_bajas;
$json->cant_familiares = $cant_familiares;

print json_encode($json);

?>