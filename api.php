<?php

$now = new DateTime();
$fechaCompleta = $now->format('YmdHis');
print $fechaCompleta;exit;
// Configura los encabezados para permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
error_reporting(0);
require_once 'clases/consultas.php';
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        
        $usuarios = datos::alumnos();
        echo json_encode($usuarios);
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $usuarios = datos::alumnos();
        echo json_encode($usuarios);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $usuarios = datos::alumnos();
        echo json_encode($usuarios);
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $usuarios = datos::alumnos();
        echo json_encode($usuarios);
        break;

    default:
        echo json_encode(['message' => 'Método no soportado']);
        break;
}
?>
