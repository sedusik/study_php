

/*
Реализуйте функцию getChildren, которая принимает на вход список пользователей и возвращает плоский список их детей. Дети каждого пользователя хранятся в виде массива в ключе children

Пример использования
<?php

$users = [
    ['name' => 'Tirion', 'children' => [
        ['name' => 'Mira', 'birthday' => '1983-03-23']
    ]],
    ['name' => 'Bronn', 'children' => []],
    ['name' => 'Sam', 'children' => [
        ['name' => 'Aria', 'birthday' => '2012-11-03'],
        ['name' => 'Keit', 'birthday' => '1933-05-14']
    ]],
    ['name' => 'Rob', 'children' => [
        ['name' => 'Tisha', 'birthday' => '2012-11-03']
    ]],
];

getChildren($users);
// [
//     ['name' => 'Mira', 'birthday' => '1983-03-23'],
//     ['name' => 'Aria', 'birthday' => '2012-11-03'],
//     ['name' => 'Keit', 'birthday' => '1933-05-14'],
//     ['name' => 'Tisha', 'birthday' => '2012-11-03']
// ]

*/

//Мое решение:


<?php

function getChildren($users)
{
    $children = array_map(fn($user) => $user['children'], $users);
    return flatten($children);
}