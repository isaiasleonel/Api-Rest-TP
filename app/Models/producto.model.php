<?php
class productoModel
{
    // privatizo los datos
    private $db;

    // conecto la base de dato con el constructor 
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=ventatecnologica;charset=utf8', 'root', '');
    }



    //-------------Base de dato (Inner Join de Producto , Categoria  Marca) -----------------------
    public function getDbProyCat($principle, $division_pages, $sort = "id_producto", $order = "asc")
    {
        $query = $this->db->prepare("SELECT  a.id_producto,a.precio, a.nombre,a.imagen, b.marca_fk , c.categoria_fk FROM producto a INNER JOIN marca b ON a.marca_fk = b.id INNER JOIN categoria c ON a.categoria_fk= c.id ORDER BY $sort $order LIMIT $principle , $division_pages");
        $query->execute();
        $innePyC = $query->fetchAll(PDO::FETCH_OBJ);
        return $innePyC;
    }


    //   filtrar las secciones 
    function filterFields($column, $value)
    {
        $query = $this->db->prepare("SELECT  a.id_producto,a.precio, a.nombre,a.imagen, b.marca_fk , c.categoria_fk FROM producto a INNER JOIN marca b ON a.marca_fk = b.id INNER JOIN categoria c ON a.categoria_fk= c.id WHERE $column = ?");
        $query->execute([$value]);
        $productFilters = $query->fetchAll(PDO::FETCH_OBJ);
        return $productFilters;
    }


    // Buscamos por ID de productos ->Solo se usa para la API
    public function getProducto($id)
    {
        $query = $this->db->prepare('SELECT producto.id_producto, producto.precio , producto.nombre, producto.imagen , marca.marca_fk , categoria.categoria_fk FROM producto  INNER JOIN marca ON producto.marca_fk = marca.id INNER JOIN categoria ON producto.categoria_fk = categoria.id WHERE producto.id_producto = ?');
        $query->execute([$id]);
        $producto = $query->fetch(PDO::FETCH_OBJ);
        return $producto;
    }

    //---------------Base dato de la tabla Producto / ordenar------------
    function getDbProduct($id)
    {
        $query = $this->db->prepare('SELECT  producto.id_producto, producto.precio , producto.nombre, producto.categoria_fk, producto.imagen , marca.marca_fk , categoria.categoria_fk FROM producto  INNER JOIN marca ON producto.marca_fk = marca.id INNER JOIN categoria ON producto.categoria_fk= categoria.id WHERE producto.categoria_fk = ?');
        $query->execute([$id]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }


    function getDbProdEditar($id)
    {
        $query = $this->db->prepare('SELECT  producto.id_producto, producto.precio , producto.nombre, producto.imagen , marca.marca_fk , categoria.categoria_fk FROM producto  INNER JOIN marca ON producto.marca_fk = marca.id INNER JOIN categoria ON producto.categoria_fk= categoria.id WHERE producto.id_producto = ?');
        $query->execute([$id]);
        $productos = $query->fetch(PDO::FETCH_OBJ);
        return $productos;
    }

    function getDbProdDescripcion($id)
    {
        $query = $this->db->prepare('SELECT  producto.id_producto, producto.precio , producto.nombre, producto.imagen , marca.marca_fk , categoria.categoria_fk FROM producto  INNER JOIN marca ON producto.marca_fk = marca.id INNER JOIN categoria ON producto.categoria_fk= categoria.id WHERE producto.id_producto = ?');
        $query->execute([$id]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }


    // Inserta los valores metido en el FORM a la base de dato producto
    public function editarProductos($precio, $nombre, $categoria, $marca, $imagen, $id)
    {
        $query = $this->db->prepare("UPDATE `producto` SET `precio` =? , `nombre` = ?, `categoria_fk` = ?, `marca_fk` = ?, `imagen` = ? WHERE `producto`.`id_producto` = ?;");
        $query->execute([$precio, $nombre, $categoria, $marca, $imagen, $id]);
    }

    // Inserta los valores metido en el FORM a la base de dato producto
    public function insertarProductos($precio, $nombre, $categoria, $marca, $imagen)
    {
        $query = $this->db->prepare("INSERT INTO producto (precio, nombre , categoria_fk , marca_fk , imagen) VALUES (?,?,?,?,?)");
        $query->execute([$precio, $nombre, $categoria, $marca, $imagen]);
        return $this->db->lastInsertId();
    }




    // Elimina una tarea dado su id.
    function deleteProductoById($id)
    {
        $query = $this->db->prepare('DELETE FROM producto WHERE id_producto = ?');
        $query->execute([$id]);
    }

    // Agregar imagen
    private function uploadImage($image)
    {
        $target = 'img/' . uniqid() . '.jpg';
        move_uploaded_file($image, $target);
        return $target;
    }
}








    // PAra hacer inner join con 3 tablas
    // SELECT  producto.id_producto, producto.precio , producto.nombre, producto.imagen , marca.marca_fk , categoria.categoria_fk FROM producto  INNER JOIN marca ON producto.marca_fk = marca.id INNER JOIN categoria ON producto.categoria_fk= categoria.id;'


    //Para el buscador de google 
    //SELECT * FROM producto WHERE nombre LIKE 'G%';
