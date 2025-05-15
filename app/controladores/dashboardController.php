<?php
require_once(__DIR__ . '/../modelos/dashboardModel.php');
require_once(__DIR__ . '/../modelos/categoryModel.php');

class DashboardController extends DashboardModel{
    private $model;
    private $category;
    public function __construct(){
        $this->model = new DashboardModel;
        $this->category = new CategoryModel;
    }

    public function index(){
        $servicesActive = $this->model->GetAllActiveService();
        $usersActive = $this->model->GetAllActiveUsers();
        $moneyEarned = $this->model->GetAllMoneyEarned();
        $moneyOwnEarned = $this->model->GetAllMoneyEarnedDirectorio();
        $feature = $this->category->GetFeaturesServices();
        $linedata = $this->category->GetUserMonth();
        include_once(__DIR__ . '/../vistas/dashboard/plantilla/body.php');
    }

    public function updateView($id){
    }
    
}