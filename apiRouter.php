<?php

require_once './libs/Router.php';
require_once './api-app/api-controller/api.controllerProducto.php';
require_once './api-app/api-controller/api.UserController.php';


// crea el router
$router = new Router();

// Productos
$router->addRoute('productos', 'GET', 'ProductoApiController', 'getProductos');
$router->addRoute('productos/:ID', 'GET', 'ProductoApiController', 'getProducto');
$router->addRoute('productos/:ID', 'DELETE', 'ProductoApiController', 'deleteProducto');
$router->addRoute('productos', 'POST', 'ProductoApiController', 'insertProducto');
$router->addRoute('productos/:ID', 'PUT', 'ProductoApiController', 'updateProducto');
// Categorias
$router->addRoute('categorias', 'GET', 'CategoriaApiController', 'getCategorias');
//Token
$router->addRoute("auth/token", 'GET', 'AuthApiController', 'getToken');

//not Found
$router->setDefaultRoute('ProductoApiController', 'defaultRouter');
// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
