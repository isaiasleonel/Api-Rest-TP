<?php
require_once './libs/Smarty.class.php';

class AuthView
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
    }

    function showFormLogin($error = null)
    {
        $this->smarty->assign("error", $error);
        $this->smarty->display('formLogin.tpl');
    }
}
