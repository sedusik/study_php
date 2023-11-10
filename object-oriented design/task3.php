

/*
Реализуйте функцию toStd(), которая принимает на вход ассоциативный массив и возвращает объект типа stdClass такой же структуры. Выполните задачу, проставляя ключи и значения вручную без использования преобразования типа.

Примеры
<?php

$data = [
    'key' => 'value',
    'key2' => 'value2',
];
$config = toStd($data);

$config->key; // value
$config->key2; // value2

*/



<?php

namespace App\Converter;

function toStd($array)
{
    $std = new \stdClass();

    foreach ($array as $key => $value) {
        $std->$key = $value;
    }
    return $std;
}
