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
        if (!isset($_POST["titulo"], $_POST["descripcion"], $_POST["precio"], $_POST["usuario_id"],
            $_POST["categoria_id"],
            $_FILES["servicio_imagen"],$_POST["barrio_id"])) {
            echo "Todos los campos son requeridos.";
            return;
        }

        $titulo = trim($_POST["titulo"]);
        $descripcion = trim($_POST["descripcion"]);
        $precio = (float) $_POST["precio"];
        $usuarioId = (int) $_POST["usuario_id"];
        $categoriaId = (int) $_POST["categoria_id"];
        $barrio_id = (int) $_POST["barrio_id"];
        $direccion =  trim($_POST["direccion"]);
        
        if (!$this->model->insert($titulo, $descripcion, $precio, $usuarioId, $categoriaId,$barrio_id,strlen($direccion)>0 ? $direccion : "No aplica")) {
            echo "El servicio no pudo ser creado.";
            return;
        }

        //lo necesario para subir las imagenes
        $lastService = $this->model->getLastId();
        $imagenRef = uploadImage("servicio_imagen","service");

        if (!$this->model->uploadImg($lastService["id_servicio"],$imagenRef)) {
            echo "No se pudo subir la imágen.";
            return;
        }

        header("Location: /directorio/rutas/rutas.php?page=services");
        exit();
    }

    public function updateService() {
        if (!isset($_POST["id_servicio"], $_POST["titulo"], $_POST["descripcion"], $_POST["precio"])) {
            echo "Datos incompletos.";
            return;
        }

        $id = (int) $_POST["id_servicio"];
        $titulo = trim($_POST["titulo"]);
        $descripcion = trim($_POST["descripcion"]);
        $precio = (float) $_POST["precio"];

        if (!$this->model->update($titulo, $descripcion, $precio, $id)) {
            echo "El servicio no pudo ser actualizado.";
            return;
        }

        header("Location: /directorio/rutas/rutas.php?page=services");
        exit();
    }

    public function deleteService() {
        if (!isset($_POST["deleteService"]) || !is_numeric($_POST["deleteService"])) {
            echo "ID de servicio inválido.";
            return;
        }

        $serviceId = (int) $_POST["deleteService"];
        if (!$this->model->delete($serviceId)) {
            echo "El servicio no pudo ser eliminado.";
            return;
        }

        header("Location: /directorio/rutas/rutas.php?page=services");
        exit();
    }
    
}
