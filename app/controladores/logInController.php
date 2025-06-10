<?php
require_once (__DIR__. '/../modelos/logInModel.php');

class logInController extends logInModel{
    private $loginModel;

    public function __construct(){
        $this->loginModel = new logInModel();
    }

    public function index(){
        include_once(__DIR__ . '/../vistas/logIn.php');
    }

    public function IsLoggedIn(){
        if (!isset($_SESSION["name"])) {
            return false;
        }

        return true;
    }

    public function CreateLogIn(){
       $response = [];

       $email = $_POST["email"]; 
       $password = $_POST["password"];
       
       if ((!isset($email) || strlen(trim($email)) < 1) || (!isset($password) || strlen(trim($password)) < 1)) {
            $response = ["status"=>false,"msg"=>"Ingrese todos los datos solicitados."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
       }

       $query = $this->loginModel->LogIn($email,$password);

       if (!$query) {
            $response = ["status"=>false,"msg"=>"Credenciales inválidas."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
       }

       try {
            $_SESSION["name"] = $query["nombre"];
            $_SESSION["role"] = $query["rol"];
            $_SESSION["email"] = $query["correo"];
            $_SESSION["photo"] = $query["foto"];
       } catch (\Throwable $th) {
            $response = ["status"=>false,"msg"=>"Ocurrió un error al momento de iniciar sesión, por favor intentelo más tarde."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
       }

       $response = ["status"=>true,"msg"=>"Sesión iniciada correctamente."];
       echo json_encode($response,JSON_UNESCAPED_UNICODE);
       die();
    }

    public function LogOut(){
        $session = $_SESSION["name"] ? $_SESSION["name"] : null;

        if (!isset($session)) {
            return false;
        }

        $_SESSION = array();

        session_destroy();
        header("Location: rutas.php?page=logIn");
        die();
    }
}