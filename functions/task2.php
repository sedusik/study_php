

/*
Реализуйте функцию average, которая возвращает среднее арифметическое всех переданных аргументов. Если функции не передать ни одного аргумента, то она должна вернуть null.

Примеры использования
<?php

average(0); // 0
average(0, 10); // 5
average(-3, 4, 2, 10); // 3.25
average(); // null

*/

//Мое решение:


function average(...$num)
{
    if (count($num) === 0) {
        return null;
    }
    $result = array_sum($num) / count($num);
    return $result;
}