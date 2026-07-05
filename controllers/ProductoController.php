<?php

require_once __DIR__ . '/../models/Producto.php';

class ProductoController
{
    private $producto;

    public function __construct()
    {
        $this->producto = new Producto();
    }

    public function index()
{
    $productos = $this->producto->getAll();

    $data = [];

    while ($fila = $productos->fetch_assoc()) {
        $data[] = $fila;
    }

    header('Content-Type: application/json');

    echo json_encode([
        "success" => true,
        "message" => "Productos obtenidos correctamente.",
        "data" => $data
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
}