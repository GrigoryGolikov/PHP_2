<?php

namespace app\controllers;


use app\engine\App;

class ProductController extends Controller
{

    public function actionCatalog()
    {
        $page = $_GET['page'];
        If (!isset($page)){
            $page = 0;
        }

        $from = 0;

        $to = $page * 2 + 2;
        $catalog = (App::call()->productRepository)->getLimit($from,$to);
        echo $this->render('catalog', ['catalog' => $catalog, 'page'=> ++$page]);
    }

    public function actionApiCatalog()
    {
        $catalog = (App::call()->productRepository)->getAll();
        echo json_encode($catalog, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function actionCard()
    {
        $id = $_GET['id'];
        $product = (App::call()->productRepository)->getOne($id);
        echo $this->render('card', ['product' => $product]);
    }


}