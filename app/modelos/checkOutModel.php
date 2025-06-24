<?php
require_once(__DIR__ . '/../../configuracion/mysql.php');

class checkOutModel extends Mysql{
    private $conn;
    public function __construct(){
        $mysql = new Mysql;
        $this->conn = $mysql->conect();
    }

    public function Insert($servicio_id, $usuario_id, $total, $barrio_usuario, $direccion_usuario, $metodo_pago) {
        $query = "INSERT INTO servicio_usuario(servicio_id, usuario_id, total, barrio_usuario, direccion_usuario, metodo_pago, estado, fecha)
        VALUES (?, ?, ?, ?, ?, ?, ? , ?)";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$servicio_id, $usuario_id, $total, $barrio_usuario, $direccion_usuario, $metodo_pago, $metodo_pago === 'tarjeta' ? 'Pagado' : 'En Curso', date('Y-m-d H:i:s')]);
    }

    public function CancelService($servicio_id,$usuario_id){
        $query = "UPDATE servicio_usuario SET estado = 'Cancelado'
        WHERE servicio_usuario.servicio_id = ? AND servicio_usuario.usuario_id = ?";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$servicio_id, $usuario_id]);
    }

    public function GetAllSales(){  
        $query = "SELECT 
        su.id,
        s.titulo AS servicio,
        u.nombre AS usuario_nombre,
        u.documento AS usuario_documento,
        su.total,
        su.fecha,
        b.nombre AS barrio,
        su.direccion_usuario,
        su.metodo_pago,
        su.estado
        FROM servicio_usuario su
        JOIN servicio s ON su.servicio_id = s.id_servicio
        JOIN usuario u ON su.usuario_id = u.id_usuario
        JOIN barrio b ON su.barrio_usuario = b.id_barrio;
        ";
        $preparedStmt = $this->conn->prepare($query);
        $preparedStmt->execute();
        $data = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

}