

/*
Реализуйте недостающие части класса Timer, который описывает собой таймер обратного отсчета. Необходимо дописать конструктор принимающий на вход три параметра: секунды, минуты (необязательный) и часы (необязательный). Конструктор должен подсчитать общее количество секунд для переданного времени и записать его в свойство secondsCount.

Воспользуйтесь константой SEC_PER_MIN для перевода минут в секунды (через умножение)
Реализуйте дополнительную константу SEC_PER_HOUR и воспользуйтесь ей для перевода часов в секунды
Примеры:
<?php

$timer1 = new Timer(10);
$timer1->getLeftSeconds(); // 10
$timer1->tick();
$timer1->getLeftSeconds(); // 9

$timer2 = new Timer(8, 20, 8);
$timer2->getLeftSeconds(); // 30008


*/



<?php

namespace App;

class Timer
{
    public const SEC_PER_MIN = 60;
    public const SEC_PER_HOUR = 3600;
    private $secondsCount;
    public function __construct($sec, $min = 0, $hour = 0)
    {
        $this->secondsCount = $sec + $min * self::SEC_PER_MIN + $hour * self::SEC_PER_HOUR;
    }

    public function getLeftSeconds()
    {
        return $this->secondsCount;
    }

    public function tick()
    {
        $this->secondsCount--;
    }
}