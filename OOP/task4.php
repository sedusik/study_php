

/*
Реализуйте функцию areUsersEqual($user1, $user2), которая сравнивает переданных пользователей на основе значений их идентификаторов (свойство id). При этом функция должна убедиться, что переданные объекты - пользователи. Сделайте это через указание типов для аргументов функции.

<?php

use function App\UserFunctions\areUsersEqual;

$user1 = new User();
$user1->id = 1;

$user2 = new User();
$user2->id = 1;

// 1 === 1
areUsersEqual($user1, $user2); // true

// У пользователя другой id
$user3 = new User();
$user3->id = 3;

// 1 === 3
areUsersEqual($user1, $user3); // false
// 1 === 3
areUsersEqual($user2, $user3); // false

// Другой тип
$cat = new Cat();
$cat->id = 1;

// Сравниваются разные типы, поэтому проверка завершается с ошибкой
areUsersEqual($user1, $cat); // Boom! (error)
*/


<?php

namespace App\UserFunctions;

use App\User;

function areUsersEqual(User $user1, User $user2)
{
    return $user1->id === $user2->id;
}