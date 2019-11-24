<?php

namespace app\controllers;


use app\models\Basket;

class BasketController extends Controller
{
    public function actionMy()
    {
        $basket = Basket::getBasket();
        echo $this->render('basket', ['basket' => $basket]);
    }

    public function actionAddToBasket()
    {
        $id = $this->request->getParams()['id'];
        (new Basket(session_id(),$id))->save();

        header('Content-Type: application/json');
        echo json_encode(['response' => 'ok', 'count' => Basket::getCountWhere('session_id', session_id()) ]);
        die();
    }

    public function actionDeleteToBasket()
    {
        $id = $this->request->getParams()['id'];

        Basket::deleteBasket($id, session_id());
        header('Content-Type: application/json');
        echo json_encode(['response' => 'ok', 'count' => Basket::getCountWhere('session_id', session_id()) ]);
        die();
    }
}