

/*
Во многих операционных системах (Linux, MacOS) существует утилита du. Она умеет считать место в указанных файлах и директориях. Например, так:

 tmp$ du -sh *
  0B    com.docker.vmnetd.socket
 10M    credo
4.0K    debug.mjs
  0B    filesystemui.socket
4.0K    index.php
 37M    vendor
 88K    composer-lock.json
 22M    taxdome

src/du.php
Реализуйте функцию du(), которая принимает на вход директорию. Функция возвращает список узлов (директорий и файлов), вложенных в указанную директорию на один уровень, и место, которое они занимают. Размер файла задается в метаданных. Размер директории складывается из сумм всех размеров файлов, находящихся внутри во всех подпапках. Сами папки размера не имеют.

Пример
<?php

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function App\du\du;

$tree = mkdir('/', [
    mkdir('etc', [
        mkdir('apache'),
        mkdir('nginx', [
            mkfile('nginx.conf', ['size' => 800]),
        ]),
        mkdir('consul', [
            mkfile('config.json', ['size' => 1200]),
            mkfile('data', ['size' => 8200]),
            mkfile('raft', ['size' => 80]),
        ]),
    ]),
    mkfile('hosts', ['size' => 3500]),
    mkfile('resolve', ['size' => 1000]),
]);

du($tree);
// [
//     ['etc', 10280],
//     ['hosts', 3500],
//     ['resolve', 1000],
// ]
Примечания
Обратите внимание на структуру результирующего массива. Каждый элемент — массив с двумя значениями: именем директории и размером файлов внутри.
Результат отсортирован по размеру в обратном порядке. То есть сверху самые тяжёлые, внизу самые лёгкие.


*/

//Мое решение 1:


<?php

namespace App\du;

use function Php\Immutable\Fs\Trees\trees\isDirectory;
use function Php\Immutable\Fs\Trees\trees\reduce;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\getMeta;
use function Php\Immutable\Fs\Trees\trees\getChildren;

function getSizeFiles($tree)
{
    if (!isDirectory($tree)) {
        return getMetA($tree)['size'];
    }
    $children = getChildren($tree);
    $descandantsSize = array_map(fn($child) => getSizeFiles($child), $children);
    return array_sum($descandantsSize);
}

function du($tree)
{
    $children = getChildren($tree);
    $result = array_map(fn($child) => [getName($child), getSizeFiles($child)], $children);
    usort($result, fn ($a, $b) => $b[1] <=> $a[1]);
    return $result;
}

//Решение учителя:

function calculateFilesSize($node)
{
    return reduce(function ($acc, $n) {
        if (isDirectory($n)) {
            return $acc;
        }

        $meta = getMeta($n);

        return $acc + $meta['size'];
    }, $node, 0);
}

function du($node)
{
    $result = array_map(fn($node) => [
        getName($node), calculateFilesSize($node)
    ], getChildren($node));

    usort($result, fn($arr1, $arr2) => $arr2[1] <=> $arr1[1]);

    return $result;
}