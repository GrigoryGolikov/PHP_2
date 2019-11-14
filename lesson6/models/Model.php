<?php

namespace app\models;

use app\interfaces\IModels;

abstract class Model implements IModels
{
    public $state = [];

    public  function clearState()
    {
        foreach ($this->state as $key => $value){
            if ($value) {
                $this->state[$key] = false;
            }
        }
    }

}