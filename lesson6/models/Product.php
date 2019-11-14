<?php

namespace app\models;

use app\traits\GetSet;

class Product extends DbModel
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;

    public $state = [
        'name' => false,
        'description' => false,
        'price' => false,
        'image' => false,
    ];

    use GetSet;

    /**
     * Product constructor.
     * @param $name
     * @param $description
     * @param $price
     * @param $image
     */
    public function __construct($name = null, $description = null, $price = null, $image = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
    }


    public static function getTableName()
   {
       return "products";
   }


}