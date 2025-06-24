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

        $query = "SELECT s.id_servicio, s.titulo, s.descripcion, s.precio, s.direccion, u.nombre, c.nombre as categoria, u.correo, u.telefono,
        c.id_categoria as id_categoria
        FROM servicio s
        INNER JOIN usuario u ON u.id_usuario = s.usuario_id_usuario
        INNER JOIN categoria c ON c.id_categoria = s.categoria_id_categoria
        WHERE id_servicio = ? AND s.estado = 'Activo'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //PARA EL INDEX DEL LANDING PAGE
    public function getServicesWithImages(){
        $query = "SELECT s.id_servicio, s.titulo, s.precio, COUNT(su.servicio_id) AS total_solicitudes,
        servicio_imagenes.imagen_ref
        FROM servicio s
        INNER JOIN servicio_usuario su ON s.id_servicio = su.servicio_id
        INNER JOIN servicio_imagenes ON servicio_imagenes.servicio_id = s.id_servicio
        WHERE s.estado = 'Activo'
        GROUP BY s.id_servicio
        ORDER BY total_solicitudes DESC
        LIMIT 8;";
        $preparedStmt = $this->connection->prepare($query);
        $preparedStmt->execute();
        $feature = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $feature;
    }

    public function ShopPageServices(){
        $query = "SELECT s.id_servicio, s.titulo, s.precio,
        servicio_imagenes.imagen_ref as imagen_servicio
        FROM servicio s
        LEFT JOIN servicio_imagenes on servicio_imagenes.servicio_id = s.id_servicio
        WHERE s.estado = 'Activo'
        GROUP BY s.id_servicio";

        $preparedStmt = $this->connection->prepare($query);
        $preparedStmt->execute();
        $services = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $services;
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

        $query = "SELECT id_servicio, titulo, precio,
        AVG(reviews.calificacion) AS calificacion,
        COUNT(reviews.servicio_id) AS total_reviews, 
        MIN(servicio_imagenes.imagen_ref) AS servicio_imagen
        FROM servicio
        LEFT JOIN reviews on reviews.servicio_id = servicio.id_servicio
        LEFT JOIN servicio_imagenes on servicio_imagenes.servicio_id = servicio.id_servicio
        WHERE servicio.estado = 'Activo' AND servicio.categoria_id_categoria = ?
        AND servicio.id_servicio != ?
        GROUP BY servicio.id_servicio
        ORDER BY calificacion DESC
        LIMIT 5";

        $stmt = $this->connection->prepare($query);
        $stmt->execute([$category_id,$service_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ServicesByCategory($category_id){
        $query = "SELECT s.id_servicio, s.titulo, s.precio,
        servicio_imagenes.imagen_ref as imagen_servicio
        FROM servicio s
        LEFT JOIN servicio_imagenes on servicio_imagenes.servicio_id = s.id_servicio
        INNER JOIN categoria c on c.id_categoria = s.categoria_id_categoria
        WHERE c.id_categoria = ? AND s.estado = 'Activo'
        GROUP BY S.id_servicio ";
        
        $preparedStmt = $this->connection->prepare($query);
        $preparedStmt->execute([$category_id]);
        $services = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $services;
    }

    public function GetServiceByUser($user_id,$service_id){
        $query = "SELECT 1
        FROM servicio
        WHERE servicio.usuario_id_usuario = ? AND servicio.id_servicio = ? AND estado = 'Activo'";
        
        $preparedStmt = $this->connection->prepare($query);
        $preparedStmt->execute([$user_id,$service_id]);
        $services = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $services;
    }

    public function ServicesByPrice($min,$max){
        $query = "SELECT s.id_servicio, s.titulo, s.precio,
        servicio_imagenes.imagen_ref as imagen_servicio
        FROM servicio s
        LEFT JOIN servicio_imagenes on servicio_imagenes.servicio_id = s.id_servicio
        WHERE s.precio BETWEEN ? and ? AND s.estado = 'Activo' 
        GROUP BY s.id_servicio";
        
        $preparedStmt = $this->connection->prepare($query);
        $preparedStmt->execute([$min,$max]);
        $services = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $services;
    }

    public function ServicesByCategoryAndPrice($category_id,$min,$max){
        $query = "SELECT s.id_servicio, s.titulo, s.precio,
        servicio_imagenes.imagen_ref as imagen_servicio
        FROM servicio s
        LEFT JOIN servicio_imagenes on servicio_imagenes.servicio_id = s.id_servicio
        WHERE s.precio BETWEEN ? and ? AND s.estado = 'Activo' AND s.categoria_id_categoria = ?
        GROUP BY s.id_servicio";
        
        $preparedStmt = $this->connection->prepare($query);
        $preparedStmt->execute([$min,$max,$category_id]);
        $services = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $services;
    }

    public function CountServiceByCategory($category_id){
        $query = "SELECT COUNT(s.categoria_id_categoria) AS service_count
        FROM servicio s
        WHERE s.categoria_id_categoria = ? AND s.estado = 'Activo' ";
        $preparedStmt = $this->connection->prepare($query);
        $preparedStmt->execute([$category_id]);

        $info = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $info;
    }

    //REVISAMOS QUE EL USUARIO HAYA COMPRADO EL SERVICIO
    public function HasUserPurchasedService($userId,$serviceId){  
        $query = "SELECT 1
        FROM servicio_usuario
        WHERE usuario_id = ? AND servicio_id = ? AND estado = 'Realizado' OR estado = 'Pagado' ";
        $preparedStmt = $this->connection->prepare($query);
        $preparedStmt->execute([$userId,$serviceId]);
        $data = $preparedStmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function GetUserServices($user_id){  
        $query = "SELECT servicio.id_servicio,servicio.titulo,servicio_imagenes.imagen_ref as imagen,servicio.precio,servicio.fecha_creacion, servicio.estado, servicio.descripcion
        FROM servicio
        LEFT JOIN servicio_imagenes ON servicio_imagenes.servicio_id = servicio.id_servicio
        WHERE servicio.usuario_id_usuario = ?
        GROUP BY servicio.id_servicio
        ORDER BY servicio.fecha_creacion DESC";

        $preparedStmt = $this->connection->prepare($query);
        $preparedStmt->execute([$user_id]);
        $data = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
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

    //TRAER LOS DOS SERVICIOS MAS TOPS DEL MERCADO
    public function getAllServiceByPopulating() {
            $query = "SELECT 
                s.id_servicio,
                s.titulo AS nombre_servicio,
                si.imagen_ref AS imagen_servicio,
                COUNT(su.servicio_id) AS cantidad_reservas
            FROM 
                servicio s
            INNER JOIN 
                servicio_usuario su ON s.id_servicio = su.servicio_id
            LEFT JOIN 
                servicio_imagenes si ON s.id_servicio = si.servicio_id
            GROUP BY 
                s.id_servicio, s.titulo, si.imagen_ref
            ORDER BY 
                cantidad_reservas DESC
            LIMIT 2;";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
