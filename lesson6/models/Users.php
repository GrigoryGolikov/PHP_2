<?php
namespace app\models;
use app\traits\GetSet;

class Users extends DbModel
{
    private $id;
    private $login;
    private $pass;

    public $state = [
        'login' => false,
        'pass' => false,
    ];

    use GetSet;

    /**
     * Users constructor.
     * @param $login
     * @param $pass
     */
    public function __construct($login = null, $pass = null)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    public static function isAuth()
    {
        if (isset($_COOKIE["hash"])) {
            $hash = $_COOKIE["hash"];

            $user = static::getWhereOne('hash', $hash);
            $userName = $user->login;
            if (!empty($userName)) {
                $_SESSION['login'] = $userName;
            }
        }
        return isset($_SESSION['login']) ? true: false;
    }

    public static function getName()
    {
        return $_SESSION['login'];
    }

    public static function auth($login, $pass, $savePass)
    {
        $user = static::getWhereOne('login', $login);
        if (password_verify($pass,$user->pass)){
            $_SESSION['login'] = $login;
            if ($savePass) {
                $hash = uniqid(rand(), true);
                setcookie("hash", $hash, time() + 3600, "/");
                $user->hash = $hash;
                $user->save();
            }
            return true;
        }
        return false;
    }

    public static function logout()
    {
        if (isset($_COOKIE["hash"])) {
            setcookie("hash", "", time() - 3600, "/");
        }
        return isset($_SESSION['login']) ? true: false;

    }

    public static function getTableName()
    {
        return "users";
    }
}