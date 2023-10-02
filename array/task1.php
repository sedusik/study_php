

/*
Реализуйте функцию apply(), которая применяет указанную операцию к переданному массиву и возвращает новый массив. Всего нужно реализовать три операции:

reset - Сброс массива
remove - Удаление значения по индексу
change - Обновление значения по индексу
<?php
 
use function App\Arrays\apply;
 
$cities = ['moscow', 'london', 'berlin', 'porto'];
 
// Сброс в пустой массив
apply($cities, 'reset'); // []
 
// удаление значения по индексу
apply($cities, 'remove', 1); // ['moscow', 'berlin', 'porto']
// изменение значения по индексу
apply($cities, 'change', 0, 'miami'); // ['miami', 'london', 'berlin', 'porto']

*/

//Мое решение:


<?php

function apply(array $items, string $operationName, int $index = null, $value = null): array
{
    if ($operationName === 'reset') {
        return $items = [];
    } elseif ($operationName === 'remove') {
        unset($items[$index]);
        return $items;
    } elseif ($operationName === 'change') {
        $items[$index] = $value;
        return $items;
    }
}

//Решение учителя:

function apply(array $items, string $operationName, int $index = null, $value = null): array
{
    $result = $items;
    switch ($operationName) {
        case 'reset':
            $result = [];
            break;
        case 'change':
            $result[$index] = $value;
            break;
        case 'remove':
            unset($result[$index]);
            break;
    }
    return $result;