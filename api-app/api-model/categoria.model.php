<?php
class categoriaModel
{
    // privatizo los datos
    private $db;

    // conecto la base de dato con el constructor 
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=ventatecnologica;charset=utf8', 'root', '');
    }

    // ---------------Base de dato de la tabla Categoria---------------------------
    public function getDbCategoria()
    {
        $query = $this->db->prepare('SELECT * FROM categoria');
        $query->execute();
        $categorias = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objeto
        return $categorias;
    }


    // Buscamos ID de la categoria
    public function  getCategoria($id)
    {
        $query = $this->db->prepare('SELECT * FROM categoria WHERE id= ?');
        $query->execute([$id]);
        $categoria = $query->fetch(PDO::FETCH_OBJ);
        return $categoria;
    }

    //unimos los FK de las tablas categoria y productos
    public function getCategoriaFK($fk)
    {
        $query = $this->db->prepare('SELECT categoria.id FROM categoria WHERE categoria_fk= ?');
        $query->execute([$fk]);
        $categoria = $query->fetch(PDO::FETCH_OBJ);
        return $categoria;
    }


    public  function insertarCategoria($categoria)
    {
        $query = $this->db->prepare("INSERT INTO categoria (categoria_fk) VALUES (?)");
        $query->execute([$categoria]);
        return $this->db->lastInsertId();
    }

    public function updateCategoria($nombre, $id)
    {
        $query = $this->db->prepare("UPDATE categoria SET categoria_fk = ?  WHERE categoria.id = ?");
        $query->execute([$nombre, $id]);
    }

    function deleteCategorias($id)
    { {
            $query = $this->db->prepare("DELETE FROM categoria  WHERE categoria.id = ?");
            $query->execute([$id]);
        }
    }
}
