<?php
require_once '../clases/consultas.php';
$json = new StdClass();
if(isset($_POST['baja'])){
    $json->respAlumno = datos::baja_alumno($_POST['id_alumno'],$_POST['baja']);
}elseif(isset($_POST['debe_mes'])){
    $json->respAlumno = datos::debe_mes($_POST['id_alumno'],$_POST['debe_mes']);
}elseif(isset($_POST['debe_mes_vinculo'])){
    $json->respAlumno = datos::debe_mes_vinculo($_POST['nombre_vinculo'],$_POST['debe_mes_vinculo']);
}elseif(isset($_POST['info_deuda'])){
    if(isset($_POST['id_alumno'])){
        $json->respAlumno = datos::info_deuda_alumno($_POST['id_alumno'],$_POST['info_deuda']);
    }elseif (isset($_POST['nombre_vinculo'])) {
        $json->respAlumno = datos::info_deuda_vinculo($_POST['nombre_vinculo'],$_POST['info_deuda']);
    }else{
        $json->respAlumno = false;
    }
}else{

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
        $success = file_put_contents($file, $data);
    }

    $array_update = ['id_alumno' => $datos->alumno->id_alumno,
    'apellido' => $datos->alumno->apellido,
    'nombre' => $datos->alumno->nombre,
    'foto_perfil' => $file,
    'fecha_nac' => $datos->alumno->fecha_nac,
    'edad' => $datos->alumno->edad,
    'nacionalidad' => $datos->alumno->nacionalidad,
    'documento' => $datos->alumno->documento,
    'domicilio' => $datos->alumno->domicilio,
    'localidad' => $datos->alumno->localidad,
    'autoriza' => $datos->alumno->autoriza,
    'tel_alumno' => $datos->alumno->tel_alumno,
    'correo' => $datos->alumno->correo,
    'actividad' => '',
    'salud' => $datos->alumno->salud,
    'notas' => $datos->alumno->notas,
    'observacion_alumno' => $datos->alumno->observacion_alumno];
    
    $json->respAlumno = datos::update_alumnos($array_update);
    $json->respActividades = datos::update_actividades_alumno($datos->alumno->id_alumno,$datos->alumno->actividades);
    
    foreach ($datos->familiares as $key) {
        $json->respFamiliar = datos::update_familiares($key->id_familiar,$key->nom_ape,$key->vinculo,$key->tel_familiar,$key->observacion_familiar);
    }
}
    
print json_encode($json);
?>