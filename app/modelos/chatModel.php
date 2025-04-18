<?php

require_once(__DIR__ . '/../../configuracion/mysql.php');

class ChatModel extends Mysql {
    private $connection;

    public function __construct(){
        $mysql = new Mysql();
        $this->connection = $mysql->conect();
    }

    public function getAllChats() {
        $query = "SELECT chat.id_chat, chat.fecha_creacion, pro.nombre as proovedor, cli.nombre as cliente, chat.estado FROM chat
        INNER JOIN usuario pro on usuario_id_usuario_pro = pro.id_usuario
        INNER JOIN usuario cli on usuario_id_usuario_cli = cli.id_usuario";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChatById($id) {
        if (!is_numeric($id)) {
            throw new Exception("ID inválido para buscar el chat");
        }

        $query = "SELECT m.mensaje, m.fecha_envio, m.usuario_id_usuario FROM chat c
        INNER JOIN mensaje m ON m.chat_id_chat = c.id_chat
        WHERE id_chat = ?
        ORDER BY m.fecha_envio ASC";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function validate($id){
        try {
            if(!is_numeric($id)) {
                throw new Exception("¿Y entonces? Con el id inválido pa donde es que va");
            }
            $queryCategory = "SELECT estado FROM chat WHERE id_chat = ?";
            $preparedStmtCategory = $this->connection->prepare($queryCategory);
            $preparedStmtCategory->execute([$id]);
            $data = $preparedStmtCategory->fetch(PDO::FETCH_ASSOC);
            if(!$data) {
                throw new Exception("Chat no encontrado");
            }
            $nuevoEstado = ($data['estado'] === 'Activo') ? 'Finalizado' : 'Activo';
            $queryUpdate = "UPDATE chat SET estado = ? WHERE id_chat = ?";
            $preparedStmt = $this->connection->prepare($queryUpdate);
            $result = $preparedStmt->execute([$nuevoEstado,$id]);
            return $result; 
        } catch (\Throwable $th) {
            return false;
        }
    }

}
