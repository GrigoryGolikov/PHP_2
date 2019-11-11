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

        //$from = $page * 3;
        $from = 0;

        $to = $page * 3 + 3;
        $catalog = Product::getLimit($from,$to);
        echo $this->render('catalog', ['catalog' => $catalog, 'page'=> $page + 1]);
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