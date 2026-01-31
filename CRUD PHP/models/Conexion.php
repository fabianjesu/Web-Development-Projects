<?php
class Conexion
{
    private $pdo;
    private $host;
    private $user;
    private $pass;
    private $port;
    private $db;

    public function getConexion()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->port = "3306";
        $this->db = "usuarios";

        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};
                port={$this->port};
                dbname={$this->db};
                charset=utf8",
                $this->user,
                $this->pass
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            echo 'Error :' . $e->getMessage();
        }
    }
}
