<?php
require_once(__DIR__ . '/../../configuracion/mysql.php');
class ReviewsModel extends Mysql{
    private $conn;

    public function __construct(){
        $mysql = new Mysql();
        $this->conn = $mysql->conect();
    }

    public function GetAllReviews(){  
        $query = "SELECT * FROM reviews ORDER BY fecha ASC";
        $preparedStmt = $this->conn->prepare($query);
        $preparedStmt->execute();
        $data = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function AllServicesReviews($service_id){  
        $query = "SELECT AVG(reviews.calificacion) as calificacion, COUNT(*) as total_reviews
        FROM reviews 
        WHERE reviews.servicio_id = ?
        LIMIT 9";
        $preparedStmt = $this->conn->prepare($query);
        $preparedStmt->execute([$service_id]);
        $data = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function TotalReviewsByService($service_id){  
        $query = "SELECT *,COUNT(*) as total_reviews
        FROM reviews
        WHERE servicio_id = ?";
        $preparedStmt = $this->conn->prepare($query);
        $preparedStmt->execute([$service_id]);
        $data = $preparedStmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function ReviewsByService($service_id){  
        $query = "SELECT id_review, calificacion, comentario, fecha, usuario_id, usuario.nombre as nombre_usuario, usuario.foto as usuario_foto
        FROM reviews
        INNER JOIN usuario on usuario.id_usuario = reviews.usuario_id
        WHERE servicio_id = ?
        LIMIT 5";
        $preparedStmt = $this->conn->prepare($query);
        $preparedStmt->execute([$service_id]);
        $data = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}