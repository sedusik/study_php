

/*
Реализуйте функцию genDiff, которая сравнивает два ассоциативных массива и возвращает результат сравнения в виде ассоциативного массива. Ключами результирующего массива будут все ключи из двух входящих массивов, а значением строка с описанием отличий => added, deleted, changed или unchanged.

Возможные значения:

added — ключ отсутствовал в первом массиве, но был добавлен во второй
deleted — ключ был в первом массиве, но отсутствует во втором
changed — ключ присутствовал и в первом и во втором массиве, но значения отличаются
unchanged — ключ присутствовал и в первом и во втором массиве с одинаковыми значениями
<?php

use function App\Solution\genDiff;

$result = genDiff(
    ['one' => 'eon', 'two' => 'two', 'four' => true],
    ['two' => 'own', 'zero' => 4, 'four' => true]
);
// [
//   'one' => 'deleted',
//   'two' => 'changed',
//   'four' => 'unchanged',
//   'zero' => 'added',
// ]
*/

//Мое решение:


<?php

function genDiff($arr1, $arr2)
{
    $currArr = array_merge($arr1, $arr2);
    foreach ($currArr as $key => $value) {
        if (!array_key_exists($key, $arr1) && array_key_exists($key, $arr2)) {
            $currArr[$key] = 'added';
        } elseif (array_key_exists($key, $arr1) && !array_key_exists($key, $arr2)) {
            $currArr[$key] = 'deleted';
        } elseif ($arr1[$key] != $arr2[$key]) {
            $currArr[$key] = 'changed';
        } elseif ($arr1[$key] == $arr2[$key]) {
            $currArr[$key] = 'unchanged';
        }
    }
    return $currArr;
}

//
//Решение учителя:
function genDiff(array $data1, array $data2)
{
    $keys = array_merge(array_keys($data1), array_keys($data2)); // https://youtu.be/vkUTX1hruF8?t=929
    $result = [];
    foreach ($keys as $key) {
        // https://ru.hexlet.io/courses/php-associative-arrays/lessons/syntax/theory_unit
        if (!array_key_exists($key, $data1)) {
            $result[$key] = 'added';
        } elseif (!array_key_exists($key, $data2)) {
            $result[$key] = 'deleted';
        } elseif ($data1[$key] !== $data2[$key]) {
            $result[$key] = 'changed';
        } else {
            $result[$key] = 'unchanged';
        }
    }

    return $result;
}