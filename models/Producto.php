<?php

require_once __DIR__ . '/../config/Database.php';

class Producto
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM productos WHERE id_producto = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function create($nombre, $precio, $stock, $id_categoria)
    {
        $sql = "INSERT INTO productos (nombre, precio, stock, id_categoria)
                 VALUES (?, ?, ?, ?)";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sdii", $nombre, $precio, $stock, $id_categoria);

        return $stmt->execute();
    }

    public function update($id, $nombre, $precio, $stock, $id_categoria)
    {
        $sql = "UPDATE productos 
                SET nombre=?, precio=?, stock=?, id_categoria=? 
                WHERE id_producto=?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sdiis", $nombre, $precio, $stock, $id_categoria, $id);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM productos WHERE id_producto=?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
