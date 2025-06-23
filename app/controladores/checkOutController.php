<?php
require_once(__DIR__ . '/../modelos/hoodModel.php');
require_once(__DIR__ . '/../modelos/serviceModel.php');
require_once(__DIR__ . '/../modelos/checkOutModel.php');

class checkOutController {
    private $hoodModel;
    private $serviceModel;
    private $checkOutModel;

    public function __construct() {
        $this->hoodModel = new HoodModel;
        $this->serviceModel = new ServiceModel;
        $this->checkOutModel = new checkOutModel;
    }

    private function CheckAllRequiredValues($values = []){
        foreach ($values as $value) {
            if (strlen($value) < 1) {
                return false;
            }
        }

        return true;
    }

    public function ManageCheckOut() {
        $response = [];

        if (count($_SESSION) < 1) {
            $response = ["status"=>false,"msg"=>"Debes iniciar sesión para realizar una compra."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $servicio_id = filter_var(intval($_POST["servicio_id"]),FILTER_SANITIZE_NUMBER_INT);
        $usuario_id = $_SESSION["id"];
        $barrio_usuario = filter_var(intval($_POST["barrio_usuario"]),FILTER_SANITIZE_NUMBER_INT);
        $direccion_usuario = filter_var(trim($_POST["direccion_usuario"]),FILTER_SANITIZE_SPECIAL_CHARS);
        $metodo_pago = filter_var(trim($_POST["metodo_pago"]),FILTER_SANITIZE_SPECIAL_CHARS);
        $terminos_checked = filter_var(trim($_POST["terminos_checked"]),FILTER_SANITIZE_SPECIAL_CHARS);

        if (!$terminos_checked || $terminos_checked !== "checked") {
            $response = ["status"=>false,"msg"=>"Para realizar la compra de este servicio debes aceptar nuestros Términos y Condiciones."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        //VALIDAMOS QUE ESTÉN TODOS LOS DATOS SOLICITADOS
        $requiredValues = [$servicio_id,$usuario_id,$barrio_usuario,$direccion_usuario,$metodo_pago];
        if (!$this->CheckAllRequiredValues($requiredValues)) {
            $response = ["status"=>false,"msg"=>"Por favor ingrese todos los datos solicitados."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }
        //VALIDAMOS EL ID DEL BARRIO
        if (!is_numeric($barrio_usuario) || !$this->hoodModel->getHoodById($barrio_usuario)) {
            $response = ["status"=>false,"msg"=>"Por favor seleccione un barrio."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $service = $this->serviceModel->getServiceById($servicio_id);
        //VALIDAMOS EL ID DEL SERVICIO
        if (!is_numeric($servicio_id) || !$service) {
            $response = ["status"=>false,"msg"=>"Ocurrió un error al intentar localizar el servicio específico, por favor intentelo más tarde."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }
        //VALIDAMOS QUE EL DUEÑO NO COMPRE SU PROPIO SERVICIO PORQUE NO MAMES
        if ($this->serviceModel->GetServiceByUser($usuario_id,$servicio_id)) {
            $response = ["status"=>false,"msg"=>"No puedes comprar tu propio servicio."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }
       
        //VALIDAMOS MÉTODOS DE PAGO
        $paymentMethods = ["pago_directo","tarjeta"];
        if (!in_array($metodo_pago,$paymentMethods)) {
            $response = ["status"=>false,"msg"=>"Método de pago incorrecto."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        //SI ELIGIÓ COMO MÉTODO DE PAGO TARJETA
        if ($metodo_pago === "tarjeta") {
            $numero_tarjeta = filter_var(intval($_POST["numero_tarjeta"]),FILTER_SANITIZE_NUMBER_INT);
            $fecha_vencimiento_tarjeta = filter_var(trim($_POST["fecha_vencimiento_tarjeta"]),FILTER_SANITIZE_SPECIAL_CHARS);
            $cvv = filter_var(intval($_POST["cvv"]),FILTER_SANITIZE_NUMBER_INT);

            //REVISAMOS TODOS LOS DATOS PEDIDOS PARA EL PAGO
            if (!$this->CheckAllRequiredValues([$numero_tarjeta,$fecha_vencimiento_tarjeta,$cvv])) {
                $response = ["status"=>false,"msg"=>"Por favor llene todos los datos necesarios para el procedimiento del pago."];
                echo json_encode($response,JSON_UNESCAPED_UNICODE);
                die();
            }
            //NUMERO DE TARJETA
            if (!is_numeric($numero_tarjeta) || strlen($numero_tarjeta) < 12 || strlen($numero_tarjeta) > 19) {
                $response = ["status"=>false,"msg"=>"El número de tarjeta ingresado es incorrecto."];
                echo json_encode($response,JSON_UNESCAPED_UNICODE);
                die();
            }
            //FECHA DE VENCIMIENTO DE LA TARJETA
            if (date('Y-m') > $fecha_vencimiento_tarjeta) {
                $response = ["status"=>false,"msg"=>"Su tarjeta ha caducado."];
                echo json_encode($response,JSON_UNESCAPED_UNICODE);
                die();
            }
            //CVV
            if (!is_numeric($cvv) || strlen($cvv) < 3 || strlen($cvv) > 4) {
                $response = ["status"=>false,"msg"=>"El código de verificación de su tarjeta es incorrecto."];
                echo json_encode($response,JSON_UNESCAPED_UNICODE);
                die();
            }
        }

        try {
            $this->checkOutModel->Insert($servicio_id,$usuario_id,$service["precio"],$barrio_usuario,$direccion_usuario,$metodo_pago);

        } catch (PDOException $err) {
            $response = ["status"=>false,"msg"=>"Ocurrió un error al intentar realizar la acción: ".$err];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $response = ["status"=>true,"msg"=>"El servicio ha sido encargado correctamente!"];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function CancelPurchase(){
        $response = [];
        if (count($_SESSION) < 1) {
            $response = ["status"=>false,"msg"=>"Debes iniciar sesión para realizar esta acción."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }
        $servicio_id = filter_var(intval($_POST["servicio_id"]),FILTER_SANITIZE_NUMBER_INT);
        $usuario_id = $_SESSION["id"];

        if (!is_numeric($servicio_id) || !$this->serviceModel->getServiceById($servicio_id)) {
            $response = ["status"=>false,"msg"=>"No se pudo encontrar el servicio."];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        try {
            $this->checkOutModel->CancelService($servicio_id,$usuario_id);
        } catch (PDOException $err) {
            $response = ["status"=>false,"msg"=>"Ocurrió un error: ".$err];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die();
        }

        $response = ["status"=>true,"msg"=>"Servicio cancelado."];
        echo json_encode($response,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function index(){
        $ventas = $this->checkOutModel->GetAllSales();
        include_once(__DIR__ . '/../vistas/dashboard/ventas/index.php');
    }
}
