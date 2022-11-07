<?php
require_once './app/Models/marca.model.php';
require_once './app/Views/marca.view.php';


class marcaController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new marcaModel();
        $this->view = new marcaView();
    }

    public function showMarca()
    {
        $marcas = $this->model->getDbMarca();
        $this->view->showMarcas($marcas);
    }
}
