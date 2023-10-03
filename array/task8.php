

/*
Реализуйте функцию getSameParity, которая принимает на вход массив чисел и возвращает новый, состоящий из элементов, у которых такая же чётность, как и у первого элемента входного массива.

Примеры
<?php

getSameParity([]);        // []
getSameParity([1, 2, 3]); // [1, 3]
getSameParity([1, 2, 8]); // [1]
getSameParity([2, 2, 8]); // [2, 2, 8]
Подсказки
Проверка чётности - остаток от деления: $item % 2 === 0 — чётное число
Если на вход функции передан пустой массив, то она должна вернуть пустой массив. Проверить массив на пустоту можно с помощью функции empty

*/

//Мое решение:


<?php

function getSameParity($array)
{
    if (empty($array)) {
        return [];
    }
    $start = $array[0];
    $result = [];
    foreach ($array as $value) {
        if ($start % 2 === 0 && $value % 2 === 0) {
            $result[] = $value;
        } elseif ($start % 2 !== 0 && $value % 2 !== 0) {
            $result[] = $value;
        }
    }
    return $result;
}

//Решение учителя:

function getSameParity($coll)
{
    if (empty($coll)) {
        return [];
    }

    $result = [];
    $remainder = $coll[0] % 2;
    foreach ($coll as $item) {
        if ($item % 2 === $remainder) {
            $result[] = $item;
        }
    }

    return $result;
}