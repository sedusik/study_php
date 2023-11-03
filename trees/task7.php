

/*
Реализуйте функцию changeClass, которая принимает на вход html-дерево и заменяет во всех узлах переданное имя класса на новое. Имена классов передаются через параметры.

<?php

use function App\changeClass\changeClass;

$tree = [
    'name' => 'div',
    'type' => 'tag-internal',
    'className' => 'hexlet-community',
    'children' => [
        [
            'name' => 'div',
            'type' => 'tag-internal',
            'className' => 'old-class',
            'children' => [],
        ],
        [
            'name' => 'div',
            'type' => 'tag-internal',
            'className' => 'old-class',
            'children' => [],
        ],
    ],
];

$result = changeClass($tree, 'old-class', 'new-class');
// Результат:
// [
//     'name' => 'div',
//     'type' => 'tag-internal',
//     'className' => 'hexlet-community',
//     'children' => [
//         [
//             'name' => 'div',
//             'type' => 'tag-internal',
//             'className' => 'new-class',
//             'children' => [],
//         ],
//         [
//             'name' => 'div',
//             'type' => 'tag-internal',
//             'className' => 'new-class',
//             'children' => [],
//         ],
//     ],
// ]

*/

//Мое решение:


<?php

namespace App\changeClass;

function changeClass($node, $classNameFrom, $classNameTo)
{
    if (array_key_exists('className', $node)) {
        $node['className'] = $classNameFrom === $node['className'] ? $classNameTo : $node['className'];
    }
    if ($node['type'] === 'tag-internal') {
        $node['children'] = array_map(fn($item) => changeClass($item, $classNameFrom, $classNameTo), $node['children']);
    }
    return $node;
}