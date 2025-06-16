<?php
require_once (__DIR__. '/../controladores/uploadImage.php');
require_once (__DIR__. '/../modelos/sessionModel.php');
require_once (__DIR__. '/../modelos/userModel.php');

class sessionController extends sessionModel{
    private $sessionModel;
    private $userModel;

    public function __construct(){
        $this->sessionModel = new sessionModel();
        $this->userModel = new UserModel();
    }
    //VIEWS
    public function LogInView(){
        include_once(__DIR__ . '/../vistas/logIn.php');
    }

    public function SignUpView(){
        include_once(__DIR__ . '/../vistas/signUp.php');
    }
    //END VIEWS

    public function IsLoggedIn(){
        if (!isset($_SESSION["name"])) {
            return false;
        }

        return true;
    }

    public function CreateSession(){
       $response = [];

       $email = $_POST["email"]; 
       $password = $_POST["password"];
       
       if ((!isset($email) || strlen(trim($email)) < 1) || (!isset($password) || strlen(trim($password)) < 1)) {
            $response = ["status"=>false,"msg"=>"Ingrese todos los datos solicitados."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
       }
       //Buscamos la contraseña asignada a ese correo
       $hashedPass = $this->sessionModel->GetPassword($email);

       if (!$hashedPass) {
            $response = ["status"=>false,"msg"=>"Correo incorrecto."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        if (!password_verify($password,$hashedPass["password"])) {
            $response = ["status"=>false,"msg"=>"La contraseña es incórrecta."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $sessionData = $this->sessionModel->LogIn($email,$hashedPass["password"]);

        try {
            $_SESSION["id"] = $sessionData["id_usuario"];
            $_SESSION["name"] = $sessionData["nombre"];
            $_SESSION["role"] = $sessionData["rol"];
            $_SESSION["email"] = $sessionData["correo"];
            $_SESSION["photo"] = $sessionData["foto"];
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
        $session = count($_SESSION) > 0 ? $_SESSION : null;

        if (!isset($session)) {
            header("Location: rutas.php?page=logIn");
            die();
        }

        $_SESSION = array();

        session_destroy();

        header("Location: rutas.php?page=home");
        die();
    }

    public function CreateAccount(){
        $response = [];

        $documento = filter_var(trim($_POST["documento"]),FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_var(trim($_POST["nombre"]),FILTER_SANITIZE_SPECIAL_CHARS);
        $correo = filter_var(trim($_POST["correo"]),FILTER_SANITIZE_EMAIL);
        $password = filter_var(trim($_POST["password"]),FILTER_SANITIZE_SPECIAL_CHARS);
        $telefono = filter_var(trim($_POST["telefono"]),FILTER_SANITIZE_NUMBER_INT);
        $nacimiento = (trim($_POST["nacimiento"]));

        $arrayRequired = [$documento,$nombre,$correo,$password,$telefono,$nacimiento];
        //VERIFICAMOS QUE TODOS LOS CAMPOS REQUERIDOS TENGAN VALORES
        for ($i=0; $i <count($arrayRequired) ; $i++) { 
            if (strlen($arrayRequired[$i]) < 1) {
                $response = ["status"=>false,"msg"=>"Ingrese todos los datos solicitados."];
                echo json_encode($response,JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        //VALIDAMOS EDAD
        $birthDate = new DateTime($nacimiento);
        $today = new DateTime();

        $diff = $today->diff($birthDate)->y;

        if ($diff < 15) {
            $response = ["status"=>false,"msg"=>"La edad mínima es de 15 años."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        //VALIDAMOS CORREO
        if (!filter_var($correo,FILTER_VALIDATE_EMAIL)) {
            $response = ["status"=>false,"msg"=>"El correo ingresado no es válido."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $emailDuplicate = $this->userModel->GetUserByEmail($correo);
        if ($emailDuplicate) {
            $response = ["status"=>false,"msg"=>"El correo ingresado ya ha sido registrado por otro usuario."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }
        //VALIDAMOS NÚMERO DOCUMENTO
        if (strlen($documento) !== 10 || $documento < 1000000000) {
            $response = ["status"=>false,"msg"=>"El número de documento ingresado no es válido."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }
        //SUBIMOS IMAGEN Y CAPTURAMOS LA URL
        $imageRef = uploadImage("foto","user");

        try {
            $hashedPass = password_hash($password,PASSWORD_DEFAULT);
            $this->sessionModel->SignUp($documento,$nombre,$correo,$hashedPass,$telefono,$nacimiento,$imageRef);
        } catch (PDOException $err) {
            $response = ["status"=>false,"msg"=>"Ocurrió un error al crear el usuario: ".$err];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $response = ["status"=>true,"msg"=>"Cuenta creada correctamente!"];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();

    }
}