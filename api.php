<?php
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
