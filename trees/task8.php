

/*
Реализуйте функцию findFilesByName(), которая принимает на вход файловое дерево и подстроку, а возвращает список файлов, имена которых содержат эту подстроку.

Примеры
<?php

use function Php\Immutable\Fs\Trees\trees\mkdir;
use function Php\Immutable\Fs\Trees\trees\mkfile;
use function App\findFilesByName\findFilesByName;

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

findFilesByName($tree, 'co');
// ['/etc/nginx/nginx.conf', '/etc/consul/config.json']


*/

//Мое решение:


<?php

function iter($node, $subStr, $ancestry, $acc)
{
    $name = getName($node);
    $newAncestry = ($name === '/') ? '' : "$ancestry/$name";
    if (isFile($node)) {
        if (str_contains($name, $subStr)) {
            $acc[] = $newAncestry;
        }
        return $acc;
    }

    return array_reduce(
        getChildren($node),
        function ($newAcc, $child) use ($subStr, $newAncestry) {
            return iter($child, $subStr, $newAncestry, $newAcc);
        },
        $acc
    );
}


function findFilesByName($root, $subStr)
{
    return iter($root, $subStr, '', []);
}