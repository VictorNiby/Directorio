<?php
// =========================================================================
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

// Controladores de Ventas
$saleController = "";

// =========================================================================



// ========================== GET ==========================
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $page = $_GET["page"] ?? 'home';

    switch ($page) {
        case 'categories':
            $categoryController->index();
            break;

        case 'update':
            if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
                echo "ID Inválido";
                return;
            }
            $categoryController->updateView($_GET["id"]);
            break;

        case 'users':
            $userController->index();
            break;

        case 'updateUser':
            if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
                echo "ID Inválido";
                return;
            }
            $userController->updateView($_GET["id"]);
            break;

        case 'hoods':
            $hoodController->index();
            break;

        case 'updateHood':
            if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
                echo "ID Inválido";
                return;
            }
            $hoodController->updateView($_GET["id"]);
            break;

        case 'chats':
            $chatController->index();
            break;

        case 'updateChat':
            if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
                echo "ID Inválido";
                return;
            }
            $chatController->updateView($_GET["id"]);
            break;

        case 'services':
            $serviceController->index();
            break;

        case 'updateService':
            if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
                echo "ID Inválido";
                return;
            }
            $serviceController->updateView($_GET["id"]);
            break;
        case 'dashboard':
            $dashController->index();
            break;

        case 'sales':
            $dashController->index();
            break;

        //PAGINA PARA CADA SERVICIO
        case 'service':
            $serviceController->servicePage($_GET["id"]);
            break;

        case 'home':
        default:
            $landingPageController->index();
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
