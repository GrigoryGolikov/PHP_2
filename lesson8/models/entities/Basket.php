<?php
namespace app\models\entities;

use app\engine\Db;
use app\models\DbModel;

class Basket extends DataEntity
{
    protected $id;
    protected $session_id;
    protected $goods_id;
    protected $framed;

    public $state = [
        'session_id' => false,
        'goods_id' => false,
        'framed' => false,
    ];

    /**
     * Basket constructor.
     * @param $session_id
     * @param $goods_id
     * @param $framed
     */
    public function __construct($session_id = null, $goods_id = null, $framed = 0)
    {
        $this->session_id = $session_id;
        $this->goods_id = $goods_id;
        $this->framed = $framed;

    }

}