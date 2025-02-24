<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Content-Type: application/json');
require_once 'clases/consultas.php';

// Credenciales de la API
// $api_user = getenv('API_USER');
// $api_password = getenv('API_PASSWORD');
$api_user = "api_user";
$api_password = "api_password";

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar credenciales
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
        $_SERVER['PHP_AUTH_USER'] !== $api_user || $_SERVER['PHP_AUTH_PW'] !== $api_password) {
        header('HTTP/1.0 401 Unauthorized');
        echo json_encode(["status" => "error", "message" => "Credenciales inválidas"]);
        exit;
    }

    $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
    $documento = filter_input(INPUT_POST, 'documento', FILTER_SANITIZE_STRING);
    
    if ($tipo == 'INSERTAR REGISTRO') {
        $agente = filter_input(INPUT_POST, 'agente', FILTER_SANITIZE_STRING);
        $foto = filter_input(INPUT_POST, 'foto', FILTER_SANITIZE_STRING);
        $crucePost = filter_input(INPUT_POST, 'cruce', FILTER_SANITIZE_STRING);
        $lugar = filter_input(INPUT_POST, 'lugar', FILTER_SANITIZE_STRING);
        $fecha = filter_input(INPUT_POST, 'fecha', FILTER_SANITIZE_STRING);

        $agenteData = datos::agente($documento);
        if (empty($agenteData)) {
            if (!datos::cargar_agente($agente, $documento, $foto)) {
                echo json_encode(["status" => "error", "message" => "Error al registrar agente."]);
                exit;
            }
        } elseif (empty($agenteData[0]['foto'])) {
            if (!datos::foto_agente($documento, $foto)) {
                echo json_encode(["status" => "error", "message" => "Error al cargar foto de agente."]);
                exit;
            }
        }
        $estado = $crucePost != '' ? 1 : 0;
        
        $cruce = $agenteData[0]['cruce'] == 'ENTRADA' ? 'SALIDA' : 'ENTRADA';
        $cruce = $crucePost != '' ? $crucePost : $cruce;

        if (datos::cargar_fichado($documento, $cruce, $lugar, $fecha, $estado)) {
            echo json_encode(["status" => "success", "message" => "Fichado correctamente, $cruce $fecha"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al registrar"]);
        }
    } elseif ($tipo == 'VALIDAR AGENTE') {
        $agenteData = datos::agente($documento);
        if (!empty($agenteData)) {
            echo json_encode(["status" => "success", "message" => "El agente existe", "data" => $agenteData]);
        } else {
            echo json_encode(["status" => "error", "message" => "El agente no existe"]);
        }
    } elseif ($tipo == 'REGISTROS AGENTE') {
        $registros = datos::registros_agente($documento);
        if (!empty($registros)) {
            echo json_encode(["status" => "success", "message" => "El agente existe", "data" => $registros]);
        } else {
            echo json_encode(["status" => "error", "message" => "El agente no existe"]);
        }
    }
}
?>
