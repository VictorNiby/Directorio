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

    //Pe causa
    public function getLastId(){
        $query = "SELECT id_servicio from servicio ORDER by id_servicio DESC LIMIT 1";
        $preparedStmt = $this->connection->prepare($query);
        $preparedStmt->execute();

        return $preparedStmt->fetch(PDO::FETCH_ASSOC);
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

        $query = "SELECT s.id_servicio, s.titulo, s.descripcion, s.precio, s.fecha_creacion, s.direccion, u.nombre, c.nombre as categoria,
        c.id_categoria as id_categoria
        FROM servicio s
        INNER JOIN usuario u ON u.id_usuario = s.usuario_id_usuario
        INNER JOIN categoria c ON c.id_categoria = s.categoria_id_categoria
        WHERE id_servicio = ? AND s.estado = 'Activo'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //PARA EL LANDING PAGE
    public function getServicesWithImages(){
        $query = "SELECT s.id_servicio, s.titulo, s.precio, COUNT(su.id) AS total_solicitudes,
        servicio_imagenes.imagen_ref
        FROM servicio s
        JOIN servicio_usuario su ON s.id_servicio = su.servicio_id
        INNER JOIN servicio_imagenes on servicio_imagenes.servicio_id = s.id_servicio
        GROUP BY s.id_servicio
        ORDER BY total_solicitudes DESC
        LIMIT 8;";
        $preparedStmt = $this->connection->prepare($query);
        $preparedStmt->execute();
        $feature = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $feature;
    }

    public function getImagesByService($service_id) {
        if (!is_numeric($service_id)) {
            throw new Exception("ID inválido para buscar servicio");
        }

        $query = "SELECT imagen_ref FROM servicio_imagenes
        INNER JOIN servicio on servicio.id_servicio = servicio_imagenes.servicio_id
        where servicio.estado = 'Activo' AND servicio_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$service_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function TopRelatedServices($category_id,$service_id) {
        if (!is_numeric($category_id) || !is_numeric($service_id)) {
            throw new Exception("Valor inválido");
        }

        $query = "SELECT id_servicio, titulo, precio, AVG(reviews.calificacion) as calificacion,
        COUNT(reviews.servicio_id) as total_reviews, 
        servicio_imagenes.imagen_ref as servicio_imagen
        FROM servicio
        INNER JOIN reviews on reviews.servicio_id = servicio.id_servicio
        INNER JOIN servicio_imagenes on servicio_imagenes.servicio_id = servicio.id_servicio
        where servicio.estado = 'Activo' AND servicio.categoria_id_categoria = ?
        AND servicio.id_servicio != ?
        ORDER BY calificacion DESC
        LIMIT 5";

        $stmt = $this->connection->prepare($query);
        $stmt->execute([$category_id,$service_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //END LANDINDG PAGE


    public function insert($titulo, $descripcion, $precio, $idUsuario, $idCategoria,$barrio_id,$direccion) {
        $query = "INSERT INTO servicio (titulo, descripcion, precio, usuario_id_usuario, categoria_id_categoria,barrio_id,direccion) 
                  VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$titulo, $descripcion, $precio, $idUsuario, $idCategoria,$barrio_id,$direccion]);
    }

    //subimos imagenes de los servicios
    public function uploadImg(String $servicio_id, String $imagen_url){
        $query = "INSERT INTO servicio_imagenes(servicio_id, imagen_ref) 
        VALUES (?,?)";
        $preparedStmt = $this->connection->prepare($query);
        return $preparedStmt->execute([$servicio_id,$imagen_url]);
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
