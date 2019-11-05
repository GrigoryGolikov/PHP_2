<?php

use app\models\{Basket, Product, Users};
use app\engine\{Autoload, Db};

include realpath("../config/config.php");
include realpath("../engine/Autoload.php");

spl_autoload_register([new Autoload(), 'loadClass']);

$product = new Product("Пицца1","Описание1", 125);
$product->insert();
//$product->delete();

$user = new Users("Петя",123);
$user->insert();
$user->pass = 456;
$user->update();
$user->delete();

// Возможно тут лучше использовать статику, а то не очень красово получается
$product = $product->getOne(3);
var_dump($product);







