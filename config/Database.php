<?php

class Database
{
    private $host = "localhost";
    private $port = 3306;
    private $database = "remapp_db";
    private $username = "root";
    private $password = "123456";

    private $connection;

    public function connect()
    {
        $this->connection = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database,
            $this->port
        );

        if ($this->connection->connect_error) {
            die("Error de conexión: " . $this->connection->connect_error);
        }

        $this->connection->set_charset("utf8mb4");

        return $this->connection;
    }
}