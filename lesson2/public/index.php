<?php

use app\models\{Product, Users, Basket};
use app\engine\Db;
use app\interfaces\IModels;

include $_SERVER['DOCUMENT_ROOT'] . "/../config/config.php";

spl_autoload_register([new Autoload(), 'loadClass']);

$db = new Db();

$product = new Product($db);
$users = new Users($db);
$basket = new Basket($db);

function foo(IModels $model)
{
    return $model->getTableName();
}

echo foo($users);
echo foo($basket);

echo $product->getOne(1);


