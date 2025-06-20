<?php
require_once(__DIR__ . '/../modelos/CategoryModel.php');
require_once(__DIR__ . '/../modelos/serviceModel.php');
require_once(__DIR__ . '/../modelos/reviewsModel.php');
require_once(__DIR__ . '/../modelos/favoritesModel.php');
require_once(__DIR__ . '/../modelos/hoodModel.php');

class LandingPageController{
    private $categoryModel;
    private $serviceModel;
    private $reviewsModel;
    private $favoritesModel;
    private $hoodsModel;

    public function __construct(){
        $this->categoryModel = new CategoryModel;
        $this->serviceModel = new ServiceModel;
        $this->reviewsModel = new ReviewsModel;
        $this->favoritesModel = new favoritesModel;
        $this->hoodsModel = new HoodModel;
    }
    
    public function index(){
        $data = $this->categoryModel->GetAllCategory();
        $info = $this->categoryModel->GetAllCategoryLanding();
        $services = $this->serviceModel->getServicesWithImages();
        include_once(__DIR__ . '/../vistas/landing/index.php');
    }

    //PAGINA DE LA TIENDA
    public function ShopPage(){
        //PARA EL HEADER
        $data = $this->categoryModel->GetAllCategory();
        //CONSEGUIMOS LOS FAVORITOS DEL USUARIO
        $getFavs= count($_SESSION) > 0 ? $this->favoritesModel->GetFavorites($_SESSION["id"]) :  null;
        $favs = [];
        //GUARDAMOS EN UN ARRAY SOLO LOS IDS 
        if (isset($getFavs)) {
            foreach ($getFavs as $fav) {
                $favs[] = $fav["id_servicio"];
            }      
        }

        $services_count = [];
        $services = [];
        $filter_category = isset($_GET["category"]) ? intval($_GET["category"]) : null ;
        $min = isset($_GET["min"]) ? intval($_GET["min"]) : null ;
        $max = isset($_GET["max"]) ? intval($_GET["max"]) : null ;

        //TRAER LOS SERVICIOS DEPENDIENDO DE DE LOS FILTROS
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
            $services = $this->serviceModel->ShopPageServices();
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
    public function ServicePage($service_id) {
        //FAVORTIOS DEL USUARIO
        $data = $this->categoryModel->GetAllCategory();
        $getFavs= count($_SESSION) > 0 ? $this->favoritesModel->GetFavorites($_SESSION["id"]) :  null;
        $favs = [];

        if (isset($getFavs)) {
            foreach ($getFavs as $fav) {
                $favs[] = $fav["id_servicio"];
            }      
        }

        //SERVICIO INDIVIDUAL
        $service = $this->serviceModel->getServiceById($service_id);
        $service_imgs = $this->serviceModel->getImagesByService($service_id);
        $serviceReviews = $this->reviewsModel->CountReviewsByService($service_id);
        //BLOQUE DE RESEÑAS
        $reviews = $this->reviewsModel->ReviewsByService($service_id);
        $canUserRateService = false;

        if (count($_SESSION) > 0) {
            $getUserReview = $this->reviewsModel->UserHasRatedService($_SESSION["id"],$service["id_servicio"]);

            $hasUserPurchasedService = $this->serviceModel->HasUserPurchasedService($_SESSION["id"],$service["id_servicio"]);

            if (!$getUserReview && $hasUserPurchasedService) {
                $canUserRateService = true;
            }
        }

        //BLOQUE SERVICIOS RELACIONADOS
        $related_services = $this->serviceModel->TopRelatedServices($service["id_categoria"],$service_id);
        $isEmpty = false;
        
        if (empty($related_services)) {
            $isEmpty = true;
        }

        include_once(__DIR__ . '/../vistas/landing/detail.php');
    }

    //FAVORITES PAGE
    public function FavoritesPage(){
        $data = $this->categoryModel->GetAllCategory();
        $favorites = $this->favoritesModel->GetFavorites($_SESSION["id"]);
        include_once (__DIR__.'/../vistas/landing/favorites.php');
    }
    //END FAVORITES PAGE

    //CHECKOUT PAGE
    public function CheckOutPage(){
        $data = $this->categoryModel->GetAllCategory();
        $service = $this->serviceModel->getServiceById($_GET["service"]);
        $hoods = $this->hoodsModel->getAllHood();

        include_once (__DIR__.'/../vistas/landing/checkout.php');
    }

}
    


    
    