<?php
session_start();
use app\models\{Basket, Product, Users};
use app\engine\{Autoload, Db, TwigRenderer, Renderer, Request};

include realpath("../config/config.php");
include realpath("../engine/Autoload.php");
include realpath("../vendor/autoload.php");

spl_autoload_register([new Autoload(), 'loadClass']);

$url = explode('/', $_SERVER['REQUEST_URI']);
$request = new Request();

$controllerName = $request->getControllerName() ?: 'product';
$actionName = $request->getActionName();

$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new Renderer(),$request);
    $controller->runAction($actionName);
} else {
    echo "404 controller";
}




