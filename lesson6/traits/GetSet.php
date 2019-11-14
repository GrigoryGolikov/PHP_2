<?php

namespace app\traits;

trait GetSet
{
    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
        $this->state[$name] = true;
    }
}