<?php

require_once(__DIR__ . '/../../configuracion/mysql.php');

class UserModel extends Mysql {
    private $connection;

    public function __construct(){
        $mysql = new Mysql();
        $this->connection = $mysql->conect();
    }

    public function getAllUsers() {
        $query = "SELECT * FROM usuario";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        if (!is_numeric($id)) {
            throw new Exception("ID inválido para buscar usuario");
        }

        $query = "SELECT * FROM usuario WHERE id_usuario = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function GetUserByEmail($email){
        $query = "SELECT * FROM usuario WHERE usuario.correo = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($nombre, $correo, $password, $telefono, $documento, $nacimiento, $rol = 'cliente') {
        $query = "INSERT INTO usuario (nombre, correo, password, telefono, rol, documento, nacimiento, foto) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, '')";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$nombre, $correo, password_hash($password, PASSWORD_BCRYPT), $telefono, $rol, $documento, $nacimiento]);
    }

    public function update($id, $nombre, $correo, $telefono, $nacimiento) {
        if (!is_numeric($id)) {
            throw new Exception("ID inválido para actualizar usuario");
        }

        $query = "UPDATE usuario 
                  SET nombre = ?, correo = ?, telefono = ?, nacimiento = ?
                  WHERE id_usuario = ?";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$nombre, $correo, $telefono, $nacimiento, $id]);
    }

    public function delete($id){
        try {
            if(!is_numeric($id)) {
                throw new Exception("¿Y entonces? Con el id inválido pa donde es que va");
            }
            $queryCategory = "SELECT estado FROM usuario WHERE id_usuario = ?";
            $preparedStmtCategory = $this->connection->prepare($queryCategory);
            $preparedStmtCategory->execute([$id]);
            $data = $preparedStmtCategory->fetch(PDO::FETCH_ASSOC);
            if(!$data) {
                throw new Exception("Categoría no encontrada");
            }
            $nuevoEstado = ($data['estado'] === 'Activo') ? 'Inactivo' : 'Activo';
            $queryUpdate = "UPDATE usuario SET estado = ? WHERE id_usuario = ?";
            $preparedStmt = $this->connection->prepare($queryUpdate);
            $result = $preparedStmt->execute([$nuevoEstado,$id]);
            return $result; 
        } catch (\Throwable $th) {
            return false;
        }
    }
}
