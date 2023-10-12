

/*
Реализуйте функцию pick, которая извлекает из переданного массива все элементы по указанным ключам и возвращает новый массив. Аргументы:

Исходный массив
Массив ключей, по которым должны быть выбраны элементы (ключ и значение) из исходного массива, и на основе выбранных данных сформирован новый массив
Примеры
<?php

$data = [
    'user' => 'ubuntu',
    'cores' => 4,
    'os' => 'linux',
    'null' => null
];

pick($data, ['user']);       // → ['user' => 'ubuntu']
pick($data, ['user', 'os']); // → ['user' => 'ubuntu', 'os' => 'linux']
pick($data, []);             // → []
pick($data, ['none']);       // → []
pick($data, ['null'])        // → ['null' => null]

*/

//Мое решение:


<?php

function pick($data, $keys)
{
    $result = [];
    foreach ($data as $key => $value) {
        for ($i = 0; $i < count($keys); $i++) {
            if ($keys[$i] === $key) {
                $result[$key] = $value;
            }
        }
    }
    return $result;
}

//Решение учителя:
function pick(array $data, array $keys)
{
    $result = [];
    foreach ($keys as $key) {
        if (array_key_exists($key, $data)) {
            $result[$key] = $data[$key];
        }
    }

    return $result;
}