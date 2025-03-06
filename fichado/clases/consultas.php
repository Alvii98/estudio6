<?php
require_once __DIR__ . '/SingletonConexion.php';
class datos{
    static public function agente($documento = '') {
        $instancia = SingletonConexion::getInstance();        
        $conn = $instancia->getConnection();
    
        if ($documento == '') {
            $query = "SELECT * FROM agentes ORDER BY agente";
            $stmt = $conn->prepare($query);
        }else {
            $query = "SELECT a.*,r.* FROM agentes a
            LEFT JOIN registros as r ON r.documento = a.documento AND r.estado = 0
            WHERE a.documento = ? ORDER BY r.fecha DESC LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $documento);
        }
        $stmt->execute();
        $resp = $stmt->get_result();
    
        return $resp->fetch_all(MYSQLI_ASSOC);
    }

    static public function registros_agente($documento){
        $instancia = SingletonConexion::getInstance();        
        $conn = $instancia->getConnection();

        $query = "SELECT * FROM registros 
        WHERE documento = ? AND fecha >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH) 
        AND estado = 0 ORDER BY fecha DESC";
    
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $documento);

        $stmt->execute();
        $resp = $stmt->get_result();
    
        return $resp->fetch_all(MYSQLI_ASSOC);
    }

    static public function administracion(){
        $instancia = SingletonConexion::getInstance();        
        $conn = $instancia->getConnection();

        $query = "SELECT * FROM administracion ORDER BY id DESC LIMIT 1";

        $stmt = $conn->prepare($query);
    
        $stmt->execute();
        $resp = $stmt->get_result();
    
        return $resp->fetch_all(MYSQLI_ASSOC);
    }

    static public function registros(){
        $instancia = SingletonConexion::getInstance();        
        $conn = $instancia->getConnection();

        $query = "SELECT r.id,a.agente,a.documento,r.cruce,r.fecha,r.lugar,r.observacion,r.estado
        FROM registros r, agentes a WHERE r.documento = a.documento and r.estado = 0 ORDER BY fecha desc";
    
        $stmt = $conn->prepare($query);
    
        $stmt->execute();
        $resp = $stmt->get_result();
    
        return $resp->fetch_all(MYSQLI_ASSOC);
    }

    static public function registros_pendientes(){
        $instancia = SingletonConexion::getInstance();        
        $conn = $instancia->getConnection();

        $query = "SELECT r.id,a.agente,a.documento,r.cruce,r.fecha,r.lugar,r.observacion,r.estado
        FROM registros r, agentes a WHERE r.documento = a.documento and r.estado = 1 ORDER BY fecha desc";
    
        $stmt = $conn->prepare($query);
    
        $stmt->execute();
        $resp = $stmt->get_result();
    
        return $resp->fetch_all(MYSQLI_ASSOC);
    }

    static public function aceptar_registro($id_registro) {
        $instancia = SingletonConexion::getInstance();        
        $conn = $instancia->getConnection();
    
        $query = "UPDATE registros SET estado = 0 WHERE id = ?";
    
        $stmt = $conn->prepare($query);

        $stmt->bind_param("i", $id_registro);

        if (!$stmt->execute()) return $stmt->error;
    
        $stmt->close();
    
        return true;
    }


    static public function cargar_agente($agente,$documento) {
        $instancia = SingletonConexion::getInstance();        
        $conn = $instancia->getConnection();
    
        $query = "INSERT INTO agentes(agente,documento,fecha_registro) VALUES (?, ?, now())";
    
        $stmt = $conn->prepare($query);

        $stmt->bind_param("ss", $agente,$documento);
    
        if (!$stmt->execute()) return $stmt->error;
    
        $resp = $stmt->insert_id;
        $stmt->close();
    
        return is_int($resp) ? true : false;
    }

    static public function cargar_fichado($documento,$cruce,$lugar,$fecha = '',$estado = 0) {
        $instancia = SingletonConexion::getInstance();        
        $conn = $instancia->getConnection();
    
        $query = "INSERT INTO registros(documento,cruce,fecha,lugar,estado) VALUES (?, ?, ?, ?, ?)";
    
        $stmt = $conn->prepare($query);

        $fecha = $fecha == '' ? date('Y-m-d H:i:s') : $fecha;
        
        $stmt->bind_param("isssi", $documento,$cruce,$fecha,$lugar,$estado);
    
        if (!$stmt->execute()) return $stmt->error;
    
        $resp = $stmt->insert_id;
        $stmt->close();
    
        return is_int($resp) ? true : false;
    }

    static public function eliminar_agente($id) {
        $instancia = SingletonConexion::getInstance();        
        $conn = $instancia->getConnection();
    
        $query = "DELETE FROM agentes WHERE id = ?";
    
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
    
        if (!$stmt->execute()) return $stmt->error;
    
        $stmt->close();
        return true;
    }

    static public function eliminar_registro($id) {
        $instancia = SingletonConexion::getInstance();        
        $conn = $instancia->getConnection();
    
        $query = "DELETE FROM registros WHERE id = ?";
    
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
    
        if (!$stmt->execute()) return $stmt->error;
    
        $stmt->close();
        return true;
    }
}
// $documento = '40756445';
// $cruce = 'ENTRADA';
// $lugar = 'ACA';
// datos::cargar_fichado($documento,$cruce,$lugar);