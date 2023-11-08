

/*
Класс Time предназначен для создания объекта-времени. Его конструктор принимает на вход количество часов и минут в виде двух отдельных параметров.

<?php
 
$time = new Time(10, 15);
echo $time; // => 10:15
src/Time.php
Добавьте в класс Time статический метод fromString, который позволяет создавать инстансы Time на основе времени переданного строкой формата часы:минуты.

<?php
 
$time = Time::fromString('10:23');
$this->assertEquals('10:23', $time); // автоматически вызывается __toString
Подсказки
Вам может понадобится функция explode()

*/

//Мое решение:

<?php

namespace App;

class Time
{
    private $h;
    private $m;
    
    public static function fromString($string)
    {
        $hour = explode(':', $string)[0];
        $min = explode(':', $string)[1];
        return new self($hour, $min);
    }

    public function __construct($h, $m)
    {
        $this->h = $h;
        $this->m = $m;
    }

    public function __toString()
    {
        return "{$this->h}:{$this->m}";
    }
}

//Решение учителя:

namespace App;

class Time
{
    private $h;
    private $m;

    // BEGIN
    public static function fromString($time)
    {
        [$h, $m] = explode(':', $time);
        return new self($h, $m);
    }
    // END

    public function __construct($h, $m)
    {
        $this->h = $h;
        $this->m = $m;
    }

    public function __toString()
    {
        return "{$this->h}:{$this->m}";
    }
}