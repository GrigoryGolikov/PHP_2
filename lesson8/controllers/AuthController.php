<?php


namespace app\controllers;

use app\engine\App;
use app\models\repositories\UsersRepository;
use app\models\entities\Users;

class AuthController extends Controller
{
    public function actionLogin()
    {
        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['pass'];
        $savePass = App::call()->request->getParams()['savePass'];
        if (!(App::call()-> usersRepository)->auth($login, $pass, $savePass)) {
            Die("Не верный пароль!");
        } else
            header("Location: /");
        exit();
    }

    public function actionLogout()
    {
        session_destroy();
        (App::call()-> usersRepository)->logout();
        header("Location: /");
        exit();
    }

}