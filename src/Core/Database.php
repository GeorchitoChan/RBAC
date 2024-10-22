<?php
    namespace App\Core;

    use PDO;
    use PDOException;

    class Database
    {
        private $host = 'localhost';
        private $port='3307';
        private $db_name = 'rbac';
        private $username = 'root';
        private $password = '';
        private $conn;

        // Método para obtener la conexión a la base de datos
        public function getConnection()
        {
            $this->conn = null;

            try {
                $this->conn = new PDO(
                    "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name,
                    $this->username,
                    $this->password
                );
                // Configurar el modo de error de PDO a excepción
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->conn->exec("set names utf8mb4"); // Asegurar que los caracteres se manejen correctamente
            } catch (PDOException $exception) {
                echo "Error de conexión: " . $exception->getMessage();
            }

            return $this->conn;
        }
    }
?>
