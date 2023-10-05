

/*
На многих картах, например google maps, реализован поиск мест находящихся рядом с выбранной точкой, например, текущим расположением. В этом задании мы реализуем подобную задачу в очень упрощенном варианте.

src/Location.php
Реализуйте функцию getTheNearestLocation(), которая находит место ближайшее к указанной точке на карте и возвращает его. Параметры функции:

$locations – массив мест на карте. Каждое место это массив из двух элементов, где первый элемент это название места, второй – точка на карте (массив из двух чисел x и y).
$point – текущая точка на карте. Массив из двух элементов-координат x и y.
Примеры
<?php

$locations = [
  ['Park', [10, 5]],
  ['Sea', [1, 3]],
  ['Museum', [8, 4]],
];

$point = [5, 5];

// Если точек нет, то возвращается null
getTheNearestLocation([], $point); // null

getTheNearestLocation($locations, $point); // ['Museum', [8, 4]]
Для решения этой задачи деструктуризация не нужна, но мы хотим её потренировать. Поэтому решите эту задачу без обращения к индексам массивов.

Подсказки
Расстояние между точками высчитывается с помощью функции getDistance().

*/

//Мое решение:


<?php

function getDistance(array $point1, array $point2)
{
    [$x1, $y1] = $point1;
    [$x2, $y2] = $point2;

    $xs = $x2 - $x1;
    $ys = $y2 - $y1;

    return sqrt($xs ** 2 + $ys ** 2);
}

function getTheNearestLocation($locations, $point)
{
    if (empty($locations)) {
        return null;
    }
    $result = $locations[0][0];
    $distance = getDistance($point, $locations[0][1]);
    foreach ($locations as $place) {
        if ((getDistance($point, $place[1])) < $distance) {
            $distance = getDistance($point, $place[1]);
            $result = $place;
        }
    }
    return $result;
}

//Мое решение2:
function getDistance(array $point1, array $point2)
{
    [$x1, $y1] = $point1;
    [$x2, $y2] = $point2;

    $xs = $x2 - $x1;
    $ys = $y2 - $y1;

    return sqrt($xs ** 2 + $ys ** 2);
}

function getTheNearestLocation($locations, $point)
{
    if (empty($locations)) {
        return null;
    }

    $result = $locations[0][0];
    $distance = getDistance($point, $locations[0][1]);
    foreach ($locations as [$place,[$a, $b]]) {
        if ((getDistance($point, [$a, $b])) < $distance) {
            $distance = getDistance($point, [$a, $b]);
            $result = [$place,[$a, $b]];
        }
    }
    return $result;
}

//Решение учителя:

function getDistance(array $point1, array $point2)
{
    [$x1, $y1] = $point1;
    [$x2, $y2] = $point2;

    $xs = $x2 - $x1;
    $ys = $y2 - $y1;

    return sqrt($xs ** 2 + $ys ** 2);
}


function getTheNearestLocation(array $locations, array $currentPoint)
{
    if (empty($locations)) {
        return null;
    }

    [$nearestLocation] = $locations;
    [, $nearestPoint] = $nearestLocation;
    $lowestDistance = getDistance($currentPoint, $nearestPoint);

    foreach ($locations as $location) {
        [, $point] = $location;
        $distance = getDistance($currentPoint, $point);

        if ($distance < $lowestDistance) {
            $lowestDistance = $distance;
            $nearestLocation = $location;
        }
    }

    return $nearestLocation;
}