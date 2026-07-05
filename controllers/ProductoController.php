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

public function show($id)
{
    $producto = $this->producto->getById($id);

    header('Content-Type: application/json');

    if ($producto) {
        echo json_encode([
            "success" => true,
            "message" => "Producto encontrado.",
            "data" => $producto
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Producto no encontrado.",
            "data" => null
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

public function store()
{
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents("php://input"), true);

    if (
        !isset($data['nombre']) ||
        !isset($data['precio']) ||
        !isset($data['stock']) ||
        !isset($data['id_categoria'])
    ) {
        echo json_encode([
            "success" => false,
            "message" => "Faltan datos obligatorios."
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
    }

    $resultado = $this->producto->create(
        $data['nombre'],
        $data['precio'],
        $data['stock'],
        $data['id_categoria']
    );

    if ($resultado) {
        echo json_encode([
            "success" => true,
            "message" => "Producto creado correctamente."
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Error al crear el producto."
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

public function update()
{
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents("php://input"), true);

    if (
        !isset($data['id']) ||
        !isset($data['nombre']) ||
        !isset($data['precio']) ||
        !isset($data['stock']) ||
        !isset($data['id_categoria'])
    ) {
        echo json_encode([
            "success" => false,
            "message" => "Datos incompletos."
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
    }

    $resultado = $this->producto->update(
        $data['id'],
        $data['nombre'],
        $data['precio'],
        $data['stock'],
        $data['id_categoria']
    );

    echo json_encode([
        "success" => $resultado,
        "message" => $resultado ? "Producto actualizado correctamente." : "Error al actualizar."
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

public function destroy()
{
    header('Content-Type: application/json');

    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['id'])) {
        echo json_encode([
            "success" => false,
            "message" => "ID requerido."
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
    }

    $resultado = $this->producto->delete($data['id']);

    echo json_encode([
        "success" => $resultado,
        "message" => $resultado ? "Producto eliminado correctamente." : "Error al eliminar."
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}