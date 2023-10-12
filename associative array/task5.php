

/*
Реализуйте функцию getIn, которая извлекает из массива (который может быть любой глубины вложенности) значение по указанным ключам. Аргументы:

Исходный массив
Массив ключей, по которым ведется поиск значения
В случае, когда добраться до значения невозможно, возвращается null.

<?php

$data = [
    'user' => 'ubuntu',
    'hosts' => [
        ['name' => 'web1'],
        ['name' => 'web2', null => 3, 'active' => false]
    ]
];

getIn($data, ['undefined']); // null
getIn($data, ['user']); // 'ubuntu'
getIn($data, ['user', 'ubuntu']); // null
getIn($data, ['hosts', 1, 'name']); // 'web2'
getIn($data, ['hosts', 0]); // ['name' => 'web1']
getIn($data, ['hosts', 1, null]); // 3
getIn($data, ['hosts', 1, 'active']); // false


*/

//Мое решение:


function getIn($data, $keys)
{
    $new = $data;
    foreach ($keys as $key) {
        if (!is_array($new) || !array_key_exists($key, $new)) {
            return null;
        }
        $new = $new[$key];
    }
    return $new;
}