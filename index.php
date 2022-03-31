<?php

header('Content-Type: application/json');

include './modelo/conexion.php';
include './modelo/metodos.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo mostrarPorId($_GET['id']);
        } else {
            echo mostrarTodos();
        }
        break;
    case 'POST':
        $datos = json_decode(file_get_contents("php://input"), false);
        if ($datos!=NULL) {
            insertar($datos->titulo,$datos->fecha,$datos->completada,$datos->descripcion);
        } else {
            http_response_code(400);
        }
        break;
    case 'PUT':
        $datos = json_decode(file_get_contents("php://input"), false);
        if ($datos!=NULL) {
            modificar($datos->id,$datos->titulo,$datos->fecha,$datos->completada,$datos->descripcion);
        } else {
            http_response_code(400);
        }
        break;
    case 'DELETE':
        if (isset($_GET['id'])) {
            if (EliminarPorId($_GET['id'])) {
                http_response_code(200);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(405);
        }
        break;
    default:
        http_response_code(405);
        break;
}

?>