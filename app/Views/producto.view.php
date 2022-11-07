<?php
require_once './libs/Smarty.class.php';

class productoView
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
    }

    //-----------------home----------------
    function showProducto($productos, $categorias)
    {
        // asigno variables al tpl smarty
        $this->smarty->assign('count', count($productos));
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('categorias', $categorias);

        // mostrar el tpl
        $this->smarty->display('./Templates/home.tpl');
    }
    //---------------------------------------------------------------------
    // Vista al formulario para agregar valores nuevos
    function showAgregar($categorias, $marcas)
    {
        $this->smarty->assign('categorias', $categorias);
        $this->smarty->assign('marcas', $marcas);
        $this->smarty->display('./Templates/form.agregar.tpl');
    }

    // Vista al formulario para editar valores nuevos
    function showEditar($productoID, $categorias, $marcas)
    {
        $this->smarty->assign('productos', $productoID);
        $this->smarty->assign('categorias', $categorias);
        $this->smarty->assign('marcas', $marcas);
        $this->smarty->display('./Templates/editarform.tpl');
    }

    //Vista a descripciones en particular
    function descripcionProd($productos, $categorias, $marcas)
    {
        $this->smarty->assign('productos', $productos);
        $this->smarty->assign('categorias', $categorias);
        $this->smarty->assign('marcas', $marcas);
        $this->smarty->display('./Templates/descripcion.tpl');
    }
}















//         $filterCategoria = getFilterCategoria();
//         // $arraycategory = getCategory();
//         echo "<ul>";
//         foreach ($filterCategoria as  $value) {
//             echo "<li> $value->categoria_fk</li>";
//         }
//         echo "</ul>";
//     }
// }
