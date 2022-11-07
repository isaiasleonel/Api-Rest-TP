<?php
require_once './app/Views/producto.view.php';
require_once './app/Models/producto.model.php';
require_once './app/Models/marca.model.php';
require_once './app/Models/categoria.model.php';
require_once './app/helper/auth.helper.php';


class productoController
{
    private $model;
    private $view;
    private $modelMarca;
    private $modelCategoria;
    private $helper;

    public function __construct()
    {
        $this->model = new productoModel();
        $this->view = new productoView();
        $this->modelMarca = new marcaModel();
        $this->modelCategoria = new categoriaModel();
        $this->helper = new Auth();
    }



    //Obtengo base dato de la tabla producto y lo muestro al view
    public function showProducto()
    {
        $homeProd = $this->model->getDbProyCat();
        $homeCat = $this->modelCategoria->getDbCategoria();
        $this->view->showProducto($homeProd, $homeCat);
    }


    // Ordeno categoria x Items
    public function showOrders($id)
    {
        $ordenamiento = $this->model->getDbProduct($id);
        $homeCat = $this->modelCategoria->getDbCategoria();
        $this->view->showProducto($ordenamiento, $homeCat);
    }

    // Buscamos todas las tablas para mostrar la descripcion completa
    public function mostrarDescripcion($id)
    {
        $productoID = $this->model->getDbProdDescripcion($id);
        $categoriaID = $this->modelCategoria->getDbCategoria();
        $marcaID = $this->modelMarca->getDbMarca();
        $this->view->descripcionProd($productoID, $categoriaID, $marcaID);
    }


    // Boton agregar -> mando a un FORM para agregar nuevos valores
    function agregarProductos()
    {
        $this->helper->checkLoggedIn();
        $categoria = $this->modelCategoria->getDbCategoria();
        $marca = $this->modelMarca->getDbMarca();
        $this->view->showAgregar($categoria, $marca);
    }


    // Obtengo valor del FORM y los mando a mi base de datos para agregar nuevos datos
    function addProductos()
    {
        $this->helper->checkLoggedIn();
        if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['marca']) && isset($_POST['categoria'])) {
            $precio = $_POST['precio'];
            $nombre = $_POST['nombre'];
            $categoria = $_POST['categoria'];
            $marca = $_POST['marca'];

            if (
                $_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg"
                || $_FILES['imagen']['type'] == "image/png"
            ) {
                $this->model->insertarProductos($precio, $nombre, $categoria, $marca, $_FILES['imagen']['tmp_name']);
                header("Location: " . BASE_URL);
            }
        }
    }

    //------Buscamos valores ingresados por input-----
    function editarProductos($id)
    {

        $this->helper->checkLoggedIn();
        if (isset($_POST['nombre']) && isset($_POST['precio'])) {
            $precio = $_POST['precio'];
            $nombre = $_POST['nombre'];
            $categoria = $_POST['categoria'];
            $marca = $_POST['marca'];

            if (
                $_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg"
                || $_FILES['imagen']['type'] == "image/png"
            ) {
                $this->model->editarProductos($precio, $nombre, $categoria, $marca, $_FILES['imagen']['tmp_name'], $id);
                header("Location: " . BASE_URL . 'item' . '/' . $id);
            }

            header("Location: " . BASE_URL);
        }
    }

    // Fromulario para editar 
    function formEditar($id)
    {
        $this->helper->checkLoggedIn();
        $productoID = $this->model->getDbProdEditar($id);
        $categorias = $this->modelCategoria->getDbCategoria();
        $marcas = $this->modelMarca->getDbMarca();
        $this->view->showEditar($productoID, $categorias, $marcas);
    }


    // Borramos el Id seleccionado 
    function deleteProductos($id)
    {
        $this->helper->checkLoggedIn();
        $this->model->deleteProductoById($id);
        header("Location: " . BASE_URL);
    }
}
