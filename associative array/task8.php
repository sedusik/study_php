

/*

Реализуйте функцию buildQueryString, которая принимает на вход список параметров и возвращает сформированный query string из этих параметров:

Примеры
<?php

buildQueryString(['per' => 10, 'page' => 1 ]);
// → page=1&per=10
Имена параметров в выходной строке должны располагаться в алфавитном порядке (то есть их нужно отсортировать).

*/

//Мое решение:


<?php

function buildQueryString($list)
{
    $result = [];
    ksort($list);
    foreach ($list as $key => $value) {
        $result[] = "{$key}={$value}";
    }
    return implode('&', $result);
}