<?php

require_once './api-app/api-model/producto.model.php';
require_once './api-app/api-model/marca.model.php';
require_once './api-app/api-model/categoria.model.php';
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
        try {
            // Por defecto
            $sortByDefault = "id_producto";
            $orderDefault = "asc";
            $division_pages = 10;
            $page = 1;
            $array = array("id_producto", "precio", "nombre", "imagen", "marca_fk", "categoria_fk");

            // Condicion para Page -> convertie valor ingresado a Number
            if (isset($_GET["page"])) {
                $page = $this->convert($_GET["page"], $page);
            }

            // Por Defecto
            $principle = ($page - 1) * $division_pages;

            // ordenamiento 
            if (!empty($_GET["sortby"]) && !empty($_GET["order"])) {
                $datos = $this->model->getDbProyCat($principle, $division_pages, $_GET["sortby"], $_GET["order"]);
            }
            // Si no mandan parametros para ORDER por defecto lanzara "ASC"
            else if (!empty($_GET["sortby"]) && (array_key_exists($_GET["sortby"], $array))) {
                $datos = $this->model->getDbProyCat($principle, $division_pages, $_GET["sortby"], $orderDefault);
            }
            // Si no mandan parametros para SORTBY por defecto mandara el "id_producto" para ordenarlo 
            else if (!empty($_GET["order"])) {
                $datos = $this->model->getDbProyCat($principle, $division_pages, $sortByDefault, $_GET["order"]);
            }

            // Condicion para filtrar
            else if (!empty($_GET["column"]) && !empty($_GET["value"])) {
                $column = $_GET["column"];
                $value = $_GET["value"];
                $datos = $this->model->filterFields($column, $value);
            }
            // Por defecto manda la paginacion de productos del " 1 al 10"
            else {
                $datos = $this->model->getDbProyCat($principle, $division_pages);
            }
            $this->view->response($datos, 200);
        } catch (Exception) {
            $this->view->response("No se encontro", 404);
        }
    }


    //Default Router
    public function defaultRouter()
    {
        $this->view->response("Not Found", 404);
    }


    //  Convertimos todo numero a numero entero
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

        //condicion si no llegara a completar los campos
        if (
            empty($producto->precio) || empty($producto->nombre) || empty($producto->categoria_fk)
            || empty($producto->marca_fk)
        ) {
            $this->view->response("Complete los datos", 400);
        } else {


            //condicion 
            if (is_numeric($producto->categoria_fk)  || is_numeric($producto->marca_fk)) {

                var_dump($producto);
                $id = $this->model->insertarProductos(
                    $producto->precio,
                    $producto->nombre,
                    $producto->categoria_fk,
                    $producto->marca_fk,
                    $producto->imagen
                );
            } else {
                $marcaFK = $this->dataMarca->marcaFK($producto->marca_fk);
                $categoriaFK = $this->dataCategoria->getCategoriaFK($producto->categoria_fk);

                $id = $this->model->insertarProductos(
                    $producto->precio,
                    $producto->nombre,
                    $categoriaFK->id,
                    $marcaFK->id,
                    $producto->imagen
                );
            }

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
        // Solo si es ADM puede eliminar
        if (!$this->authHelper->isLoggedIn()) {
            $this->view->response("No estas logeado", 401);
            return;
        }

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
            // Obtengo jsn si existe el ID
            $body = $this->getData();

            // peticion  de FK a las otra tablas 
            $marcaFK = $this->dataMarca->marcaFK($body->marca_fk);
            $categoriaFK = $this->dataCategoria->getCategoriaFK($body->categoria_fk);

            //json por id
            $precio = $body->precio;
            $nombre = $body->nombre;
            $categoria = $categoriaFK->id;
            $marca = $marcaFK->id;
            $imagen = $body->imagen;

            $producto = $this->model->editarProductos($precio, $nombre, $categoria, $marca, $imagen, $id);
            $this->view->response("Producto id=$id actualizada con éxito", 200);
        } else
            $this->view->response("Producto id=$id not found", 404);
    }
}
