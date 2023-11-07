

/*
src\Point.php
Реализуйте класс Point с публичными свойствами $x и $y.

src\PointFunctions.php
Реализуйте функцию getMidpoint, которая принимает на вход две точки (объекты) и возвращает точку (объект) лежащую между ними (поиск середины отрезка).

<?php

$point1 = new Point();
$point1->x = 1;
$point1->y = 10;
$point2 = new Point();
$point2->x = 10;
$point2->y = 1;

$midpoint = getMidpoint($point1, $point2);
$midpoint->x; // 5.5
$midpoint->y; // 5.5

*/



<?php

namespace App;

class Point
{
    public $x;
    public $y;
}


namespace App\PointFunctions;

use App\Point;

function getMidpoint($point1, $point2)
{
    $midPoint = new Point();
    $midPoint->x = ($point1->x + $point2->x) / 2;
    $midPoint->y = ($point1->y + $point2->y) / 2;
    return $midPoint;
}