<?php
require_once(__DIR__ . '/../modelos/UserModel.php');

class UserController {
    private $model;

    public function __construct() {
        $this->model = new UserModel;
    }

    public function index() {
        $users = $this->model->getAllUsers();
        include_once(__DIR__ . '/../vistas/dashboard/usuarios/index.php');
    }

    public function updateView($userId) {
        $user = $this->model->getUserById($userId);
        include_once(__DIR__ . '/../vistas/dashboard/usuarios/index.php');
    }

    public function insertUser() {
        if (!isset($_POST["name"], $_POST["email"], $_POST["password"], $_POST["phone"], $_POST["document"], $_POST["birthdate"])) {
            echo "Todos los campos son requeridos.";
            return;
        }

        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = $_POST["password"];
        $phone = trim($_POST["phone"]);
        $document = trim($_POST["document"]);
        $birthdate = $_POST["birthdate"];
        $birthday = new DateTime($birthdate);
        $today = new DateTime();
        $age = $birthday->diff($today)->y;

        if ($age < 18) {
            echo "Debe tener al menos 18 años.";
            return;
        }

        if (!$this->model->insert($name, $email, $password, $phone, $document, $birthdate)) {
            echo "El usuario pudo ser creado.";
            return;
        }

        header("Location: /directorio/rutas/rutas.php?page=users");
        exit();
    }

    public function updateUser() {
        if (!isset($_POST["id"], $_POST["name"], $_POST["email"], $_POST["phone"], $_POST["document"], $_POST["birthdate"])) {
            echo "Datos inválidos.";
            return;
        }

        $userId = (int) $_POST["id"];
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $phone = trim($_POST["phone"]);
        $birthdate = $_POST["birthdate"];
        $birthday = new DateTime($birthdate);
        $today = new DateTime();
        $age = $birthday->diff($today)->y;

        if ($age < 18) {
            echo "Debe tener al menos 18 años.";
            return;
        }

        if (!$this->model->update($userId, $name, $email, $phone, $birthdate)) {
            echo "El usuario pudo ser actualizado.";
            return;
        }

        header("Location: /directorio/rutas/rutas.php?page=users");
        exit();
    }

    public function deleteUser() {
        if (!isset($_POST["deleteUser"]) || !is_numeric($_POST["deleteUser"])) {
            echo "Datos inválidos.";
            return;
        }

        $userId = (int) $_POST["deleteUser"];
        if (!$this->model->delete($userId)) {
            echo "El usuario no pudo ser eliminado.";
            return;
        }

        header("Location: /directorio/rutas/rutas.php?page=users");
        exit();
    }
}
