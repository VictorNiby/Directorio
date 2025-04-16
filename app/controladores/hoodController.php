<?php
require_once(__DIR__ . '/../modelos/HoodModel.php');

class HoodController extends HoodModel{
    private $model;
    public function __construct(){
        $this->model = new HoodModel;
    }

    public function index(){
        $data = $this->model->GetAllHood();
        include_once(__DIR__ . '/../vistas/dashboard/barrios/index.php');
    }

    public function updateView($id){
        $data = $this->model->getHoodById($id);
        include_once(__DIR__ . '/../vistas/dashboard/barrios/index.php');
    }

    public function insertHood(){
        if (!isset($_POST["name"]) || !trim($_POST["name"])) {
            echo "El nombre del barrio es obligatorio.";
            return;
        }
    
        $name = trim($_POST["name"]);
        if (!$this->model->insert($name)) {
            echo "No se pudo insertar la categoría.";
            return;
        }
    
        header("Location: /directorio/rutas/rutas.php?page=hoods");
        exit();
    }
    

    public function UpdateHood(){
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
    
        header("Location: /directorio/rutas/rutas.php?page=hoods");
        exit();
    }
    

    public function DeleteHood(){
        if (!isset($_POST["deleteHood"]) || !is_numeric($_POST["deleteHood"])) {
            echo "ID inválido para eliminar.";
            return;
        }
    
        $id = (int) $_POST["deleteHood"];
        if (!$this->model->Delete($id)) {
            echo "No se pudo eliminar la categoría.";
            return;
        }
    
        header("Location: /directorio/rutas/rutas.php?page=hoods");
        exit();
    }    
    
}