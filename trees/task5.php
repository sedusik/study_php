

/*
Реализуйте функцию getHiddenFilesCount(), которая считает количество скрытых файлов в директории и всех поддиректориях. Скрытым файлом в Linux системах считается файл, название которого начинается с точки.

Примеры
<?php

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function App\getHiddenFilesCount\getHiddenFilesCount;

$tree = mkdir('/', [
    mkdir('etc', [
    mkdir('apache', []),
    mkdir('nginx', [
        mkfile('.nginx.conf', ['size' => 800]),
    ]),
    mkdir('.consul', [
        mkfile('.config.json', ['size' => 1200]),
        mkfile('data', ['size' => 8200]),
        mkfile('raft', ['size' => 80]),
    ]),
    ]),
    mkfile('.hosts', ['size' => 3500]),
    mkfile('resolve', ['size' => 1000]),
]);


getHiddenFilesCount($tree); // 3


*/

//Мое решение 1:


<?php

namespace App\getHiddenFilesCount;

use function Php\Immutable\Fs\Trees\trees\isFile;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\getChildren;

function getHiddenFilesCount($tree)
{
    $name = getName($tree);

    if (isFile($tree)) {
        return substr($name, 0, 1) === '.' ? 1 : 0;
    }

    $children = getChildren($tree);
    $hiddenFilesCount = array_map(fn($child) => getHiddenFilesCount($child), $children);
    return array_sum($hiddenFilesCount);
}

//Решение учителя:

function getHiddenFilesCount($node)
{
    $name = getName($node);
    if (isFile($node)) {
        return str_starts_with($name, '.') ? 1 : 0;
    }

    $children = getChildren($node);

    return array_reduce($children, fn($acc, $child) => $acc + getHiddenFilesCount($child));
}