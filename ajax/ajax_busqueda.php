<?php
error_reporting(0);
require_once '../clases/consultas.php';

$json = new StdClass();

$datos = datos::busqueda(trim($_POST['apellido']),trim($_POST['nombre']),trim($_POST['edad']),trim($_POST['actividad']));

$alumnos = array();
$foto_rota = array();
$foto = true;
$id = 0;
foreach ($datos as $value) {
    if($value['edad'] != datos::obtener_edad($value['fecha_nac'])){
        datos::update_acomodar_edad($value['id'],datos::obtener_edad($value['fecha_nac']));
    }
    if(!file_exists('../'.$value['foto_perfil']) || $value['foto_perfil'] == '') {
        // try {
        //     $foto = getimagesize('../'.$value['foto_perfil']);
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     $error = $th;
        //     $foto = false;
        // }
        // if($foto === false){

            if ($id == $value['id']) {
                $ultimo_alumno = end($foto_rota);
                $ultimo_alumno['actividad'] = utf8_encode($ultimo_alumno['actividad'].' <br> '.$value['actividad']);
                $foto_rota[key($foto_rota)] = $ultimo_alumno;        
                continue;
            }
            $id = $value['id'];

            $foto_rota[] = ['id' => utf8_encode($value['id']),
            'apellido' => utf8_encode($value['apellido']),
            'nombre' => utf8_encode($value['nombre']),
            'vinculo' =>'Sin vinculo',
            'baja' =>utf8_encode($value['baja']),
            'edad' => datos::obtener_edad($value['fecha_nac']),
            'actividad' => utf8_encode($value['actividad'])];

            continue;
        // }
    }
    if ($id == $value['id']) {
        $ultimo_alumno = end($alumnos);
        $ultimo_alumno['actividad'] = utf8_encode($ultimo_alumno['actividad'].'<br>'.$value['actividad']);
        $alumnos[key($alumnos)] = $ultimo_alumno;        
        continue;
    }
    $id = $value['id'];

    $alumnos[] = ['id' => $value['id'],
                'apellido' => utf8_encode($value['apellido']),
                'nombre' => utf8_encode($value['nombre']),
                'vinculo' =>'Sin vinculo',
                'baja' =>utf8_encode($value['baja']),
                'edad' => datos::obtener_edad($value['fecha_nac']),
                'actividad' => utf8_encode($value['actividad'])];
}
if(!empty(trim($_POST['apellido']))){

    $datos2 = datos::busqueda_familiar(trim($_POST['apellido']));
    $vinculo = '';
    foreach ($datos2 as $value) {
        if($vinculo == $value['vinculo']) continue;
        $vinculo = $value['vinculo'];
        
        $alumnos[] = ['id' => '0',
        'apellido' => utf8_encode($value['vinculo']),
        'nombre' => '',
        'vinculo' => 'Familia',
        'baja' => '',
        'edad' => '',
        'actividad' => ''];
        
    }
}
$json->datos = $alumnos ;
$json->foto_rota = $foto_rota;

print json_encode($json);

?>