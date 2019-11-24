<?php


namespace app\models\entities;


class Order extends DataEntity
{
    protected $id;
    protected $name;
    protected $phone;
    protected $email;
    protected $address;
    protected $status_id;
    protected $session_id;

    public $state = [
        'name' => false,
        'phone' => false,
        'email' => false,
        'address' => false,
        'status_id' => false,
        'session_id' => false,
    ];

    /**
     * Order constructor.
     * @param $id
     * @param $name
     * @param $phone
     * @param $address
     * @param $status_id
     * @param $session_id
     */
    public function __construct($name = null, $phone = null, $address = null, $email = null, $status_id = null, $session_id = null)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->email= $email;
        $this->address = $address;
        $this->status_id = $status_id;
        $this->session_id = $session_id;
    }


}