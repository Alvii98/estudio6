<?php
require_once '../clases/consultas.php';
$json = new StdClass();
$json->datosAlumno = '';
$json->erro = '';

$datos = json_decode(file_get_contents('php://input'));
$json->datosAlumno = $datos->alumno;


$array_insert = ['apellido' => $datos->alumno->apellido,
                'nombre' => $datos->alumno->nombre,
                'foto_perfil' => '',
                'fecha_nac' => $datos->alumno->fecha_nac,
                'edad' => $datos->alumno->edad,
                'nacionalidad' => $datos->alumno->nacionalidad,
                'documento' => $datos->alumno->documento,
                'domicilio' => $datos->alumno->domicilio,
                'localidad' => $datos->alumno->localidad,
                'autoriza' => isset($datos->alumno->autoriza) ? $datos->alumno->autoriza : '',
                'tel_alumno' => isset($datos->alumno->telefono) ? $datos->alumno->telefono : '',
                'correo' => $datos->alumno->correo,
                'actividad' => '',
                'salud' => $datos->alumno->salud,
                'observacion_alumno' => isset($datos->alumno->observacion_alumno) ? $datos->alumno->observacion_alumno : ''];

$actividades = $datos->alumno->actividades;
$id_alumno = datos::insert_datos($array_insert,$actividades);

if (isset($datos->alumno->adulto_apellido)) {
    $array_insert = ['id_alumno' => $id_alumno,
        'nom_ape' => $datos->alumno->adulto_apellido.' '.$datos->alumno->adulto_nombre,
        'vinculo' => $datos->alumno->adulto_vinculo,
        'tel_familiar' => $datos->alumno->adulto_telefono,
        'observacion_familiar' => ''];

    $json->respFamiliar = datos::insert_familiar($array_insert);
}
if (isset($datos->alumno->adulto2_apellido)){
    $array_insert = ['id_alumno' => $id_alumno,
        'nom_ape' => $datos->alumno->adulto2_apellido.' '.$datos->alumno->adulto2_nombre,
        'vinculo' => $datos->alumno->adulto2_vinculo,
        'tel_familiar' => $datos->alumno->adulto2_telefono,
        'observacion_familiar' => ''];
    $json->respFamiliar = datos::insert_familiar($array_insert);
}

if (isset($datos->alumno->tercero_apellido)) {
    $array_insert = ['id_alumno' => $id_alumno,
        'nom_ape' => $datos->alumno->tercero_apellido.' '.$datos->alumno->tercero_nombre,
        'vinculo' => $datos->alumno->tercero_vinculo,
        'tel_familiar' => $datos->alumno->tercero_telefono,
        'observacion_familiar' => ''];

    $json->respFamiliar = datos::insert_familiar($array_insert);
}
if (isset($datos->alumno->tercero2_apellido)){
    $array_insert = ['id_alumno' => $id_alumno,
        'nom_ape' => $datos->alumno->tercero2_apellido.' '.$datos->alumno->tercero2_nombre,
        'vinculo' => $datos->alumno->tercero2_vinculo,
        'tel_familiar' => $datos->alumno->tercero2_telefono,
        'observacion_familiar' => ''];
    $json->respFamiliar = datos::insert_familiar($array_insert);
}

print json_encode($json);
?>