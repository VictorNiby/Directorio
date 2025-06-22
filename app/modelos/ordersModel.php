
<?php

require_once(__DIR__ . '/../../configuracion/mysql.php');

class ordersModel extends Mysql{
    private $conn;

    public function __construct(){
        $mysql = new Mysql();
        $this->conn = $mysql->conect();
    }

    public function GetOrders($user_id){  
        $query = "SELECT servicio.id_servicio,servicio.titulo,servicio_imagenes.imagen_ref as imagen,servicio_usuario.total,servicio_usuario.fecha,usuario.nombre,servicio_usuario.direccion_usuario
        FROM servicio_usuario
        INNER JOIN usuario ON usuario.id_usuario = servicio_usuario.usuario_id
        INNER JOIN servicio ON servicio.id_servicio = servicio_usuario.servicio_id
        LEFT JOIN servicio_imagenes ON servicio_imagenes.servicio_id = servicio_usuario.servicio_id
        WHERE servicio.usuario_id_usuario = ? AND servicio_usuario.estado = 'En Curso'
        GROUP BY servicio_usuario.fecha
        ORDER BY servicio_usuario.fecha DESC";
        $preparedStmt = $this->conn->prepare($query);
        $preparedStmt->execute([$user_id]);
        $data = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    //FIN LANDING PAGE
}
