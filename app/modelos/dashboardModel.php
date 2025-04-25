<?php

require_once(__DIR__ . '/../../configuracion/mysql.php');

class DashboardModel extends Mysql {
    private $connection;

    public function __construct(){
        $mysql = new Mysql();
        $this->connection = $mysql->conect();
    }

    public function getAllHood() {
        $query = "SELECT * FROM barrio ORDER BY nombre ASC";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
