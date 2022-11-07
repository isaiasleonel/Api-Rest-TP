<?php

class Auth
{

    public function checkLoggedIn()
    {

        if (!isset($_SESSION['USER_ID'])) {
            header('Location: ' . BASE_URL . 'login');
            die();
        }
    }
}
