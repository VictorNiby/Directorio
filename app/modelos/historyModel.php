<?php

require_once(__DIR__ . '/../../configuracion/mysql.php');

class historyModel extends Mysql{
    private $conn;

    public function __construct(){
        $mysql = new Mysql();
        $this->conn = $mysql->conect();
    }

    public function GetHistory($user_id){  
        $query = "SELECT servicio.id_servicio,servicio.usuario_id_usuario AS owner_id,servicio.titulo,servicio_imagenes.imagen_ref as imagen,servicio_usuario.total,servicio_usuario.fecha, servicio_usuario.estado
        FROM servicio_usuario
        INNER JOIN usuario ON usuario.id_usuario = servicio_usuario.usuario_id
        INNER JOIN servicio ON servicio.id_servicio = servicio_usuario.servicio_id
        LEFT JOIN servicio_imagenes ON servicio_imagenes.servicio_id = servicio_usuario.servicio_id
        WHERE servicio_usuario.usuario_id = ?
        GROUP BY servicio_usuario.fecha
        ORDER BY servicio_usuario.estado DESC";
        $preparedStmt = $this->conn->prepare($query);
        $preparedStmt->execute([$user_id]);
        $data = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
