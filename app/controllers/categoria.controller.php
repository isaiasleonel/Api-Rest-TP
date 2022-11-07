<?php
require_once './app/Models/categoria.model.php';
require_once './app/Views/categoria.view.php';
require_once './app/helper/auth.helper.php';


class categoriaController
{
    private $model;
    private $view;
    private $helper;

    public function __construct()
    {
        $this->model = new categoriaModel();
        $this->view = new categoriaView();
        $this->helper = new Auth();
    }

    public function formCategoria()
    {
        $this->helper->checkLoggedIn();
        $categorias = $this->model->getDbCategoria();
        $this->view->formCategoria($categorias);
    }

    public function agregarCategoria()
    {
        $this->helper->checkLoggedIn();
        // si esta seteado 
        if (isset($_POST['nombreCat'])) {
            $nombreCat = $_POST['nombreCat'];

            // insertamos la categoria nueva 
            $this->model->insertarCategoria($nombreCat);
            //redireccionamos al HOME
            header("Location: " . BASE_URL);
        }
    }


    public function editarCategorias()
    {
        $this->helper->checkLoggedIn();

        if (isset($_POST)) {
            $nombreCat = $_POST['name'];
            $select = $_POST['categoria'];
            // insertamos la categoria nueva           
            $this->model->updateCategoria($nombreCat, $select);
            //redireccionamos al HOME
            header("Location: " . BASE_URL);
        }
    }


    public function deleteCategorias()
    {
        $this->helper->checkLoggedIn();

        if (isset($_POST)) {
            $select = $_POST['categoria'];
            $this->model->deleteCategorias($select);
            header("Location: " . BASE_URL);
        }
    }
}
