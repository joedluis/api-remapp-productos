<?php

$route = $_GET['route'] ?? '';

switch ($route) {
    case 'productos':
        require_once 'routes/productos.php';
        break;

    default:
        header('Content-Type: application/json');

        echo json_encode([
            "success" => false,
            "message" => "Ruta no encontrada"
        ]);
        break;
}