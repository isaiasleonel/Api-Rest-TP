<?php
require_once './app/Models/categoria.model.php';
require_once './api-app/api-view/api.view.php';

class CategoriaApiController
{
    private $model;
    private $view;
    private $data;

    public function __construct()
    {
        $this->model = new categoriaModel();
        $this->view = new ApiView();

        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        return json_decode($this->data);
    }


    //Obtengo base dato de la tabla Categoria y lo muestro al view
    public function getCategorias($params = null)
    {
        $categorias = $this->model->getDbCategoria();
        $this->view->response($categorias);
    }


    // buscar por ID las categoria
    public function getCategoria($params = null)
    {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $categoria = $this->model->getCategoria($id);
        // si no existe devuelvo 404
        if ($categoria)
            $this->view->response($categoria);
        else
            $this->view->response("La tarea con el id=$id no existe", 404);
    }



    // insertar en la API   .🥼
    public function insertCategoria($params = null)
    {
        $categoria = $this->getData();

        if (empty($categoria->categoria_fk)) {

            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertarCategoria(
                $categoria->categoria_fk,
            );

            $this->view->response("La tarea se insertó con éxito con el id=$id", 201);
        }
    }


    // //eliminar ID seleccionado
    // public function deleteProducto($params = null)
    // {
    //     $id = $params[':ID'];

    //     $producto = $this->model->getProducto($id);
    //     if ($producto) {
    //         $this->model->deleteProductoById($id);
    //         $this->view->response("El producto con el id=$id , se elimino con éxito", 200);
    //     } else
    //         $this->view->response("La tarea con el id=$id no existe", 404);
    // }


    // // Update del ID seleccionado 
    // public function updateProducto($params = [])
    // {
    //     $id = $params[':ID'];
    //     $producto = $this->model->getProducto($id);

    //     if ($producto) {
    //         $body = $this->getData();

    //         $precio = $body->precio;
    //         $nombre = $body->nombre;
    //         $categoria = $body->categoria_fk;
    //         $marca = $body->marca_fk;
    //         $imagen = $body->imagen;

    //         $producto = $this->model->editarProductos($precio, $nombre, $categoria, $marca, $imagen, $id);
    //         $this->view->response("Producto id=$id actualizada con éxito", 200);
    //     } else
    //         $this->view->response("Producto id=$id not found", 404);
    // }
}
