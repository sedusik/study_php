

/*
Реализуйте абстракцию для работы с рациональными числами включающую в себя следующие функции:

Конструктор makeRational - принимает на вход числитель и знаменатель, возвращает дробь.
Селектор getNumer - возвращает числитель
Селектор getDenom - возвращает знаменатель
Сложение add - складывает две переданные дроби
Вычитание sub - находит разность между двумя дробями
Не забудьте реализовать нормализацию дробей удобным для вас способом

<?php
$rat1 = makeRational(3, 9);
getNumer($rat1); // 1
getDenom($rat1); // 3

$rat2 = makeRational(10, 3);

$rat3 = add($rat1, $rat2);
RatToString($rat3); // 11/3

$rat4 = sub($rat1, $rat2);
RatToString($rat4); // -3/1


*/

//Мое решение:

<?php

namespace App\Rational;

use function App\Utils\gcd;

function makeRational($numer, $denom)
{
    if ($denom < 0) {
        $numer = -$numer;
        $denom = -$denom;
    }

    $gcd = gcd($numer, $denom);
    $normalNumer = $numer / $gcd;
    $normalDenom = $denom / $gcd;

    return ("{$normalNumer}/{$normalDenom}");
}

function getNumer($rat)
{
    return explode('/', $rat)[0];
}

function getDenom($rat)
{
    return explode('/', $rat)[1];
}

function add($rat1, $rat2)
{
    return makeRational(
        getNumer($rat1) * getDenom($rat2) + getNumer($rat2) * getDenom($rat1),
        getDenom($rat1) * getDenom($rat2)
    );
}

function sub($rat1, $rat2)
{
    return makeRational(
        getNumer($rat1) * getDenom($rat2) - getNumer($rat2) * getDenom($rat1),
        getDenom($rat1) * getDenom($rat2)
    );
}

function ratToString($rat)
{
    return getNumer($rat) . '/' . getDenom($rat);
}