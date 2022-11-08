<?php

require_once './app/Models/producto.model.php';
require_once './app/Models/marca.model.php';
require_once './app/Models/categoria.model.php';
require_once './api-app/api-view/api.view.php';
require_once './api-app/ApiHelper/auth.ApiHelper.php';

class ProductoApiController
{
    private $authHelper;
    private $model;
    private $view;
    private $data;
    private $dataMarca;
    private $dataCategoria;

    public function __construct()
    {
        $this->authHelper = new AuthApiHelper();
        $this->model = new productoModel();
        $this->dataMarca = new MarcaModel();
        $this->dataCategoria = new CategoriaModel();
        $this->view = new ApiView();

        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        return json_decode($this->data);
    }


    /**
     * 
     * Obtengo base dato de la tabla producto y lo muestro al view
     * 
     */
    public function getProductos($params = null)
    {
        $sortByDefault = "id_producto";
        $orderDefault = "asc";
        $division_pages = 10;
        $page = 1;
        $array = array("id_producto", "precio", "nombre", "imagen", "marca_fk", "categoria_fk");

        // condicion para Page
        if (isset($_GET["page"])) {
            $page = $this->convert($_GET["page"], $page);
        }
        $principle = ($page - 1) * $division_pages;

        // ordenamiento 
        if (!empty($_GET["sortby"]) && !empty($_GET["order"])) {
            $datos = $this->model->getDbProyCat($principle, $division_pages, $_GET["sortby"], $_GET["order"]);
        } else if (!empty($_GET["sortby"]) && (array_key_exists($_GET["sortby"], $array))) {
            $datos = $this->model->getDbProyCat($principle, $division_pages, $_GET["sortby"], $orderDefault);
        } else if (!empty($_GET["order"])) {
            $datos = $this->model->getDbProyCat($principle, $division_pages, $sortByDefault, $_GET["order"]);
        }

        // condicion para filtrar
        else if (!empty($_GET["column"]) && !empty($_GET["value"])) {
            $column = $_GET["column"];
            $value = $_GET["value"];
            $datos = $this->model->filterFields($column, $value);
        } else {
            $datos = $this->model->getDbProyCat($principle, $division_pages);
        }

        $this->view->response($datos, 200);
    }

    //  Convertimos todo numero a numero natural
    public function Convert($param, $defaultParam)
    {
        $result = intval($param);
        if ($result > 0) {
            $result = $param;
        } else {
            $result = $defaultParam;
        }
        return $result;
    }


    /**
     * 
     *  ------------ buscar📭 por ID los productos----------
     * 
     */
    public function getProducto($params = null)
    {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $producto = $this->model->getProducto($id);
        // si no existe devuelvo 404
        if ($producto)
            $this->view->response($producto);
        else
            $this->view->response("La tarea con el id=$id no existe", 404);
    }


    /**
     * 
     *  ----------- insertar 📝en la API---------------
     * 
     */
    public function insertProducto($params = null)
    {
        $producto = $this->getData();

        // Solo si es ADM puede insertar
        if (!$this->authHelper->isLoggedIn()) {
            $this->view->response("No estas logeado", 401);
            return;
        }

        //condicion
        if (
            empty($producto->precio) || empty($producto->nombre) || empty($producto->categoria_fk)
            || empty($producto->marca_fk)
        ) {
            $this->view->response("Complete los datos", 400);
        } else {


            //pedir permiso a tabla  marca
            $categoria = $this->dataCategoria->getCategoriaFK($producto->categoria_fk);
            $id = $this->model->insertarProductos(
                $producto->precio,
                $producto->nombre,
                $categoria->id,
                $producto->marca_fk,
                $producto->imagen
            );

            $this->view->response("La tarea se insertó con éxito con el id=$id", 201);
        }
    }


    /**
     * 
     * ----------- Eliminar❌  ID seleccionado----------------
     * 
     */
    public function deleteProducto($params = null)
    {
        $id = $params[':ID'];

        $producto = $this->model->getProducto($id);
        if ($producto) {
            $this->model->deleteProductoById($id);
            $this->view->response("El producto con el id=$id , se elimino con éxito", 200);
        } else
            $this->view->response("La tarea con el id=$id no existe", 404);
    }


    /**
     * 
     *---------- Update 🔂 del ID seleccionado ---------------- 
     *
     */
    public function updateProducto($params = [])
    {
        $id = $params[':ID'];
        $producto = $this->model->getProducto($id);

        if (!$this->authHelper->isLoggedIn()) {
            $this->view->response("No estas logeado", 401);
            return;
        }

        if ($producto) {
            $body = $this->getData();

            $precio = $body->precio;
            $nombre = $body->nombre;
            $categoria = $body->categoria_fk;
            $marca = $body->marca_fk;
            $imagen = $body->imagen;

            $producto = $this->model->editarProductos($precio, $nombre, $categoria, $marca, $imagen, $id);
            $this->view->response("Producto id=$id actualizada con éxito", 200);
        } else
            $this->view->response("Producto id=$id not found", 404);
    }
}
