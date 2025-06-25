<?php
require_once(__DIR__ . '/../modelos/ServiceModel.php');
require_once(__DIR__ . '/../modelos/HoodModel.php');
require_once(__DIR__ . '/../modelos/userModel.php');
//importamos funcion para subir imagenes
require_once(__DIR__ . '/../controladores/uploadImage.php');

class serviceController {
    private $model;
    private $hoodModel;
    private $userModel;

    public function __construct() {
        $this->model = new ServiceModel;
        $this->hoodModel = new HoodModel;
        $this->userModel = new UserModel;
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

        $response = ["status"=>true,"msg"=>"Acción completada correctamente!"];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();
    }
    //PARA EL LANDING
    public function UploadService() {
        $response = [];
        if (!isset($_POST["titulo"], $_POST["descripcion"], $_POST["precio"],
            $_POST["categoria"],$_FILES["imagen"],$_POST["barrio"],$_POST["direccion"])) {

            $response = ["status"=>false,"msg"=>"Todos los campos son requeridos."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $titulo = trim($_POST["titulo"]);
        $descripcion = trim($_POST["descripcion"]);
        $precio = (float) $_POST["precio"];
        $usuarioId = $_SESSION["id"];
        $categoriaId = (int) $_POST["categoria"];
        $barrio_id = (int) $_POST["barrio"];
        $direccion =  trim($_POST["direccion"]);

        $requiredValues = [$titulo,$descripcion,$precio,$usuarioId,$categoriaId,$barrio_id];

        foreach ($requiredValues as $value) {
            if (empty($value)) {
                $response = ["status"=>false,"msg"=>"Todos los campos son requeridos."];
                echo json_encode($response,JSON_UNESCAPED_UNICODE);
                die();
            }
        }
        
        //SUBIR SERVICIO CON IMAGEN
        $lastService = "";

        try {
            if (!$this->model->insert($titulo, $descripcion, $precio, $usuarioId, $categoriaId,$barrio_id,strlen($direccion) > 0 ? $direccion : "No aplica")) {
                throw new Exception("No se pudo crear el servicio.");
            }

            $imagenRef = uploadImage("imagen","service");
            $lastService = $this->model->getLastId();

            if (!$this->model->uploadImg($lastService["id_servicio"],$imagenRef)) {
                throw new Exception("El servicio se creó pero no se pudo subir la imagen.");
            }

        } catch (Exception $err) {
            $response = ["status"=>false,"msg"=>$err];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        //SUBIR GALERIA SERVICIO
        if (isset($_FILES["galeria"]) && strlen($_FILES["galeria"]['name'][0]) > 0) {
            $galeryImgRef = UploadServiceGallery("galeria");

            if ($galeryImgRef["status"]) {

                foreach ($galeryImgRef["data"] as $img) {
                    $this->model->uploadImg($lastService["id_servicio"],$img);
                }

            }else {
                $response = ["status"=>false,"msg"=>$galeryImgRef["msg"]];
                echo json_encode($response,JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        $this->userModel->MakeUserSupplier($usuarioId);
        
        $response = ["status"=>true,"msg"=>"Servicio creado correctamente."];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();
    }
    
}
