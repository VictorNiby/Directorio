<?php
// =========================================================================
//  Controladores de Categorías
require_once(__DIR__ . '/../app/controladores/categoryController.php');
$categoryController = new CategoryController();

//  Controladores de Usuarios
require_once(__DIR__ . '/../app/controladores/userController.php');
$userController = new UserController();

//  Controladores de Barrios
require_once(__DIR__ . '/../app/controladores/hoodController.php');
$hoodController = new HoodController();

require_once(__DIR__ . '/../app/controladores/chatController.php');
$chatController = new ChatController();
// =========================================================================

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    switch ($_GET["page"]) {

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

        default:
            echo "PAGE WASN'T FOUND";
            break;
    }
}

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
}
