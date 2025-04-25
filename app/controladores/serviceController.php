<?php
require_once(__DIR__ . '/../modelos/ServiceModel.php');

class serviceController {
    private $model;
    public function __construct() {
        $this->model = new ServiceModel;
    }

    // Mostrar lista de servicios
    public function index() {
        $users = $this->model->getAllUsers();
        $categories = $this->model->getAllCategories();
        $services = $this->model->getAllService();
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
        if (!isset($_POST["titulo"], $_POST["descripcion"], $_POST["precio"], $_POST["usuario_id"], $_POST["categoria_id"],$_FILES["producto_imagen"])) {
            echo "Todos los campos son requeridos.";
            return;
        }

        $titulo = trim($_POST["titulo"]);
        $descripcion = trim($_POST["descripcion"]);
        $precio = (float) $_POST["precio"];
        $usuarioId = (int) $_POST["usuario_id"];
        $categoriaId = (int) $_POST["categoria_id"];

        $targetRoute = realpath(__DIR__ . '/../../publico/img/servicios/');
        $dateNow = date("h:i:s");

        $targetFile = $targetRoute . basename($_FILES["producto_imagen"]["name"]);

        $customName = $dateNow . pathinfo($_FILES["producto_imagen"]["name"],PATHINFO_EXTENSION);
        $imageExt = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        
        $allowedExt = ["jpg","png","jpeg"];
        if (!in_array($imageExt,$allowedExt)) {
            echo "Extensión de imagen no permitida (solo jpg, png, jpeg)";
            die();
        }

        if (!move_uploaded_file($_FILES["producto_imagen"]["tmp_name"],$targetFile . $customName)) {
            echo "No se subió la imágen.";
            die();
        }

        die();

        if (!$this->model->insert($titulo, $descripcion, $precio, $usuarioId, $categoriaId)) {
            echo "El servicio no pudo ser creado.";
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
