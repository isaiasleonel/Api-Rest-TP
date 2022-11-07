<?php
class marcaModel
{
    // privatizo los datos
    private $db;

    // conecto la base de dato con el constructor 
    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=ventatecnologica;charset=utf8', 'root', '');
    }

    // ---------------Base de dato de la tabla Categoria---------------------------
    public function getDbMarca()
    {
        $query = $this->db->prepare('SELECT * FROM marca');
        $query->execute();
        $marca = $query->fetchAll(PDO::FETCH_OBJ);
        return $marca;
    }
}
