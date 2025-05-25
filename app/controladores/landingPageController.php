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

    public function index(){
        $data = $this->categoryModel->GetAllCategory();
        $info = $this->categoryModel->GetAllCategoryLanding();
        $services = $this->serviceModel->getServicesWithImages();
        include_once(__DIR__ . '/../vistas/landing/index.php');
    }

    //PAGINA DE LA TIENDA
    public function ShopPage(){
        $data = $this->categoryModel->GetAllCategory();
        $services_count = [];
        $services = [];

        $filter_category = isset($_GET["category"]) ? intval($_GET["category"]) : null ;
        $min = isset($_GET["min"]) ? intval($_GET["min"]) : null ;
        $max = isset($_GET["max"]) ? intval($_GET["max"]) : null ;
        
        if (isset($filter_category) || (isset($min) && isset($max))) {

            if (isset($filter_category) && !isset($min) ) {

                if(!is_numeric($filter_category) || $filter_category < 1) {
                    header("Location: rutas.php?page=home"); 
                    die();
                }
                $services = $this->serviceModel->ServicesByCategory($filter_category);
                

            }else if(isset($min) && !isset($filter_category)){
                
                if ($min < 0 || $max <= $min) {
                    header("Location: rutas.php?page=home"); 
                    die();
                }

                $services = $this->serviceModel->ServicesByPrice($min,$max);
            }else{

            }

        }else {
            $services = $this->serviceModel->ServicesWithReviews();
        }

        $reviews = [];

        foreach ($services as $service) {
            $query = $this->reviewsModel->AllServicesReviews($service["id_servicio"]);
            $reviews[] = ["calificacion"=>$query[0]["calificacion"],"total_reviews"=>$query[0]["total_reviews"]];
        }

        foreach ($data as $category) {
            $query = $this->serviceModel->CountServiceByCategory($category["id_categoria"]);
            $services_count[] = ["service_count"=>$query[0]["service_count"]];
        }

        include_once(__DIR__ . '/../vistas/landing/shop.php');
    }

    //FIN PAGINA TIENDA

    //PAGE DETAILS SERVICE
    public function servicePage($service_id) {
        $service = $this->serviceModel->getServiceById($service_id);
        $service_imgs = $this->serviceModel->getImagesByService($service_id);
        $reviews = $this->reviewsModel->ReviewsByService($service_id);
        $data = $this->categoryModel->GetAllCategory();
        $total_reviews = $this->reviewsModel->TotalReviewsByService($service_id);
        $related_services = $this->serviceModel->TopRelatedServices($service["id_categoria"],$service_id);
        $isEmpty = false;

        for ($i=0; $i <count($related_services) ; $i++) { 
            if (in_array("",$related_services[$i]) || in_array(null,$related_services[$i])) {
                $isEmpty = true;
            }
        }

        include_once(__DIR__ . '/../vistas/landing/detail.php');
    }

}
    


    
    