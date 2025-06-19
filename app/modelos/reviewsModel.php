<?php
require_once(__DIR__ . '/../../configuracion/mysql.php');
class ReviewsModel extends Mysql{
    private $conn;

    public function __construct(){
        $mysql = new Mysql();
        $this->conn = $mysql->conect();
    }
    //DASHBOARD I GUESS
    public function GetAllReviews(){  
        $query = "SELECT * FROM reviews ORDER BY fecha ASC";
        $preparedStmt = $this->conn->prepare($query);
        $preparedStmt->execute();
        $data = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    //PARA LA PAGINA DE SERVICIOS INDIVIDUALES, BLOQUE DE REVIEWS
    public function ReviewsByService($service_id){  
        $query = "SELECT id_review, calificacion, comentario, fecha, usuario_id, usuario.nombre as nombre_usuario, usuario.foto as usuario_foto
        FROM reviews
        INNER JOIN usuario on usuario.id_usuario = reviews.usuario_id
        WHERE servicio_id = ?
        GROUP BY calificacion DESC
        LIMIT 5";
        $preparedStmt = $this->conn->prepare($query);
        $preparedStmt->execute([$service_id]);
        $data = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    //PAGINA DE SERVICIO INDIVIDUAL, COUNT DE REVIEWS Y PROMEDIO
    public function CountReviewsByService($service_id){  
        $query = "SELECT COUNT(*) as total_reviews, AVG(reviews.calificacion) as reviews_promedio
        FROM reviews
        WHERE servicio_id = ?";
        $preparedStmt = $this->conn->prepare($query);
        $preparedStmt->execute([$service_id]);
        $data = $preparedStmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    //PAGINA DE LA TIENDA, MOSTRAR LAS CALIFICACIONES DE CADA SERVICIO
    public function AllServicesReviews($service_id){  
        $query = "SELECT AVG(reviews.calificacion) as calificacion, COUNT(*) as total_reviews
        FROM reviews 
        WHERE reviews.servicio_id = ?
        ";
        $preparedStmt = $this->conn->prepare($query);
        $preparedStmt->execute([$service_id]);
        $data = $preparedStmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    //GUARDAR NUEVA RESEÑA
    public function InsertReview($calificacion,$comentario,$servicioId,$usuarioId){
        $query = "INSERT INTO reviews(calificacion,comentario,servicio_id,usuario_id)
        VALUES (?,?,?,?)";
        $preparedStmt =$this->conn->prepare($query);
        $data = $preparedStmt->execute([$calificacion,$comentario,$servicioId,$usuarioId]);
        return $data;
    }
    //REVISAMOS SI EL USUARIO YA CALIFICÓ UNA VEZ EL SERVICIO
    public function UserHasRatedService($userId,$serviceId){  
        $query = "SELECT 1
        FROM reviews
        WHERE usuario_id = ? AND servicio_id = ?";
        $preparedStmt = $this->conn->prepare($query);
        $preparedStmt->execute([$userId,$serviceId]);
        $data = $preparedStmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}