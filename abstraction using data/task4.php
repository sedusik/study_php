

/*
В этой задаче, тесты написаны для отрезков, которые в свою очередь используют точки. Ваша задача, реализовать интерфейсные функции для работы с точками. Внутреннее представление точек должно быть основано на полярной системе координат, хотя интерфейс предполагает работу с декартовой системой (снаружи).

src\Points.php
Реализуйте интерфейсные функции точек:

makePoint(). Принимает на вход координаты и возвращает точку. Уже реализован.
getX()
getY()
<?php
 
$x = 4;
$y = 8;
 
// $point хранит в себе данные в полярной системе координат
$point = makePoint($x, $y);
 
// Здесь происходит преобразование из полярной в декартову
getX($point); // 4
getY($point); // 8

*/

//Мое решение:

<?php

namespace App\Points;

function makePoint($x, $y)
{
     return [
         'angle' => atan2($y, $x),
         'radius' => sqrt($x ** 2 + $y ** 2)
     ];
}

function getAngle($point)
{
    return $point['angle'];
}

function getRadius($point)
{
    return $point['radius'];
}

function getX($point)
{
    return getRadius($point) * cos(getAngle($point));
}

function getY($point)
{
    return getRadius($point) * sin(getAngle($point));
}