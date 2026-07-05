<?php

require_once __DIR__ . '/../controllers/ProductoController.php';

$controller = new ProductoController();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    case 'GET':

        if (isset($_GET['id'])) {
            $controller->show($_GET['id']);
        } else {
            $controller->index();
        }

        break;

    case 'POST':
        $controller->store();
        break;

    case 'PUT':
        $controller->update();
        break;

    case 'DELETE':
        $controller->destroy();
        break;

    default:

        header('Content-Type: application/json');

        echo json_encode([
            "success" => false,
            "message" => "Método HTTP no permitido."
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        break;
}