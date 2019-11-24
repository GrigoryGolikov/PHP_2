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

    public static function getTableName()
    {
        return "users";
    }
}