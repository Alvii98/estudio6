<?php
require_once __DIR__.'/consultas.php';

class valores{
    static public function precio_por_alumno($actividades){
        $actividad = array();
        $actividad_valores = array();
        foreach ($actividades as $value) {
            if($value == '') continue;
            $valor_actividad = datos::actividad_valores($value);
            $actividad_valores[] = $valor_actividad[0];
            $actividad[] = $valor_actividad[0]['actividad'];
        }
        // Ordeno array alfabeticamente
        sort($actividad_valores); 
        $valor = 0;
        $efectivo = 0;
        $combo = 0;
        $temporal = '';
        foreach ($actividad_valores as $value) {
            // Array_count_value agrupa las actividades repetidas
            // Si hay una que esta 2 o mas veces se le cobra el valor 2
            if(array_count_values($actividad)[$value['actividad']] >= 2){
                if($temporal == $value['actividad']) continue;
    
                $temporal = $value['actividad'];
                $valor = $valor + $value['dos_veces'];
                $efectivo = $efectivo + $value['dos_veces_efec'];
                $combo = $efectivo;
            }else{
                $valor = $valor + $value['una_vez'];
                $efectivo = $efectivo + $value['una_vez_efec'];
                $combo = $efectivo;
            } 
        }
        // 10% de descuento por hacer mas de 1 actividad / Se cambio al 7% 14/04/2024
        if(count(array_count_values($actividad)) >= 2){
            datos::agregar_campo_tablabdd();
            $descuento = datos::actividades()[0]['descuento_actividad'];
            $porcentaje = intval($combo) * $descuento / 100;
            $combo = intval($combo) - $porcentaje;
        }else{
            $combo = 0;
        }

        return ['valor' => $valor,'efectivo' => $efectivo,'combo' => $combo];
    }

    static public function precio_por_familia($alumnos){
        $valor = 0;
        $efectivo = 0;
        $combo = 0;
        foreach ($alumnos as $value) {
            $valores = valores::precio_por_alumno($value['actividad']);

            $valor = $valor + intval($valores['valor']);
            $efectivo = $efectivo + intval($valores['efectivo']);
            $combo = $efectivo;
        }
        // 10% de descuento por ser familiares / Se cambio al 7% 14/04/2024
        datos::agregar_campo_tablabdd();
        $descuento = datos::actividades()[0]['descuento_familiar'];
        $porcentaje = $combo * $descuento  / 100;
        $combo = $combo - $porcentaje;

        return ['valor' => $valor,'efectivo' => $efectivo,'combo' => $combo];
    }
}

?>