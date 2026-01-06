<?php
require_once '../clases/consultas.php';

$json = new StdClass();
$json->respAlumno = false;
$json->respFamiliar = false;
$json->respActividad = '';
$json->datos = '';
$json->error = '';
// $_POST['documento'] = '50700479';
if (isset($_POST['documento'])) {
    $datos = datos::alumno_dni($_POST['documento']);
    $alumno = array();
    $familiar = array();
    if (!empty($datos)) {
        foreach ($datos as $value) {
            $fam = $value['nombre_apellido'];
            if (!empty($fam)) {
                $apellido_fam = '';
                $nombre_fam = '';
                if (strlen(explode(' ',$fam)[0]) < 3 || count(explode(' ',$fam)) > 3) {
                    $apellido_fam = explode(' ',$fam)[0].' '.explode(' ',$fam)[1];
                    for ($i=1; $i < count(explode(' ',$fam)); $i++) { 
                        $nombre_fam .= ' '.explode(' ',$fam)[$i];
                    }
                }else {
                    $apellido_fam = explode(' ',$fam)[0];
                    for ($i=1; $i < count(explode(' ',$fam)); $i++) { 
                        $nombre_fam .= ' '.explode(' ',$fam)[$i];
                    }
                }
            }
            $familiar[] = ['apellido_fam' => $apellido_fam,
                'nombre_fam' => $nombre_fam,
                'vinculo' => $value['vinculo'],
                'telefono' => $value['telefono']
            ];
        }
        $alumno[] = ['apellido' => $datos[0]['apellido'],
                'nombre' => $datos[0]['nombre'],
                'documento' => $datos[0]['documento'],
                'mail' => $datos[0]['mail'],
                'nacionalidad' => $datos[0]['nacionalidad'],
                'localidad' => $datos[0]['localidad'],
                'domicilio' => $datos[0]['domicilio'],
                'fecha_nac' => $datos[0]['fecha_nac'],
                'edad' => datos::obtener_edad($datos[0]['fecha_nac']),
                'tel_movil' => $datos[0]['tel_movil'],
                'apellido_fam' => $apellido_fam,
                'nombre_fam' => $nombre_fam,
                'vinculo' => $datos[0]['vinculo'],
                'telefono' => $datos[0]['telefono'],
                'familiares' => $familiar
            ];
        $json->datos = $alumno;
    }else {
        $json->error = 'No encontramos datos con ese documento.';
    }
}else {
    $datos = json_decode(file_get_contents('php://input'));
    if (!empty($datos)) {
        if (!empty(datos::alumno_dni($datos->alumno->documento,'EXISTE'))) {
            $json->error = 'El alumno ya fue registrado.';
        }else {
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
                            'salud' => $datos->alumno->salud,
                            'observacion_alumno' => isset($datos->alumno->observacion) ? $datos->alumno->observacion : ''];
        
            $actividades = $datos->alumno->actividades;
        
            foreach ($actividades as $value) {
                $dispon = datos::actividad_disponible($value)[0];
                if ($dispon['disponibles'] < 1) {
                    $json->respActividad = 'No hay mas cupos para la actividad '.$dispon['actividad'].' - '.$dispon['dias_horarios'].'.';
                    print json_encode($json);
                    exit;
                }
            }
        
            $id_alumno = datos::insert_datos($array_insert,$actividades);
            // datos::actualizar_historico();
            if (is_int($id_alumno)) {
                $json->respAlumno = true;
        
                if (isset($datos->alumno->adulto_apellido)) {
                    $array_insert = ['id_alumno' => $id_alumno,
                        'nom_ape' => $datos->alumno->adulto_apellido.' '.$datos->alumno->adulto_nombre,
                        'vinculo' => $datos->alumno->adulto_vinculo,
                        'tel_familiar' => $datos->alumno->adulto_telefono,
                        'observacion_familiar' => ''];
        
                    $json->respFamiliar = datos::insert_familiar($array_insert);
                }
                if (isset($datos->alumno->adulto2_apellido) && $json->respFamiliar){
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
                if (isset($datos->alumno->tercero2_apellido) && $json->respFamiliar){
                    $array_insert = ['id_alumno' => $id_alumno,
                        'nom_ape' => $datos->alumno->tercero2_apellido.' '.$datos->alumno->tercero2_nombre,
                        'vinculo' => $datos->alumno->tercero2_vinculo,
                        'tel_familiar' => $datos->alumno->tercero2_telefono,
                        'observacion_familiar' => ''];
                    $json->respFamiliar = datos::insert_familiar($array_insert);
                }
            }else {
                $json->respAlumno = false;
            }
        }
    }else {
        $json->error = 'Faltan parametros.';
    }
}
print json_encode($json);
?>