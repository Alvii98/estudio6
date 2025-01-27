<?php
require_once __DIR__.'/consultas.php';

class valores{
    static public function precio_por_alumno($id_alumno){

        $actividad_valores = datos::actividades_alumno_valor($id_alumno);
        $valor = 0;
        $combo = 0;
        $cantidad = 0;
        foreach ($actividad_valores as $value) {
            $cantidad = $cantidad + 1;
            // Array_count_value agrupa las actividades repetidas
            // Si hay una que esta 2 o mas veces se le cobra el valor 2
            if($value['cantidad'] >= 2){
                $valor = $valor + intval($value['dos_veces']);
                // $combo = $valor;
            }else{
                $valor = $valor + intval($value['una_vez']);
                // $combo = $valor;
            } 
        }
        // 10% de descuento por hacer mas de 1 actividad / Se cambio al 7% 14/04/2024
        if($cantidad > 1){
            $descuento = datos::administracion()[0]['descuento'];
            $porcentaje = intval($valor) * $descuento / 100;
            $combo = intval($valor) - $porcentaje;
        }

        return ['valor' => intval($valor),'combo' => intval($combo)];
    }

    static public function precio_por_familia($alumnos){
        $valor = 0;
        $combo = 0;
        foreach ($alumnos as $value) {
            $valores = valores::precio_por_alumno($value['id']);
            $valor = $valor + intval($valores['valor']);
        }
        // 10% de descuento por ser familiares / Se cambio al 7% 14/04/2024
        $descuento = datos::administracion()[0]['descuento'];
        $porcentaje = intval($valor) * $descuento / 100;
        $combo = intval($valor) - $porcentaje;

        return ['valor' => intval($valor),'combo' => intval($combo)];
    }
}

?>