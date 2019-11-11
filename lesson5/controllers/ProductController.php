<?php

namespace app\controllers;


use app\models\Product;

class ProductController extends Controller
{

    public function actionCatalog()
    {
        //$catalog = Product::getAll();
        $page = $_GET['page'];
        If (!isset($page)){
            $page = 0;
        }

        $from = 0;

        $to = $page * 2 + 2;
        $catalog = Product::getLimit($from,$to);
        echo $this->render('catalog', ['catalog' => $catalog, 'page'=> ++$page]);
    }

    public function actionApiCatalog()
    {
        $catalog = Product::getAll();
        echo json_encode($catalog, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $product = Product::getOne($id);
        echo $this->render('card', ['product' => $product]);
    }


}