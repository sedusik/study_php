

/*
Отрезок - еще один графический примитив. В коде описывается парой точек, одна из которых - начало отрезка, другая - конец. Обычный отрезок не имеет направления, поэтому вы сами вольны выбирать то, какую точку считать началом, а какую концом.

В этом задании подразумевается, что вы уже понимаете принцип построения абстракции и способны самостоятельно принять решение о том, как она будет реализована. Напомню, что сделать это можно разными способами и нет одного правильного.

src\Segments.php
Реализуйте указанные ниже функции:

makeSegment(). Принимает на вход две точки и возвращает отрезок.
getMidpointOfSegment(). Принимает на вход отрезок и возвращает точку находящуюся на середине отрезка.
getBeginPoint(). Принимает на вход отрезок и возвращает точку начала отрезка.
getEndPoint(). Принимает на вход отрезок и возвращает точку конца отрезка.
<?php

$segment = makeSegment(makeDecartPoint(3, 2), makeDecartPoint(0, 0));

getMidpointOfSegment($segment); // (1.5, 1)
getBeginPoint($segment); // (3, 2)
getEndPoint($segment); // (0, 0)

*/

//Мое решение:

<?php

namespace App\Segments;

use function App\Points\makeDecartPoint;
use function App\Points\getX;
use function App\Points\getY;

function makeSegment($point1, $point2)
{
    return ['beginPoint' => $point1, 'endPoint' => $point2];
}

function getBeginPoint($segment)
{
    return $segment['beginPoint'];
}

function getEndPoint($segment)
{
    return $segment['endPoint'];
}

function getMidpointOfSegment($segment)
{
    $beginPoint = getBeginPoint($segment);
    $endPoint = getEndPoint($segment);

    $x = (getX($beginPoint) + getX($endPoint)) / 2;
    $y = (getY($beginPoint) + getY($endPoint)) / 2;

    return makeDecartPoint($x, $y);
}