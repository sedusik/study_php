

/*
Реализуйте функцию getManWithLeastFriends, которая принимает список пользователей и возвращает пользователя, у которого меньше всего друзей.

Примечания
Если список пользователей пустой, то возвращается null
Если в списке есть более одного пользователя с минимальным количеством друзей, то возвращается последний из таких пользователей
Примеры
<?php

$users = [
    ['name' => 'Tirion', 'friends' => [
        ['name' => 'Mira', 'gender' => 'female'],
        ['name' => 'Ramsey', 'gender' => 'male']
    ]],
    ['name' => 'Bronn', 'friends' => []],
    ['name' => 'Sam', 'friends' => [
        ['name' => 'Aria', 'gender' => 'female'],
        ['name' => 'Keit', 'gender' => 'female']
    ]],
    ['name' => 'Keit', 'friends' => []],
    ['name' => 'Rob', 'friends' => [
        ['name' => 'Taywin', 'gender' => 'male']
    ]],
];

getManWithLeastFriends($users);
// => ['name' => 'Keit', 'friends' => []];

*/

//Мое решение:


<?php
use Funct\Collection;
function getManWithLeastFriends($users)
{
    if (empty($users)) {
        return null;
    }
    return Collection\minValue($users, function ($item) {
        return count($item['friends']);
    });
}