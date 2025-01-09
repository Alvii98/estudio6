<?php
require_once '../clases/consultas.php';
$json = new StdClass();

$datos = json_decode(file_get_contents('php://input'));
if(isset($datos->id_actividad)){
    $id_actividad = $datos->id_actividad;

    $json->respActividad = datos::actividades($id_actividad);

}else if(isset($datos->guardar_actividad)){

    $id = $datos->guardar_actividad->id_guardar_id;

    if (isset($datos->guardar_actividad->eliminar_actividad_bdd)) {
        $json->respGuardarActividad = datos::delete_actividades($id);
    }else {
        $actividad = $datos->guardar_actividad->id_guardar_actividad;
        $una = $datos->guardar_actividad->id_guardar_una;
        $una_efec = $datos->guardar_actividad->id_guardar_una_efectivo;
        $dos = $datos->guardar_actividad->id_guardar_dos;
        $dos_efec = $datos->guardar_actividad->id_guardar_dos_efectivo;
        $dias = $datos->guardar_actividad->id_guardar_dias;
        $profe = $datos->guardar_actividad->id_guardar_profe;
        $edadMin = $datos->guardar_actividad->id_guardar_edad_min;
        $edadMax = $datos->guardar_actividad->id_guardar_edad_max;
        $cupos = $datos->guardar_actividad->id_guardar_cupos;

        if($id == 0){
            $json->respGuardarActividad = datos::insert_actividades($id,$actividad,$una,$una_efec,$dos,$dos_efec,$dias,$profe,$edadMin,$edadMax,$cupos);
        }else{
            $json->respGuardarActividad = datos::update_actividades($id,$actividad,$una,$una_efec,$dos,$dos_efec,$dias,$profe,$edadMin,$edadMax,$cupos);
        }
    }
}else if(isset($datos->datosDescuentos)){
    $descuento_actividad = $datos->datosDescuentos->descuento_actividad;
    $descuento_familiar = $datos->datosDescuentos->descuento_familiar;
    
    $json->respGuardarDescuentos = datos::descuentos($descuento_actividad,$descuento_familiar);
}else{
    $id_alumno = $datos->alumnos->id_alumno;
    $nom_vinculo = $datos->alumnos->nom_vinculo;

    if($nom_vinculo == '0') $nom_vinculo = $datos->alumnos->nom_vinculo_nuevo;
    
    if(isset($datos->alumnos->desvincular)){
        $json->respVinculo = datos::delete_vinculo($id_alumno,$nom_vinculo);
    }else{
        $json->respVinculo = datos::insert_vinculo($id_alumno,$nom_vinculo);
    }
}

print json_encode($json);

?>