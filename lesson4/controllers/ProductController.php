<?php

namespace app\controllers;


use app\models\Product;

class ProductController extends Controller
{

    public function actionCatalog() {
        //$catalog = Product::getAll();
        $from = $_GET['from'];
        If (!isset($from)){
            $from = 0;
        }
        $to = $_GET['to'];
        If (!isset($to)){
            $to = 2;
        }

        $catalog = Product::getLimit($from,$to);
        echo $this->render('catalog', ['catalog' => $catalog, 'from'=> $from + 3, 'to' => $to + 3]);
    }

    public function actionApiCatalog() {
        $catalog = Product::getAll();
        echo json_encode($catalog, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionCard() {
        $id = $_GET['id'];
        $product = Product::getOne($id);
        echo $this->render('card', ['product' => $product]);
    }


}