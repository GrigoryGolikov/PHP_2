<?php

class Car
{
    public $brand;
    public $color;
    public $power;
    public $fuelConsumption;
    public $tankVolume;
    public $driver;

    public function __construct($brand = null, $color = null, $power = null,$fuelConsumption = 0, $tankVolume = 0, $driver = null)
    {
        $this->brand = $brand;
        $this->color = $color;
        $this->power = $power;
        $this->fuelConsumption = $fuelConsumption;
        $this->tankVolume = $tankVolume;
        $this->driver = $driver;
    }

    public function quantityOfKilometers($volume)
    {
        return 100 * $volume / $this -> fuelConsumption;
    }

    public function setDriver($driver)
    {
        $this->driver = $driver;
    }

}

class Truck extends Car
{
    private $maxTonnage; // Максимальная загрузка кузова
    private $cargoWeight; // текущая загрузка кузова

    public function __construct($brand = null, $color = null, $power = null,$fuelConsumption = 0, $tankVolume = 0, $driver = null,$maxTonnage = 0,$cargoWeight = 0)
    {
        parent::__construct($brand, $color, $power,$fuelConsumption, $tankVolume, $driver);
        $this->maxTonnage = $maxTonnage;
        $this->cargoWeight = $cargoWeight;
    }

    public function remainingSpace()
    {

        return $this->maxTonnage - $this->cargoWeight;

    }

    public function addLoad($volume)
    {

        $freeSpace = $this -> remainingSpace();

        if ($freeSpace - $volume < 0){
            echo 'в кузове не хватает места. Осталось ' . $freeSpace;
            echo '<br>';
            return false;
        } else{
            echo 'в кузов добавили ' . $volume;
            echo ' Осталось ' . $freeSpace;
            echo '<br>';
            $this->cargoWeight = $this->cargoWeight + $volume;
        }
    }

}

$car1 = new Truck("Камаз","Красный",200, 200, 100, 100,0);
$car1->setDriver("Иванов");

echo $car1->driver;
echo '<br>';

echo $car1->quantityOfKilometers(100);
echo '<br>';

$car1->addLoad(20);
$car1->addLoad(50);
$car1->addLoad(60);




class A
{
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();  // создание экземпляра класса
$a2 = new A();  // создание экземпляра класса
// $x статическая переменная принадлежащая классу A. Поэтому когда каждый экземпляр вызывает функцию foo, переменная увеличивается на 1
$a1->foo(); // Выведет 1
$a2->foo(); // Выведет 2
$a1->foo(); // Выведет 3
$a2->foo(); // Выведет 4


echo '<br>';
class A1
{
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B1 extends A1 {
}

$a1 = new A1();
$b1 = new B1();
// Статичаская переменная $x для каждого класса будет своя.
$a1->foo(); // Выведет 1
$b1->foo(); // Выведет 1
$a1->foo(); // Выведет 2
$b1->foo(); // Выведет 2

echo '<br>';


// отработает аналогично предыдущему пункту. При создани класса нет скобок (). Их можно упустить если у конструктора класса нет аргументов.
class A2
{
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B2 extends A2
{
}
$a1 = new A2;
$b1 = new B2;
// Статичаская переменная $x для каждого класса будет своя.
$a1->foo(); // Выведет 1
$b1->foo(); // Выведет 1
$a1->foo(); // Выведет 2
$b1->foo(); // Выведет 2
