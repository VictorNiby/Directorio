<?php
require_once(__DIR__ . '/../modelos/CategoryModel.php');

class CategoryController extends CategoryModel{
    private $model;
    public function __construct(){
        $this->model = new CategoryModel;
    }

    public function index(){
        $data = $this->model->GetAllCategory();
        include_once(__DIR__ . '/../vistas/dashboard/categorias/index.php');
    }

    public function updateView($id){
        $data = $this->model->CategoryById($id);
        include_once(__DIR__ . '/../vistas/dashboard/categorias/index.php');
    }

    public function insertCategory(){
        if (!isset($_POST["name"]) || !trim($_POST["name"])) {
            echo "El nombre de la categoría es obligatorio.";
            return;
        }
    
        $name = trim($_POST["name"]);
        if (!$this->model->insert($name)) {
            echo "No se pudo insertar la categoría.";
            return;
        }
    
        header("Location: /directorio/rutas/rutas.php?page=categories");
        exit();
    }
    

    public function UpdateCategory(){
        if (!isset($_POST["name"], $_POST["id"]) || 
            !trim($_POST["name"]) || 
            !is_numeric($_POST["id"])) {
            echo "Datos inválidos para actualizar la categoría.";
            return;
        }
    
        $name = trim($_POST["name"]);
        $id = (int) $_POST["id"];
        
        if (!$this->model->Update($name, $id)) {
            echo "No se pudo actualizar la categoría.";
            return;
        }
    
        header("Location: /directorio/rutas/rutas.php?page=categories");
        exit();
    }
    

    public function DeleteCategory(){
        if (!isset($_POST["delete"]) || !is_numeric($_POST["delete"])) {
            echo "ID inválido para eliminar.";
            return;
        }
    
        $id = (int) $_POST["delete"];
        if (!$this->model->Delete($id)) {
            echo "No se pudo eliminar la categoría.";
            return;
        }
    
        header("Location: /directorio/rutas/rutas.php?page=categories");
        exit();
    }    
    
}