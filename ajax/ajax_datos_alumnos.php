<?php
require_once '../clases/consultas.php';

$json = new StdClass();
$datos = datos::datos_excel();
$id = 0;
foreach ($datos as $value) {
    $value['actividad'] = is_null($value['actividad']) ? '' : $value['actividad'];

    if ($id == $value['id']) {
        $ultimo_alumno = end($alumnos);
        $ultimo_alumno['actividad'] = $ultimo_alumno['actividad'].', '.$value['actividad'];
        $alumnos[key($alumnos)] = $ultimo_alumno;        
        continue;
    }
    $id = $value['id'];

    $alumnos[] = ['id' => $value['id'],
                'apellido' => $value['apellido'],
                'nombre' => $value['nombre'],
                'documento' => $value['documento'],
                'fecha_nac' => $value['fecha_nac'],
                'edad' => datos::obtener_edad($value['fecha_nac']),
                'nacionalidad' => $value['nacionalidad'],
                'localidad' => $value['localidad'],
                'domicilio' => $value['domicilio'],
                'tel_movil' => $value['tel_movil'],
                'autoriza' => $value['autoriza'],
                'mail' => $value['mail'],
                'salud' => $value['salud'],
                'notas' => $value['notas'],
                'observaciones' => $value['observaciones'],
                'baja' =>$value['baja'],
                'actividad' => $value['actividad']];
}

$datosFam = datos::familiares();

$json->resp = $alumnos;
$json->resp2 = $datosFam;

print json_encode($json);

?>