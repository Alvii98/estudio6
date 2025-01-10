<?php
require_once '../clases/consultas.php';
$json = new StdClass();
$json->respAlumno = '';
$json->error = '';
$datos = json_decode(file_get_contents('php://input'));
$file = '';
if(!empty($datos->alumno->foto_perfil)){
    $img = $datos->alumno->foto_perfil;
    if(strpos($img, 'data:image/png;base64,') !== FALSE){
        $img = str_replace('data:image/png;base64,', '', $img);
    }elseif (strpos($img, 'data:image/jpg;base64,') !== FALSE) {
        $img = str_replace('data:image/jpg;base64,', '', $img);
    }elseif (strpos($img, 'data:image/jpeg;base64,') !== FALSE) {
        $img = str_replace('data:image/jpeg;base64,', '', $img);
    }else{
        exit;
    }
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $now = new DateTime();
    $fechaCompleta = $now->format('Y').$now->format('m').$now->format('d').$now->format('H').$now->format('i').$now->format('s');
    $file = 'img/perfil/foto_'.$fechaCompleta.'.png';
    $success = file_put_contents('../'.$file, $data);
}
$array_insert = ['apellido' => $datos->alumno->apellido,
                'nombre' => $datos->alumno->nombre,
                'foto_perfil' => $file,
                'fecha_nac' => $datos->alumno->fecha_nac,
                'edad' => $datos->alumno->edad,
                'nacionalidad' => $datos->alumno->nacionalidad,
                'documento' => $datos->alumno->documento,
                'domicilio' => $datos->alumno->domicilio,
                'localidad' => $datos->alumno->localidad,
                'tel_fijo' => $datos->alumno->tel_fijo,
                'tel_alumno' => $datos->alumno->tel_alumno,
                'correo' => $datos->alumno->correo,
                'actividad' => '',
                'salud' => $datos->alumno->salud,
                'observacion_alumno' => $datos->alumno->observacion_alumno];

if(!empty(trim($array_insert['fecha_nac']))){
    $actividades = $datos->alumno->actividades;
    $json->respAlumno = datos::insert_datos($array_insert,$actividades);
    // $json->respAlumno = $array_insert;
}else{
    $json->error = 'Complete los campos requeridos';
}

print json_encode($json);
?>