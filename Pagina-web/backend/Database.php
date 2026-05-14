<?php

include 'conexion.php';

class Database
{
    private $host = "sql111.infinityfree.com";
    private $db_name = "if0_41919908_sensores";
    private $username = "if0_41919908";
    private $password = "4TS1CPgAPkQAJ";
    private $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password
            );

            // Configuración importante
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

?>
