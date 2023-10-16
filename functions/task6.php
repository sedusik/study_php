

/*
Реализуйте функцию takeOldest, которая принимает на вход список пользователей и возвращает самых взрослых. Количество возвращаемых пользователей задается вторым параметром, который по-умолчанию равен единице.

Пример использования
<?php
$users = [
    ['name' => 'Tirion', 'birthday' => '1988-11-19'],
    ['name' => 'Sam', 'birthday' => '1999-11-22'],
    ['name' => 'Rob', 'birthday' => '1975-01-11'],
    ['name' => 'Sansa', 'birthday' => '2001-03-20'],
    ['name' => 'Tisha', 'birthday' => '1992-02-27']
];

takeOldest($users);
# Array (
#     ['name' => 'Rob', 'birthday' => '1975-01-11']
# )
*/

//Мое решение:


<?php

function takeOldest($users, $count = 1)
{
    $cmp = fn($a, $b) => $a['birthday'] <=> $b['birthday'];
    usort($users, $cmp);
    return(firstN($users, $count));
}

//Решение учителя:

function takeOldest(array $users, int $count = 1)
{
    usort(
        $users,
        fn($user1, $user2) => $user1['birthday'] <=> $user2['birthday']
    );

    return firstN($users, $count);
}