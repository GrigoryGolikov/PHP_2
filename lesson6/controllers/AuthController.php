<?php


namespace app\controllers;


use app\engine\Request;
use app\models\Users;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $login = $this->request->getParams()['login'];
        $pass = $this->request->getParams()['pass'];
        $savePass = $this->request->getParams()['savePass'];
        var_dump($savePass);
        if (!Users::auth($login, $pass, $savePass)) {
            Die("Не верный пароль!");
        } else
            header("Location: /");
        exit();
    }

    public function actionLogout()
    {
        session_destroy();
        Users::logout();
        header("Location: /");
        exit();
    }

}