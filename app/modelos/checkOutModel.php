<?php
require_once(__DIR__ . '/../../configuracion/mysql.php');

class checkOutModel extends Mysql{
    private $conn;
    public function __construct(){
        $mysql = new Mysql;
        $this->conn = $mysql->conect();
    }

    public function Insert($servicio_id, $usuario_id, $total, $barrio_usuario, $direccion_usuario, $metodo_pago) {
        $query = "INSERT INTO servicio_usuario(servicio_id, usuario_id, total, barrio_usuario, direccion_usuario, metodo_pago)
        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$servicio_id, $usuario_id, $total, $barrio_usuario, $direccion_usuario, $metodo_pago]);
    }

    public function CancelService($servicio_id,$usuario_id){
        $query = "UPDATE servicio_usuario SET estado = 'Cancelado'
        WHERE servicio_usuario.servicio_id = ? AND servicio_usuario.usuario_id = ?";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$servicio_id, $usuario_id]);
    }


}