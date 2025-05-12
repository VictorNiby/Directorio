<?php
require_once(__DIR__ . '/../modelos/SaleModel.php');

class SaleController {
    private $model;

    public function __construct() {
        $this->model = new UserModel;
    }

    public function index() {
        $sale = $this->model->getAllSale();
        include_once(__DIR__ . '/../vistas/dashboard/ventas/index.php');
    }

    public function updateView() {
        include_once(__DIR__ . '/../vistas/dashboard/usuarios/index.php');
    }

    public function insertSale() {

    }

    public function updateSale() {

    }

    public function deleteSale() {

    }
}
