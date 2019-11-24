<?php


namespace app\models\repositories;

use app\engine\App;
use app\models\entities\Order;
use app\models\Repository;

class OrderRepository extends Repository
{

    public function getTableName()
    {
        return "orders";
    }

    public function getEntityClass()
    {
        return Order::class;
    }

    public function getOrderDetail($sessionId)
    {
        // Запрос похож на получение корзины
        // Но для дальнейшего развития системы решил вынести его отдельно
        $sql = "SELECT 
                    basket.id as basket_id, 
                    goods.id as good_id, 
                    goods.name as name, 
                    goods.price as price,
                    goods.image as image 
                FROM 
                    Basket left join `products` as goods 
                    on basket.goods_id=goods.id
                WHERE 
                     session_id = :session_id 
                    AND  basket.framed ";

        return App::call()->db->queryAll($sql,['session_id' => $sessionId]);
    }

}