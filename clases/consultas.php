<?php
require_once __DIR__ . '/SingletonConexion.php';
class datos{
    static public function respuestaQuery($query){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    

        $datos_usuarios = mysqli_query($conn, $query);

        return $datos_usuarios->fetch_all(MYSQLI_ASSOC); 
    }
    static public function busqueda($ape,$nom,$edad,$activ){

        if(empty($edad)){
            $query = "SELECT a.id,a.apellido,a.nombre,a.edad,a.fecha_nac,a.baja,a.foto_perfil,av.actividad FROM alumnos a
            LEFT JOIN actividades_alumnos aa ON aa.id_alumno = a.id
            LEFT JOIN actividades_valores av ON av.id = aa.id_actividad
            WHERE a.apellido LIKE '%".$ape."%' AND a.nombre LIKE '%".$nom."%'
            ORDER BY CASE WHEN a.baja = 1 THEN 1 ELSE 0 END,a.apellido ASC";
            // $query = "SELECT a.id,a.apellido,a.nombre,a.edad,a.fecha_nac,a.actividad,a.baja,a.foto_perfil FROM alumnos a
            // WHERE a.apellido LIKE '%".$ape."%' AND a.nombre LIKE '%".$nom."%'
            // AND a.actividad LIKE '%".$activ."%' ORDER BY CASE WHEN a.baja = 1 THEN 1 ELSE 0 END,a.apellido ASC;";
        }else{
            $query = "SELECT a.id,a.apellido,a.nombre,a.edad,a.fecha_nac,a.baja,a.foto_perfil,av.actividad FROM alumnos a
            LEFT JOIN actividades_alumnos aa ON aa.id_alumno = a.id
            LEFT JOIN actividades_valores av ON av.id = aa.id_actividad
            WHERE a.edad = ".$edad." ORDER BY CASE WHEN a.baja = 1 THEN 1 ELSE 0 END,a.apellido ASC";
        }

        return datos::respuestaQuery($query);
    }
    static public function busqueda_familiar($vinculo,$id = ''){

        $query = "SELECT DISTINCT id_alumno,vinculo FROM vinculos WHERE id_alumno = ".$id;  
        
        if(empty($id)){
            $query = "SELECT DISTINCT id_alumno,vinculo FROM vinculos WHERE vinculo LIKE '%".$vinculo."%'";  
        }

        return datos::respuestaQuery($query);
    }

    static public function busqueda_familiar_datos($vinculo,$id = ''){

        $query = "SELECT DISTINCT id_alumno,vinculo,debemes,info_deuda FROM vinculos WHERE id_alumno = ".$id;  
        
        if(empty($id)){
            $query = "SELECT v.id_alumno,v.vinculo,v.debemes,v.info_deuda,a.apellido,a.nombre FROM vinculos v,alumnos a 
            WHERE v.vinculo = '".$vinculo."' AND v.id_alumno = a.id";
        }

        return datos::respuestaQuery($query);
    }

    static public function vinculos(){

        $query = "SELECT * FROM vinculos ORDER BY vinculo ASC";    

        return datos::respuestaQuery($query);
    }

    static public function datos_vinculo($vinculo){

        $query = "SELECT v.vinculo,CONCAT(a.apellido,' ',a.nombre) AS alumno 
        FROM vinculos v,alumnos a WHERE v.vinculo = '".$vinculo."' AND v.id_alumno = a.id ORDER BY 2";    

        return datos::respuestaQuery($query);
    }

    static public function alumnos(){

        $query = "SELECT * FROM alumnos ORDER BY apellido ASC";    

        return datos::respuestaQuery($query);
    }
    
    static public function alumno_id($id){

        $query = "SELECT * FROM alumnos WHERE id =".$id." LIMIT 1";    

        return datos::respuestaQuery($query);
    }

    static public function familiar($id){

        $query = "SELECT * FROM familiar WHERE id_alumno = ".$id;    

        return datos::respuestaQuery($query);
    }

    static public function familiares(){

        $query = "SELECT * FROM familiar ORDER BY nombre_apellido ASC";    

        return datos::respuestaQuery($query);
    }
    
    static public function actividades_alumno($id_alumno){

        $query = "SELECT av.id,av.actividad,av.una_vez,av.una_vez_efec FROM actividades_alumnos aa, actividades_valores av 
        WHERE aa.id_alumno = ".$id_alumno." AND aa.id_actividad = av.id ORDER BY 2";

        return datos::respuestaQuery($query);
    }

    static public function actividades_alumno_valor($id_alumno){

        $query = "SELECT av.id,av.actividad,av.una_vez,av.dos_veces,COUNT(av.id) as cantidad 
        FROM actividades_alumnos aa, actividades_valores av 
        WHERE aa.id_alumno = ".$id_alumno." AND aa.id_actividad = av.id GROUP BY av.actividad ORDER BY 2";

        return datos::respuestaQuery($query);
    }

    static public function actividades($id_actividad = ''){

        $query = "SELECT * FROM actividades_valores WHERE id =".$id_actividad;

        if (empty($id_actividad)) {
            $query = "SELECT av.*, (av.cupos - (SELECT COUNT(aa.id_actividad) FROM actividades_alumnos aa
            JOIN alumnos a ON a.id = aa.id_alumno WHERE aa.id_actividad = av.id AND a.baja = 0)) AS disponibles
            FROM actividades_valores av GROUP BY av.id ORDER BY av.actividad ASC";    
        }

        return datos::respuestaQuery($query);
    }

    static public function descuentos_actividades(){

        $query = "SELECT descuento_actividad,descuento_familiar FROM actividades_valores 
        WHERE descuento_actividad <> 0 AND descuento_familiar <> 0 LIMIT 1";    

        return datos::respuestaQuery($query);
    }

    static public function actividad_valores($actividad){

        $query = "SELECT actividad,una_vez,una_vez_efec,dos_veces,dos_veces_efec FROM actividades_valores 
        WHERE actividad LIKE '%".$actividad."%'";
        return datos::respuestaQuery($query);
    }
    static public function vinculo_existe($id_alumno,$nom_vinculo){

        $query = "SELECT * FROM vinculos WHERE id_alumno = ".$id_alumno." AND vinculo = '".$nom_vinculo."'";

        return datos::respuestaQuery($query);
    }
    
    static public function datos_actividad($id_actividad){

        $query = "SELECT CONCAT(a.apellido,' ',a.nombre) as alumno,av.actividad,av.dias_horarios,av.profe 
        FROM actividades_alumnos aa, actividades_valores av,alumnos a 
        WHERE aa.id_actividad = ".$id_actividad." AND av.id = aa.id_actividad AND a.id = aa.id_alumno AND a.baja = 0 ORDER BY 1";

        return datos::respuestaQuery($query);
    }

    static public function insert_datos($array,$actividades){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();

        $query = "INSERT INTO alumnos(apellido, nombre, foto_perfil, fecha_nac, edad, nacionalidad, documento,
        domicilio, localidad, tel_fijo, tel_movil, mail, actividad, salud, observaciones) VALUES 
        ('".$array['apellido']."','".$array['nombre']."','".$array['foto_perfil']."','".$array['fecha_nac']."',".$array['edad'].",'".$array['nacionalidad']."',
        '".$array['documento']."','".$array['domicilio']."','".$array['localidad']."','".$array['tel_fijo']."','".$array['tel_alumno']."',
        '".$array['correo']."','".$array['actividad']."','".$array['salud']."','".$array['observacion_alumno']."')";
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        $id_alumno = mysqli_insert_id($conn);
        if (is_int($id_alumno)) {
            foreach ($actividades as $value) {
                $query = "INSERT INTO actividades_alumnos(id_alumno,id_actividad) VALUES (".$id_alumno.",".$value.")";
                if (!mysqli_query($conn, $query)) {
                    return mysqli_error($conn);
                }
            }
            return true;
        }
        return false;
    }

    static public function insert_familiar($array){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();

        $query = "INSERT INTO familiar(id_alumno, nombre_apellido, telefono, vinculo, observacion)
        VALUES (".$array['id_alumno'].",'".$array['nom_ape']."','".$array['tel_familiar']."','".$array['vinculo']."','".$array['observacion_familiar']."')";
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }

    static public function insert_vinculo($id_alumno,$nom_vinculo){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();

        $vinculo_existe = datos::vinculo_existe($id_alumno,$nom_vinculo);        
        if(!empty($vinculo_existe)){
            return $vinculo_existe;
        }
        $query = "INSERT INTO vinculos(id_alumno, vinculo)
        VALUES (".$id_alumno.",'".$nom_vinculo."')";
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function insert_actividades($id,$actividad,$una,$dos,$dias,$profe,$edadMin,$edadMax,$cupos){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();  
          
        $query = "INSERT INTO actividades_valores(actividad,una_vez,dos_veces,dias_horarios,profe,min_edad,max_edad,cupos) 
        VALUES ('".$actividad."',".$una.",".$dos.",'".$dias."','".$profe."',".$edadMin.",".$edadMax.",".$cupos.")";
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }

    static public function update_actividades_alumno($id_alumno,$actividades){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();  
        
        $query = "DELETE FROM actividades_alumnos WHERE id_alumno = ".$id_alumno;
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        foreach ($actividades as $value) {
            $query = "INSERT INTO actividades_alumnos(id_alumno,id_actividad) VALUES (".$id_alumno.",".$value.")";
            if (!mysqli_query($conn, $query)) {
                return mysqli_error($conn);
            }
        }
        return true;
    }
    static public function delete_actividades($id){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();  
          
        $query = "DELETE FROM `actividades_valores` WHERE id = ".$id."";
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function baja_alumno($id_alumno,$baja){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    

        $query = "UPDATE alumnos SET baja = ".$baja." WHERE id = ".$id_alumno;
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function debe_mes($id_alumno,$debe){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    

        $query = "UPDATE alumnos SET debemes = ".$debe." WHERE id = ".$id_alumno;
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function descuentos($descuento_actividad,$descuento_familiar){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    

        $query = "UPDATE actividades_valores SET descuento_actividad = ".$descuento_actividad.",descuento_familiar = ".$descuento_familiar;
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function debe_mes_vinculo($nombre_vinculo,$debe_mes_vinculo){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    
        
        $query = "UPDATE vinculos SET debemes = ".$debe_mes_vinculo." WHERE vinculo = '".$nombre_vinculo."'";
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function info_deuda_alumno($id_alumno,$info){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    

        $query = "UPDATE alumnos SET info_deuda = '".$info."' WHERE id = ".$id_alumno;
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function info_deuda_vinculo($nombre_vinculo,$info){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    

        $query = "UPDATE vinculos SET info_deuda = '".$info."' WHERE vinculo = '".$nombre_vinculo."'";
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function update_alumnos($array){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();  
          
        if (empty($array['foto_perfil'])) {
            $query = "UPDATE alumnos SET apellido = '".$array['apellido']."', nombre = '".$array['nombre']."',
            fecha_nac = '".$array['fecha_nac']."', edad = '".$array['edad']."', nacionalidad = '".$array['nacionalidad']."',
            documento = '".$array['documento']."',domicilio = '".$array['domicilio']."',localidad = '".$array['localidad']."',
            tel_fijo = '".$array['tel_fijo']."', tel_movil = '".$array['tel_alumno']."', mail = '".$array['correo']."',
            actividad = '".$array['actividad']."', notas = '".$array['notas']."', salud = '".$array['salud']."',
            observaciones = '".$array['observacion_alumno']."' WHERE id = ".$array['id_alumno'];
        }else {
            $query = "UPDATE alumnos SET apellido = '".$array['apellido']."', nombre = '".$array['nombre']."', foto_perfil = '".$array['foto_perfil']."',
            fecha_nac = '".$array['fecha_nac']."', edad = '".$array['edad']."', nacionalidad = '".$array['nacionalidad']."',
            documento = '".$array['documento']."',domicilio = '".$array['domicilio']."',localidad = '".$array['localidad']."',
            tel_fijo = '".$array['tel_fijo']."', tel_movil = '".$array['tel_alumno']."', mail = '".$array['correo']."',
            actividad = '".$array['actividad']."', notas = '".$array['notas']."', salud = '".$array['salud']."',
            observaciones = '".$array['observacion_alumno']."' WHERE id = ".$array['id_alumno'];
        }
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function update_actividades($id,$actividad,$una,$dos,$dias,$profe,$edadMin,$edadMax,$cupos){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    

        $query = "UPDATE actividades_valores SET actividad = '".$actividad."',una_vez = ".$una.",dos_veces = ".$dos.",
        dias_horarios = '".$dias."',profe = '".$profe."', min_edad= ".$edadMin.",max_edad = ".$edadMax.",cupos = ".$cupos." WHERE id = ".$id;
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function update_familiares($id,$nom_ape,$vinculo,$tel,$observacion){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    

        $query = "UPDATE familiar SET nombre_apellido = '".$nom_ape."',telefono = '".$tel."',
        vinculo = '".$vinculo."', observacion = '".$observacion."' WHERE id = ".$id;
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function update_acomodar_edad($id,$edad){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    

        $query = "UPDATE alumnos SET edad = '".$edad."' WHERE id = ".$id;
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function update_actividad($id,$actividad){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    

        $query = "UPDATE alumnos SET actividad = '".$actividad."' WHERE id = ".$id;
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function delete_alumno($id){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    

        $query = "DELETE FROM alumnos WHERE id = ".$id;
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        
        $query = "DELETE FROM familiar WHERE id_alumno = ".$id;
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        
        $query = "DELETE FROM vinculos WHERE id_alumno = ".$id;
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }

        $query = "DELETE FROM actividades_alumnos WHERE id_alumno = ".$id;
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }

        return true;
    }
    static public function delete_familiar($id){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    

        $query = "DELETE FROM familiar WHERE id = ".$id;
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }

    static public function delete_vinculo($id_alumno,$nom_vinculo){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection(); 

        $vinculo_existe = datos::vinculo_existe($id_alumno,$nom_vinculo);        
        if(empty($vinculo_existe)){
            return $vinculo_existe;
        }
        $query = "DELETE FROM vinculos WHERE id_alumno = ".$id_alumno." AND vinculo = '".$nom_vinculo."'";
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }

    static public function obtener_edad($fecha_nac){
        
        // $arr = explode('/', $fecha_nac);
        // $fecha_nac = $arr[2].'-'.$arr[1].'-'.$arr[0];
        
        $nacimiento = new DateTime($fecha_nac);
        $actual = new DateTime(date("Y-m-d"));

        $diferencia = $actual->diff($nacimiento);

        return $diferencia->format("%y");
    }
}

// foreach (datos::alumnos() as $key) {
//     # code...
//     $arr = explode('|', $key['actividad']);
//     $dato = '';
//     foreach ($arr as $key2) {
//         # code...
//         $dato .= $key2;
//         // echo $key2.'|';
//     }
//     echo $dato.'|';
//     echo $key['id'].'<br>';
//     // datos::update_actividad($key['id'],$dato);
// }
// exit;
// print'<pre>';print_r(datos::alumnos());exit;