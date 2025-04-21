<?php

require_once(__DIR__ . '/../../configuracion/mysql.php');

class HoodModel extends Mysql {
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

    public function getHoodById($id) {
        if (!is_numeric($id)) {
            throw new Exception("ID inválido para buscar usuario");
        }

        $query = "SELECT * FROM barrio WHERE id_barrio = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($nombre) {
        $query = "INSERT INTO barrio (nombre) 
                  VALUES (?)";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$nombre]);
    }

    public function update($name,$id) {
        if (!is_numeric($id)) {
            throw new Exception("ID inválido para actualizar usuario");
        }

        $query = "UPDATE barrio 
                  SET nombre = ?
                  WHERE id_barrio = ?";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$name, $id]);
    }

    public function delete($id){
        try {
            if(!is_numeric($id)) {
                throw new Exception("¿Y entonces? Con el id inválido pa donde es que va");
            }
            $queryCategory = "SELECT estado FROM barrio WHERE id_barrio = ?";
            $preparedStmtCategory = $this->connection->prepare($queryCategory);
            $preparedStmtCategory->execute([$id]);
            $data = $preparedStmtCategory->fetch(PDO::FETCH_ASSOC);
            if(!$data) {
                throw new Exception("Categoría no encontrada");
            }
            $nuevoEstado = ($data['estado'] === 'Activo') ? 'Inactivo' : 'Activo';
            $queryUpdate = "UPDATE barrio SET estado = ? WHERE id_barrio = ?";
            $preparedStmt = $this->connection->prepare($queryUpdate);
            $result = $preparedStmt->execute([$nuevoEstado,$id]);
            return $result; 
        } catch (\Throwable $th) {
            return false;
        }
    }
}
