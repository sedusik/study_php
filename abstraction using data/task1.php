

/*
Реализуйте функцию calculateDistance(), которая находит расстояние между двумя точками на плоскости.

<?php

$point1 = [0, 0];
$point2 = [3, 4];
calculateDistance($point1, $point2); // 5

*/

//Мое решение:

<?php

namespace App\Points;

function calculateDistance($point1, $point2)
{
    [$x1, $y1] = $point1;
    [$x2, $y2] = $point2;
    return sqrt(($x1 - $x2) ** 2 + ($y1 - $y2) ** 2);
}