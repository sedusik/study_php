

/*
Реализуйте функцию compressImages(), которая принимает на вход директорию, находит внутри нее картинки и "сжимает" их. Под сжиманием понимается уменьшение свойства size в метаданных в два раза. Функция должна вернуть обновленную директорию со сжатыми картинками и всеми остальными данными, которые были внутри этой директории.

Картинками считаются все файлы заканчивающиеся на .jpg.

Примеры
<?php
 
use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function App\tree\compressImages;
 
$tree = mkdir(
    'my documents', [
        mkfile('avatar.jpg', ['size' => 100]),
        mkfile('passport.jpg', ['size' => 200]),
        mkfile('family.jpg',  ['size' => 150]),
        mkfile('addresses',  ['size' => 125]),
        mkdir('presentations')
    ]
);
 
$newTree = compressImages($tree);
// То же самое, что и tree, но во всех картинках размер уменьшен в два раза



*/

//Мое решение 1:


<?php

namespace App\tree;

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function Php\Immutable\Fs\Trees\trees\isFile;
use function Php\Immutable\Fs\Trees\trees\getChildren;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\getMeta;

function compressImages($tree)
{
    $children = getChildren($tree);
    $newChildren = array_map(function ($child) {
        $name = getName($child);
        if (isFile($child) && substr($name, -3) === 'jpg') {
            $size = getMeta($child)['size'] / 2;
            return mkfile($name, ['size' => $size]);
        }
        return $child;
    }, $children);
    return mkdir(getName($tree), $newChildren, getMeta($tree));
}

//Решение учителя:

function compressImages($node)
{
    $children = getChildren($node);
    $newChildren = array_map(function ($child) {
        $name = getName($child);
        if (!isFile($child) || !str_ends_with($name, '.jpg')) {
            return $child;
        }

        $meta = getMeta($child);
        $meta['size'] /= 2;

        return mkfile($name, $meta);
    }, $children);

    return mkdir(getName($node), $newChildren, getMeta($node));
}