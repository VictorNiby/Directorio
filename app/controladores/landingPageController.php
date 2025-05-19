<?php

require_once(__DIR__ . '/../modelos/CategoryModel.php');
require_once(__DIR__ . '/../modelos/serviceModel.php');

class LandingPageController{
    private $categoryModel;
    private $serviceModel;
    public function __construct(){
        $this->categoryModel = new CategoryModel;
        $this->serviceModel = new ServiceModel;
    }

    // LANDING PAGE
    public function index(){
        $data = $this->categoryModel->GetAllCategory();
        $info = $this->categoryModel->GetAllCategoryLanding();
        $feature = $this->categoryModel->GetFeaturesServices();
        $imgs = $this->serviceModel->getImages();
        include_once(__DIR__ . '/../vistas/landing/index.php');
    }
    // LANDING PAGE
    
}