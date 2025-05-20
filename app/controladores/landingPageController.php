<?php

require_once(__DIR__ . '/../modelos/CategoryModel.php');
require_once(__DIR__ . '/../modelos/serviceModel.php');
require_once(__DIR__ . '/../modelos/reviewsModel.php');

class LandingPageController{
    private $categoryModel;
    private $serviceModel;
    private $reviewsModel;

    public function __construct(){
        $this->categoryModel = new CategoryModel;
        $this->serviceModel = new ServiceModel;
        $this->reviewsModel = new ReviewsModel;
    }

    // LANDING PAGE
    public function index(){
        $data = $this->categoryModel->GetAllCategory();
        $info = $this->categoryModel->GetAllCategoryLanding();
        $services = $this->serviceModel->getServicesWithImages();
        include_once(__DIR__ . '/../vistas/landing/index.php');
    }
    // LANDING PAGE
    
    //Landing page de cada servicio
    public function servicePage($service_id) {
        $service = $this->serviceModel->getServiceById($service_id);
        $service_imgs = $this->serviceModel->getImagesByService($service_id);
        $reviews = $this->reviewsModel->ReviewsByService($service_id);
        $total_reviews = $this->reviewsModel->TotalReviewsByService($service_id);
        $related_services = $this->serviceModel->TopRelatedServices($service["id_categoria"],$service_id);

        include_once(__DIR__ . '/../vistas/landing/detail.php');
    }
}