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
        $response = [];

        if (!isset($_POST["name"], $_POST["email"], $_POST["password"], $_POST["phone"], $_POST["document"], $_POST["birthdate"])) {
            $response = ["status"=>false,"msg"=>"Todos los campos son requeridos."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
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
            $response = ["status"=>false,"msg"=>"Debe tener al menos 18 años."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        try {
            $this->model->insert($name, $email,$password, $phone, $document, $birthdate);
        } catch (PDOException $err) {
            $response = ["status"=>false,"msg"=>"El usuario no pudo ser creado."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $response = ["status"=>true,"msg"=>"Usuario creado correctamente."];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function updateUser() {
        $response = [];

        if (!isset($_POST["id"], $_POST["name"], $_POST["email"], $_POST["phone"], $_POST["birthdate"])) {
            $response = ["status"=>false,"msg"=>"Todos los campos son requeridos."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
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
            $response = ["status"=>false,"msg"=>"Debe tener al menos 18 años."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        try {
            $this->model->update($userId, $name, $email, $phone, $birthdate);
        } catch (PDOException $err) {
            $response = ["status"=>false,"msg"=>"El usuario no pudo ser actualizado."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $response = ["status"=>true,"msg"=>"El usuario se actualizó correctamente."];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function deleteUser() {
        $response = [];

        if (!isset($_POST["deleteUser"]) || !is_numeric($_POST["deleteUser"])) {
            $response = ["status"=>false,"msg"=>"Datos inválidos."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $userId = (int) $_POST["deleteUser"];
        try {
            $this->model->delete($userId);
        } catch (PDOException $err) {
            $response = ["status"=>false,"msg"=>"No se pudo desactivar el usuario."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $response = ["status"=>true,"msg"=>"Acción completada correctamente."];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();
    }
}
