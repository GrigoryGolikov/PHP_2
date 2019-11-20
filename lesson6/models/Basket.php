<?php
namespace app\models;

use app\engine\Db;
use app\traits\GetSet;

class Basket extends DbModel
{
    public $id;
    public $session_id;
    public $goods_id;

    public $state = [
        'session_id' => false,
        'goods_id' => false,
    ];

    use GetSet;

    /**
     * Basket constructor.
     * @param $session_id
     * @param $goods_id
     */
    public function __construct($session_id = null, $goods_id = null)
    {
        $this->session_id = $session_id;
        $this->goods_id = $goods_id;
    }


    public static function getTableName()
    {
        return "basket";
    }

    public static function deleteBasket($id, $session_id)
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id and session_id = :session_id";
        return Db::getInstance()->execute($sql, [":id" => $id, ":session_id" => $session_id]);
    }

    public static function getBasket()
    {
        $tableName = static::getTableName();
        $sql = "SELECT 
                    basket.id as basket_id, 
                    goods.id as good_id, 
                    goods.name as name, 
                    goods.price as price,
                    goods.image as image 
                FROM 
                    `{$tableName}`, `products` as goods
                WHERE 
                    basket.goods_id=goods.id AND session_id = :session_id AND NOT basket.framed";

        return Db::getInstance()->queryAll($sql,['session_id' => session_id()]);
    }
}