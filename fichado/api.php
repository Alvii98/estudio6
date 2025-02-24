<?php
// Configura los encabezados para permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once 'clases/consultas.php';
header('Content-Type: application/json');

// Credenciales de la API
$api_user = "api_user";
$api_password = "api_password";
// $_SERVER['REQUEST_METHOD'] = 'POST';
// $_POST['tipo'] = 'REGISTROS AGENTE';
// $_POST['documento'] = '40756445';
// $_SERVER['PHP_AUTH_USER'] = $api_user;
// $_SERVER['PHP_AUTH_PW'] = $api_password;
// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar credenciales
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
        $_SERVER['PHP_AUTH_USER'] !== $api_user || $_SERVER['PHP_AUTH_PW'] !== $api_password) {
        header('HTTP/1.0 401 Unauthorized');
        echo json_encode(["status" => "error", "message" => "Credenciales invalidas"]);
    }else {

        if ($_POST['tipo'] == 'INSERTAR REGISTRO') {
            $agente = datos::agente($_POST['documento']);
            if (empty($agente)) {
                if (!datos::cargar_agente($_POST['agente'],$_POST['documento'],$_POST['foto'])) {
                    echo json_encode(["status" => "error", "message" => "Error al registrar agente."]);
                    exit;
                }
            }elseif (empty($agente[0]['foto'])){
                if (!datos::foto_agente($_POST['documento'],$_POST['foto'])) {
                    echo json_encode(["status" => "error", "message" => "Error al cargar foto de agente."]);
                    exit;
                }
            }
            $estado = $_POST['cruce'] != '' ? 1 : 0;
            $cruce = $_POST['cruce'] != '' ? $_POST['cruce'] : 'ENTRADA';

            if ($agente[0]['cruce'] == 'ENTRADA') $cruce = 'SALIDA';

            // agregar el estado a la carga
            if (datos::cargar_fichado($_POST['documento'],$cruce,$_POST['lugar'],$_POST['fecha'],$estado)) {
                echo json_encode(["status" => "success", "message" => "Fichado correctamente, ".$cruce." ".$_POST['fecha']]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al registrar"]);
            }
            
        }elseif ($_POST['tipo'] == 'VALIDAR AGENTE') {
            $agente = datos::agente($_POST['documento']);
            if (!empty($agente)) {
                echo json_encode(["status" => "success", "message" => "El agente existe", "data" => $agente]);
            } else {
                echo json_encode(["status" => "error", "message" => "El agente no existe"]);
            }
        }elseif ($_POST['tipo'] == 'REGISTROS AGENTE') {
            $registros = datos::registros_agente($_POST['documento']);
            if (!empty($registros)) {
                echo json_encode(["status" => "success", "message" => "El agente existe", "data" => $registros]);
            } else {
                echo json_encode(["status" => "error", "message" => "El agente no existe"]);
            }
        }
    }
}

