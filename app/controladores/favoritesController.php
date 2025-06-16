<?php
require_once(__DIR__ . '/../modelos/favoritesModel.php');
class favoritesController extends favoritesModel{
    private $favoritesModel;
    public function __construct(){
        $this->favoritesModel = new favoritesModel;
    }

    public function ManageFavorites(){
        $response = [];
        if (count($_SESSION) < 1) {
            $response = ["status"=>false,"msg"=>"Debes iniciar sesión para realizar esta acción"];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $serviceId = $_POST["servicio_id"]; 
        $userId = $_SESSION["id"];

        if (!is_numeric($serviceId)) {
            $response = ["status"=>false,"msg"=>"No se pudo encontrar el servicio solicitado."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $getFavorite = $this->favoritesModel->GetFavoritesByService($serviceId,$userId);
        
        if ($getFavorite) {
            try {
                $this->favoritesModel->DeleteFavorite($serviceId,$userId);
                $response = ["status"=>true,"action"=>"delete"];
                echo json_encode($response,JSON_UNESCAPED_UNICODE);
                die();
            } catch (PDOException $err) {
                $response = ["status"=>false,"msg"=>"Ocurrió un error: ".$err];
                echo json_encode($response,JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        try {
            $this->favoritesModel->InsertFavorite($serviceId,$userId);
            $response = ["status"=>true,"action"=>"insert"];
        } catch (PDOException $err) {
            $response = ["status"=>false,"msg"=>"Ocurrió un error: ".$err];
        }

        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function RemoveFavorites(){
        $response = [];
        if (count($_SESSION) < 1) {
            $response = ["status"=>false,"msg"=>"Debes iniciar sesión para realizar esta acción"];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $serviceId = trim($_POST["servicio_id"]); 
        $userId = $_SESSION["id"];

        if (!is_numeric($serviceId)) {
            $response = ["status"=>false,"msg"=>"No se pudo encontrar el servicio solicitado."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        try {
            $this->favoritesModel->DeleteFavorite($serviceId,$userId);
            $response = ["status"=>true,"msg"=>"Se ha removido el servicio de tus favoritos!"];
        } catch (PDOException $err) {
            $response = ["status"=>false,"msg"=>"Ocurrió un error: ".$err];
        }

        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();
    }
}