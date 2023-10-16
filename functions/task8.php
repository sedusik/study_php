

/*
Реализуйте функцию getGirlFriends, которая принимает на вход список пользователей и возвращает плоский список подруг всех пользователей (без сохранения ключей). Друзья каждого пользователя хранятся в виде массива в ключе friends. Пол доступен по ключу gender и может принимать значения male или female.

Пример использования
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
    ['name' => 'Rob', 'friends' => [
        ['name' => 'Taywin', 'gender' => 'male']
    ]],
];

getGirlFriends($users);
# Array (
#     ['name' => 'Mira', 'gender' => 'female'],
#     ['name' => 'Aria', 'gender' => 'female'],
#     ['name' => 'Keit', 'gender' => 'female']
# )

*/

//Мое решение:


<?php

function getGirlFriends($users)
{
    $friends = array_map(fn($user) => $user['friends'], $users);
    $friends = flatten($friends);
    $girlFriends = array_filter($friends, fn($user) => $user['gender'] === 'female');
    return array_values($girlFriends);
}