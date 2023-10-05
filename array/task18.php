

/*
Реализуйте функцию flatten(). Эта функция принимает на вход массив и выпрямляет его: если элементами массива являются массивы, то flatten() сводит всё к одному массиву, раскрывая один уровень вложенности.

Пример:
use function App\Arrays\flatten;

// Для пустого массива возвращается []
flatten([]); // []
flatten([1, [3, 2], 9]); // [1, 3, 2, 9]
flatten([1, [[2], [3]], [9]]); // [1, [2], [3], 9]
Реализуйте добавление элементов вложенного массива в результирующий через spread-оператор.

*/

//Мое решение:


<?php

function flatten($array)
{
    $result = [];
    foreach ($array as $item) {
        if (is_array($item)) {
            foreach ($item as $subitem) {
                $result[] = $subitem;
            }
        } else {
            $result[] = $item;
        }
    }
    return $result;
}

//Решение2:

function flatten($coll)
{
    $result = [];
    foreach ($coll as $item) {
        if (is_array($item)) {
            $result = [...$result, ...$item];
        } else {
            $result[] = $item;
        }
    }

    return $result;