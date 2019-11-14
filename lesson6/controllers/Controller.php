<?php


namespace app\controllers;


use app\engine\Session;
use app\interfaces\IRenderer;
use app\models\Basket;
use app\models\Users;

class Controller
{

    protected $action;
    protected $defaultAction = 'index';
    protected $layout = 'main';
    protected $useLayout = true;
    /** @var IRenderer $renderer */
    protected $renderer;
    protected $request;
    protected $session;

    public function __construct($renderer, $request)
    {
        $this->renderer = $renderer;
        $this->request = $request;
        $this->session = new Session();
    }

    /**
     * Controller constructor.
     * @param $action
     */
    public function runAction($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "404 action";
        }

    }

    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'menu' => $this->renderTemplate('menu',['count' => Basket::getCountWhere('session_id', session_id()) ]),
                'content' => $this->renderTemplate($template, $params),
                'auth' => Users::isAuth(),
                'username' => Users::getName(),
            ]);
        } else {
            return $this->renderTemplate($template, $params = []);
        }
    }

    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->renderTemplate($template, $params);
    }

}