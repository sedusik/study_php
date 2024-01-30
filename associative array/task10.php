

/*

Реализуйте набор функций, для работы со словарём, построенным на хеш-таблице. Для простоты, наша реализация не поддерживает разрешение коллизий.

По сути в этом задании надо реализовать ассоциативный массив. По понятным причинам использовать ассоциативные массивы для их создания нельзя. Представьте что в языке ассоциативных массивов нет и мы их хотим добавить.

make() — создаёт новый словарь
set($map, $key, $value) — устанавливает в словарь значение по ключу. Работает и для создания и для изменения. Функция возвращает true, если удалось установить значение. При возникновении коллизии, функция никак не меняет словарь и возвращает false
get($map, $key, $defaultValue = null) — читает в словаре значение по ключу и возвращает его. Параметр $defaultValue — значение, которое функция возвращает, если в словаре нет ключа (по умолчанию равно null). При возникновении коллизии функция также возвращает значение по умолчанию
Функции set() и get() принимают первым параметром словарь. Передача идет по ссылке, поэтому set() может изменить его напрямую.

Для полноценного погружения в тему, считаем, что массив в PHP может использоваться только как индексированный массив.

Примеры
<?php

use function App\Map\make;
use function App\Map\get;
use function App\Map\set;

$map = make();
$result = get($map, 'key');
print_r($result); // => null

$result = get($map, 'key', 'value');
print_r($result); // => value

set($map, 'key2', 'value2');
$result = get($map, 'key2');
print_r($result); // => value2


*/

//Мое решение:


<?php

function getIndex($key)
{
    return crc32($key) % 1000;
}

function make()
{
    return [];
}

function hasCollision($map, $key)
{
    $index = getIndex($key);
    [$currentKey] = $map[$index];
    return $currentKey !== $key;
}

function set(&$map, $key, $value)
{
    $index = getIndex($key);
    if (isset($map[$index]) && hasCollision($map, $key)) {
        return false;
    }
    $map[$index] = [$key, $value];
    return true;
}

function get($map, $key, $default = null)
{
    $index = getIndex($key);
    if (!isset($map[$index]) || hasCollision($map, $key)) {
        return $default;
    }
    [, $value] = $map[$index];
    return $value;
}