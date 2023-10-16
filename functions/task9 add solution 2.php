

/*
Реализуйте функцию getMenCountByYear(), которая принимает на вход список пользователей и возвращает массив, в котором ключ это год рождения, а значение это количество мужчин, родившихся в этот год.

<?php

$users = [
    ['name' => 'Bronn', 'gender' => 'male', 'birthday' => '1973-03-23'],
    ['name' => 'Reigar', 'gender' => 'male', 'birthday' => '1973-11-03'],
    ['name' => 'Eiegon',  'gender' => 'male', 'birthday' => '1963-11-03'],
    ['name' => 'Sansa', 'gender' => 'female', 'birthday' => '2012-11-03'],
    ['name' => 'Jon', 'gender' => 'male', 'birthday' => '1980-11-03'],
    ['name' => 'Robb','gender' => 'male', 'birthday' => '1980-05-14'],
    ['name' => 'Tisha', 'gender' => 'female', 'birthday' => '2012-11-03'],
    ['name' => 'Rick', 'gender' => 'male', 'birthday' => '2012-11-03'],
    ['name' => 'Joffrey', 'gender' => 'male', 'birthday' => '1999-11-03'],
    ['name' => 'Edd', 'gender' => 'male', 'birthday' => '1973-11-03']
];

getMenCountByYear($users);
# Array (
#     1973 => 3,
#     1963 => 1,
#     1980 => 2,
#     2012 => 1,
#     1999 => 1
# );

*/

//Мое решение:


<?php

function getMenCountByYear($users)
{
    $mens = array_filter($users, fn($user) => $user['gender'] === 'male');
    $mens = array_values($mens);
    $menCountByYear = array_reduce($mens, function ($acc, $user) {
        $acc[$user['birthday']][] = $user['name'];
        return $acc;
    }, []);
    $res = [];
    foreach ($menCountByYear as $key => $value) {
        $timestamp = strtotime($key);
        $year = date('Y', $timestamp);
        if (array_key_exists($year, $res)) {
            $res[$year] += count($value);
        } else {
            $res[$year] = count($value);
        }
    }
    return $res;
}

//Мое решение2:

