<?php

require_once './app/Models/producto.model.php';
require_once './app/Models/marca.model.php';
require_once './app/Models/categoria.model.php';
require_once './api-app/api-view/api.view.php';

class ProductoApiController
{
    private $model;
    private $view;
    private $data;
    private $dataMarca;
    private $dataCategoria;

    public function __construct()
    {
        $this->model = new productoModel();
        $this->view = new ApiView();
        $this->dataMarca = new MarcaModel();
        $this->dataCategoria = new CategoriaModel();

        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        return json_decode($this->data);
    }


    //Obtengo base dato de la tabla producto y lo muestro al view
    public function getProductos($params = null)
    {
        $homeProd = $this->model->getDbProyCat();
        $this->view->response($homeProd);
    }


    // buscar por ID los productos
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



    // insertar en la API   .🥼
    public function insertProducto($params = null)
    {

        $producto = $this->getData();

        if (
            empty($producto->precio) || empty($producto->nombre) || empty($producto->categoria_fk)
            || empty($producto->marca_fk)
        ) {
            $this->view->response("Complete los datos", 400);
        } else {
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


    //eliminar ID seleccionado
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


    // Update del ID seleccionado 
    public function updateProducto($params = [])
    {
        $id = $params[':ID'];
        $producto = $this->model->getProducto($id);

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
