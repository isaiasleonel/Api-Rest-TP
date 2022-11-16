<?php
require_once './api-app/api-model/user.model.php';
require_once './api-app/api-view/api.view.php';
require_once './api-app/ApiHelper/auth.ApiHelper.php';


function base64url_encode($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}


class AuthApiController
{
    private $userModel;
    private $view;
    private $authHelper;


    public function __construct()
    {
        //$this->model = new TaskModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        $this->userModel = new UserModel();
    }


    public function getToken($params = null)
    {
        // Obtener "Basic base64(user:pass)
        $basic = $this->authHelper->getAuthHeader();

        if (empty($basic)) {
            $this->view->response('No autorizado', 401);
            return;
        }
        $basic = explode(" ", $basic);
        if ($basic[0] != "Basic") {
            $this->view->response('La autenticación debe ser Basic', 401);
            return;
        }

        //validar usuario:contraseña
        $userpass = base64_decode($basic[1]); // user:pass
        $userpass = explode(":", $userpass);
        $user = $userpass[0];
        $pass = $userpass[1];

        // Obtiene el user de la tabla de usuario
        $email = $this->userModel->getUserByEmail($user);

        //Verificamos 
        if ($email && $email->email == $user  && password_verify($pass, $email->contrasenia)) {
            //  crear un token
            $header = array(
                'alg' => 'HS256',
                'typ' => 'JWT'
            );
            $payload = array(
                'id' => $email->id_user,
                'name' => $email->nombre,
                'exp' => time() + 3600
            );
            $header = base64url_encode(json_encode($header));
            $payload = base64url_encode(json_encode($payload));
            $signature = hash_hmac('SHA256', "$header.$payload", "sopa", true);
            $signature = base64url_encode($signature);
            $token = "$header.$payload.$signature";
            $this->view->response($token);
        } else {
            $this->view->response('No autorizado', 401);
        }
    }
}
