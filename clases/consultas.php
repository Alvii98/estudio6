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
        if ($activ != '0' && $activ != '') {
            $query = "SELECT a.id,a.apellido,a.nombre,a.edad,a.fecha_nac,a.baja,a.foto_perfil,av.actividad,av.dias_horarios FROM alumnos a
            LEFT JOIN actividades_alumnos aa ON aa.id_actividad = ".$activ."
            LEFT JOIN actividades_valores av ON av.id = aa.id_actividad
            WHERE a.id = aa.id_alumno
            ORDER BY CASE WHEN a.baja = 1 THEN 1 ELSE 0 END,a.apellido ASC";
        }elseif(empty($edad)){
            $query = "SELECT a.id,a.apellido,a.nombre,a.edad,a.fecha_nac,a.baja,a.foto_perfil,av.actividad,av.dias_horarios FROM alumnos a
            LEFT JOIN actividades_alumnos aa ON aa.id_alumno = a.id
            LEFT JOIN actividades_valores av ON av.id = aa.id_actividad
            WHERE a.apellido LIKE '%".$ape."%' AND a.nombre LIKE '%".$nom."%'
            ORDER BY CASE WHEN a.baja = 1 THEN 1 ELSE 0 END,a.apellido ASC";
        }else{
            $query = "SELECT a.id,a.apellido,a.nombre,a.edad,a.fecha_nac,a.baja,a.foto_perfil,av.actividad,av.dias_horarios FROM alumnos a
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

        $query = "SELECT DISTINCT id_alumno,vinculo FROM vinculos WHERE id_alumno = ".$id;  
        
        if(empty($id)){
            $query = "SELECT v.id_alumno,v.vinculo,a.apellido,a.nombre FROM vinculos v,alumnos a 
            WHERE v.vinculo = '".$vinculo."' AND v.id_alumno = a.id";
        }

        return datos::respuestaQuery($query);
    }

    static public function vinculos(){

        $query = "SELECT * FROM vinculos ORDER BY vinculo ASC";    

        return datos::respuestaQuery($query);
    }

    static public function deudas_alumno($id_alumno){

        $query = "SELECT *,(enero + febrero + marzo + abril + mayo + junio + julio + agosto + septiembre + octubre + noviembre + diciembre) AS total
        FROM deudas_alumno WHERE id_alumno = ".$id_alumno." ORDER BY id DESC LIMIT 1";    

        return datos::respuestaQuery($query);
    }

    static public function insert_deudas_alumno($id_alumno,$array){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();

        $query = "INSERT INTO deudas_alumno(id_alumno,enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre)
        VALUES (".$id_alumno.",".$array['enero'].",".$array['febrero'].",".$array['marzo'].",".$array['abril'].",".$array['mayo'].",".$array['junio']
        .",".$array['julio'].",".$array['agosto'].",".$array['septiembre'].",".$array['octubre'].",".$array['noviembre'].",".$array['diciembre'].")";    

        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        $resp = mysqli_insert_id($conn);
        if (is_int($resp)) return true;
        else return false;
    }

    static public function update_deudas_alumno($id_alumno,$array){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();

        $query = "UPDATE deudas_alumno SET enero=".$array['enero'].",febrero=".$array['febrero'].",marzo=".$array['marzo'].",abril=".$array['abril'].",
        mayo=".$array['mayo'].",junio=".$array['junio'].",julio=".$array['julio'].",agosto=".$array['agosto'].",septiembre=".$array['septiembre'].",
        octubre=".$array['octubre'].",noviembre=".$array['noviembre'].",diciembre=".$array['diciembre']." WHERE id_alumno = ".$id_alumno;    

        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }

    static public function deudas_vinculo($vinculo){

        $query = "SELECT *,(enero + febrero + marzo + abril + mayo + junio + julio + agosto + septiembre + octubre + noviembre + diciembre) AS total
        FROM deudas_vinculo WHERE vinculo = '".$vinculo."' ORDER BY id DESC LIMIT 1";

        return datos::respuestaQuery($query);
    }

    static public function insert_deudas_vinculo($vinculo,$array){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();

        $query = "INSERT INTO deudas_vinculo(vinculo,enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre)
        VALUES ('".$vinculo."',".$array['enero'].",".$array['febrero'].",".$array['marzo'].",".$array['abril'].",".$array['mayo'].",".$array['junio']
        .",".$array['julio'].",".$array['agosto'].",".$array['septiembre'].",".$array['octubre'].",".$array['noviembre'].",".$array['diciembre'].")";    

        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        $resp = mysqli_insert_id($conn);
        if (is_int($resp)) return true;
        else return false;
    }

    static public function update_deudas_vinculo($vinculo,$array){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();

        $query = "UPDATE deudas_vinculo SET enero=".$array['enero'].",febrero=".$array['febrero'].",marzo=".$array['marzo'].",abril=".$array['abril'].",
        mayo=".$array['mayo'].",junio=".$array['junio'].",julio=".$array['julio'].",agosto=".$array['agosto'].",septiembre=".$array['septiembre'].",
        octubre=".$array['octubre'].",noviembre=".$array['noviembre'].",diciembre=".$array['diciembre']." WHERE vinculo = '".$vinculo."'";    

        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }

    static public function datos_vinculo($vinculo){

        $query = "SELECT v.vinculo,CONCAT(a.apellido,' ',a.nombre) AS alumno 
        FROM vinculos v,alumnos a WHERE v.vinculo = '".$vinculo."' AND v.id_alumno = a.id ORDER BY 2";    

        return datos::respuestaQuery($query);
    }
    
    static public function datos_excel(){

        $query = "SELECT a.id,a.apellido,a.nombre,a.documento,a.edad,a.fecha_nac,a.nacionalidad,a.domicilio,a.localidad,a.tel_movil,
        a.autoriza,a.mail,a.salud,a.notas,a.observaciones,a.baja,CONCAT(av.actividad,' - ',av.dias_horarios) as actividad FROM alumnos a
        LEFT JOIN actividades_alumnos aa ON aa.id_alumno = a.id
        LEFT JOIN actividades_valores av ON av.id = aa.id_actividad
        ORDER BY CASE WHEN a.baja = 1 THEN 1 ELSE 0 END,a.apellido ASC";    

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
            FROM actividades_valores av GROUP BY av.id ORDER BY av.id ASC";    
        }

        return datos::respuestaQuery($query);
    }

    static public function actividad_disponible($id_actividad = ''){
        
        $query = "SELECT av.*, (av.cupos - (SELECT COUNT(aa.id_actividad) FROM actividades_alumnos aa
        JOIN alumnos a ON a.id = aa.id_alumno WHERE aa.id_actividad = av.id AND a.baja = 0)) AS disponibles
        FROM actividades_valores av WHERE av.id = ".$id_actividad." GROUP BY av.id ORDER BY av.id ASC";    

        return datos::respuestaQuery($query);
    }
    
    static public function administracion(){

        $query = "SELECT * FROM administracion ORDER BY id DESC LIMIT 1";    

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
        domicilio, localidad, autoriza, tel_movil, mail, salud, observaciones) VALUES 
        ('".$array['apellido']."','".$array['nombre']."','".$array['foto_perfil']."','".$array['fecha_nac']."',".$array['edad'].",'".$array['nacionalidad']."',
        '".$array['documento']."','".$array['domicilio']."','".$array['localidad']."','".$array['autoriza']."','".$array['tel_alumno']."',
        '".$array['correo']."','".$array['salud']."','".$array['observacion_alumno']."')";
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        $id_alumno = mysqli_insert_id($conn);
        if (is_int($id_alumno)) {
            $query = "";
            foreach ($actividades as $value) {
                if (empty($query)) $query .= "(".$id_alumno.",".$value.")";
                else $query .= ",(".$id_alumno.",".$value.")";
            }
            $query = "INSERT INTO actividades_alumnos (id_alumno, id_actividad) VALUES ".$query.";";
            if (!mysqli_query($conn, $query)) {
                return mysqli_error($conn);
            }

            return $id_alumno;
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
    static public function control_actividades_alumno($id_alumno,$id_actividad){
        $query = "SELECT * FROM actividades_alumnos WHERE id_alumno = ".$id_alumno." and id_actividad = ".$id_actividad;
        return datos::respuestaQuery($query);
    }


    static public function update_actividades_alumno($id_alumno,$actividades){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();  
        
        $query = "DELETE FROM actividades_alumnos WHERE id_alumno = ".$id_alumno.";";
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        $query = "";
        foreach ($actividades as $value) {
            if (empty($query)) $query .= "(".$id_alumno.",".$value.")";
            else $query .= ",(".$id_alumno.",".$value.")";
        }
        $query = "INSERT INTO actividades_alumnos (id_alumno, id_actividad) VALUES ".$query.";";
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }
        return true;
    }
    static public function delete_actividades($id){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();  
          
        $query = "DELETE FROM actividades_valores WHERE id = ".$id;
        
        if (!mysqli_query($conn, $query)) {
            return mysqli_error($conn);
        }

        $query = "DELETE FROM actividades_alumnos WHERE id_actividad = ".$id;
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

    static public function update_descuento($descuento_actividad){
        $instancia = SingletonConexion::getInstance();
        $conn = $instancia->getConnection();    

        $query = "UPDATE administracion SET descuento = ".$descuento_actividad;
        
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
            autoriza = '".$array['autoriza']."', tel_movil = '".$array['tel_alumno']."', mail = '".$array['correo']."',
            notas = '".$array['notas']."', salud = '".$array['salud']."',
            observaciones = '".$array['observacion_alumno']."' WHERE id = ".$array['id_alumno'];
        }else {
            $query = "UPDATE alumnos SET apellido = '".$array['apellido']."', nombre = '".$array['nombre']."', foto_perfil = '".$array['foto_perfil']."',
            fecha_nac = '".$array['fecha_nac']."', edad = '".$array['edad']."', nacionalidad = '".$array['nacionalidad']."',
            documento = '".$array['documento']."',domicilio = '".$array['domicilio']."',localidad = '".$array['localidad']."',
            autoriza = '".$array['autoriza']."', tel_movil = '".$array['tel_alumno']."', mail = '".$array['correo']."',
            notas = '".$array['notas']."', salud = '".$array['salud']."',
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