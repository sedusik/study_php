

/*
Реализуйте класс Booking, который позволяет бронировать номер отеля на определённые даты. Единственный интерфейс класса — функция book(), которая принимает на вход две даты в текстовом формате. Если бронирование возможно, то метод возвращает true и выполняет бронирование (даты записываются во внутреннее состояние объекта).

Класс CarbonPeriod не подключен в задаче по умолчанию, используйте интерфейс объекта Carbon для работы с датами.

Примеры
<?php

$booking = new Booking();
$booking->book('11-11-2008', '13-11-2008'); // true
$booking->book('12-11-2008', '12-11-2008'); // false
$booking->book('10-11-2008', '12-11-2008'); // false
$booking->book('12-11-2008', '14-11-2008'); // false
$booking->book('10-11-2008', '11-11-2008'); // true
$booking->book('13-11-2008', '14-11-2008'); // true
Подсказки
По обычаям гостиничного сервиса время заселения в номер — после полудня первого дня, а время выселения — до полудня последнего дня. Конкретные часы варьируются в разных отелях. Но в данной практике это не важно, главное понять принцип, по которому указываются даты:

<?php

$booking = new Booking();

// забронировать номер на два дня
$booking->book('10-11-2008', '12-11-2008');

// бронь невозможна, 11-го числа номер будет занят
$booking->book('11-11-2008', '15-11-2008');

// бронь возможна, потому что 12-го числа номер освободится
$booking->book('12-11-2008', '13-11-2008');

// бронь невозможна, съём, сроком менее одного дня, обычно не практикуется
$booking->book('17-11-2008', '17-11-2008');

// бронь возможна, съём номера на один день
$booking->book('17-11-2008', '18-11-2008');

*/



<?php

namespace App;

use Carbon\Carbon;

class Booking
{
    private $dates = [];

    public function book($begin, $end)
    {
        $beginCarbon = new Carbon($begin);
        $endCarbon = new Carbon($end);
        if ($this->canBook($beginCarbon, $endCarbon)) {
            $this->dates[] = [$beginCarbon, $endCarbon];
            return true;
        }
        return false;
    }
    public function canBook($begin, $end)
    {
        if ($begin >= $end) {
            return false;
        }
        foreach ($this->dates as [$bookedBegin, $bookedEnd]) {
            $isIntersected = $begin < $bookedEnd && $end > $bookedBegin;
            if ($isIntersected) {
                return false;
            }
        }
        return true;
    }
}