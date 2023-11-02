

/*
Реализуйте функцию downcaseFileNames(), которая принимает на вход директорию (объект-дерево) и приводит имена всех файлов в этой и во всех вложенных директориях к нижнему регистру. Результат в виде обработанной директории возвращается наружу. Исходное дерево не изменяется.

Примеры
<?php

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function App\downcaseFileNames\downcaseFileNames;

$tree = mkdir('/', [
    mkdir('eTc', [
        mkdir('NgiNx'),
        mkdir('CONSUL', [
            mkfile('config.json'),
        ]),
    ]),
    mkfile('hOsts'),
]);

downcaseFileNames($tree);
// [
//      'name' => '/',
//      'type' => 'directory',
//      'meta' => [],
//      'children' => [
//           [
//                'name' => 'eTc',
//                'type' => 'directory',
//                'meta' => [],
//                'children' => [
//                     [
//                          'name' => 'NgiNx',
//                          'type' => 'directory',
//                          'meta' => [],
//                          'children' => [],
//                      ],
//                      [
//                          'name' => 'CONSUL',
//                          'type' => 'directory',
//                          'meta' => [],
//                          'children' => [
//                               [
//                                    'name' => 'config.json',
//                                    'type' => 'file',
//                                    'meta' => [],
//                               ]
//                          ],
//                      ],
//                 ],
//           ],
//           [
//                'name' => 'hosts',
//                'type' => 'file',
//                'meta' => [],
//           ],
//      ],
// ]

*/

//Мое решение 1:


<?php

namespace App\downcaseFileNames;

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function Php\Immutable\Fs\Trees\trees\isFile;
use function Php\Immutable\Fs\Trees\trees\getName;
use function Php\Immutable\Fs\Trees\trees\getMeta;
use function Php\Immutable\Fs\Trees\trees\getChildren;

function downcaseFileNames($tree)
{
    $name = getName($tree);
    if (isFile($tree)) {
        return mkfile(strtolower($name), getMeta($tree));
    }
    $children = getChildren($tree);
    $newChildren = array_map(fn($child) => downcaseFileNames($child), $children);
    $newTree = mkdir($name, $newChildren, getMeta($tree));
    return $newTree;
}