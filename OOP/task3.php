

/*
Реализуйте функцию dup, которая клонирует переданную точку. Под клонированием подразумевается процесс создания нового объекта, с такими же данными как и у старого.

<?php

use function App\PointFunctions\dup;

$point1 = new \App\Point();
$point2 = dup($point1);

$point1 == $point2; // true
$point1 === $point2; // false

*/



<?php

namespace App\PointFunctions;

use App\Point;

function dup(Point $point1)
{
    $point2 = new Point();
    $point2->x = $point1->x;
    $point2->y = $point1->y;
    return $point2;
}