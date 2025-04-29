<?php

require_once(__DIR__ . '/../../configuracion/mysql.php');

class DashboardModel extends Mysql {
    private $connection;

    public function __construct(){
        $mysql = new Mysql();
        $this->connection = $mysql->conect();
    }

    public function getAllActiveUsers() {
        $query = "SELECT COUNT(usuario.id_usuario) as total FROM usuario WHERE estado = 'Activo'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllMoneyEarned() {
        $query = "SELECT SUM(s.precio) AS total_ganado
        FROM servicio_usuario su
        JOIN servicio s ON su.servicio_id = s.id_servicio
        WHERE su.estado = 'Pagado';";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllMoneyEarnedDirectorio() {
        $query = "SELECT SUM(s.precio * 0.10) AS total_ganado
        FROM servicio_usuario su
        JOIN servicio s ON su.servicio_id = s.id_servicio
        WHERE su.estado = 'Pagado';";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllActiveService() {
        $query = "SELECT COUNT(s.id_servicio) as total FROM servicio s WHERE s.estado = 'Activo'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
