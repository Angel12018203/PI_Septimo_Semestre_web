<?php
require_once '../config/configuracion.php'; // Solo cargas este archivo y listo

class Conexion {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($this->conn->connect_error) {
            throw new Exception('Error conectando a la base de datos: ' . $this->conn->connect_error);
        }

        // Establecer el charset a utf8mb4
        if (!$this->conn->set_charset("utf8mb4")) {
            throw new Exception('Error configurando el charset a utf8mb4: ' . $this->conn->error);
        }
    }

    public function close() {
        $this->conn->close();
    }

    public function executeQuery($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception('Error preparando la consulta: ' . $this->conn->error);
        }
        if ($params) {
            $types = str_repeat('s', count($params));
            if (!$stmt->bind_param($types, ...$params)) {
                throw new Exception('Error vinculando los parámetros: ' . $stmt->error);
            }
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function executeUpdate($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            throw new Exception('Error preparando la consulta: ' . $this->conn->error);
        }
        if ($params) {
            $types = str_repeat('s', count($params));
            if (!$stmt->bind_param($types, ...$params)) {
                throw new Exception('Error vinculando los parámetros: ' . $stmt->error);
            }
        }
        $stmt->execute();
        $stmt->close();
    }
}
?>
