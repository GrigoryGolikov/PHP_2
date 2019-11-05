<?php

namespace app\models;

class Product extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;

    public function __construct($name = '', $description = '', $price=0)
    {
        parent::__construct();
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }
   public function getTableName()
   {
       return "products";
   }


}