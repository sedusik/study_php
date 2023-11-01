

/*
Реализуйте функцию getMidpoint(), которая находит точку посередине между двумя указанными точками

<?php

$point1 = ['x' => 0, 'y' => 0];
$point2 = ['x' => 4, 'y' => 4];
$point3 = getMidpoint($point1, $point2);
print_r($point3); // => [ 'x' => 2, 'y' => 2 ]

*/

//Мое решение:

<?php

namespace App\Points;

function getMidpoint($point1, $point2)
{
    $x = ($point1['x'] + $point2['x']) / 2;
    $y = ($point1['y'] + $point2['y']) / 2;
    return [ 'x' => $x, 'y' => $y ];
}