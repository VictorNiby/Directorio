<?php
require_once(__DIR__ . '/../../configuracion/mysql.php');

class favoritesModel extends Mysql{
    private $connection;

    public function __construct(){
        $mysql = new Mysql();
        $this->connection = $mysql->conect();
    }

    public function GetFavorites($usuarioId){
        $query = "SELECT servicio_imagenes.imagen_ref,
        servicio.titulo,servicio.precio, servicio.id_servicio
        FROM favoritos
        INNER JOIN servicio_imagenes on servicio_imagenes.servicio_id = favoritos.servicio_id
        INNER JOIN servicio on servicio.id_servicio = favoritos.servicio_id
        WHERE favoritos.usuario_id = ?
        ";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$usuarioId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetFavoritesByService($serviceId,$usuarioId){
        $query = "SELECT 1
        FROM favoritos
        WHERE favoritos.usuario_id = ? AND favoritos.servicio_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$usuarioId,$serviceId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function GetFavoritesCount($usuarioId){
        $query = "SELECT COUNT(*) as total
        FROM favoritos
        WHERE favoritos.usuario_id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->execute([$usuarioId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function InsertFavorite($servicioId,$usuarioId){
        $query = "INSERT INTO favoritos(servicio_id,usuario_id)
        VALUES (?,?)";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$servicioId,$usuarioId]);
    }

    public function DeleteFavorite($servicioId,$usuarioId){
        $query = "DELETE FROM favoritos
        WHERE favoritos.servicio_id = ? AND favoritos.usuario_id = ?";
        $stmt = $this->connection->prepare($query);
        return $stmt->execute([$servicioId,$usuarioId]);
    }

}