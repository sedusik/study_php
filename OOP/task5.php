

/*
src/Segment.php
Реализуйте класс App\Segment с двумя публичными свойствами beginPoint и endPoint. Определите в классе конструктор.

Примеры
<?php

$segment = new Segment(new Point(1, 1), new Point(10, 11));
src/SegmentFunctions.php
Реализуйте функцию reverse, которая принимает на вход отрезок и возвращает новый отрезок с точками, добавленными в обратном порядке (begin меняется местами с end).

Примечания
Точки в результирующем отрезке должны быть копиями (по значению) соответствующих точек исходного отрезка. То есть они не должны быть ссылкой на один и тот же объект, так как это разные объекты (пускай и с одинаковыми координатами).
Примеры
<?php

use function App\SegmentFunctions\reverse;
use App\Point;
use App\Segment;

$segment = new Segment(new Point(1, 10), new Point(11, -3));
$reversedSegment = reverse($segment);

$reversedSegment->beginPoint; // (11, -3)
$reversedSegment->endPoint; // (1, 10)


*/



<?php

namespace App;

class Segment
{
    public $beginPoint;
    public $endPoint;
    public function __construct($beginPoint, $endPoint)
    {
        $this->beginPoint = $beginPoint;
        $this->endPoint = $endPoint;
    }
}

namespace App\SegmentFunctions;

use App\Point;
use App\Segment;

function reverse(Segment $segment)
{
    $beginPoint = $segment->beginPoint;
    $endPoint = $segment->endPoint;

    $newBeginPoint = new Point($endPoint->x, $endPoint->y);
    $newEndPoint = new Point($beginPoint->x, $beginPoint->y);
    return new Segment($newBeginPoint, $newEndPoint);
}
