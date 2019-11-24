<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\Basket;
use app\models\entities\Order;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;


class OrderController extends Controller
{
    public function actionIndex()
    {
        $name = App::call()->request->getParams()['name'];
        $phone = App::call()->request->getParams()['phone'];
        $address = App::call()->request->getParams()['address'];
        $email = App::call()->request->getParams()['email'];

        (App::call()-> orderRepository)->save(new Order($name, $phone, $address, $email, 1, session_id()));
        $basket = App::call()->basketRepository->getBasket(session_id());

        foreach ($basket as $item){
            $itemBasket = App::call()->basketRepository->getBasketOne($item['basket_id'],session_id());
            $itemBasket->framed = 1;
            App::call()->basketRepository->save($itemBasket);
        }

        header('Content-Type: application/json');
        echo json_encode([
            'count' => (App::call()->basketRepository)->getCountWhere('session_id', session_id()) ,
            'sum' => (App::call()-> basketRepository)->getSumBasket() ]);
        die();
    }

    public function actionAdmin()
    {

        $orders = (App::call()->orderRepository->getAll());
        echo $this->render('admin', [
            'orders' => $orders,
            'admin' => (App::call()-> usersRepository)->iAmAdmin() ]);

    }

    public function actionSave()
    {
        $id = App::call()->request->getParams()['id'];
        $status = App::call()->request->getParams()['status'];
        $order = (App::call()->orderRepository->getOne($id));
        $order->status_id = $status;

        App::call()->orderRepository->save($order);

        header('http://localhost/order/admin/');
        die();

    }

    public function actionDetails()
    {
        $id = App::call()->request->getParams()['id'];
        $order = (App::call()->orderRepository)->getOne($id);
        $basket = (App::call()->orderRepository->getOrderDetail($order->session_id));

        echo $this->render('orderDetails', [
            'order' => $order,
            'admin' => (App::call()-> usersRepository)->iAmAdmin(),
            'basket' => $basket,

        ]);

    }
}