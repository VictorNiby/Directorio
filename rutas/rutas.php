<?php
// =========================================================================
date_default_timezone_set('America/Bogota');

// Controladores de la landing Page
require_once(__DIR__ . '/../app/controladores/sessionController.php');
$sessionController = new sessionController();

// Controladores de Categorías
require_once(__DIR__ . '/../app/controladores/categoryController.php');
$categoryController = new CategoryController();

// Controladores de Usuarios
require_once(__DIR__ . '/../app/controladores/userController.php');
$userController = new UserController();

// Controladores de Barrios
require_once(__DIR__ . '/../app/controladores/hoodController.php');
$hoodController = new HoodController();

// Controladores de Chats - Mensajes
require_once(__DIR__ . '/../app/controladores/chatController.php');
$chatController = new ChatController();

// Controladores de Servicios
require_once(__DIR__ . '/../app/controladores/serviceController.php');
$serviceController = new ServiceController();

// Controladores del Menu Principal Dashboard
require_once(__DIR__ . '/../app/controladores/dashboardController.php');
$dashController = new DashboardController();

// Controladores de la landing Page
require_once(__DIR__ . '/../app/controladores/landingPageController.php');
$landingPageController = new LandingPageController();

// Controller favorites
require_once(__DIR__ . '/../app/controladores/favoritesController.php');
$favoritesController = new favoritesController();

// Controller reviews
require_once(__DIR__ . '/../app/controladores/reviewsController.php');
$reviewsController = new reviewsController();

// Controladores de Ventas
require_once(__DIR__ . '/../app/controladores/checkOutController.php');
$checkOutController = new checkOutController;

// =========================================================================
session_start();

// ========================== GET ==========================
if ($_SERVER["REQUEST_METHOD"] === "GET"){
    //SI NO HAY SE ENCUENTRA EL PARAMETRO 'page', REVISA OTRO PARAMETRO LLAMADO 'action', SI TAMPOCO LO ENCUENTRA, REDIRECCIONA AL HOME
    if (!isset($_GET["page"])) {
        if (!isset($_GET["action"])) {
            header("Location: rutas.php?page=home");
            die();
        }

        $action = $_GET["action"];
        switch ($action) {
            case 'getFavsCount':
                $favoritesController->FavoritesCount();
                break;
            
            default:
                echo "QUE!";
                break;
        }
    }

    $page = $_GET["page"] ?? 'home';
    //HAS LOGGED IN?
    $isLoggedIn = $sessionController->IsLoggedIn();

    //ALL PAGES
    switch ($page) {
        // ============================= LANDING ===========================================
        case 'home':
            $landingPageController->index();
            break;

        //SESSION
        case 'logIn':
            $sessionController->LogInView();
            break;

        case 'signUp':
            $sessionController->SignUpView();
            break;

        case 'shop':
            $landingPageController->ShopPage();
            break;

        //PAGINA PARA CADA SERVICIO
        case 'service':
            if (!isset($_GET["id"])) {
                header("Location: rutas.php?page=home");
                break;
            }
            $landingPageController->ServicePage($_GET["id"]);
            break;
        
        case 'favorites':
            $isLoggedIn ? $landingPageController->FavoritesPage() : header("Location: rutas.php?page=logIn");
            break;

        case 'checkout':
            $isLoggedIn && isset($_GET["service"]) ? $landingPageController->CheckOutPage() : header("Location: rutas.php?page=home");
            break;

        case 'shoppingHistory':
            $isLoggedIn ? $landingPageController->HistoryPage() : header("Location:rutas.php?page=logIn");
            break;

        case 'orders':
            $isLoggedIn && $_SESSION["role"] === "proveedor" ? $landingPageController->OrdersPage() : header("Location:rutas.php?page=home");
            break;

        case 'chat':
            $isLoggedIn ? $landingPageController->ChatPage() : header("Location:rutas.php?page=logIn");
            break;

        case 'myServices':
            $isLoggedIn && $_SESSION["role"] === 'proveedor' ? $landingPageController->MyServicesPage() : header("Location:rutas.php?page=home");
            break;

        // ============================= DASHBOARD ===========================================
        case 'categories':
            $isLoggedIn ? $categoryController->index() : header("Location: rutas.php?page=logIn");
            break;

        case 'update':
            if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
                echo "ID Inválido";
                return;
            }
            $isLoggedIn ?  $categoryController->updateView($_GET["id"]) : header("Location: rutas.php?page=logIn");
            break;

        case 'users':
            $isLoggedIn ? $userController->index() : header("Location: rutas.php?page=logIn");
            break;

        case 'updateUser':
            if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
                echo "ID Inválido";
                return;
            }
            $isLoggedIn ? $userController->updateView($_GET["id"]) : header("Location: rutas.php?page=logIn");
            break;

        case 'hoods':
            $isLoggedIn ? $hoodController->index() : header("Location: rutas.php?page=logIn");
            break;

        case 'updateHood':
            if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
                echo "ID Inválido";
                return;
            }
            $isLoggedIn ? $hoodController->updateView($_GET["id"]) : header("Location: rutas.php?page=logIn");
            break;

        case 'chats':
            $isLoggedIn ? $chatController->index(): header("Location: rutas.php?page=logIn");
            break;

        case 'updateChat':
            if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
                echo "ID Inválido";
                return;
            }
            $isLoggedIn ? $chatController->updateView($_GET["id"]) : header("Location: rutas.php?page=logIn");
            break;

        case 'services':
            $isLoggedIn ? $serviceController->index() : header("Location: rutas.php?page=logIn");
            break;

        case 'updateService':
            if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
                echo "ID Inválido";
                return;
            }
            $isLoggedIn ? $serviceController->updateView($_GET["id"]) : header("Location: rutas.php?page=logIn");
            break;

        case 'sales':
            $isLoggedIn ? $checkOutController->index() : header("Location: rutas.php?page=logIn");
            break;
            
        case 'dashboard':
            $isLoggedIn && $_SESSION["role"] === 'admin' ? $dashController->index() : header("Location: rutas.php?page=logIn");
            break;

        default:
            header("Location: rutas.php?page=home");
            break;
    }
}

// ========================== POST ==========================
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST["action"])) {
        switch ($_POST["action"]) {
            case 'insert':
                $categoryController->insertCategory();
                break;

            case 'update':
                $categoryController->UpdateCategory();
                break;

            case 'insertUser':
                $userController->insertUser();
                break;

            case 'updateUser':
                $userController->updateUser();
                break;

            case 'insertHood':
                $hoodController->insertHood();
                break;

            case 'updateHood':
                $hoodController->UpdateHood();
                break;

            case 'insertService':
                $serviceController->insertService();
                break;

            case 'updateService':
                $serviceController->UpdateService();
                break;
            
            //SESSION
            case 'logIn':
                $sessionController->CreateSession();
                break;

            case 'logOut':
                $sessionController->LogOut();
                break;

            // ============================= LANDING ===========================================
            case 'signUp':
                $sessionController->CreateAccount();
                break;
            
            case 'manageFavorites':
                $favoritesController->ManageFavorites();
                break;

            case 'deleteFavorite':
                $favoritesController->RemoveFavorites();
                break;

            case 'newReview':
                $reviewsController->CreateReview();
                break;

            case 'checkOut':
                $checkOutController->ManageCheckOut();
                break;

            case 'cancelService':
                $checkOutController->CancelPurchase();
                break;

            default:
                echo "INVALID METHOD";
                break;
        }
    }

    if (isset($_POST["delete"])) {
        $categoryController->DeleteCategory();
    }

    if (isset($_POST["deleteUser"])) {
        $userController->deleteUser();
    }

    if (isset($_POST["deleteHood"])) {
        $hoodController->deleteHood();
    }

    if (isset($_POST["validateChat"])) {
        $chatController->validateChat();
    }

    if (isset($_POST["deleteService"])) {
        $serviceController->deleteService();
    }
}
