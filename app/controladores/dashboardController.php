<?php
require_once(__DIR__ . '/../modelos/DashboardModel.php');
require_once(__DIR__ . '/../modelos/CategoryModel.php');

class DashboardController extends DashboardModel{
    private $model;
    private $category;
    public function __construct(){
        $this->model = new DashboardModel;
        $this->cat = new CategoryModel;
    }

    public function index(){
        $servicesActive = $this->model->GetAllActiveService();
        $usersActive = $this->model->GetAllActiveUsers();
        $moneyEarned = $this->model->GetAllMoneyEarned();
        $moneyOwnEarned = $this->model->GetAllMoneyEarnedDirectorio();
        $feature = $this->cat->GetFeaturesServices();
        $linedata = $this->cat->GetUserMonth();
        include_once(__DIR__ . '/../vistas/dashboard/plantilla/body.php');
    }

    public function updateView($id){
        $data = $this->model->getHoodById($id);
        include_once(__DIR__ . '/../vistas/dashboard/plantilla/body.php');
    }
    
}