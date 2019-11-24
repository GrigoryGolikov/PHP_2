<?php


namespace app\models\repositories;


use app\engine\App;
use app\models\entities\Basket;
use app\models\Repository;

class BasketRepository extends Repository
{

    public function getTableName()
    {
        return "basket";
    }

    public function getEntityClass()
    {
        return Basket::class;
    }
    public function deleteBasket($id)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id and session_id = :session_id";
        return App::call()->db->execute($sql, [":id" => $id, ":session_id" => session_id()]);
    }

    public function getBasketOne($id, $session_id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id and session_id = :session_id";
        return App::call()->db->queryObject($sql, [":id" => $id, ":session_id" => $session_id], $this->getEntityClass());
    }

    function getSumBasket() {
        $session_id = session_id();
        $sql = "SELECT SUM(products.price) as sum FROM `basket`, `products` WHERE basket.goods_id=products.id AND `session_id` = :session_id AND NOT basket.framed";
        return App::call()->db->queryOne($sql, ["session_id"=>$session_id])['sum'];
    }

    public function getCountWhere($field, $value) {
        $tableName = $this->getTableName();
        $sql = "SELECT count(*) as count FROM {$tableName} WHERE `$field`=:value AND NOT basket.framed";
        return App::call()->db->queryOne($sql, ["value"=>$value])['count'];
    }

    public function getBasket($sessionId)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT 
                    basket.id as basket_id, 
                    goods.id as good_id, 
                    goods.name as name, 
                    goods.price as price,
                    goods.image as image 
                FROM 
                    `{$tableName}` left join `products` as goods 
                    on basket.goods_id=goods.id
                WHERE 
                     session_id = :session_id 
                    AND  not basket.framed ";

        return App::call()->db->queryAll($sql,['session_id' => $sessionId]);
    }


}