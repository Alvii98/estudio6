<?php
require_once '../clases/consultas.php';
$json = new StdClass();

if(isset($_POST['actualizar_deudas'])){
    $json->actualizar = datos::actualizar_deudas();
}else if(isset($_POST['inscripciones'])){
    $op = $_POST['op'];
    if ($op != 1 && $op != 0) $op = 0;
    $json->respAlumno = datos::acceso_inscripciones($op);
}else if(isset($_POST['baja'])){
    $json->respAlumno = datos::baja_alumno($_POST['id_alumno'],$_POST['baja']);
}else{

    $datos = json_decode(file_get_contents('php://input'));

    $array_update = ['id_alumno' => $datos->alumno->id_alumno,
    'apellido' => $datos->alumno->apellido,
    'nombre' => $datos->alumno->nombre,
    'fecha_nac' => $datos->alumno->fecha_nac,
    'edad' => $datos->alumno->edad,
    'nacionalidad' => $datos->alumno->nacionalidad,
    'documento' => $datos->alumno->documento,
    'domicilio' => $datos->alumno->domicilio,
    'localidad' => $datos->alumno->localidad,
    'autoriza' => $datos->alumno->autoriza,
    'tel_alumno' => $datos->alumno->tel_alumno,
    'correo' => $datos->alumno->correo,
    'salud' => $datos->alumno->salud,
    'notas' => $datos->alumno->notas,
    'observacion_alumno' => $datos->alumno->observacion_alumno];
    try {
        if (datos::update_alumnos($array_update) === true) {
            $json->respAlumno = true;
        }else {
            $json->respAlumno = false;
        }
    } catch (\Throwable $th) {
        $json->respAlumno = false;
    }
    try {
        if (datos::update_actividades_alumno($datos->alumno->id_alumno,$datos->alumno->actividades) === true) {
            $json->respActividades = true;
        }else {
            $json->respActividades = false;
        }
    } catch (\Throwable $th) {
        $json->respActividades = $th;
    }
    $fam = 0;
    foreach ($datos->familiares as $key) {
        if (datos::update_familiares($key->id_familiar,$key->nom_ape,$key->vinculo,$key->tel_familiar,$key->observacion_familiar) === true) {
            $json->respFamiliar = true;
        }else {
            $fam = 1;
        }
    }
    if ($fam == 1) {
        $json->respFamiliar = false;
    }
}
    
print json_encode($json);
?>