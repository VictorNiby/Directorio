<?php
require_once(__DIR__ . '/../modelos/ServiceModel.php');
require_once(__DIR__ . '/../modelos/HoodModel.php');
//importamos funcion para subir imagenes
require_once(__DIR__ . '/../controladores/uploadImage.php');

class serviceController {
    private $model;
    private $hoodModel;

    public function __construct() {
        $this->model = new ServiceModel;
        $this->hoodModel = new HoodModel;
    }

    // Mostrar lista de servicios
    public function index() {
        $users = $this->model->getAllUsers();
        $categories = $this->model->getAllCategories();
        $services = $this->model->getAllService();
        $hoods = $this->hoodModel->getAllHood();
        include_once(__DIR__ . '/../vistas/dashboard/servicios/index.php');
    }
    
    // Mostrar vista de actualización con los datos de un servicio
    public function updateView($serviceId) {
        $service = $this->model->getServiceById($serviceId);
        $users = $this->model->getAllUsers();
        $categories = $this->model->getAllCategories();
        include_once(__DIR__ . '/../vistas/dashboard/servicios/index.php');
    }

    public function insertService() {
        $response = [];
        if (!isset($_POST["titulo"], $_POST["descripcion"], $_POST["precio"], $_POST["usuario_id"],
            $_POST["categoria_id"],
            $_FILES["servicio_imagen"],$_POST["barrio_id"])) {

            $response = ["status"=>false,"msg"=>"Todos los campos son requeridos."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $titulo = trim($_POST["titulo"]);
        $descripcion = trim($_POST["descripcion"]);
        $precio = (float) $_POST["precio"];
        $usuarioId = (int) $_POST["usuario_id"];
        $categoriaId = (int) $_POST["categoria_id"];
        $barrio_id = (int) $_POST["barrio_id"];
        $direccion =  trim($_POST["direccion"]);
        
        try {
            $this->model->insert($titulo, $descripcion, $precio, $usuarioId, $categoriaId,$barrio_id,strlen($direccion)>0 ? $direccion : "No aplica");
        } catch (PDOException $err) {
            $response = ["status"=>false,"msg"=>"El servicio no pudo ser creado."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        //lo necesario para subir las imagenes
        $lastService = $this->model->getLastId();
        $imagenRef = uploadImage("servicio_imagen","service");

        if (!$this->model->uploadImg($lastService["id_servicio"],$imagenRef)) {
            $response = ["status"=>false,"msg"=>"No se pudo subir la imágen."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $response = ["status"=>true,"msg"=>"Servicio creado correctamente."];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function updateService() {
        $response = [];

        if (!isset($_POST["id_servicio"], $_POST["titulo"], $_POST["descripcion"], $_POST["precio"])) {
            $response = ["status"=>false,"msg"=>"Todos los campos son requeridos."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $id = (int) $_POST["id_servicio"];
        $titulo = trim($_POST["titulo"]);
        $descripcion = trim($_POST["descripcion"]);
        $precio = (float) $_POST["precio"];

        try {
            $this->model->update($titulo, $descripcion, $precio, $id);
        } catch (PDOException $err) {
            $response = ["status"=>false,"msg"=>"El servicio no pudo ser actualizado."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $response = ["status"=>true,"msg"=>"Servicio actualizado correctamente."];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function deleteService() {
        $response = [];

        if (!isset($_POST["deleteService"]) || !is_numeric($_POST["deleteService"])) {
            $response = ["status"=>false,"msg"=>"ID de servicio inválido."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $serviceId = (int) $_POST["deleteService"];
        try {
            $this->model->delete($serviceId);
        } catch (PDOException $err) {
            $response = ["status"=>false,"msg"=>"El servicio no pudo ser eliminado."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $response = ["status"=>true];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();
    }
    
}
