<?php
session_start();
use app\models\{Basket, Product, Users};
use app\engine\{App, Autoload, Db, TwigRenderer, Renderer, Request};
use app\controllers\ActionException;
use app\controllers\RequestException;

try {

    $config = include __DIR__ . "/../config/config.php";
    //include realpath("../engine/Autoload.php");
    include realpath("../vendor/autoload.php");


    App::call()->run($config);
}
catch (\PDOException $e) {
    var_dump("Ошибка PDO");
}
catch (RequestException $e) {
    var_dump("Ошибка request");
}
catch (ActionException $e) {
    var_dump($e->getMessage());
}
catch (\Exception $e) {
    var_dump($e);
    var_dump($e->getTrace());
}




