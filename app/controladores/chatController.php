<?php
require_once(__DIR__ . '/../modelos/chatModel.php');

class ChatController extends ChatModel {
    private $model;

    public function __construct(){
        $this->model = new ChatModel;
    }

    public function index(){
        $chat = $this->model->getAllChats();
        include_once(__DIR__ . '/../vistas/dashboard/chats/index.php');
    }

    public function updateView($id){
        $mensaje = $this->model->getChatById($id);
        $chat = $this->model->getAllChats();
        include_once(__DIR__ . '/../vistas/dashboard/chats/index.php');
    }

    public function validateChat(){
        if (!isset($_POST["validateChat"]) || !is_numeric($_POST["validateChat"])) {
            echo "ID inválido para eliminar el chat.";
            return;
        }

        $id = (int) $_POST["validateChat"];
        if (!$this->model->validate($id)) {
            echo "No se pudo validar el chat.";
            return;
        }

        header("Location: /directorio/rutas/rutas.php?page=chats");
        exit();
    }

}
