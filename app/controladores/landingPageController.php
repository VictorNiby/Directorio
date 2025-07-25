<?php
require_once(__DIR__ . '/../modelos/CategoryModel.php');
require_once(__DIR__ . '/../modelos/serviceModel.php');
require_once(__DIR__ . '/../modelos/reviewsModel.php');
require_once(__DIR__ . '/../modelos/favoritesModel.php');
require_once(__DIR__ . '/../modelos/hoodModel.php');
require_once(__DIR__ . '/../modelos/historyModel.php');
require_once(__DIR__ . '/../modelos/ordersModel.php');

class LandingPageController{
    private $categoryModel;
    private $serviceModel;
    private $reviewsModel;
    private $favoritesModel;
    private $hoodsModel;
    private $historyModel;
    private $ordersModel;

    public function __construct(){
        $this->categoryModel = new CategoryModel;
        $this->serviceModel = new ServiceModel;
        $this->reviewsModel = new ReviewsModel;
        $this->favoritesModel = new favoritesModel;
        $this->hoodsModel = new HoodModel;
        $this->historyModel = new historyModel;
        $this->ordersModel = new ordersModel;
    }
    
    public function index(){
        $data = $this->categoryModel->GetAllCategory();
        $info = $this->categoryModel->GetAllCategoryLanding();
        $services = $this->serviceModel->getServicesWithImages();
        $toptier = $this->serviceModel->getAllServiceByPopulating();
        include_once(__DIR__ . '/../vistas/landing/index.php');
    }

    //PAGINA DE LA TIENDA
    public function ShopPage(){
        try {
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
            $filter_category = isset($_GET["category"]) && is_numeric($_GET["category"]) ? intval($_GET["category"]) : null;
            $price = isset($_GET["price"]) && is_numeric($_GET["price"]) ? intval($_GET["price"]) : null ;

            //TRAER LOS SERVICIOS DEPENDIENDO DE DE LOS FILTROS
            if (isset($filter_category) || (isset($price) )) {
                $ranges = [
                    0 => ['min' => 0, 'max' => 999999999],
                    1 => ['min' => 0, 'max' => 5000],
                    2 => ['min' => 5000, 'max' => 15000],
                    3 => ['min' => 15000, 'max' => 30000],
                    4 => ['min' => 30000, 'max' => 60000],
                    5 => ['min' => 60000, 'max' => 100000],
                    6 => ['min' => 100000, 'max' => 999999999]
                ];

                if (isset($filter_category) && !isset($price) ) {

                    if(!$this->categoryModel->CategoryById($filter_category)){
                        header("Location: rutas.php?page=shop"); 
                        die();
                    }
                    $services = $this->serviceModel->ServicesByCategory($filter_category);

                }else if(isset($price) && !isset($filter_category)){
                    
                    if (!isset($ranges[$price])) {
                        header("Location: rutas.php?page=shop"); 
                        die();
                    }

                    $services = $this->serviceModel->ServicesByPrice($ranges[$price]["min"],$ranges[$price]["max"]);
                    
                }else{
                    if (!$this->categoryModel->CategoryById($filter_category) || !isset($ranges[$price])) {
                        header("Location: rutas.php?page=shop"); 
                        die();
                    }

                    $services = $this->serviceModel->ServicesByCategoryAndPrice($filter_category,$ranges[$price]["min"],$ranges[$price]["max"]);
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

        } catch (\Throwable $th) {
            header("Location: rutas.php");
            die();
        }
        
    }
    //FIN PAGINA TIENDA

    //PAGE DETAILS SERVICE
    public function ServicePage($service_id) {
        try {
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
                $isOwner = $this->serviceModel->GetServiceByUser($_SESSION["id"],$service["id_servicio"]);

                $getUserReview = $this->reviewsModel->UserHasRatedService($_SESSION["id"],$service["id_servicio"]);

                $hasUserPurchasedService = $this->serviceModel->HasUserPurchasedService($_SESSION["id"],$service["id_servicio"]);

                if (!$isOwner && !$getUserReview && $hasUserPurchasedService) {
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

        } catch (\Throwable $th) {
            header("Location: rutas.php");
            die();
        }
        
    }

    //FAVORITES PAGE
    public function FavoritesPage(){
        try {
            $data = $this->categoryModel->GetAllCategory();
            $favorites = $this->favoritesModel->GetFavorites($_SESSION["id"]);
            include_once (__DIR__.'/../vistas/landing/favorites.php');

        } catch (\Throwable $th) {
            header("Location: rutas.php");
            die();
        }
        
    }
    //END FAVORITES PAGE

    //FAVORITES PAGE
    public function HistoryPage(){
        try {
            $data = $this->categoryModel->GetAllCategory();
            $history = $this->historyModel->GetHistory($_SESSION["id"]);
            include_once (__DIR__.'/../vistas/landing/history.php');
        } catch (\Throwable $th) {
            header("Location: rutas.php");
            die();
        }
        
    }
    //END FAVORITES PAGE

    //CHECKOUT PAGE
    public function CheckOutPage(){
        try {
            if (!is_numeric($_GET["service"]) || !$this->serviceModel->getServiceById($_GET["service"])) {
                header("Location: rutas.php");
                die();
            }
            $data = $this->categoryModel->GetAllCategory();
            $service = $this->serviceModel->getServiceById($_GET["service"]);
            $hoods = $this->hoodsModel->getAllHood();
            include_once (__DIR__.'/../vistas/landing/checkout.php');

        } catch (\Throwable $th) {
            header("Location: rutas.php");
            die();
        }
        
    }

    //ORDERS PAGE
    public function OrdersPage(){
        try {
            $data = $this->categoryModel->GetAllCategory();
            $orders = $this->ordersModel->GetOrders($_SESSION["id"]);

            include_once (__DIR__.'/../vistas/landing/orders.php');
        } catch (\Throwable $th) {
            header("Location: rutas.php");
            die();
        }
    }

    //MY SERVICES PAGE
    public function MyServicesPage(){
        try {
            $data = $this->categoryModel->GetAllCategory();
            $services = $this->serviceModel->GetUserServices($_SESSION["id"]);
            include_once (__DIR__.'/../vistas/landing/myServices.php');
        } catch (\Throwable $th) {
            echo $th;
            die();
        }
        
    }
    //END MY SERVICES PAGE

    //UPLOAD SERVICE PAGE
    public function UploadServicePage(){
        $data = $this->categoryModel->GetAllCategory();
        $hoods = $this->hoodsModel->getAllHood();
        include_once (__DIR__.'/../vistas/landing/uploadService.php');
    }

    public function ChatPage(){
        // $data = $this->categoryModel->GetAllCategory();

        include_once (__DIR__.'/../vistas/landing/chat.php');
    }

}
    


    
    