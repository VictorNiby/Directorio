<?php
require_once(__DIR__ . '/../modelos/favoritesModel.php');
class favoritesController extends favoritesModel{
    private $favoritesModel;
    public function __construct(){
        $this->favoritesModel = new favoritesModel;
    }

    public function ManageFavorites(){
        
    }
}