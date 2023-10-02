

/*
PHP некорректно обрабытывает случаи обращения к массиву по индексу, которого нет в массиве. Поэтому существуют функции в библиотеках, которые могут корректно получить нужный элемент или сообщить, что такого элемента нет.
Например, функция array_get()

src\Arrays.php
Реализуйте функцию get, аналогичную приведённой выше array_get(), которая извлекает из массива элемент по переданному индексу, если такой индекс существует.
Если индекса нет, то функция возвращает значение по умолчанию. Функция принимает на вход три аргумента:

Массив
Индекс
Значение по умолчанию (равно null)
Примеры
<?php

use function App\Arrays\get;

$cities = ['moscow', 'london', 'berlin', 'porto', null];

get($cities, 1); // london
get($cities, 10, 'paris'); // paris
get($cities, 4); // null
get($cities, 4, 'default'); // null

*/

//Мое решение:


<?php
function get($array, $index, $value = null)
{
    if (array_key_exists($index, $array)) {
        return $array[$index];
    } else {
        return $value;
    }
}
//Мое решение 2:

<?php
function get($array, $index, $value = null)
{
    return array_key_exists($index, $array) ? $array[$index] : $value;
}