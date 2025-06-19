<?php 
include_once(__DIR__.'/../modelos/reviewsModel.php');
include_once(__DIR__.'/../modelos/serviceModel.php');

class reviewsController extends ReviewsModel{
    private $reviewsModel;
    private $serviceModel;

    public function __construct(){
        $this->reviewsModel = new ReviewsModel();
        $this->serviceModel = new ServiceModel();
    }

    public function CreateReview(){
        $response = [];
        if (count($_SESSION) < 1) {
            $response = ["status"=>false,"msg"=>"Debe haber iniciado sesión primero para realizar esta acción."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $calificacion = filter_var($_POST["calificacion"],FILTER_SANITIZE_NUMBER_INT);
        $comentario = filter_var(trim($_POST["comentario"]),FILTER_SANITIZE_SPECIAL_CHARS);
        $servicioId = filter_var($_POST["servicio_id"],FILTER_SANITIZE_NUMBER_INT);

        $usuarioId = $_SESSION["id"];
        //REVISAMOS QUE TODOS LOS CAMPOS SOLICITADOS TENGAN VALORES
        $requiredFields = [$calificacion,$comentario,$servicioId];
        foreach ($requiredFields as $field) {
            if (strlen($field) < 1) {
                $response = ["status"=>false,"msg"=>"Ingrese todos los datos solicitados."];
                echo json_encode($response,JSON_UNESCAPED_UNICODE);
                die();
            }
        }
        //VALIDAMOS $calificacion
        if ($calificacion < 1) {
            $response = ["status"=>false,"msg"=>"Por favor ingresa tu calificación."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }
        
        //VALIDAMOS $serviceId
        if (!is_numeric($servicioId)) {
            $response = ["status"=>false,"msg"=>"Tuvimos un problema localizando el servicio correspondiente, por favor, intentelo más tarde."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }else{
            $findService = $this->serviceModel->getServiceById($servicioId);
            if (!$findService) {
                $response = ["status"=>false,"msg"=>"Tuvimos un problema localizando el servicio correspondiente, por favor, intentelo más tarde."];
                echo json_encode($response,JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        try {
            $this->reviewsModel->InsertReview($calificacion,$comentario,$servicioId,$usuarioId);
        } catch (PDOException $err) {
            $response = ["status"=>false,"msg"=>"Ocurrió un error interno del servidor, por favor, intentelo más tarde."];
        }

        $response = ["status"=>true,"msg"=>"Muchas gracias por tu calificación!"];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();
    }
}