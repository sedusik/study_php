

/*
В этом задании под деревом понимается любой массив элементов, которые в свою очередь могут быть также деревьями (массивами). Пример:

[
  3, // лист
  [5, 3], // узел
  [[2]] // узел
]
Больше примеров в тестах.

removeFirstLevel.php
Реализуйте функцию removeFirstLevel(), которая принимает на вход дерево, и возвращает новое, элементами которого являются дети вложенных узлов (см. пример).

Примеры
<?php

use function App\removeFirstLevel\removeFirstLevel;

// Второй уровень тут: 5, 3, 4
$tree1 = [[5], 1, [3, 4]];
removeFirstLevel($tree1); // [5, 3, 4]

$tree2 = [1, 2, [3, 5], [[4, 3], 2]];
removeFirstLevel($tree2); // [3, 5, [4, 3], 2]


*/

//Мое решение 1:


<?php

namespace App\removeFirstLevel;

function removeFirstLevel($tree)
{
    $newTree = [];
    foreach ($tree as $item) {
        if (is_array($item)) {
            foreach ($item as $subitem) {
                $newTree[] = $subitem;
            }
        }
    }
    return $newTree;
}

//Мое решение 2:

function removeFirstLevel($tree)
{
    $nodes = array_filter($tree, fn($node) => is_array($node));
    return array_merge(...$nodes);
}