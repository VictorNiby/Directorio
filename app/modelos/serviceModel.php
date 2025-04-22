<?php

require_once(__DIR__ . '/../../configuracion/mysql.php');

class ServiceModel extends Mysql {
    private $connection;

    public function __construct(){
        $mysql = new Mysql();
        $this->connection = $mysql->conect();
    }

    //EXTRA : Para Input Select

    public function getAllUsers() {
        $query = "SELECT id_usuario, nombre FROM usuario WHERE estado = 'Activo'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllCategories() {
        $query = "SELECT id_categoria, nombre FROM categoria WHERE estado = 'Activo'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //AL LIO TIO

    public function getAllService() {
        $query = "SELECT s.id_servicio, s.titulo, s.descripcion, s.precio, s.fecha_creacion, u.nombre as nombre, c.nombre as categoria, s.estado as estado
        FROM servicio s
        INNER JOIN usuario u ON u.id_usuario = s.usuario_id_usuario
        INNER JOIN categoria c ON c.id_categoria = s.categoria_id_categoria";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getServiceById($id) {
        if (!is_numeric($id)) {
            throw new Exception("ID inválido para buscar usuario");
        }

        $query = "SELECT s.id_servicio, s.titulo, s.descripcion, s.precio, s.fecha_creacion, u.nombre, c.nombre
        FROM servicio s
        INNER JOIN usuario u ON u.id_usuario = s.usuario_id_usuario
        INNER JOIN categoria c ON c.id_categoria = s.categoria_id_categoria
        WHERE id_servicio = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($titulo, $descripcion, $precio, $idUsuario, $idCategoria) {
        $query = "INSERT INTO servicio (titulo, descripcion, precio, usuario_id_usuario, categoria_id_categoria) 
                  VALUES (?,?,?,?,?)";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$titulo, $descripcion, $precio, $idUsuario, $idCategoria]);
    }

    public function update($titulo,$descripcion,$precio,$id) {
        if (!is_numeric($id)) {
            throw new Exception("ID inválido para actualizar usuario");
        }

        $query = "UPDATE servicio 
                  SET titulo = ?,
                      descripcion = ?,
                      precio = ?
                  WHERE id_servicio = ?";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$titulo,$descripcion,$precio, $id]);
    }

    public function delete($id){
        try {
            if(!is_numeric($id)) {
                throw new Exception("¿Y entonces? Con el id inválido pa donde es que va");
            }
            $queryCategory = "SELECT estado FROM servicio WHERE id_servicio = ?";
            $preparedStmtCategory = $this->connection->prepare($queryCategory);
            $preparedStmtCategory->execute([$id]);
            $data = $preparedStmtCategory->fetch(PDO::FETCH_ASSOC);
            if(!$data) {
                throw new Exception("Categoría no encontrada");
            }
            
            $nuevoEstado = ($data['estado'] === 'Activo') ? 'Inactivo' : 'Activo';
            $queryUpdate = "UPDATE servicio SET estado = ? WHERE id_servicio = ?";
            $preparedStmt = $this->connection->prepare($queryUpdate);
            $result = $preparedStmt->execute([$nuevoEstado,$id]);

            return $result; 
        } catch (\Throwable $th) {
            return false;
        }
    }
}
