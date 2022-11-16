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


    //unimos los FK de las tablas categoria y productos
    public function getCategoriaFK($fk)
    {
        $query = $this->db->prepare('SELECT categoria.id FROM categoria WHERE categoria_fk= ?');
        $query->execute([$fk]);
        $categoria = $query->fetch(PDO::FETCH_OBJ);
        return $categoria;
    }
}
