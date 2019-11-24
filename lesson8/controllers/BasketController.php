<?php

namespace app\controllers;


use app\engine\App;
use app\models\entities\Basket;
use app\models\repositories\BasketRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;



class BasketController extends Controller
{
    public function actionIndex()
    {
        $basket = (App::call()-> basketRepository)->getBasket(session_id());
        echo $this->render('basket', [
            'basket' => $basket,
            'sum' => (App::call()-> basketRepository)->getSumBasket() ]);
    }

    public function actionAddToBasket()
    {
        $id = App::call()->request->getParams()['id'];

        ( App::call()->basketRepository)->save(new Basket(session_id(),$id));

        header('Content-Type: application/json');
        echo json_encode([
            'response' => 'ok',
            'count' => (App::call()->basketRepository)->getCountWhere('session_id', session_id()) ]);
        die();
    }

    public function actionDeleteToBasket()
    {
        $id = App::call()->request->getParams()['id'];

        (App::call()->basketRepository)->deleteBasket($id);
        header('Content-Type: application/json');
        echo json_encode([
            'response' => 'ok',
            'count' => (App::call()-> basketRepository)->getCountWhere('session_id', session_id()),
            'sum' => (App::call()-> basketRepository)->getSumBasket() ]);
        die();
    }
}