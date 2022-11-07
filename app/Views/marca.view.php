<?php
require_once './libs/Smarty.class.php';

class marcaView
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
    }


    function  showMarcas($marcas)
    {
        // asigno variables al tpl smarty
        $this->smarty->assign('marcas', $marcas);
        $this->smarty->assign('count', count($marcas));
        // mostrar el tpl
        $this->smarty->display('./Templates/marca-sponsor.tpl');
    }
}
