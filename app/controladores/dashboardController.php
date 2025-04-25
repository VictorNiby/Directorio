<?php
require_once(__DIR__ . '/../modelos/DashboardModel.php');

class DashboardController extends DashboardModel{
    private $model;
    public function __construct(){
        $this->model = new DashboardModel;
    }

    public function index(){
        $data = $this->model->GetAllHood();
        include_once(__DIR__ . '/../vistas/dashboard/plantilla/body.php');
    }

    public function updateView($id){
        $data = $this->model->getHoodById($id);
        include_once(__DIR__ . '/../vistas/dashboard/plantilla/body.php');
    }
    
}