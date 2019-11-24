<?php


namespace app\controllers;


use app\engine\App;
use app\engine\Session;
use app\interfaces\IRenderer;
use app\models\entities\Basket;
use app\models\entities\Users;
use app\models\repositories\BasketRepository;
use app\models\repositories\UsersRepository;

class ActionException extends \Exception {

}

class Controller
{

    protected $action;
    protected $defaultAction = 'index';
    protected $layout = 'main';
    protected $useLayout = true;
    /** @var IRenderer $renderer */
    protected $renderer;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
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
            throw new ActionException("Ошибка при определении action");
            //            echo "404 action";
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
                'menu' => $this->renderTemplate('menu',
                    ['count' => (App::call()->  basketRepository)->getCountWhere('session_id', session_id()),
                    'admin'=> (App::call()->usersRepository)->iAmAdmin(),
                    ]),
                'content' => $this->renderTemplate($template, $params),
                'auth' => (App::call()-> usersRepository)->isAuth(),
                'username' => (App::call()-> usersRepository)->getName(),
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