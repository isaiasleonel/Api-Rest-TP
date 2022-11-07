<?php
// van los require de los php
require_once './app/controllers/categoria.controller.php';
require_once './app/controllers/producto.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/marca.controller.php';


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');


$action = "inicio";
// parametro
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}


//parsear la accion
$params = explode('/', $action);

$authController = new AuthController();
$controllerProducto = new productoController();
$controllerCategoria = new categoriaController();
$controllerMarca = new marcaController();
switch ($params[0]) {
        // ----Ruteo de Login-----
    case 'login':

        $authController->showFormLogin();
        break;

    case 'validar':
        $authController->validateUser();
        break;

    case 'logout':
        $authController->logout();
        break;

        // ----------Ruteo de Home---------
    case 'inicio':
        $controllerProducto->showProducto();
        break;

    case 'ordenamiento':
        $id = $params[1];
        $controllerProducto->showOrders($id);
        break;

    case 'descripcion':
        $id = $params[1];
        $controllerProducto->mostrarDescripcion($id);
        break;

        // -------Ruteo de Productos-------
    case 'agregarform':
        $controllerProducto->agregarProductos();
        break;

    case 'agregar':
        $controllerProducto->addProductos();
        break;

    case 'editarform':
        $id = $params[1];
        $controllerProducto->formEditar($id);
        break;

    case 'editar':
        $id = $params[1];
        $controllerProducto->editarProductos($id);
        break;

    case 'eliminar':
        $id = $params[1];
        $controllerProducto->deleteProductos($id);
        break;

        // -------Ruteo de Categoria-----
    case 'agregarformCategoria':
        $controllerCategoria->formCategoria();
        break;


    case 'agregarcategoria':
        $controllerCategoria->agregarCategoria();
        break;

    case 'editarcategoria':
        $controllerCategoria->editarCategorias();
        break;

    case 'eliminarcategoria':
        $controllerCategoria->deleteCategorias();
        break;
        // -------Ruteo de Marca-----
    case 'marcas':
        $controllerMarca->showMarca();
        break;

    default:
        echo ('404 Page not found');
        break;
}
