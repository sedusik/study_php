

/*
Реализуйте функцию addPrefix, которая добавляет к каждому элементу массива переданный префикс и возвращает получившийся массив. Функция предназначена для работы со строковыми элементами. Аргументы:

Массив
Префикс
После префикса автоматически добавляется пробел.

<?php

use function App\Arrays\addPrefix;

$names = ['john', 'smith', 'karl'];

$newNames = addPrefix($names, 'Mr');
print_r($newNames);
// => ['Mr john', 'Mr smith', 'Mr karl'];


*/

//Мое решение:


<?php

function addPrefix($array, $prefix)
{
    $newArray = array();
    for ($i = 0; $i < count($array); $i++) {
        $newArray[$i] = "{$prefix} {$array[$i]}";
    }
    return $newArray;
}